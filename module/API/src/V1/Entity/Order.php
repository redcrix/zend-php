<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="orders")
 * @ORM\Entity
 */
class Order {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Pet
     * 
     * @ORM\ManyToOne(targetEntity="Pet")
     * @ORM\JoinColumn(name="pet_id", referencedColumnName="id", nullable=false)
     */
    private $pet;

    /**
     * Owner
     * 
     * @ORM\ManyToOne(targetEntity="Owner")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", nullable=false)
     */
    private $owner;

    /**
     * Endereco
     * 
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     */
    private $address;

    /**
     * Pet
     * 
     * @ORM\ManyToOne(targetEntity="PreOrder")
     * @ORM\JoinColumn(name="pre_order_id", referencedColumnName="id", nullable=false)
     */
    private $preOrder;

    /**
     * Payment
     * 
     * @ORM\Column(name="payment", type="text")
     */
    private $payment;

    /**
     * Preço
     * 
     * @ORM\Column(name="price", type="decimal", scale=2, nullable=true)
     */
    private $price;

    /**
     * Desconto
     * 
     * @ORM\Column(name="discount", type="decimal", scale=2, nullable=true)
     */
    private $discount;

    /**
     * Estatus
     * @var string|null
     * @ORM\Column(name="status", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $status;

    /**
     * Rastreador
     * @var string|null
     * @ORM\Column(name="tracker", type="string", length=200, precision=0, scale=0, nullable=false, unique=false)
     */
    private $tracker;

    /**
     * Moeda
     * @var string|null
     * @ORM\Column(name="currency", type="string", length=8, precision=0, scale=0, nullable=false, unique=false)
     */
    private $currency;

    /**
     * Data de cadastro
     * @var \DateTime
     * @ORM\Column(name="register", type="datetime")
     */
    private $register;

    /**
     * Vendedor
     * 
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="seller_id", referencedColumnName="id")
     */
    private $seller;

    /**
     * Cupom de desconto
     * 
     * @ORM\OneToOne(targetEntity="Cupom")
     * @ORM\JoinColumn(name="cupom_id", referencedColumnName="id")
     */
    private $cupom;

    public function __construct() {
        
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getPet() {
        return $this->pet;
    }

    public function getOwner() {
        return $this->owner;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getPreOrder() {
        return $this->preOrder;
    }

    public function getPayment() {
        return $this->payment;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getRegister(): \DateTime {
        return $this->register;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setPet($pet) {
        $this->pet = $pet;
        return $this;
    }

    public function setOwner($owner) {
        $this->owner = $owner;
        return $this;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    public function setPreOrder($preOrder) {
        $this->preOrder = $preOrder;
        return $this;
    }

    public function setPayment($payment) {
        $this->payment = $payment;
        return $this;
    }

    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    public function setRegister(\DateTime $register) {
        $this->register = $register;
        return $this;
    }

    public function getCurrency() {
        return $this->currency;
    }

    public function setCurrency($currency) {
        $this->currency = $currency;
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getTracker() {
        return $this->tracker;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    public function setTracker($tracker) {
        $this->tracker = $tracker;
        return $this;
    }

    public function getSeller() {
        return $this->seller;
    }

    public function setSeller($seller) {
        $this->seller = $seller;
        return $this;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
        return $this;
    }

    public function getCupom() {
        return $this->cupom;
    }

    public function setCupom($cupom) {
        $this->cupom = $cupom;
        return $this;
    }

}
