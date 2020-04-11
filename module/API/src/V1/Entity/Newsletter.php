<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="newsletters")
 * @ORM\Entity
 */
class Newsletter {

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
     * @ORM\Column(name="type", type="string", length=20, precision=0, scale=0, nullable=false, unique=false)
     */
    private $type;

    /**
     * E-mail do lead
     * @var string     
     * @ORM\Column(name="lang", type="string", length=10, precision=0, scale=0, nullable=false, unique=false)
     */
    private $lang;

    /**
     * Data de cadastro do lead
     * @var \DateTime
     * @ORM\Column(name="register", type="datetime")
     */
    private $register;

    public function __construct() {
        
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
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

    public function getType() {
        return $this->type;
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

    public function setType($type) {
        $this->type = $type;
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

}
