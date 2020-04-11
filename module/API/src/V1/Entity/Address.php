<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="address")
 * @ORM\Entity
 */
class Address {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Nome da rua, avenida, logradouro...
     * @var string
     * @ORM\Column(name="address", type="string", nullable=true)
     */
    private $address;

    /**
     * Complemento do endereço
     * @var string
     * @ORM\Column(name="address2", type="string", nullable=true)
     */
    private $address2;

    /**
     * Complemento do endereço extra
     * @var string
     * @ORM\Column(name="address3", type="string", nullable=true)
     */
    private $address3;

    /**
     * Número do endereço
     * @var string
     * @ORM\Column(name="number", type="string", length=100, nullable=true)
     */
    private $number;

    /**
     * Código postal
     * @var string
     * @ORM\Column(name="zipcode", type="string", length=100, nullable=true)
     */
    private $zipcode;

    /**
     * Cidade do endereço
     * @var string
     * @ORM\Column(name="city", type="string", length=150, nullable=true)
     */
    private $city;

    /**
     * Estado do endereço
     * @var string
     * @ORM\Column(name="state", type="string", length=150, nullable=true)
     */
    private $state;

    /**
     * País
     * #var string
     * @ORM\Column(name="country", type="string", length=150, nullable=true)
     */
    private $country;

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
            if (\property_exists(Address::class, $key)) {
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
            if (\property_exists(Address::class, $key) && $key != 'id') {
                $this->{$key} = $value;
            }
        }
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getAddress2() {
        return $this->address2;
    }

    public function getAddress3() {
        return $this->address3;
    }

    public function getNumber() {
        return $this->number;
    }

    public function getZipcode() {
        return $this->zipcode;
    }

    public function getCity() {
        return $this->city;
    }

    public function getState() {
        return $this->state;
    }

    public function getCountry() {
        return $this->country;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    public function setAddress2($address2) {
        $this->address2 = $address2;
        return $this;
    }

    public function setAddress3($address3) {
        $this->address3 = $address3;
        return $this;
    }

    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    public function setZipcode($zipcode) {
        $this->zipcode = $zipcode;
        return $this;
    }

    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public function setState($state) {
        $this->state = $state;
        return $this;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

}
