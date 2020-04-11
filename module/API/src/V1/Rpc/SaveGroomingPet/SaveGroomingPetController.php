<?php

namespace API\V1\Rpc\SaveGroomingPet;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Clinic;
use API\V1\Entity\Pet;
use API\V1\Entity\GroomingHistory;

/**
 * RPC para persistir um serviço a um pet e clinica
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class SaveGroomingPetController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function saveGroomingPetAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();

        $session = json_decode($this->user->getSession());
        $clinic = $this->em->find(Clinic::class, $session->clinica->id);

        $pet = $this->em->find(Pet::class, $data->pet);

        foreach ($data->services as $s) {
            $s = (object) $s;
            $novo = new GroomingHistory();
            $novo->setClinic($clinic)
                    ->setCreation(new \DateTime())
                    ->setName($s->name)
                    ->setPet($pet)
                    ->setPrice($s->price)
                    ->setProfissional($this->user)
                    ->setObs($data->obs)
                    ->setQtd($s->qtd);
            $this->em->persist($novo);
        }

        $this->em->flush();

        return [
            'status' => 'ok'
        ];
    }

}
