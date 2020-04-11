<?php

namespace API\V1\Rpc\SaveTextHistory;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Pet;

/**
 * RPC para adicionar anormalidades
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class SaveTextHistoryController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function saveTextHistoryAction() {
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

        switch ($data->local) {
            case 'presumptiveDiagnosis':
                $history->setPresumptiveDiagnosis($data->valor);
                break;
            case 'reason':
                $history->setReason($data->valor);
                break;
            case 'anamnesics':
                $history->setAnamnesics($data->valor);
                break;
            case 'impressionDiagnosis':
                $history->setImpressionDiagnosis($data->valor);
                break;
        }

        $this->em->persist($history);
        $this->em->flush();

        return [
            'status' => 'saved'
        ];
    }

}
