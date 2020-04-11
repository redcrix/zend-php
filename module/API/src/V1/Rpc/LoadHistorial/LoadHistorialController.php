<?php

namespace API\V1\Rpc\LoadHistorial;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\History;

/**
 * RPC para carregar informações de hospitalização do pet
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoadHistorialController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function loadHistorialAction() {
        $permitidos = ['employee', 'manager', 'owner'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();
        $entity = History::class;
        $dql = <<<DQL
                SELECT 
                    h, c
                FROM {$entity} h
                JOIN h.pet p
                JOIN h.clinic c
                WHERE p.id = :pet
                ORDER BY h.id DESC
DQL;

        $arr = $this->em->createQuery($dql)
                ->setParameter('pet', $data->pet)
                ->getArrayResult();

        $retorno = [];
        foreach ($arr as $h) {
            $retorno [] = [
                'id' => $h['id'],
                'clinic' => $h['clinic']['name'],
                'creation' => $h['creation'],
                'release' => $h['release']
            ];
        }

        return [
            'historial' => $retorno
        ];
    }

}
