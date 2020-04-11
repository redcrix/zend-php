<?php

namespace API\V1\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * History PDF
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 * @ORM\Table(name="histories_pdf")
 * @ORM\Entity
 */
class HistoryPdf {

    /**
     * ID
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     */
    private $id;

    /**
     * PDF
     * @ORM\ManyToOne(targetEntity="Image")
     * @ORM\JoinColumn(name="pdf_id", referencedColumnName="id")
     */
    private $pdf;

    /**
     * Data de cadastro
     * @var \DateTime
     * @ORM\Column(name="creation", type="datetime")
     */
    private $creation;

    /**
     * Pet da história
     * @ORM\ManyToOne(targetEntity="Pet", inversedBy="historiesPdf")
     * @ORM\JoinColumn(name="pet_id", referencedColumnName="id")
     */
    private $pet;

    public function __construct() {
        
    }

    ######### Getters e Setters #########

    public function getId() {
        return $this->id;
    }

    public function getPdf() {
        return $this->pdf;
    }

    public function getCreation(): \DateTime {
        return $this->creation;
    }

    public function getPet() {
        return $this->pet;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setPdf($pdf) {
        $this->pdf = $pdf;
        return $this;
    }

    public function setCreation(\DateTime $creation) {
        $this->creation = $creation;
        return $this;
    }

    public function setPet($pet) {
        $this->pet = $pet;
        return $this;
    }

}
