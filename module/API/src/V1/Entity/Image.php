<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image - Bucket de imagem e arquivos
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="images")
 * @ORM\Entity
 */
class Image {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="mime", type="string", length=20)
     */
    private $mime;

    public function __construct() {
        
    }
    
    /**
     * Recupera dados de um endereço como array associativo
     * @return array
     */
    public function getData() {
        $dados = [];
        foreach ($this as $key => $value) {
            if (\property_exists(Image::class, $key)) {
                $dados[$key] = $value;
            }
        }
        return $dados;
    }
    ######### Getters e Setters #########
    
    public function getId() {
        return $this->id;
    }

    public function getMime() {
        return $this->mime;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setMime($mime) {
        $this->mime = $mime;
        return $this;
    }

}
