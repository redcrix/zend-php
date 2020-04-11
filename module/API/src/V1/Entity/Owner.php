<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Dono de pet
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="owners")
 * @ORM\Entity
 */
class Owner {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Pets do mesmo dono
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Pet", mappedBy="owner")
     */
    private $pets;

    /**
     * Usuário do dono
     * @var User
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    public function __construct() {
        $this->pets = new ArrayCollection();
    }

    ######### Auxiliares #########

    /**
     * Adiciona um pet ao dono
     * @param \API\V1\Entity\Pet $pet
     * @return $this
     */
    public function addPet(Pet $pet) {
        if ($this->pets->contains($pet)) {
            return $this;
        }

        $pet->setOwner($this);
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

    public function getPets(): ArrayCollection {
        return $this->pets;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setPets(ArrayCollection $pets) {
        $this->pets = $pets;
        return $this;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

}
