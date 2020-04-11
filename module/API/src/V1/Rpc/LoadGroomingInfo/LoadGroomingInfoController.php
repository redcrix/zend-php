<?php

namespace API\V1\Rpc\LoadGroomingInfo;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\GroomingHistory;
use API\V1\Entity\Pet;

/**
 * RPC para carregar informações de grooming do pet
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoadGroomingInfoController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function loadGroomingInfoAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();
        $entity = Pet::class;
        
        $dql = <<<DQL
                SELECT
                    partial p.{id, sex, name, birthdate, race, specie},
                    f, partial o.{id}, partial ou.{id, name, username}
                FROM {$entity} p
                LEFT JOIN p.photo f
                LEFT JOIN p.owner o
                LEFT JOIN o.user ou
                WHERE p.id = :pet
DQL;
                
        # Load veterinary data
        $rs = $this->em->createQuery($dql)
                ->setParameter('pet', $data->id)
                ->getArrayResult();
        
        return [
            'groomingInfo' => $rs[0],
            'servicos' => $this->getGroomingServices($data)
        ];
    }
    
    private function getGroomingServices($data) {
        $session = json_decode($this->user->getSession());

        $arr = $this->em->createQueryBuilder()
                ->select('h')
                ->from(GroomingHistory::class, 'h')
                ->join('h.clinic', 'c')
                ->join('h.pet', 'p')
                ->where('c.id = :clinic')
                ->andWhere('p.id = :pet')
                ->setParameter('clinic', $session->clinica->id)
                ->setParameter('pet', $data->id)
                ->orderBy('h.creation', 'DESC')
                ->getQuery()
                ->setMaxResults(25)
                ->getArrayResult();

        return $arr;
    }

}
