<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Funcionários
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="employees")
 * @ORM\Entity
 */
class Employee {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Usuário do funcionário
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Clínica do funcionário
     * @var Clinic
     * @ORM\ManyToOne(targetEntity="Clinic", inversedBy="employees")
     * @ORM\JoinColumn(name="clinic_id", referencedColumnName="id")
     */
    private $clinic;

    /**
     * Histórias de atendimento veterinário
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="History", mappedBy="employee")
     */
    private $histories;

    /**
     * Pets inclusos pelo funcionário
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Pet", mappedBy="employee")
     */
    private $pets;

    public function __construct() {
        $this->histories = new ArrayCollection();
        $this->pets = new ArrayCollection();
    }

    ######### Auxiliares #########

    /**
     * Adiciona uma história ao funcionário
     * @param \API\V1\Entity\History $history
     * @return $this
     */
    public function addHistory(History $history) {
        if ($this->histories->contains($history)) {
            return $this;
        }

        $history->setVeterinary($this);
        $this->histories->add($history);
        return $this;
    }

    /**
     * Adiciona um pet ao funcionário
     * @param \API\V1\Entity\Pet $pet
     * @return $this
     */
    public function addPet(Pet $pet) {
        if ($this->pets->contains($pet)) {
            return $this;
        }

        $pet->setEmployee($this);
        $this->pets->add($pet);
        return $this;
    }
    
    /**
     * Recupera a quantidade de pets de funcionário
     * @return integer
     */
    public function getPetsCount() {
        return $this->pets->count();
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getClinic(): Clinic {
        return $this->clinic;
    }

    public function getHistories(): ArrayCollection {
        return $this->histories;
    }

    public function getPets(): ArrayCollection {
        return $this->pets;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    public function setClinic(Clinic $clinic) {
        $this->clinic = $clinic;
        return $this;
    }

    public function setHistories(ArrayCollection $histories) {
        $this->histories = $histories;
        return $this;
    }

    public function setPets(ArrayCollection $pets) {
        $this->pets = $pets;
        return $this;
    }

}
