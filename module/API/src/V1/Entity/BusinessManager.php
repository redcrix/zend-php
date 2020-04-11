<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Gerentes de negócios (clínica)
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="business_managers")
 * @ORM\Entity
 */
class BusinessManager {

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
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Clínica do gerente
     * @var Clinic
     * @ORM\OneToOne(targetEntity="Clinic", mappedBy="manager")
     */
    private $clinic;

    /**
     * Pets inclusos pelo funcionário
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Pet", mappedBy="manager")
     */
    private $pets;

    public function __construct() {
        $this->pets = new ArrayCollection();
    }
    
    ######### Auxiliares #########
    
    /**
     * Adiciona um pet ao funcionário
     * @param \API\V1\Entity\Pet $pet
     * @return $this
     */
    public function addPet(Pet $pet) {
        if ($this->pets->contains($pet)) {
            return $this;
        }

        $pet->setManager($this);
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

    public function getUser() {
        return $this->user;
    }

    public function getClinic() {
        return $this->clinic;
    }

    public function getPets() {
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

    public function setPets(ArrayCollection $pets) {
        $this->pets = $pets;
        return $this;
    }

}
