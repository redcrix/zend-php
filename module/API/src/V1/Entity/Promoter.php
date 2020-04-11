<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Promotor
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="promoters")
 * @ORM\Entity
 */
class Promoter {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Usuário do gerente
     * @var User
     * @ORM\ManyToOne(targetEntity="User", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Cupom Base
     * @var string|null
     * @ORM\Column(name="base", type="string", length=150, precision=0, scale=0, nullable=false, unique=true)
     */
    private $base;

    /**
     * Comissão em porcentagem
     * @ORM\Column(name="commission", type="integer")
     */
    private $commission;

    /**
     * Variantes de cupons
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Cupom", mappedBy="promoter")
     */
    private $cupons;

    /**
     * Deletado?
     * @var string
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted = false;

    public function __construct() {
        $this->cupons = new ArrayCollection();
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getBase() {
        return $this->base;
    }

    public function getCommission() {
        return $this->commission;
    }

    public function getCupons(): ArrayCollection {
        return $this->cupons;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    public function setBase($base) {
        $this->base = $base;
        return $this;
    }

    public function setCommission($commission) {
        $this->commission = $commission;
        return $this;
    }

    public function setCupons(ArrayCollection $cupons) {
        $this->cupons = $cupons;
        return $this;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
        return $this;
    }
    
}
