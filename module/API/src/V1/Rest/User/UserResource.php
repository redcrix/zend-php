<?php

namespace API\V1\Rest\User;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use API\V1\Rest\Image\ImageResource;
use API\V1\Entity\User;
use API\V1\Entity\Address;
use API\V1\Entity\EmailToken;

class UserResource extends AbstractResourceListener {

    use \API\V1\Util\Comum\ConstructorUtils;

    /**
     * Perfil a ser buscado
     * @var string
     */
    protected $role = 'admin';

    /**
     * Persiste um usuário
     *
     * @param stdClass $data
     * @return ApiProblem|mixed
     */
    public function create($data) {
        $permitidos = ['admin'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $user = $this->getVerifyUser($data);
        if (!$user) {
            return new ApiProblem(428, 'users_erros_existing_user');
        }

        $user = $this->persistAddress($user, $data);
        $user = $this->persistPhoto($user, $data);

        if ($data->id == 'novo') {
            $user->setBlocked(false)
                    ->setDeleted(false)
                    ->setEmailConfirmation(false)
                    ->setPasswordReset(true)
                    ->setPassword('NewUserPassword')
                    ->setCreation(new \DateTime())
                    ->setRole('admin')
                    ->setSession('{"path": ""}')
                    ->setUpdate(new \DateTime());
        }

        $user->setDocument($data->documento)
                ->setName($data->nome)
                ->setPhone($data->phone);

        if ($data->id == 'novo') {
            $this->newUserEmailConfig($user);
        }

        $this->em->persist($user);
        $this->em->flush();

        return $this->fetch($user->getId());
    }

    /**
     * Configura e envia um e-mail com link para conclusão do cadastro
     * @param User $user
     */
    protected function newUserEmailConfig(User $user) {

        $config = $this->config['frontend']['uri'];
        $link = $config . '/email-confirmation/' . $this->createToken($user);

        $dicionario = $this->getDicionario();
        $text = str_replace('%name%', $user->getName(), $dicionario['register_user_layout_email_desc']);
        $title = str_replace('%name%', $user->getName(), $dicionario['register_user_layout_email_title']);
        $subject = str_replace('%name%', $user->getName(), $dicionario['register_user_title']);

        $vars = json_encode([
            'personalizations' => [
                [
                    'to' => [
                        [
                            'email' => $user->getUsername(),
                            'name' => $user->getName()
                        ]
                    ],
                    'dynamic_template_data' => [
                        'link' => $link,
                        'title' => $title,
                        'button' => $dicionario['register_password_layout_email_button'],
                        'text' => $text,
                        'subject' => $subject
                    ]
                ]
            ],
            'from' => [
                'email' => 'support@inetpet.com',
                'name' => 'Chris Matt'
            ],
            'reply_to' => [
                'email' => 'support@inetpet.com',
                'name' => 'Chris Matt'
            ],
            'template_id' => 'd-b7dc266d96cb434eaf18a7c4ac17fb34'
        ]);

        $this->sendEmail($vars);
    }

    /**
     * Gerador de token para confirmação de email
     * 
     * @param User $user
     * @return string
     */
    public function createToken(User $user, $tipo = 'ativar-email') {
        $token = md5(date('Ymdis') . $user->getUsername()) . md5($tipo) . md5($user->getPassword());

        $emailToken = new EmailToken();
        $emailToken->setDateSend(new \DateTime());
        $emailToken->setEmail($user->getUsername());
        $emailToken->setToken($token);
        $emailToken->setType($tipo);
        $emailToken->setIsUsed(false);

        $this->em->persist($emailToken);
        $this->em->flush();

        return $token;
    }

    /**
     * Persiste uma imagem a um usuário
     * @param User $user
     * @param type $data
     * @return User
     */
    protected function persistPhoto(User $user, $data) {
        if (isset($data->foto['id'])) {
            if ($data->foto['id'] == 0) {
                $imagemResource = new ImageResource($this->em);
                $foto = $imagemResource->saveInternal(
                        $data->foto['logo'], $user->getPhoto()
                );
                $user->setPhoto($foto);
            }
        }
        return $user;
    }

    /**
     * Persiste um endereço a um usuário
     * @param User $user
     * @param stdClass $data
     * @return User
     */
    public function persistAddress(User $user, $data) {
        $address = $user->getAddress();
        if (!$address && $this->checkAddress($data)) {
            $address = new Address();
        }

        if (!!$address) {
            $address->setAddress($data->endereco)
                    ->setNumber($data->numero)
                    ->setAddress2($data->bairro)
                    ->setAddress3($data->complemento)
                    ->setCity($data->cidade)
                    ->setState($data->estado)
                    ->setZipcode($data->cep)
                    ->setCountry($data->pais);
            $this->em->persist($address);
        }

        $user->setAddress($address);
        return $user;
    }

    /**
     * Checa se existe informações de endereço
     * @param stdClass $data
     * @return boolean
     */
    protected function checkAddress($data) {
        $keys = [
            'endereco', 'numero', 'bairro', 'cidade',
            'estado', 'pais', 'complemento', 'cep'
        ];
        foreach ($data as $key => $v) {
            if (in_array($key, $keys)) {
                if (isset($v)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Recupera um usuario
     * @param stdClass $data
     * @return User
     */
    public function getVerifyUser($data, $externo = false, $role = null) {

        if (!!$role) {
            $this->role = $role;
        }
        
        $user = $this->getUserByUsername($data->username);
        
        # Usuário novo
        if (!$user && $data->id == 'novo') {
            $user = new User();
            $user->setUsername($data->username);
            return $user;
        }

        # Usuário mudando Username
        if (!$user && $data->id != 'novo') {
            $user = $this->getUserById($data->id);
            $user->setUsername($data->username);
            return $user;
        }

        if ($externo) {
            return $user->getId() == $data->usuarioId ? $user : false;
        }

        return $user->getId() == $data->id ? $user : false;
    }

    /**
     * Deleta um usuário do sistema
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id) {
        $permitidos = ['admin'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $qb = $this->em->createQueryBuilder();
        $qb->select('u');
        $qb->from(User::class, 'u');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->setParameter('role', 'admin');
        $all = $qb->getQuery()->getResult();

        if (count($all) == 1) {
            return false;
        }

        $user = $this->getUserById($id);
        if ($user->getPhoto()) {
            $this->em->remove($user->getPhoto());
        }
        if ($user->getAddress()) {
            $this->em->remove($user->getAddress());
        }
        $this->em->remove($user);
        $this->em->flush();

        return true;
    }

    /**
     * Recupera um administrador
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id) {
        $permitidos = ['admin'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $qb = $this->getUserQueryBuilder();
        $qb->andWhere('u.id = :id');
        $qb->setParameter('id', $id);
        $user = $qb->getQuery()->getArrayResult();

        if (count($user) == 1) {
            $user = $user[0];
            unset($user['password']);
            unset($user['deleted']);
            unset($user['blocked']);
            unset($user['session']);
            return [
                'user' => $user
            ];
        }

        return new ApiProblem(428, 'User not founded!');
    }

    /**
     * Recupera usuários administrativos
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = []) {
        $permitidos = ['admin'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $qb = $this->em->createQueryBuilder();
        $qb->select('u');
        $qb->from(User::class, 'u');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->setParameter('role', 'admin');

        if (isset($params['search'])) {
            $buscar = [
                'u.name LIKE :busca',
                'u.username LIKE :busca'
            ];

            $qb->andWhere(\join(' OR ', $buscar));
            $qb->setParameter('busca', "%{$params['search']}%");
        }
        $qb->orderBy('u.name', 'ASC');
        $qb->addOrderBy('u.username', 'ASC');

        $arr = $qb->getQuery()->getArrayResult();
        return new UserCollection($arr);
    }

}
