<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Enfermaria de pets
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="nurseries")
 * @ORM\Entity
 */
class Nursery {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Nome da raça
     * @var string|null
     * @ORM\Column(name="room_name", type="string", length=120, precision=0, scale=0, nullable=true, unique=false)
     */
    private $roomName;

    /**
     * Clínica
     * @var Clinic
     * @ORM\OneToOne(targetEntity="Clinic", inversedBy="nursery")
     * @ORM\JoinColumn(name="clinic_id", referencedColumnName="id")
     */
    private $clinic;

    /**
     * @ORM\ManyToMany(targetEntity="Pet")
     * @ORM\JoinTable(name="nurseries_x_pets",
     *      joinColumns={@ORM\JoinColumn(name="nursery_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="pet_id", referencedColumnName="id")}
     *      )
     */
    private $pets;

    public function __construct() {
        $this->pets = new ArrayCollection();
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getRoomName() {
        return $this->roomName;
    }

    public function getClinic() {
        return $this->clinic;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setRoomName($roomName) {
        $this->roomName = $roomName;
        return $this;
    }

    public function setClinic($clinic) {
        $this->clinic = $clinic;
        return $this;
    }

    public function getPets() {
        return $this->pets;
    }

    public function setPets($pets) {
        $this->pets = $pets;
        return $this;
    }

}
