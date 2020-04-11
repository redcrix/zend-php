<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TherapeuticPlan
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="therapeutic_plan")
 * @ORM\Entity
 */
class TherapeuticPlan {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Nome
     * @var string
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    private $type;

    /**
     * Principio ativo
     * @var string
     * @ORM\Column(name="active_principle", type="string", nullable=true)
     */
    private $activePrinciple;

    /**
     * Principio ativo
     * @var string
     * @ORM\Column(name="presentation", type="string", nullable=true)
     */
    private $presentation;

    /**
     * Posologia
     * @var string
     * @ORM\Column(name="posology", type="string", nullable=true)
     */
    private $posology;

    /**
     * Dose total
     * @var string
     * @ORM\Column(name="total_dose", type="string", nullable=true)
     */
    private $totalDose;

    /**
     * Via
     * @var string
     * @ORM\Column(name="via", type="string", nullable=true)
     */
    private $via;

    /**
     * Frequencia
     * @var string
     * @ORM\Column(name="frequency", type="string", nullable=true)
     */
    private $frequency;

    /**
     * Historia / Atendimento
     * @ORM\ManyToOne(targetEntity="History", inversedBy="mucous")
     * @ORM\JoinColumn(name="history_id", referencedColumnName="id")
     */
    private $history;

    /**
     * Data de cadastro
     * @ORM\Column(name="creation", type="datetime", nullable=true)
     */
    private $creation;

    /**
     * Usuário do funcionário
     * @var Veterinary
     * @ORM\ManyToOne(targetEntity="Veterinary")
     * @ORM\JoinColumn(name="veterinary_id", referencedColumnName="id")
     */
    private $veterinary;

    /**
     * Pet
     * @var Pet
     * @ORM\ManyToOne(targetEntity="Pet")
     * @ORM\JoinColumn(name="pet_id", referencedColumnName="id")
     */
    private $pet;

    public function __construct() {
        
    }

    ######### Auxiliares #########

    /**
     * Recupera dados de um endereço como array associativo
     * @return array
     */
    public function getData() {
        $dados = [];
        foreach ($this as $key => $value) {
            if (\property_exists(TherapeuticPlan::class, $key)) {
                $dados[$key] = $value;
            }
        }
        return $dados;
    }

    /**
     * Hidrata a entidade para cadastro e edição
     * @param stdClass $data
     */
    public function setData($data) {
        foreach ($data as $key => $value) {
            if (\property_exists(TherapeuticPlan::class, $key) && $key != 'id') {
                $this->{$key} = $value;
            }
        }
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getType() {
        return $this->type;
    }

    public function getActivePrinciple() {
        return $this->activePrinciple;
    }

    public function getPresentation() {
        return $this->presentation;
    }

    public function getPosology() {
        return $this->posology;
    }

    public function getTotalDose() {
        return $this->totalDose;
    }

    public function getVia() {
        return $this->via;
    }

    public function getFrequency() {
        return $this->frequency;
    }

    public function getHistory() {
        return $this->history;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setActivePrinciple($activePrinciple) {
        $this->activePrinciple = $activePrinciple;
        return $this;
    }

    public function setPresentation($presentation) {
        $this->presentation = $presentation;
        return $this;
    }

    public function setPosology($posology) {
        $this->posology = $posology;
        return $this;
    }

    public function setTotalDose($totalDose) {
        $this->totalDose = $totalDose;
        return $this;
    }

    public function setVia($via) {
        $this->via = $via;
        return $this;
    }

    public function setFrequency($frequency) {
        $this->frequency = $frequency;
        return $this;
    }

    public function setHistory($history) {
        $this->history = $history;
        return $this;
    }

    public function getCreation() {
        return $this->creation;
    }

    public function setCreation($creation) {
        $this->creation = $creation;
        return $this;
    }

    public function getVeterinary() {
        return $this->veterinary;
    }

    public function setVeterinary(Veterinary $veterinary) {
        $this->veterinary = $veterinary;
        return $this;
    }

    public function getPet() {
        return $this->pet;
    }

    public function setPet(Pet $pet) {
        $this->pet = $pet;
        return $this;
    }

}
