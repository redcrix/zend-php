<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroomingHistory
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="pet_grooming_history")
 * @ORM\Entity
 */
class GroomingHistory {

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
     * Nome
     * @var string
     * @ORM\Column(name="qtd", type="integer", nullable=true)
     */
    private $qtd;

    /**
     * Preço
     * @var string
     * @ORM\Column(name="price", type="decimal", scale=2, nullable=true)
     */
    private $price;

    /**
     * Clínica
     * @ORM\ManyToOne(targetEntity="Clinic")
     * @ORM\JoinColumn(name="clinic_id", referencedColumnName="id")
     */
    private $clinic;

    /**
     * Pet
     * @ORM\ManyToOne(targetEntity="Pet")
     * @ORM\JoinColumn(name="pet_id", referencedColumnName="id")
     */
    private $pet;

    /**
     * User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $profissional;

    /**
     * Data de realização
     * @var \DateTime
     * @ORM\Column(name="creation", type="datetime")
     */
    private $creation;

    /**
     * Obs
     * @var string
     * @ORM\Column(name="obs", type="text")
     */
    private $obs = '';

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
            if (\property_exists(GroomingHistory::class, $key)) {
                $dados[$key] = $value;
            }
        }
        unset($dados['id']);
        return $dados;
    }

    /**
     * Hidrata a entidade para cadastro e edição
     * @param stdClass $data
     */
    public function setData($data) {
        foreach ($data as $key => $value) {
            if (\property_exists(GroomingHistory::class, $key) && $key != 'id') {
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

    public function getQtd() {
        return $this->qtd;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getClinic() {
        return $this->clinic;
    }

    public function getPet() {
        return $this->pet;
    }

    public function getProfissional() {
        return $this->profissional;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setQtd($qtd) {
        $this->qtd = $qtd;
        return $this;
    }

    public function setPrice($price) {
        $this->price = $price;
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

    public function setProfissional($profissional) {
        $this->profissional = $profissional;
        return $this;
    }

    public function getCreation(): \DateTime {
        return $this->creation;
    }

    public function setCreation(\DateTime $creation) {
        $this->creation = $creation;
        return $this;
    }

    public function getObs() {
        return $this->obs;
    }

    public function setObs($obs) {
        $this->obs = $obs;
        return $this;
    }

}
