<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="histories")
 * @ORM\Entity
 */
class History {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Clinica responsável
     * @ORM\ManyToOne(targetEntity="Clinic")
     * @ORM\JoinColumn(name="clinic_id", referencedColumnName="id")
     */
    private $clinic;

    /**
     * Pet da história
     * @ORM\ManyToOne(targetEntity="Pet", inversedBy="histories")
     * @ORM\JoinColumn(name="pet_id", referencedColumnName="id")
     */
    private $pet;

    /**
     * Ações / Iterações de veterinários
     * @ORM\OneToMany(targetEntity="HistoryAction", mappedBy="history")
     */
    private $actions;

    /**
     * Planos diagnóstico / Exames
     * @ORM\OneToMany(targetEntity="Diagnosis", mappedBy="history")
     */
    private $diagnosis;

    /**
     * Plano terapeutico  / Medicações
     * @ORM\OneToMany(targetEntity="TherapeuticPlan", mappedBy="history")
     */
    private $therapeuticPlan;

    /**
     * Motivo
     * @var string
     * @ORM\Column(name="reason", type="text")
     */
    private $reason = '';

    /**
     * Anamnese
     * @var string
     * @ORM\Column(name="anamnesics", type="text")
     */
    private $anamnesics = '';

    /**
     * Diagnostico presumido
     * @var string
     * @ORM\Column(name="presumptive_diagnosis", type="string")
     */
    private $presumptiveDiagnosis = '';

    /**
     * Impressão diagnóstica
     * @var string
     * @ORM\Column(name="impression_diagnosis", type="text")
     */
    private $impressionDiagnosis = '';

    /**
     * Data de cadastro
     * @ORM\Column(name="creation", type="datetime")
     */
    private $creation;

    /**
     * Data de alta
     * @ORM\Column(name="release_date", type="datetime", nullable=true)
     */
    private $release;

    /**
     * User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_creation", referencedColumnName="id")
     */
    private $userCreation;

    /**
     * User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_release", referencedColumnName="id")
     */
    private $userRelease;

    /**
     * Nursery
     * @ORM\ManyToOne(targetEntity="Nursery")
     * @ORM\JoinColumn(name="nursery_id", referencedColumnName="id")
     */
    private $nursery;

    public function __construct() {
        
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getClinic() {
        return $this->clinic;
    }

    public function getPet() {
        return $this->pet;
    }

    public function getActions() {
        return $this->actions;
    }

    public function getDiagnosis() {
        return $this->diagnosis;
    }

    public function getTherapeuticPlan() {
        return $this->therapeuticPlan;
    }

    public function getReason() {
        return $this->reason;
    }

    public function getAnamnesics() {
        return $this->anamnesics;
    }

    public function getPresumptiveDiagnosis() {
        return $this->presumptiveDiagnosis;
    }

    public function getImpressionDiagnosis() {
        return $this->impressionDiagnosis;
    }

    public function getCreation() {
        return $this->creation;
    }

    public function getRelease() {
        return $this->release;
    }

    public function getUserCreation() {
        return $this->userCreation;
    }

    public function getUserRelease() {
        return $this->userRelease;
    }

    public function getNursery() {
        return $this->nursery;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setClinic($clinic) {
        $this->clinic = $clinic;
        return $this;
    }

    public function setPet($pet) {
        $this->pet = $pet;
        return $this;
    }

    public function setActions($actions) {
        $this->actions = $actions;
        return $this;
    }

    public function setDiagnosis($diagnosis) {
        $this->diagnosis = $diagnosis;
        return $this;
    }

    public function setTherapeuticPlan($therapeuticPlan) {
        $this->therapeuticPlan = $therapeuticPlan;
        return $this;
    }

    public function setReason($reason) {
        $this->reason = $reason;
        return $this;
    }

    public function setAnamnesics($anamnesics) {
        $this->anamnesics = $anamnesics;
        return $this;
    }

    public function setPresumptiveDiagnosis($presumptiveDiagnosis) {
        $this->presumptiveDiagnosis = $presumptiveDiagnosis;
        return $this;
    }

    public function setImpressionDiagnosis($impressionDiagnosis) {
        $this->impressionDiagnosis = $impressionDiagnosis;
        return $this;
    }

    public function setCreation($creation) {
        $this->creation = $creation;
        return $this;
    }

    public function setRelease($release) {
        $this->release = $release;
        return $this;
    }

    public function setUserCreation($userCreation) {
        $this->userCreation = $userCreation;
        return $this;
    }

    public function setUserRelease($userRelease) {
        $this->userRelease = $userRelease;
        return $this;
    }

    public function setNursery($nursery) {
        $this->nursery = $nursery;
        return $this;
    }

}
