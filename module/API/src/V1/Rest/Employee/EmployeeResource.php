<?php

namespace API\V1\Rest\Employee;

use ZF\ApiProblem\ApiProblem;
use API\V1\Entity\Clinic;
use API\V1\Rest\User\UserResource;
use API\V1\Entity\User;
use API\V1\Entity\Employee;
use API\V1\Entity\Veterinary;

class EmployeeResource extends UserResource {

    /**
     * Perfil a ser buscado
     * @var string
     */
    protected $role = 'employee';

    /**
     * Persiste um funcionário
     *
     * @param stdClass $data
     * @return ApiProblem|mixed
     */
    public function create($data) {
        $permitidos = ['admin', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $user = $this->getUserByUsername($data->username);
        if (!$user) {
            $user = new User();
            $user->setUsername($data->username);
        }

        $user = $this->persistAddress($user, $data);
        $user = $this->persistPhoto($user, $data);

        if ($data->id == 'novo') {
            $employee = new Employee();
            $user->setBlocked(false)
                    ->setDeleted(false)
                    ->setEmailConfirmation(false)
                    ->setPasswordReset(true)
                    ->setPassword('NewUserPassword')
                    ->setCreation(new \DateTime())
                    ->setRole('employee')
                    ->setSession('{"path": ""}')
                    ->setUpdate(new \DateTime());

            $clinic = $this->getClinicByUserId($this->user->getId());

            $employee->setUser($user)
                    ->setClinic($clinic);
        } else {
            $employee = $this->getEmployeeById($data->id);
        }

        $user->setDocument($data->documento)
                ->setName($data->nome)
                ->setPhone($data->phone);

        if ($data->id == 'novo') {
            $this->newDistributorEmailConfig($user);
        }

        if (!!$data->isVeterinary) {
            if ($data->id == 'novo') {
                $vet = new Veterinary();
                $vet->setDocument($data->veterinaryDoc);
                $user->setVeterinary($vet);
            } else {
                $vet = $user->getVeterinary();
                if (!!$vet) {
                    $vet->setDocument($data->veterinaryDoc);
                } else {
                    $vet = new Veterinary();
                    $vet->setDocument($data->veterinaryDoc);
                    $user->setVeterinary($vet);
                }
            }

            $this->em->persist($vet);
        } else {
            $vet = $user->getVeterinary();
            if (!!$vet) {
                $user->setVeterinary(null);
            }
        }

        $this->em->persist($user);
        $this->em->persist($employee);
        $this->em->flush();

        return $this->fetch($employee->getId());
    }

    /**
     * 
     * @param type $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getClinicByUserId($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['c']);
        $qb->from(Clinic::class, 'c');
        $qb->join('c.manager', 'd');
        $qb->join('d.user', 'u');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('u.id = :id');
        $qb->setParameter('role', 'manager');
        $qb->setParameter('id', $id);
        return $qb->getQuery()->getSingleResult();
    }

    /**
     * 
     * @param type $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getEmployeeById($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['e', 'u', 'a', 'f']);
        $qb->from(Employee::class, 'e');
        $qb->join('e.user', 'u');
        $qb->leftJoin('u.photo', 'f');
        $qb->leftJoin('u.address', 'a');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('e.id = :id');
        $qb->setParameter('role', 'employee');
        $qb->setParameter('id', $id);
        return $qb->getQuery()->getSingleResult();
    }

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
     * Deleta um usuário do sistema
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id) {
        $permitidos = ['admin', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $employee = $this->getEmployeeById($id);
        $employee->getUser()->setDeleted(true);
        $this->em->persist($employee);
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
        $permitidos = ['admin', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $qb = $this->em->createQueryBuilder();
        $qb->select(['e', 'u', 'a', 'f', 'v']);
        $qb->from(Employee::class, 'e');
        $qb->join('e.user', 'u');
        $qb->leftJoin('u.photo', 'f');
        $qb->leftJoin('u.address', 'a');
        $qb->leftJoin('u.veterinary', 'v');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('e.id = :id');
        $qb->setParameter('role', 'employee');
        $qb->setParameter('id', $id);
        $employee = $qb->getQuery()->getArrayResult();

        if (count($employee) == 1) {
            $employee = $employee[0];
            unset($employee['user']['password']);
            unset($employee['user']['deleted']);
            unset($employee['user']['blocked']);
            unset($employee['user']['session']);
            return [
                'employee' => $employee
            ];
        }

        return new ApiProblem(428, 'Employee not founded!');
    }

    /**
     * Lista de funcionários com busca e paginação
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = []) {
        $permitidos = ['manager', 'admin'];
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

        $entity = Employee::class;
        $dql = <<<DQL
        SELECT 
            e as employee,
            partial u.{id, name, username},
            v
        FROM {$entity} e
        JOIN e.user u
        LEFT JOIN u.veterinary v
        JOIN e.clinic c
        JOIN c.manager m
        JOIN m.user mu
        WHERE u.role = 'employee'
        AND u.deleted = false
        AND mu.id = {$this->user->getId()}
        {$buscar}
        ORDER BY u.name ASC
DQL;

        $qb = $this->em->createQuery($dql);
        if (isset($params['search'])) {
            $qb->setParameter('busca', "%{$params['search']}%");
        }

        $arr = $qb->getArrayResult();
        return new EmployeeCollection($arr);
    }

}
