<?php

namespace API\V1\Rpc\RemoveMedicamento;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\TherapeuticPlan;

/**
 * RPC para remover exame
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class RemoveMedicamentoController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function removeMedicamentoAction() {
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

        $action = $this->em->find(TherapeuticPlan::class, $data->id);
        $history->getTherapeuticPlan()->removeElement($action);

        $this->em->remove($action);
        $this->em->persist($history);
        $this->em->flush();

        return [
            'status' => 'deleted'
        ];
    }

}
