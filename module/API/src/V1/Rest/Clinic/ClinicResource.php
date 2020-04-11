<?php

namespace API\V1\Rest\Clinic;

use ZF\ApiProblem\ApiProblem;
use API\V1\Rest\User\UserResource;
use API\V1\Rest\Image\ImageResource;
use API\V1\Entity\BusinessManager;
use API\V1\Entity\Veterinary;
use API\V1\Entity\Distributor;
use API\V1\Entity\Clinic;
use API\V1\Entity\Address;

class ClinicResource extends UserResource {

    /**
     * Perfil a ser buscado
     * @var string
     */
    protected $role = 'manager';

    /**
     * Persiste um usuário (gerente) e uma clínica
     *
     * @param stdClass $data
     * @return ApiProblem|mixed
     */
    public function create($data) {
        $permitidos = ['distributor', 'admin'];
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
            $manager = new BusinessManager();
            $user->setBlocked(false)
                    ->setDeleted(false)
                    ->setEmailConfirmation(false)
                    ->setPasswordReset(true)
                    ->setPassword('NewUserPassword')
                    ->setCreation(new \DateTime())
                    ->setRole('manager')
                    ->setSession('{"path": ""}')
                    ->setUpdate(new \DateTime());
            $manager->setUser($user);
        } else {
            $qb = $this->getManagerById($data->id);
            $manager = $qb->getQuery()->getSingleResult();
        }

        $user->setDocument($data->documento)
                ->setName($data->nome)
                ->setPhone($data->phone);

        $manager = $this->saveClinic($data, $manager);

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

        if ($data->id == 'novo') {
            $distrib = new UserResource($this->em, $this->config);
            $distrib->newUserEmailConfig($user);
        }

        $this->em->persist($user);
        $this->em->persist($manager);
        $this->em->flush();

