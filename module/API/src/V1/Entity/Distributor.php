<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Distribuidores
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="distributors")
 * @ORM\Entity
 */
class Distributor {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Usuário do gerente
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Distributor", inversedBy="distributors")
     * @ORM\JoinColumn(name="distributor_id", referencedColumnName="id")
     */
    private $distributor;

    /**
     * @ORM\OneToMany(targetEntity="Distributor", mappedBy="distributor")
     */
    private $distributors;

    /**
     * Clínica do gerente
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Clinic", mappedBy="distributor")
     */
    private $clinics;

    /**
     * Flag que controla se distribuidor é master
     * @var boolean
     * @ORM\Column(name="master", type="boolean")
     */
    private $master;

    public function __construct() {
        $this->clinics = new ArrayCollection();
        $this->distributors = new ArrayCollection();
    }

    ######### Auxiliares #########

    /**
     * Adiciona uma clínica a um distribuidor
     * @param \API\V1\Entity\Clinic $clinic
     * @return $this
     */
    public function addClinic(Clinic $clinic) {
        if ($this->clinics->contains($clinic)) {
            return $this;
        }

        $clinic->setDistributor($this);
        $this->clinics->add($clinic);
        return $this;
    }

    /**
     * Adiciona um sub-distribuidor a um distribuidor
     * @param \API\V1\Entity\Distributor $distributor
     * @return $this
     */
    public function addDistributor(Distributor $distributor) {
        if ($this->distributors->contains($distributor)) {
            return $this;
        }

        $distributor->setDistributor($this);
        $this->distributors->add($distributor);
        return $this;
    }

    /**
     * Retorna total de clínicas
     * @return integer
     */
    public function getClinicsCount() {
        return $this->clinics->count();
    }

    /**
     * Retorna total de pets de todas as clínicas
     * @return integer
     */
    public function getPetsCount() {
        $total = 0;
        foreach ($this->clinics as $clinic) {
            $total += $clinic->getPetsCount();
        }
        return $total;
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getUser() {
        return $this->user;
    }

    public function getDistributor() {
        return $this->distributor;
    }

    public function getDistributors() {
        return $this->distributors;
    }

    public function getClinics() {
        return $this->clinics;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

    public function setDistributor($distributor) {
        $this->distributor = $distributor;
        return $this;
    }

    public function setDistributors($distributors) {
        $this->distributors = $distributors;
        return $this;
    }

    public function setClinics($clinics) {
        $this->clinics = $clinics;
        return $this;
    }

    public function getMaster() {
        return $this->master;
    }

    public function setMaster($master) {
        $this->master = $master;
        return $this;
    }

}
