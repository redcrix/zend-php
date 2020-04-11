<?php

namespace API\V1\Rest\Pet;

use ZF\ApiProblem\ApiProblem;
use Endroid\QrCode\QrCode;
use API\V1\Rest\User\UserResource;
use API\V1\Rest\Image\ImageResource;
use API\V1\Entity\Pet;
use API\V1\Entity\Owner;
use API\V1\Entity\User;
use API\V1\Entity\Employee;
use API\V1\Entity\BusinessManager;
use API\V1\Entity\Clinic;

class PetResource extends UserResource {

    /**
     * Perfil a ser buscado
     * @var string
     */
    protected $role = 'owner';

    /**
     * Persiste um pet, um dono e gera QRCode
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data) {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        # Usuário Dono do PET
        $user = $this->getVerifyUser($data, true);
        if (!$user) {
            return new ApiProblem(428, 'users_erros_existing_user');
        }

        if ($this->user->getRole() == 'employee') {
            if (!$this->checkEmployee()) {
                return new ApiProblem(401, 'Permission denied!');
            }
        } else {
            if (!$this->checkManager()) {
                return new ApiProblem(401, 'Permission denied!');
            }
        }

        # Persist o dono
        $owner = $this->persistOwner($data, $user);

        # Persist o pet
        $pet = $this->persistPet($data, $owner);

        if ($data->id == 'novo') {
            switch ($this->user->getRole()) {
                case 'employee':
                    $employee = $this->getEmployeeByUserId($this->user->getId());
                    $employee->addPet($pet);
                    $this->em->persist($employee);
                    break;
                case 'manager':
                    $manager = $this->getManagerByUserId($this->user->getId());
                    $manager->addPet($pet);
                    $this->em->persist($manager);
                    break;
            }
            #Add pet na clinica
            $session = json_decode($this->user->getSession());
            $clinic = $this->em->find(Clinic::class, $session->clinica->id);
            $pet->addClinic($clinic);
            $this->em->persist($clinic);
            $this->em->persist($pet);
            $this->em->flush();
        }


        return [
            'id' => $pet->getId()
        ];
    }

    private function checkManager() {
        $clinica = $this->em->createQueryBuilder()
                ->select(['c', 'm'])
                ->from(Clinic::class, 'c')
                ->join('c.manager', 'm')
                ->join('m.user', 'u')
                ->where('u.blocked = false')
                ->andWhere('u.deleted = false')
                ->andWhere('u.emailConfirmation = true')
                ->andWhere('u.role = :role')
                ->andWhere('u.id = :id')
                ->andWhere('c.deleted = false')
                ->setParameter('role', 'manager')
                ->setParameter('id', $this->user->getId())
                ->getQuery()
                ->getSingleResult();
        return $clinica->getVerified();
    }

    private function checkEmployee() {
        $session = json_decode($this->user->getSession());
        $clinica = $this->em->createQueryBuilder()
                ->select(['c', 'e'])
                ->from(Clinic::class, 'c')
                ->join('c.employees', 'e')
                ->join('e.user', 'u')
                ->where('u.blocked = false')
                ->andWhere('u.deleted = false')
                ->andWhere('u.emailConfirmation = true')
                ->andWhere('u.role = :role')
                ->andWhere('u.id = :id')
                ->andWhere('c.id = :clinica')
                ->andWhere('c.deleted = false')
                ->setParameter('role', 'employee')
                ->setParameter('id', $this->user->getId())
                ->setParameter('clinica', $session->clinica->id)
                ->getQuery()
                ->getSingleResult();

        return $clinica->getVerified();
    }

    /**
     * Recupera um funcionário
     * @param integer $id
     * @return BusinessManager
     */
    private function getManagerByUserId($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['m', 'u']);
        $qb->from(BusinessManager::class, 'm');
        $qb->join('m.user', 'u');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('u.id = :id');
        $qb->setParameter('role', 'manager');
        $qb->setParameter('id', $id);
        return $qb->getQuery()->getSingleResult();
    }

    /**
     * Recupera um funcionário
     * @param integer $id
     * @return Employee
     */
    private function getEmployeeByUserId($id) {
        $session = json_decode($this->user->getSession());
        $session->clinica = (object) $session->clinica;
        $qb = $this->em->createQueryBuilder();
        $qb->select(['e', 'u']);
        $qb->from(Employee::class, 'e');
        $qb->join('e.user', 'u');
        $qb->join('e.clinic', 'c');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('u.id = :id');
        $qb->andWhere('c.id = :clinica');
        $qb->setParameter('role', 'employee');
        $qb->setParameter('id', $id);
        $qb->setParameter('clinica', $session->clinica->id);
        return $qb->getQuery()->getSingleResult();
    }

    /**
     * Persist um PET
     * @param type $data
     * @param Owner $owner
     * @return Pet
     */
    private function persistPet($data, Owner $owner) {
        if ($data->id == 'novo') {
            $pet = new Pet();
            $pet->setCreation(new \DateTime())
                    ->setDeleted(false)
                    ->setOwner($owner);
        } else {
            $qb = $this->getPetById($data->id);
            $pet = $qb->getQuery()->getSingleResult();
        }

        $pet->setBirthdate(new \DateTime($data->nascimento))
                ->setColor($data->cor)
                ->setName($data->nome)
                ->setOrign($data->orign)
                ->setPedigree($data->pedigree)
                ->setSex($data->sex)
                ->setRace($data->race)
                ->setSpecie($data->specie);

        $this->em->persist($pet);
        $pet = $this->persistPhotoPet($pet, $data);

        if ($data->id == 'novo') {
            $dicionario = $this->getDicionario();
            $url = $this->config['frontend']['uri'] . '/pet-profile/' . $pet->getId();
            $sex = $data->sex == 'M' ? 'qrcode_sex_male' : 'qrcode_sex_female';

            $message = <<<QRCODE
{$dicionario['qrcode_name']}: {$data->nome}
{$dicionario['qrcode_race']}: {$data->race}
{$dicionario['qrcode_sex']}: {$dicionario[$sex]}
{$dicionario['qrcode_url']}: {$url}
{$dicionario['qrcode_owner']}: {$data->dono}
{$dicionario['qrcode_cellphone']}: {$data->phone}
{$dicionario['qrcode_email']}: {$data->username}
QRCODE;
            $qrCode = new QrCode();
            $qrCode->setText($message)
                    ->setSize(300)
                    ->setPadding(10)
                    ->setErrorCorrection('high')
                    ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
                    ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
                    ->setLogo(__DIR__ . "/logo.png")
                    ->setLogoSize(98)
                    ->setImageType(QrCode::IMAGE_TYPE_PNG);

            # Persist QRCode
            $imagemResource = new ImageResource($this->em);
            $img = $imagemResource->saveQRCode();
            $qrCode->save($img->dir);

            $pet->setQrCode($img->QRCode);
            $this->em->persist($pet);
        }

        $this->em->flush();

        return $pet;
    }

    /**
     * Persiste um Owner e seu usuário
     * @param stdClass $data
     * @param User $user
     * @return Owner
     */
    private function persistOwner($data, User $user) {
        $user = $this->persistAddress($user, $data);
        $user = $this->persistPhotoOwner($user, $data);

        if ($data->id == 'novo') {
            $owner = new Owner();
            $user->setBlocked(false)
                    ->setDeleted(false)
                    ->setEmailConfirmation(false)
                    ->setPasswordReset(true)
                    ->setPassword('NewUserPassword')
                    ->setCreation(new \DateTime())
                    ->setRole('owner')
                    ->setSession('{"path": ""}')
                    ->setUpdate(new \DateTime());
            $owner->setUser($user);
        } else {
            $qb = $this->getOwnerById($data->ownerId);
            $owner = $qb->getQuery()->getSingleResult();
        }

        $user->setDocument($data->documento)
                ->setName($data->dono)
                ->setPhone($data->phone);

        if ($data->id == 'novo') {
            $this->newOwnerEmailConfig($user);
        }

        $this->em->persist($user);
        $this->em->persist($owner);
        $this->em->flush();
        return $owner;
    }

    /**
     * Recupera um QueryBuilder para um Owner
     * @param type $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getOwnerById($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['o', 'u', 'a', 'f']);
        $qb->from(Owner::class, 'o');
        $qb->join('o.user', 'u');
        $qb->join('u.address', 'a');
        $qb->leftJoin('u.photo', 'f');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('o.id = :id');
        $qb->setParameter('role', 'owner');
        $qb->setParameter('id', $id);
        return $qb;
    }

    /**
     * Persiste uma imagem a um usuário
     * @param User $user
     * @param type $data
     * @return User
     */
    protected function persistPhotoOwner(User $user, $data) {
        if (isset($data->photoDono['id'])) {
            if ($data->photoDono['id'] == 0) {
                $imagemResource = new ImageResource($this->em);
                $foto = $imagemResource->saveInternal(
                        $data->photoDono['logo'], $user->getPhoto()
                );
                $user->setPhoto($foto);
            }
        }
        return $user;
    }

    /**
     * Persiste uma imagem a um pet
     * @param Pet $pet
     * @param type $data
     * @return User
     */
    protected function persistPhotoPet(Pet $pet, $data) {
        if (isset($data->photo['id'])) {
            if ($data->photo['id'] == 0) {
                $imagemResource = new ImageResource($this->em);
                $foto = $imagemResource->saveInternal(
                        $data->photo['logo'], $pet->getPhoto()
                );
                $pet->setPhoto($foto);
            }
        }
        return $pet;
    }

    public function sendOwnerEmail(User $user) {
        $this->newOwnerEmailConfig($user);
    }

    /**
     * Envia email para um Owner
     * @param User $user
     */
    private function newOwnerEmailConfig(User $user) {
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
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id) {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $clinic = $this->getClinic();
        $pet = $this->getPetById($id)->getQuery()->getSingleResult();
        $pet->getClinics()->removeElement($clinic);
        $clinic->getPets()->removeElement($pet);
        $this->em->flush();
        return true;
    }

    /**
     * Recupera um QueryBuilder para 1 pet
     * @param integer $id
     * @return Clinic
     */
    private function getClinic() {
        $qb = $this->em->createQueryBuilder();
        $qb->select('c', 'p');
        $qb->from(Clinic::class, 'c');
        $qb->leftJoin('c.pets', 'p');
        $qb->where('c.id = :id');
        $qb->setParameter('id', json_decode($this->user->getSession())->clinica->id);
        return $qb->getQuery()->getSingleResult();
    }

    /**
     * Recupera um QueryBuilder para 1 pet
     * @param integer $id
     * @return \Doctrine\DBAL\Query\QueryBuilder
     */
    private function getPetById($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select('p', 'o', 'u', 'a', 'f', 'fu', 'q');
        $qb->from(Pet::class, 'p');
        $qb->join('p.owner', 'o');
        $qb->join('o.user', 'u');
        $qb->leftJoin('u.address', 'a');
        $qb->leftJoin('p.photo', 'f');
        $qb->leftJoin('u.photo', 'fu');
        $qb->join('p.qrCode', 'q');
        $qb->where('p.id = :id');
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
        $qb = $this->em->createQueryBuilder();
        $qb->select('p', 'o', 'u', 'a', 'f', 'fu', 'q');
        $qb->from(Pet::class, 'p');
        $qb->join('p.owner', 'o');
        $qb->join('o.user', 'u');
        $qb->leftJoin('u.address', 'a');
        $qb->leftJoin('p.photo', 'f');
        $qb->leftJoin('u.photo', 'fu');
        $qb->join('p.qrCode', 'q');
        $qb->where('p.id = :id');
        $qb->setParameter('id', $id);
        $pet = $qb->getQuery()->getArrayResult();
        return [
            'pet' => $pet[0]
        ];
    }

    /**
     * 
     * @param type $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getManagerById($id) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['d', 'u', 'c']);
        $qb->from(BusinessManager::class, 'd');
        $qb->join('d.user', 'u');
        $qb->join('d.clinic', 'c');
        $qb->where('u.role = :role');
        $qb->andWhere('u.deleted = false');
        $qb->andWhere('u.id = :id');
        $qb->setParameter('role', 'manager');
        $qb->setParameter('id', $id);
        return $qb->getQuery()->getSingleResult();
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = []) {
        $permitidos = ['employee', 'manager', 'admin'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        switch ($this->user->getRole()) {
            case 'employee':
                $clinic = json_decode($this->user->getSession())->clinica->id;
                break;
            case 'manager':
                $clinic = $this->getManagerById($this->user->getId())->getClinic()->getId();
                break;
            case 'admin':

                break;
        }

        $qb = $this->em->createQueryBuilder();
        $qb->select('p', 'o', 'f', 'q', 'u');
        $qb->from(Pet::class, 'p');
        $qb->join('p.owner', 'o');
        $qb->join('o.user', 'u');
        $qb->leftJoin('p.photo', 'f');
        $qb->leftJoin('p.clinics', 'c');
        $qb->join('p.qrCode', 'q');
        if ($this->user->getRole() != 'admin') {
            $qb->where('c.id = :id');
            $qb->setParameter('id', $clinic);
        }

        if (isset($params['search'])) {
            $buscar = [
                'p.id = :busca',
                'p.name LIKE :busca',
                'u.name LIKE :busca',
                'p.race LIKE :busca'
            ];

            $qb->andWhere(\join(' OR ', $buscar));
            $qb->setParameter('busca', "%{$params['search']}%");
        }
        $qb->orderBy('p.name', 'ASC');

        $arr = $qb->getQuery()->getArrayResult();

        if (count($arr) == 0) {
            $id = str_replace('.', '', $params['search']);
            $qb = $this->em->createQueryBuilder();
            $qb->select('p', 'o', 'f', 'q', 'u');
            $qb->from(Pet::class, 'p');
            $qb->join('p.owner', 'o');
            $qb->join('o.user', 'u');
            $qb->leftJoin('p.photo', 'f');
            $qb->leftJoin('p.clinics', 'c');
            $qb->join('p.qrCode', 'q');
            $qb->where('p.id = :id');
            $qb->setParameter('id', $id);
            $arr = $qb->getQuery()->getArrayResult();
            if (count($arr) != 0) {
                $arr[0]['novo'] = true;
            }
        }
        return new PetCollection($arr);
    }

}
