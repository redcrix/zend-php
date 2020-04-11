<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HistoryAction
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="histories_actions")
 * @ORM\Entity
 */
class HistoryAction {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="bigint")
     */
    private $id;

    /**
     * Categoria
     * @var string
     * @ORM\Column(name="category", type="string", length=50, nullable=false)
     */
    private $category;

    /**
     * Criação
     * @var string
     * @ORM\Column(name="creation", type="datetime")
     */
    private $creation;

    /**
     * Valor
     * @var string
     * @ORM\Column(name="valor", type="text")
     */
    private $value = '';

    /**
     * Obs
     * @var string
     * @ORM\Column(name="obs", type="string", length=255)
     */
    private $obs = '';

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

    /**
     * História
     * @var History
     * @ORM\ManyToOne(targetEntity="History", inversedBy="actions")
     * @ORM\JoinColumn(name="history_id", referencedColumnName="id")
     */
    private $history;

    public function __construct() {
        
    }

    /**
     * Recupera dados de um endereço como array associativo
     * @return array
     */
    public function getData() {
        $dados = [];
        foreach ($this as $key => $value) {
            if (\property_exists(HistoryAction::class, $key)) {
                $dados[$key] = $value;
            }
        }
        $dados['veterinary'] = $this->veterinary->getData();
        return $dados;
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getCreation() {
        return $this->creation;
    }

    public function getValue() {
        return $this->value;
    }

    public function getObs() {
        return $this->obs;
    }

    public function getVeterinary(): Veterinary {
        return $this->veterinary;
    }

    public function getPet(): Pet {
        return $this->pet;
    }

    public function getHistory(): History {
        return $this->history;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setCategory($category) {
        $this->category = $category;
        return $this;
    }

    public function setCreation($creation) {
        $this->creation = $creation;
        return $this;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function setObs($obs) {
        $this->obs = $obs;
        return $this;
    }

    public function setVeterinary(Veterinary $veterinary) {
        $this->veterinary = $veterinary;
        return $this;
    }

    public function setPet(Pet $pet) {
        $this->pet = $pet;
        return $this;
    }

    public function setHistory(History $history) {
        $this->history = $history;
        return $this;
    }

}
