<?php

namespace API\V1\Rest\Distributor;

use ZF\ApiProblem\ApiProblem;
use API\V1\Entity\Distributor;
use API\V1\Rest\User\UserResource;
use API\V1\Entity\User;

/**
 * REST para distribuidores
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class DistributorResource extends UserResource {

    /**
     * Perfil a ser buscado
     * @var string
     */
    protected $role = 'distributor';

    /**
     * Persiste um usuário
     *
     * @param stdClass $data
     * @return ApiProblem|mixed
     */
    public function create($data) {
        $permitidos = ['admin', 'distributor'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $user = $this->getVerifyUser($data, true);
        if (!$user) {
            return new ApiProblem(428, 'users_erros_existing_user');
        }

        $user = $this->persistAddress($user, $data);
        $user = $this->persistPhoto($user, $data);

        if ($data->id == 'novo') {
            $distributor = new Distributor();
            $user->setBlocked(false)
                    ->setDeleted(false)
                    ->setEmailConfirmation(false)
                    ->setPasswordReset(true)
                    ->setPassword('NewUserPassword')
                    ->setCreation(new \DateTime())
                    ->setRole('distributor')
                    ->setSession('{"path": ""}')
                    ->setUpdate(new \DateTime());
            $mandarEmail = true;
            $distributor->setUser($user);

            if ($this->user->getRole() === 'distributor') {
                $qb = $this->getDistributorByUserId($this->user->getId());
                $super = $qb->getQuery()->getSingleResult();
                $distributor->setDistributor($super);
                $distributor->setMaster(false);
                $this->em->persist($super);
            } else {
                $distributor->setMaster(true);
            }
        } else {
            $qb = $this->getDistributorById($data->id);
            $distributor = $qb->getQuery()->getSingleResult();
        }

        $user->setDocument($data->documento)
                ->setName($data->nome)
                ->setPhone($data->phone);

        if ($data->id == 'novo') {
            $this->newDistributorEmailConfig($user);
        }

        $this->em->persist($user);
        $this->em->persist($distributor);
        $this->em->flush();

        return $this->fetch($distributor->getId());
    }

    /**
     * Envia email para um usuario
     * @param User $user
     */
    private function newDistributorEmailConfig(User $user) {
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
    private function getDistributorById($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['d', 'u', 'a', 'f', 'c', 'm']);
        $qb->from(Distributor::class, 'd');
        $qb->join('d.user', 'u');
        $qb->join('u.address', 'a');
        $qb->leftJoin('u.photo', 'f');
        $qb->leftJoin('d.clinics', 'c');
        $qb->leftJoin('c.manager', 'm');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('d.id = :id');
        $qb->setParameter('role', 'distributor');
        $qb->setParameter('id', $id);
        return $qb;
    }

    /**
     * 
     * @param type $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getDistributorByUserId($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['d', 'u', 'a', 'f', 'c', 'm']);
        $qb->from(Distributor::class, 'd');
        $qb->join('d.user', 'u');
        $qb->join('u.address', 'a');
        $qb->leftJoin('u.photo', 'f');
        $qb->leftJoin('d.clinics', 'c');
        $qb->leftJoin('c.manager', 'm');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('u.id = :id');
        $qb->setParameter('role', 'distributor');
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
        $permitidos = ['admin', 'distributor'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $qb = $this->getDistributorById($id);
        $distribuidor = $qb->getQuery()->getSingleResult();
        $distribuidor->getUser()->setDeleted(true);
        $this->em->persist($distribuidor);
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
        $permitidos = ['admin', 'distributor'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $qb = $this->getDistributorById($id);
        $distribuidor = $qb->getQuery()->getArrayResult();

        if (count($distribuidor) == 1) {
            $distribuidor = $distribuidor[0];
            unset($distribuidor['user']['password']);
            unset($distribuidor['user']['deleted']);
            unset($distribuidor['user']['blocked']);
            unset($distribuidor['user']['session']);
            return [
                'distributor' => $distribuidor
            ];
        }

        return new ApiProblem(428, 'Distributor not founded!');
    }

    /**
     * Lista de distribuidores com busca e paginação
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = []) {
        $permitidos = ['admin', 'distributor'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $buscar = '';
        if (isset($params['search'])) {
            $buscar = [
                'u.name LIKE :busca',
                'u.username LIKE :busca'
            ];

            $buscar = 'AND (' . \join(' OR ', $buscar) . ')';
        }

        $distrib = '';
        $join = '';
        if ($this->user->getRole() === 'distributor') {
            $join = 'JOIN d.distributor dd JOIN dd.user ddu';
            $distrib = 'AND ddu.id = ' . $this->user->getId();
        }

        $entity = Distributor::class;
        $dql = <<<DQL
        SELECT 
            d as distributor,
            partial u.{id, name, username}, 
            partial a.{id, city, country}, 
            count(c.id) as clinics, count(p.id) as petsE, count(p2.id) as petsM,
            count(c2.id) as clinics2, count(p3.id) as petsED, count(p4.id) as petsMD
        FROM {$entity} d
        JOIN d.user u
        JOIN u.address a
        LEFT JOIN d.distributors dds
        LEFT JOIN d.clinics c
        LEFT JOIN c.employees e
        LEFT JOIN c.manager m
        LEFT JOIN e.pets p
        LEFT JOIN m.pets p2 
        LEFT JOIN dds.clinics c2
        LEFT JOIN c2.employees ed
        LEFT JOIN c2.manager md
        LEFT JOIN ed.pets p3
        LEFT JOIN md.pets p4 {$join}
        WHERE u.role = 'distributor'
        AND u.deleted = false {$distrib}
        {$buscar}
        GROUP BY d.id
        ORDER BY u.name ASC
DQL;

        $qb = $this->em->createQuery($dql);
        if (isset($params['search'])) {
            $qb->setParameter('busca', "%{$params['search']}%");
        }

        $arr = $qb->getArrayResult();
        return new DistributorCollection($arr);
    }

}
