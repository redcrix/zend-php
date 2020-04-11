<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Language
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="languages")
 * @ORM\Entity
 */
class Language {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Nome do idioma
     * @var string
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * Abreviação
     * @var string
     * @ORM\Column(name="lang", type="string", length=6)
     */
    private $lang;

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
            if (\property_exists(Language::class, $key)) {
                $dados[$key] = $value;
            }
        }
        return $dados;
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getLang() {
        return $this->lang;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setLang($lang) {
        $this->lang = $lang;
        return $this;
    }

}
