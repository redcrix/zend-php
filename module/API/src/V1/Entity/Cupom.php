<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Variações de cupons
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="cupons")
 * @ORM\Entity
 */
class Cupom {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Promotor de vendas / divulgador / marketeiro
     * @var Promoter
     * @ORM\ManyToOne(targetEntity="Promoter", inversedBy="cupons")
     * @ORM\JoinColumn(name="promoter_id", referencedColumnName="id")
     */
    private $promoter;

    /**
     * Cupons
     * @ORM\Column(name="cupom", type="string", length=50)
     */
    private $cupom;

    /**
     * Desconto em porcentagem
     * @ORM\Column(name="discount", type="integer")
     */
    private $discount;

    /**
     * Deletado?
     * @var string
     * @ORM\Column(name="deleted", type="boolean")
     */
    private $deleted = false;

    public function __construct() {
        
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getPromoter(): Promoter {
        return $this->promoter;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function getDeleted() {
        return $this->deleted;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setPromoter(Promoter $promoter) {
        $this->promoter = $promoter;
        return $this;
    }

    public function setDiscount($discount) {
        $this->discount = $discount;
        return $this;
    }

    public function setDeleted($deleted) {
        $this->deleted = $deleted;
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
