<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Veterinary
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="veterinaries")
 * @ORM\Entity
 */
class Veterinary {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * Documento do veterinário
     * @var string
     * @ORM\Column(name="document", type="string", nullable=true)
     */
    private $document;

    /**
     * Histórias de atendimento veterinário
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="History", mappedBy="veterinary")
     */
    private $histories;

    /**
     * Usuário
     * 
     * @ORM\OneToOne(targetEntity="User", mappedBy="veterinary")
     */
    private $user;

    public function __construct() {
        $this->histories = new ArrayCollection();
    }

    ######### Auxiliares #########

    /**
     * Recupera dados de um endereço como array associativo
     * @return array
     */
    public function getData() {
        $dados = [];
        foreach ($this as $key => $value) {
            if (\property_exists(Veterinary::class, $key)) {
                $dados[$key] = $value;
            }
        }
        return $dados;
    }

    /**
     * Adiciona uma história ao veterinário
     * @param \API\V1\Entity\History $history
     * @return $this
     */
    public function addHistory(History $history) {
        if ($this->histories->contains($history)) {
            return $this;
        }

        $history->setVeterinary($this);
        $this->histories->add($history);
        return $this;
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getDocument() {
        return $this->document;
    }

    public function getHistories(): ArrayCollection {
        return $this->histories;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setDocument($document) {
        $this->document = $document;
        return $this;
    }

    public function setHistories(ArrayCollection $histories) {
        $this->histories = $histories;
        return $this;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }

}
