<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Clinic
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="clinics")
 * @ORM\Entity
 */
class Clinic {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Nome da clínica
     * @var string|null
     * @ORM\Column(name="name", type="string", length=120, precision=0, scale=0, nullable=true, unique=false)
     */
    private $name;

    /**
     * Pesquisa de pet
     * @var integer|null
     * @ORM\Column(name="pesquisa_pet", type="integer", nullable=true)
     */
    private $pesquisaPet;

    /**
     * Documento da clínica
     * @var string|null
     * @ORM\Column(name="document", type="string", length=50, precision=0, scale=0, nullable=true, unique=false)
     */
    private $document;

    /**
     * Telefone da clínica
     * @var string
     * @ORM\Column(name="phone", type="string", length=20, precision=0, scale=0, nullable=true, unique=false)
     */
    private $phone;

    /**
     * Data de cadastro da clínica
     * @var \DateTime
     * @ORM\Column(name="creation", type="datetime")
     */
    private $creation;

    /**
     * Gerente de negócios da clínica
     * @var BusinessManager
     * @ORM\OneToOne(targetEntity="BusinessManager", inversedBy="clinic", cascade={"persist"})
     * @ORM\JoinColumn(name="manager_id", referencedColumnName="id")
     */
    private $manager;

    /**
     * Distribuidor da clínica
     * @var Distributor
     * @ORM\ManyToOne(targetEntity="Distributor", inversedBy="clinic")
     * @ORM\JoinColumn(name="distributor_id", referencedColumnName="id")
     */
    private $distributor;

    /**
     * Funcionários de uma clínica
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Employee", mappedBy="clinic")
     */
    private $employees;

    /**
     * Enfermarias da clínica
     * @var Nursery
     * @ORM\OneToOne(targetEntity="Nursery", mappedBy="clinic")
     */
    private $nursery;

    /**
     * Endereco da clínica
     * @var Address
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    private $address;

    /**
     * Foto do usuário
     * @var Image
     * @ORM\OneToOne(targetEntity="Image")
     * @ORM\JoinColumn(name="photo_id", referencedColumnName="id")
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity="Pet", mappedBy="clinics")
     */
    private $pets;

    /**
     * Flag que controla se a clínica está deletada
     * @var boolean
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted = false;

    /**
     * Flag que controla se a clínica está deletada
     * @var boolean
     * @ORM\Column(name="verified", type="boolean")
     */
    private $verified = true;

    /**
     * Flag que controla se o cadastro está completo
     * @var boolean
     * @ORM\Column(name="completed", type="boolean")
     */
    private $completed = true;

    /**
     * Usuario que homologou
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="homologed_by", referencedColumnName="id")
     */
    private $homologadoPor;

    /**
     * ClinicConfig
     * @ORM\OneToOne(targetEntity="ClinicConfig")
     * @ORM\JoinColumn(name="config_id", referencedColumnName="id")
     */
    private $config;

    public function __construct() {
        $this->employees = new ArrayCollection();
        $this->pets = new ArrayCollection();
    }

    ######### Auxiliares #########

    /**
     * Adiciona um funcionário
     * @param \API\V1\Entity\Employee $employee
     * @return $this
     */
    public function addEmployee(Employee $employee) {
        if ($this->employees->contains($employee)) {
            return $this;
        }

        $employee->setClinic($this);
        $this->employees->add($employee);
        return $this;
    }

    /**
     * Recupera a quantidade de pets de uma clínica
     * @return integer
     */
    public function getPetsCount() {
        $total = 0;
        foreach ($this->employees as $emp) {
            $total += $emp->getPetsCount();
        }
        return $total;
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getCreation() {
        return $this->creation;
    }

    public function getManager() {
        return $this->manager;
    }

    public function getDistributor() {
        return $this->distributor;
    }

    public function getEmployees() {
        return $this->employees;
    }

    public function getNursery() {
        return $this->nursery;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getPets() {
        return $this->pets;
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

    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    public function setCreation($creation) {
        $this->creation = $creation;
        return $this;
    }

    public function setManager($manager) {
        $this->manager = $manager;
        return $this;
    }

    public function setDistributor($distributor) {
        $this->distributor = $distributor;
        return $this;
    }

    public function setEmployees($employees) {
        $this->employees = $employees;
        return $this;
    }

    public function setNursery($nursery) {
        $this->nursery = $nursery;
        return $this;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
        return $this;
    }

    public function setPets($pets) {
        $this->pets = $pets;
        return $this;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
        return $this;
    }

    public function getVerified() {
        return $this->verified;
    }

    public function setVerified($verified) {
        $this->verified = $verified;
        return $this;
    }

    public function getDocument() {
        return $this->document;
    }

    public function setDocument($document) {
        $this->document = $document;
        return $this;
    }

    public function getPesquisaPet() {
        return $this->pesquisaPet;
    }

    public function setPesquisaPet($pesquisaPet) {
        $this->pesquisaPet = $pesquisaPet;
        return $this;
    }

    public function getHomologadoPor() {
        return $this->homologadoPor;
    }

    public function setHomologadoPor($homologadoPor) {
        $this->homologadoPor = $homologadoPor;
        return $this;
    }

    public function getConfig() {
        return $this->config;
    }

    public function setConfig($config) {
        $this->config = $config;
        return $this;
    }

    public function getCompleted() {
        return $this->completed;
    }

    public function setCompleted($completed) {
        $this->completed = $completed;
        return $this;
    }

}
