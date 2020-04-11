<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logger
 * 
 * Classo de registro de logs para transações financeiras
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="transaction_logs")
 * @ORM\Entity
 */
class Logger {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * IP do usuário que fez a transação
     * @var string     
     * @ORM\Column(name="ip", type="string", length=16, precision=0, scale=0, nullable=false)
     */
    private $ip;

    /**
     * Ação executada JSON (Query + Parametros)
     * @var string     
     * @ORM\Column(name="action", type="text")
     */
    private $action;

    /**
     * Usuário que fez a transação
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Data de criação do log
     * @var \DateTime
     * @ORM\Column(name="creation", type="datetime")
     */
    private $creation;

    public function __construct() {
        
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getIp() {
        return $this->ip;
    }

    public function getAction() {
        return $this->action;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getCreation(): \DateTime {
        return $this->creation;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setIp($ip) {
        $this->ip = $ip;
        return $this;
    }

    public function setAction($action) {
        $this->action = $action;
        return $this;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    public function setCreation(\DateTime $creation) {
        $this->creation = $creation;
        return $this;
    }

}
