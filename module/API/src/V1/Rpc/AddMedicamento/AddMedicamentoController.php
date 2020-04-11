<?php

namespace API\V1\Rpc\AddMedicamento;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Pet;
use API\V1\Entity\TherapeuticPlan;

/**
 * RPC para adicionar exame
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class AddMedicamentoController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function addMedicamentoAction() {
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

        $m = (object) $data;

        $medic = new TherapeuticPlan();
        $medic->setActivePrinciple($m->medicacao)
                ->setVeterinary($vet)
                ->setPet($pet)
                ->setFrequency($m->frequencia)
                ->setPosology($m->posologia)
                ->setCreation(new \DateTime())
                ->setPresentation($m->apresentacao)
                ->setTotalDose($m->total)
                ->setType($m->type)
                ->setVia($m->via)
                ->setHistory($history);

        $this->em->persist($medic);
        $history->getTherapeuticPlan()->add($medic);

        $this->em->persist($history);
        $this->em->flush();

        $retorno = $medic->getData();

        return [
            'medicamento' => $retorno
        ];
    }

}
