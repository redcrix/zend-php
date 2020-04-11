<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Espécie de animais
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="species")
 * @ORM\Entity
 */
class Specie {

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
     * Raças da espécie
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Race", mappedBy="specie")
     */
    private $races;

    public function __construct() {
        $this->races = new ArrayCollection();
    }

    ######### Auxiliares #########

    /**
     * Adiciona uma história ao funcionário
     * @param \API\V1\Entity\History $history
     * @return $this
     */
    public function addRace(Race $race) {
        if ($this->races->contains($race)) {
            return $this;
        }

        $race->setSpecie($this);
        $this->races->add($race);
        return $this;
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getRaces(): ArrayCollection {
        return $this->races;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setRaces(ArrayCollection $races) {
        $this->races = $races;
        return $this;
    }

}
