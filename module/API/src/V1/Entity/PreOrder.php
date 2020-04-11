<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PreOrder
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="pre_orders")
 * @ORM\Entity
 */
class PreOrder {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * E-mail do lead
     * @var string     
     * @ORM\Column(name="email", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $email;

    /**
     * E-mail do lead
     * @var string     
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * E-mail do lead
     * @var string     
     * @ORM\Column(name="phone", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
     */
    private $phone;

    /**
     * E-mail do lead
     * @var string     
     * @ORM\Column(name="pet", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $pet;

    /**
     * E-mail do lead
     * @var string     
     * @ORM\Column(name="lang", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $lang;

    /**
     * Link para fechar o pedido
     * @var string     
     * @ORM\Column(name="link", type="string", length=255, precision=0, scale=0, nullable=false, unique=true)
     */
    private $link;

    /**
     * Data de cadastro do lead
     * @var \DateTime
     * @ORM\Column(name="register", type="datetime")
     */
    private $register;

    /**
     * Dados da etapa 1
     * @var string     
     * @ORM\Column(name="etapa1", type="text")
     */
    private $etapa1 = '';

    /**
     * Dados da etapa 2
     * @var string     
     * @ORM\Column(name="etapa2", type="text")
     */
    private $etapa2 = '';

    /**
     * Cupom de desconto
     * @var string     
     * @ORM\Column(name="cupom", type="string", length=30)
     */
    private $cupom = '';

    /**
     * URL de promotor
     * @var string     
     * @ORM\Column(name="base", type="string", length=150)
     */
    private $base = '';

    /**
     * Dados da sessao stripe
     * @var string     
     * @ORM\Column(name="stripe", type="text")
     */
    private $stripe = '';

    public function __construct() {
        
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getPet() {
        return $this->pet;
    }

    public function getLang() {
        return $this->lang;
    }

    public function getRegister(): \DateTime {
        return $this->register;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
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

    public function setPet($pet) {
        $this->pet = $pet;
        return $this;
    }

    public function setLang($lang) {
        $this->lang = $lang;
        return $this;
    }

    public function setRegister(\DateTime $register) {
        $this->register = $register;
        return $this;
    }

    public function getLink() {
        return $this->link;
    }

    public function setLink($link) {
        $this->link = $link;
        return $this;
    }

    public function getEtapa1() {
        return $this->etapa1;
    }

    public function getEtapa2() {
        return $this->etapa2;
    }

    public function setEtapa1($etapa1) {
        $this->etapa1 = $etapa1;
        return $this;
    }

    public function setEtapa2($etapa2) {
        $this->etapa2 = $etapa2;
        return $this;
    }

    public function getStripe() {
        return $this->stripe;
    }

    public function setStripe($stripe) {
        $this->stripe = $stripe;
        return $this;
    }

    public function getCupom() {
        return $this->cupom;
    }

    public function getBase() {
        return $this->base;
    }

    public function setCupom($cupom) {
        $this->cupom = $cupom;
        return $this;
    }

    public function setBase($base) {
        $this->base = $base;
        return $this;
    }

}
