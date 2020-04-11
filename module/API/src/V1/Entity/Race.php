<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Raças de diversas espécies
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="races")
 * @ORM\Entity
 */
class Race {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Nome da raça
     * @var string|null
     * @ORM\Column(name="name", type="string", length=120, precision=0, scale=0, nullable=true, unique=false)
     */
    private $name;

    /**
     * Especie do animal
     * @var Race
     * @ORM\ManyToOne(targetEntity="Specie", inversedBy="races")
     * @ORM\JoinColumn(name="specie_id", referencedColumnName="id")
     */
    private $specie;

    public function __construct() {
        
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getSpecie(): Race {
        return $this->specie;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setSpecie(Race $specie) {
        $this->specie = $specie;
        return $this;
    }

}
