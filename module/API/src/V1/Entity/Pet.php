<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Pet
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="pets")
 * @ORM\Entity
 */
class Pet {

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="API\V1\Util\Doctrine\ProntuarioIdGenerator")
     */
    private $id;

    /**
     * Nome do pet
     * @var string|null
     * @ORM\Column(name="name", type="string", length=120, precision=0, scale=0, nullable=true, unique=false)
     */
    private $name;

    /**
     * Nome do pet
     * @var string|null
     * @ORM\Column(name="sex", type="string", length=1)
     */
    private $sex;

    /**
     * Nascimento do pet
     * @ORM\Column(name="birthdate", type="date", length=20, nullable=true)
     */
    private $birthdate;

    /**
     * Cor do animal
     * @ORM\Column(name="color", type="string", length=80, nullable=true)
     */
    private $color;

    /**
     * Origem do pet
     * @var string|null
     * @ORM\Column(name="orign", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $orign;

    /**
     * Pedigree do pet
     * @var string|null
     * @ORM\Column(name="pedigree", type="string", length=120, precision=0, scale=0, nullable=true, unique=false)
     */
    private $pedigree;

    /**
     * Microchip do Pet
     * @var string|null
     * @ORM\Column(name="microchip", type="string", length=120, precision=0, scale=0, nullable=true, unique=false)
     */
    private $microchip;

    /**
     * QRCode do pet
     * @var Image
     * @ORM\OneToOne(targetEntity="Image")
     * @ORM\JoinColumn(name="qr_code", referencedColumnName="id")
     */
    private $qrCode;

    /**
     * Data de cadastro do pet
     * @var \DateTime
     * @ORM\Column(name="creation", type="datetime")
     */
    private $creation;

    /**
     * Raça do pet
     * @var string
     * @ORM\Column(name="race", type="string", length=120, precision=0, scale=0, nullable=true, unique=false)
     */
    private $race;

    /**
     * Espécie do pet
     * @var string
     * @ORM\Column(name="specie", type="string", length=120, precision=0, scale=0, nullable=true, unique=false)
     */
    private $specie;

    /**
     * Dono do pet
     * @var Owner
     * @ORM\ManyToOne(targetEntity="Owner", inversedBy="pets")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     */
    private $owner;

    /**
     * @ORM\ManyToOne(targetEntity="Employee", inversedBy="pets")
     * @ORM\JoinColumn(name="employee_id", referencedColumnName="id")
     */
    private $employee;

    /**
     * @ORM\ManyToOne(targetEntity="BusinessManager", inversedBy="pets")
     * @ORM\JoinColumn(name="manager_id", referencedColumnName="id")
     */
    private $manager;

    /**
     * Foto do pet
     * @var Image
     * @ORM\OneToOne(targetEntity="Image")
     * @ORM\JoinColumn(name="photo_id", referencedColumnName="id")
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity="Clinic", inversedBy="pets")
     * @ORM\JoinTable(name="clinics_x_pets",
     *      joinColumns={@ORM\JoinColumn(name="pet_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="clinic_id", referencedColumnName="id")}
     *      )
     */
    private $clinics;

    /**
     * Flag que controla se o pet está deletado
     * @var boolean
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted = false;

    /**
     * Serviços realizados por clinicas
     * 
     * @ORM\OneToMany(targetEntity="GroomingHistory", mappedBy="pet")
     */
    private $groomings;

    /**
     * Histórias de atendimento do pet
     * 
     * @ORM\OneToMany(targetEntity="History", mappedBy="pet")
     */
    private $histories;

    /**
     * Histórias de atendimento do pet em PDF
     * 
     * @ORM\OneToMany(targetEntity="HistoryPdf", mappedBy="pet")
     */
    private $historiesPdf;

    public function __construct() {
        $this->clinics = new ArrayCollection();
        $this->histories = new ArrayCollection();
        $this->historiesPdf = new ArrayCollection();
        $this->groomings = new ArrayCollection();
    }

    ######### Auxiliares #########

    /**
     * Adiciona uma história ao pet
     * @param \API\V1\Entity\History $history
     * @return $this
     */
    public function addHistory(History $history) {
        if ($this->histories->contains($history)) {
            return $this;
        }

        $history->setPet($this);
        $this->histories->add($history);
        return $this;
    }

    /**
     * Adiciona um pet a uma clinica
     * @param \API\V1\Entity\Clinic $clinic
     * @return $this
     */
    public function addClinic(Clinic $clinic) {
        if ($this->clinics->contains($clinic)) {
            return $this;
        }

        $clinic->getPets()->add($this);
        $this->clinics->add($clinic);
        return $this;
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSex() {
        return $this->sex;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }

    public function getColor() {
        return $this->color;
    }

    public function getOrign() {
        return $this->orign;
    }

    public function getPedigree() {
        return $this->pedigree;
    }

    public function getQrCode() {
        return $this->qrCode;
    }

    public function getCreation() {
        return $this->creation;
    }

    public function getHistories() {
        return $this->histories;
    }

    public function getRace() {
        return $this->race;
    }

    public function getSpecie() {
        return $this->specie;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function getEmployee() {
        return $this->employee;
    }

    public function getManager() {
        return $this->manager;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getClinics() {
        return $this->clinics;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setSex($sex) {
        $this->sex = $sex;
        return $this;
    }

    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
        return $this;
    }

    public function setColor($color) {
        $this->color = $color;
        return $this;
    }

    public function setOrign($orign) {
        $this->orign = $orign;
        return $this;
    }

    public function setPedigree($pedigree) {
        $this->pedigree = $pedigree;
        return $this;
    }

    public function setQrCode($qrCode) {
        $this->qrCode = $qrCode;
        return $this;
    }

    public function setCreation($creation) {
        $this->creation = $creation;
        return $this;
    }

    public function setHistories($histories) {
        $this->histories = $histories;
        return $this;
    }
    
    public function setRace($race) {
        $this->race = $race;
        return $this;
    }

    public function setSpecie($specie) {
        $this->specie = $specie;
        return $this;
    }

    public function setOwner(Owner $owner) {
        $this->owner = $owner;
        return $this;
    }

    public function setEmployee($employee) {
        $this->employee = $employee;
        return $this;
    }

    public function setManager($manager) {
        $this->manager = $manager;
        return $this;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
        return $this;
    }

    public function setClinics($clinics) {
        $this->clinics = $clinics;
        return $this;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
        return $this;
    }

    public function getMicrochip() {
        return $this->microchip;
    }

    public function setMicrochip($microchip) {
        $this->microchip = $microchip;
        return $this;
    }

    public function getGroomings() {
        return $this->groomings;
    }

    public function getHistoriesPdf() {
        return $this->historiesPdf;
    }

    public function setGroomings($groomings) {
        $this->groomings = $groomings;
        return $this;
    }

    public function setHistoriesPdf($historiesPdf) {
        $this->historiesPdf = $historiesPdf;
        return $this;
    }

}
