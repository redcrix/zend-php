<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TermsProfessional
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="terms_professionals")
 * @ORM\Entity
 */
class TermsProfessional {

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
     * @ORM\Column(name="lang", type="string", length=6)
     */
    private $lang;

    /**
     * Moeda
     * @var string
     * @ORM\Column(name="term", type="text")
     */
    private $term;

    public function __construct() {
        
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getLang() {
        return $this->lang;
    }

    public function getTerm() {
        return $this->term;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setLang($lang) {
        $this->lang = $lang;
        return $this;
    }

    public function setTerm($term) {
        $this->term = $term;
        return $this;
    }

}
