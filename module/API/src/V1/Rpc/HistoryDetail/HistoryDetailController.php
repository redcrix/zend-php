<?php

namespace API\V1\Rpc\HistoryDetail;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\History;
/**
 * RPC para carregar detalhes de uma historia
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class HistoryDetailController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function historyDetailAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        if (!$this->user->isVeterinary()) {
            return $this->sendError(401, 'Permission denied!');
        }
        
        $data = (object) $this->bodyParams();

        $entity = History::class;

        $dql = <<<DQL
                SELECT 
                    h, m, d, dr
                FROM {$entity} h
                LEFT JOIN h.mucous m
                LEFT JOIN h.diagnosis d
                LEFT JOIN d.resultFile dr
                WHERE h.id = :historia
DQL;

        $rs = $this->em->createQuery($dql)
                ->setParameter('historia', $data->id)
                ->getArrayResult();

        return [
            'history' => $rs[0]
        ];
    }

}
