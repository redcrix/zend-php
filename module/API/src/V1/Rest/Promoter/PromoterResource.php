<?php

namespace API\V1\Rest\Promoter;

use ZF\ApiProblem\ApiProblem;
use API\V1\Rest\User\UserResource;
use API\V1\Entity\Promoter;
use API\V1\Entity\User;

/**
 * REST para promotores
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class PromoterResource extends UserResource {

    /**
     * Perfil a ser buscado
     * @var string
     */
    protected $role = 'promoter';

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

        $user = $this->getVerifyUser($data, true);
        if (!$user) {
            return new ApiProblem(428, 'users_erros_existing_user');
        }

        if (!$this->checkBase($data, $user)) {
            return new ApiProblem(428, 'Base já existe!');
        }

        # $user = $this->persistAddress($user, $data);
        $user = $this->persistPhoto($user, $data);

        if ($data->id == 'novo') {
            $promotor = new Promoter();
            $user->setBlocked(false)
                    ->setDeleted(false)
                    ->setEmailConfirmation(false)
                    ->setPasswordReset(true)
                    ->setPassword('NewUserPassword')
                    ->setCreation(new \DateTime())
                    ->setRole('promoter')
                    ->setSession('{"path": ""}')
                    ->setUpdate(new \DateTime());
            $mandarEmail = true;
            $promotor->setUser($user);
        } else {
            $qb = $this->getPromoterById($data->id);
            $promotor = $qb->getQuery()->getSingleResult();
        }

        $user->setDocument($data->documento)
                ->setName($data->nome)
                ->setPhone($data->phone);

        $data->base = str_replace(' ', '', $data->base);
        $promotor->setBase(strtolower($data->base))
                ->setCommission($data->commission);

        if ($data->id == 'novo') {
            $this->newPromoterEmailConfig($user);
        }

        $this->em->persist($user);
        $this->em->persist($promotor);
        $this->em->flush();

        return $this->fetch($promotor->getId());
    }

    private function like($needle, $haystack) {
        $regex = '/' . str_replace('%', '.*?', $needle) . '/';
        return preg_match($regex, $haystack) > 0;
    }

    private function checkBase($data, User $user) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['p']);
        $qb->from(Promoter::class, 'p');
        $qb->join('p.user', 'u');
        $qb->where('u.role = :role');
        $qb->setParameter('role', 'promoter');
        if (!!$user->getId()) {
            $qb->andWhere('u.id != :id');
            $qb->setParameter('id', $user->getId());
        }

        $promoter = $qb->getQuery()->getResult();
        $passou = true;
        foreach ($promoter as $p) {
            if ($this->like($p->getBase() . '%', $data->base)) {
                return false;
            }

            if ($this->like($data->base . '%', $p->getBase())) {
                return false;
            }
        }

        return $passou;
    }

    /**
     * Envia email para um usuario
     * @param User $user
     */
    private function newPromoterEmailConfig(User $user) {
        $config = $this->config['frontend']['uri'];
        $link = $config . '/email-confirmation/' . $this->createToken($user, 'ativar-email');

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
     * 
     * @param type $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getPromoterById($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['p', 'u', 'f', 'c']);
        $qb->from(Promoter::class, 'p');
        $qb->join('p.user', 'u');
        $qb->leftJoin('u.photo', 'f');
        $qb->leftJoin('p.cupons', 'c');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('p.deleted = false');
        $qb->andWhere('p.id = :id');
        $qb->setParameter('role', 'promoter');
        $qb->setParameter('id', $id);
        return $qb;
    }

    /**
     * 
     * @param type $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getPromoterByUserId($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['d', 'u', 'f']);
        $qb->from(Promoter::class, 'd');
        $qb->join('d.user', 'u');
        $qb->leftJoin('u.photo', 'f');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('u.id = :id');
        $qb->setParameter('role', 'promoter');
        $qb->setParameter('id', $id);
        return $qb;
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

        $qb = $this->getPromoterById($id);
        $promoter = $qb->getQuery()->getSingleResult();
        $promoter->getUser()->setDeleted(true);
        $this->em->persist($promoter->getUser());
        $this->em->persist($promoter);
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

        $qb = $this->getPromoterById($id);
        $promoter = $qb->getQuery()->getArrayResult();

        if (count($promoter) == 1) {
            $promoter = $promoter[0];
            unset($promoter['user']['password']);
            unset($promoter['user']['deleted']);
            unset($promoter['user']['blocked']);
            unset($promoter['user']['session']);
            return [
                'promoter' => $promoter
            ];
        }

        return new ApiProblem(428, 'Promoter not founded!');
    }

    /**
     * Lista de distribuidores com busca e paginação
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = []) {
        $permitidos = ['admin'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $buscar = '';
        if (isset($params['search'])) {
            $buscar = [
                'u.name LIKE :busca',
                'u.username LIKE :busca',
                'p.base LIKE :busca'
            ];

            $buscar = 'AND (' . \join(' OR ', $buscar) . ')';
        }

        $entity = Promoter::class;
        $dql = <<<DQL
        SELECT 
            p,
            partial u.{id, name, username}
        FROM {$entity} p
        JOIN p.user u
        WHERE u.role = 'promoter'
        AND u.deleted = false 
        {$buscar}
        ORDER BY u.name ASC
DQL;

        $qb = $this->em->createQuery($dql);
        if (isset($params['search'])) {
            $qb->setParameter('busca', "%{$params['search']}%");
        }

        $arr = $qb->getArrayResult();
        return new PromoterCollection($arr);
    }

}