        return $this->fetch($manager->getClinic()->getId());
    }

    private function saveClinic($data, BusinessManager $manager) {
        if ($data->id == 'novo') {
            $clinic = new Clinic();
            $clinic->setCreation(new \DateTime())
                    ->setVerified(true)
                    ->setCompleted(true)
                    ->setDistributor($this->getLoggedDistributor())
                    ->setManager($manager);
            $manager->setClinic($clinic);
        } else {
            $clinic = $manager->getClinic();
        }

        $clinic = $this->persistClinicAddress($clinic, $data);
        $clinic = $this->persistClinicPhoto($clinic, $data);

        $clinic->setName($data->nomeClinica)
                ->setPhone($data->phoneClinica);

        if ($data->verified && $this->user->getRole() == 'admin') {
            $clinic->setVerified($data->verified);
            $clinic->setHomologadoPor($this->user);
        }

        $this->em->persist($clinic);
        return $manager;
    }

    /**
     * Persiste uma imagem a uma clínica
     * @param Clinic $clinic
     * @param type $data
     * @return Clinic
     */
    protected function persistClinicPhoto(Clinic $clinic, $data) {
        if (isset($data->fotoClinica['id'])) {
            if ($data->fotoClinica['id'] == 0) {
                $imagemResource = new ImageResource($this->em);
                $foto = $imagemResource->saveInternal(
                        $data->fotoClinica['logo'], $clinic->getPhoto()
                );
                $clinic->setPhoto($foto);
            }
        }
        return $clinic;
    }

    /**
     * Persiste um endereço a um usuário
     * @param Clinic $clinic
     * @param stdClass $data
     * @return Clinic
     */
    protected function persistClinicAddress(Clinic $clinic, $data) {
        $address = $clinic->getAddress();
        if (!$address) {
            $address = new Address();
        }

        $address->setAddress($data->enderecoClinica)
                ->setNumber($data->numeroClinica)
                ->setAddress2($data->bairroClinica)
                ->setAddress3($data->complementoClinica)
                ->setCity($data->cidadeClinica)
                ->setState($data->estadoClinica)
                ->setZipcode($data->cepClinica)
                ->setCountry($data->paisClinica);
        $this->em->persist($address);

        $clinic->setAddress($address);
        return $clinic;
    }

    /**
     * Recupera distribuidor por ID de usuário
     * @param type $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getLoggedDistributor() {
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
        $qb->setParameter('id', $this->user->getId());
        return $qb->getQuery()->getSingleResult();
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['d', 'u', 'a', 'f', 'fc', 'c', 'ca', 'v']);
        $qb->from(Clinic::class, 'c');
        $qb->join('c.manager', 'd');
        $qb->join('d.user', 'u');
        $qb->join('u.address', 'a');
        $qb->join('c.address', 'ca');
        $qb->leftJoin('u.photo', 'f');
        $qb->leftJoin('u.veterinary', 'v');
        $qb->leftJoin('c.photo', 'fc');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('c.id = :id');
        $qb->setParameter('role', 'manager');
        $qb->setParameter('id', $id);
        $clinic = $qb->getQuery()->getSingleResult();
        $clinic->setDeleted(true);
        $clinic->getManager()->getUser()->setDeleted(true);
        $this->em->persist($clinic->getManager()->getUser());
        $this->em->persist($clinic);
        $this->em->flush();
        return true;
    }

    /**
     * 
     * @param type $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getClinicById($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['d', 'u', 'a', 'f', 'fc', 'c', 'ca', 'v']);
        $qb->from(Clinic::class, 'c');
        $qb->join('c.manager', 'd');
        $qb->join('d.user', 'u');
        $qb->join('u.address', 'a');
        $qb->join('c.address', 'ca');
        $qb->leftJoin('u.photo', 'f');
        $qb->leftJoin('u.veterinary', 'v');
        $qb->leftJoin('c.photo', 'fc');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('c.id = :id');
        $qb->setParameter('role', 'manager');
        $qb->setParameter('id', $id);
        return $qb;
    }

    /**
     * 
     * @param type $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getManagerById($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['d', 'u', 'a', 'f', 'fc', 'c', 'ca', 'v']);
        $qb->from(BusinessManager::class, 'd');
        $qb->join('d.user', 'u');
        $qb->join('u.address', 'a');
        $qb->join('d.clinic', 'c');
        $qb->join('c.address', 'ca');
        $qb->leftJoin('u.photo', 'f');
        $qb->leftJoin('u.veterinary', 'v');
        $qb->leftJoin('c.photo', 'fc');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('c.id = :id');
        $qb->setParameter('role', 'manager');
        $qb->setParameter('id', $id);
        return $qb;
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id) {
        $qb = $this->getManagerById($id);
        $manager = $qb->getQuery()->getArrayResult();
        unset($manager[0]['password']);
        return [
            'manager' => $manager[0]
        ];
    }

    private function getDistributorsIds() {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['d', 'dd', 'u']);
        $qb->from(Distributor::class, 'd');
        $qb->join('d.distributors', 'dd');
        $qb->join('d.user', 'du');
        $qb->join('dd.user', 'u');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('du.id = :id');
        $qb->setParameter('role', 'distributor');
        $qb->setParameter('id', $this->user->getId());
        $arr = $qb->getQuery()->getOneOrNullResult();

        $ids = [];
        $ids[] = $this->user->getId();
        if (!!$arr) {
            foreach ($arr->getDistributors() as $v) {
                $ids[] = $v->getUser()->getId();
            }
        }
        return $ids;
    }

    /**
     * Recupera lista de clínicas com busca e paginação
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = []) {
        $permitidos = ['admin', 'distributor'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $where = [];
        if ($this->user->getRole() == 'distributor') {
            $ids = $this->getDistributorsIds();
            $where[] = 'u.id IN (' . join(',', $ids) . ')';
        }

        $buscar = '';
        if (isset($params['search'])) {
            $buscar = [
                'c.name LIKE :busca',
                'u.name LIKE :busca',
                'u.username LIKE :busca'
            ];

            $where[] = '(' . \join(' OR ', $buscar) . ')';
        }

        if (count($where) > 0) {
            $where = 'AND ' . \join(' AND ', $where);
        } else {
            $where = '';
        }

        $entity = Clinic::class;
        $dql = <<<DQL
        SELECT 
            partial c.{id, name, verified} as clinic,
            partial d.{id},
            partial u.{id, name, username},
            partial m.{id},
            partial mu.{id, name, username},
            count(e.id) as employees, count(p.id) as petsE, count(p2.id) as petsM
        FROM {$entity} c
        JOIN c.distributor d
        JOIN d.user u
        JOIN c.manager m
        JOIN m.user mu
        LEFT JOIN c.employees e
        LEFT JOIN e.pets p
        LEFT JOIN m.pets p2
        WHERE c.deleted = false AND u.deleted = false
        {$where}
        GROUP BY c.id
        ORDER BY c.name ASC
DQL;

        $qb = $this->em->createQuery($dql);
        if (isset($params['search'])) {
            $qb->setParameter('busca', "%{$params['search']}%");
        }

        $arr = $qb->getArrayResult();
        return new ClinicCollection($arr);
    }

}
