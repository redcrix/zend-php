<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GroomingService
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="grooming_services")
 * @ORM\Entity
 */
class GroomingService {

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
     * Preço
     * @var string
     * @ORM\Column(name="price", type="decimal", scale=2, nullable=true)
     */
    private $price;

    /**
     * Deletado?
     * @var string
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted = false;

    /**
     * Clínica
     * @var Clinic
     * @ORM\ManyToOne(targetEntity="Clinic")
     * @ORM\JoinColumn(name="clinic_id", referencedColumnName="id")
     */
    private $clinic;

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
            if (\property_exists(GroomingService::class, $key)) {
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
            if (\property_exists(GroomingService::class, $key) && $key != 'id') {
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

    public function getPrice() {
        return $this->price;
    }

    public function getClinic() {
        return $this->clinic;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
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

    public function getDeleted() {
        return $this->deleted;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
        return $this;
    }

}
