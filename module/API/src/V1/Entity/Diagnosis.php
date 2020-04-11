<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagnosis
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="diagnosis")
 * @ORM\Entity
 */
class Diagnosis {

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
     * @ORM\Column(name="nome", type="string", nullable=true)
     */
    private $name;

    /**
     * Autorizado
     * @var string
     * @ORM\Column(name="authorized", type="boolean")
     */
    private $authorized;

    /**
     * Dia
     * @var string
     * @ORM\Column(name="dia", type="date")
     */
    private $dia;

    /**
     * Laboratorio
     * @var string
     * @ORM\Column(name="laboratory", type="string", nullable=true)
     */
    private $laboratory;

    /**
     * Resultado é um arquivo?
     * @var string
     * @ORM\Column(name="result_is_file", type="boolean")
     */
    private $resultIsFile = false;

    /**
     * Resultado
     * @var string
     * @ORM\Column(name="result_text", type="text")
     */
    private $resultText = '';

    /**
     * Interpretação
     * @var string
     * @ORM\Column(name="interpretation", type="text")
     */
    private $interpretation = '';

    /**
     * @ORM\ManyToMany(targetEntity="Image")
     * @ORM\JoinTable(name="diagnosis_x_results",
     *      joinColumns={@ORM\JoinColumn(name="file_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="diagnosisid", referencedColumnName="id")}
     *      )
     */
    private $resultFile;

    /**
     * Historia / Atendimento
     * @ORM\ManyToOne(targetEntity="History", inversedBy="diagnosis")
     * @ORM\JoinColumn(name="history_id", referencedColumnName="id")
     */
    private $history;

    /**
     * Pet da história
     * @ORM\ManyToOne(targetEntity="Pet")
     * @ORM\JoinColumn(name="pet_id", referencedColumnName="id")
     */
    private $pet;

    /**
     * Usuário do funcionário
     * @var Veterinary
     * @ORM\ManyToOne(targetEntity="Veterinary")
     * @ORM\JoinColumn(name="veterinary_id", referencedColumnName="id")
     */
    private $veterinary;

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
            if (\property_exists(Diagnosis::class, $key)) {
                $dados[$key] = $value;
            }
        }
        $dados['veterinary'] = $this->veterinary->getData();
        return $dados;
    }

    /**
     * Hidrata a entidade para cadastro e edição
     * @param stdClass $data
     */
    public function setData($data) {
        foreach ($data as $key => $value) {
            if (\property_exists(Diagnosis::class, $key) && $key != 'id') {
                $this->{$key} = $value;
            }
        }
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getAuthorized() {
        return $this->authorized;
    }

    public function getDia() {
        return $this->dia;
    }

    public function getLaboratory() {
        return $this->laboratory;
    }

    public function getResultIsFile() {
        return $this->resultIsFile;
    }

    public function getResultText() {
        return $this->resultText;
    }

    public function getResultFile() {
        return $this->resultFile;
    }

    public function getHistory() {
        return $this->history;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setAuthorized($authorized) {
        $this->authorized = $authorized;
        return $this;
    }

    public function setDia($dia) {
        $this->dia = $dia;
        return $this;
    }

    public function setLaboratory($laboratory) {
        $this->laboratory = $laboratory;
        return $this;
    }

    public function setResultIsFile($resultIsFile) {
        $this->resultIsFile = $resultIsFile;
        return $this;
    }

    public function setResultText($resultText) {
        $this->resultText = $resultText;
        return $this;
    }

    public function setResultFile($resultFile) {
        $this->resultFile = $resultFile;
        return $this;
    }

    public function setHistory($history) {
        $this->history = $history;
        return $this;
    }

    public function getInterpretation() {
        return $this->interpretation;
    }

    public function setInterpretation($interpretation) {
        $this->interpretation = $interpretation;
        return $this;
    }

    public function getPet() {
        return $this->pet;
    }

    public function setPet($pet) {
        $this->pet = $pet;
        return $this;
    }

    public function getVeterinary(): Veterinary {
        return $this->veterinary;
    }

    public function setVeterinary(Veterinary $veterinary) {
        $this->veterinary = $veterinary;
        return $this;
    }

}
