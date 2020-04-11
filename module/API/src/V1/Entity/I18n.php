<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * I18n
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="i18n")
 * @ORM\Entity
 */
class I18n {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Titulo do termo
     * @var string
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * Tradução do termo
     * @var string
     * @ORM\Column(name="value", type="text")
     */
    private $value;

    /**
     * Idioma
     * @var string
     * @ORM\Column(name="lang", type="string", length=6)
     */
    private $lang;

    /**
     * Local
     * @var string
     * @ORM\Column(name="local", type="string", length=6)
     */
    private $local;

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
            if (\property_exists(I18n::class, $key)) {
                $dados[$key] = $value;
            }
        }
        return $dados;
    }

    /**
     * Hidrata a entidade para cadastro e edição
     * @param stdClass $data
     */
    public function setData($data) {
        foreach ($data as $key => $value) {
            if (\property_exists(I18n::class, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getValue() {
        return $this->value;
    }

    public function getLang() {
        return $this->lang;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setValue($value) {
        $this->value = $value;
        return $this;
    }

    public function setLang($lang) {
        $this->lang = $lang;
        return $this;
    }

    public function getLocal() {
        return $this->local;
    }

    public function setLocal($local) {
        $this->local = $local;
        return $this;
    }

}
