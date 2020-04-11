<?php

namespace API\V1\Rpc\AddExame;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Pet;
use API\V1\Entity\Diagnosis;

/**
 * RPC para adicionar exame
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class AddExameController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function addExameAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }
        $isVet = $this->user->isVeterinary();

        if (!$isVet) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();
        $history = $this->getOpenHistory($data->pet);
        $pet = $this->em->find(Pet::class, $data->pet);
        $vet = $this->getVeterinary();

        $v = (object) $data;
        $e = new Diagnosis();
        $e->setAuthorized(!!$v->autorizado)
                ->setDia(new \DateTime())
                ->setHistory($history)
                ->setLaboratory($v->laboratario)
                ->setVeterinary($vet)
                ->setPet($pet)
                ->setName($v->exame);
        $this->em->persist($e);

        $history->getDiagnosis()->add($e);

        $this->em->persist($history);
        $this->em->flush();

        $retorno = $e->getData();
        
        return [
            'exame' => $retorno
        ];
    }

}
