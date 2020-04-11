<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CountryPrice
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="countries_prices")
 * @ORM\Entity
 */
class CountryPrice {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * País
     * @var string
     * @ORM\Column(name="country", type="string", length=160)
     */
    private $country;

    /**
     * Moeda
     * @var string
     * @ORM\Column(name="currency", type="string", length=20)
     */
    private $currency;

    /**
     * Preço
     * @var string
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    public function __construct() {
        
    }

    ######### Auxiliares #########

    /**
     * Recupera dados como array associativo
     * @return array
     */
    public function getData() {
        $dados = [];
        foreach ($this as $key => $value) {
            if (\property_exists(CountryPrice::class, $key)) {
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
            if (\property_exists(CountryPrice::class, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
        return $this;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

}
