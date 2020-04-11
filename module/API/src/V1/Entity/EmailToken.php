<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EmailToken
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="email_token")
 * @ORM\Entity
 */
class EmailToken {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * E-mail de destino do token
     * @var string
     * @ORM\Column(name="email", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $email;

    /**
     * Clínica em caso de funcionários
     * @var Clinic
     * @ORM\ManyToOne(targetEntity="Clinic")
     * @ORM\JoinColumn(name="clinic_id", referencedColumnName="id")
     */
    private $clinic;

    /**
     * Se o token é para um funcionário
     * @var string
     * @ORM\Column(name="is_employee", type="boolean")
     */
    private $isEmployee = false;

    /**
     * Token para validação de e-mail
     * @var string
     * @ORM\Column(name="token", type="text")
     */
    private $token;

    /**
     * Tipo do token
     * @var string
     * @ORM\Column(name="type", type="string", length=20)
     */
    private $type;

    /**
     * Flag que controla se o token já foi usado
     * @var boolean
     * @ORM\Column(name="is_used", type="boolean")
     */
    private $isUsed;

    /**
     * Data de envio do token
     * @var \DateTime
     * @ORM\Column(name="date_send", type="datetime")
     */
    private $dateSend;

    /**
     * Data de uso do token
     * @var \DateTime
     * @ORM\Column(name="date_use", type="datetime", nullable=true)
     */
    private $dateUse;

    public function __construct() {
        
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getClinic(): Clinic {
        return $this->clinic;
    }

    public function getIsEmployee() {
        return $this->isEmployee;
    }

    public function getToken() {
        return $this->token;
    }

    public function getType() {
        return $this->type;
    }

    public function getIsUsed() {
        return $this->isUsed;
    }

    public function getDateSend(): \DateTime {
        return $this->dateSend;
    }

    public function getDateUse(): \DateTime {
        return $this->dateUse;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setClinic(Clinic $clinic) {
        $this->clinic = $clinic;
        return $this;
    }

    public function setIsEmployee($isEmployee) {
        $this->isEmployee = $isEmployee;
        return $this;
    }

    public function setToken($token) {
        $this->token = $token;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setIsUsed($isUsed) {
        $this->isUsed = $isUsed;
        return $this;
    }

    public function setDateSend(\DateTime $dateSend) {
        $this->dateSend = $dateSend;
        return $this;
    }

    public function setDateUse(\DateTime $dateUse) {
        $this->dateUse = $dateUse;
        return $this;
    }

}
