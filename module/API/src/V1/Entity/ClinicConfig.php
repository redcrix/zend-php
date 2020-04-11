<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClinicConfig
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="clinic_config")
 * @ORM\Entity
 */
class ClinicConfig {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="crt", type="string", length=10, nullable=true)
     */
    private $crt;

    /**
     * @var string
     * @ORM\Column(name="hr", type="string", length=10, nullable=true)
     */
    private $hr;

    /**
     * @var string
     * @ORM\Column(name="rf", type="string", length=10, nullable=true)
     */
    private $rf;

    /**
     * @var string
     * @ORM\Column(name="pulse", type="string", length=10, nullable=true)
     */
    private $pulse;

    /**
     * @var string
     * @ORM\Column(name="temperature", type="string", length=10, nullable=true)
     */
    private $temperature;

    /**
     * @var string
     * @ORM\Column(name="weight", type="string", length=10, nullable=true)
     */
    private $weight;

    /**
     * @var string
     * @ORM\Column(name="currency", type="string", length=3, nullable=true)
     */
    private $currency;

    /**
     * @var string
     * @ORM\Column(name="thousands_sep", type="string", length=1, nullable=true)
     */
    private $thousandsSep;

    /**
     * @var string
     * @ORM\Column(name="decimal_sep", type="string", length=1, nullable=true)
     */
    private $decimalSep;

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
            if (\property_exists(ClinicConfig::class, $key)) {
                $dados[$key] = $value;
            }
        }
        unset($dados['id']);
        return $dados;
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getCrt() {
        return $this->crt;
    }

    public function getHr() {
        return $this->hr;
    }

    public function getRf() {
        return $this->rf;
    }

    public function getPulse() {
        return $this->pulse;
    }

    public function getTemperature() {
        return $this->temperature;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setCrt($crt) {
        $this->crt = $crt;
        return $this;
    }

    public function setHr($hr) {
        $this->hr = $hr;
        return $this;
    }

    public function setRf($rf) {
        $this->rf = $rf;
        return $this;
    }

    public function setPulse($pulse) {
        $this->pulse = $pulse;
        return $this;
    }

    public function setTemperature($temperature) {
        $this->temperature = $temperature;
        return $this;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
        return $this;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
        return $this;
    }

}
