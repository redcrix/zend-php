<?php

namespace API\V1\Rpc\SearchPet;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Pet;

/**
 * RPC para buscar um pet por ID ou email do dono
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class SearchPetController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function searchPetAction() {
        $permitidos = ['employee', 'manager', 'admin'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();

        $qb = $this->em->createQueryBuilder();
        $qb->select('p', 'o', 'f', 'q', 'u');
        $qb->from(Pet::class, 'p');
        $qb->join('p.owner', 'o');
        $qb->join('o.user', 'u');
        $qb->leftJoin('p.photo', 'f');
        $qb->join('p.qrCode', 'q');

        $buscar = [
            'p.id = :id',
            'u.username LIKE :busca'
        ];
        
        $id = str_replace('.', '', $data->busca);

        $qb->andWhere(\join(' OR ', $buscar));
        $qb->setParameter('busca', "%{$data->busca}%");
        $qb->setParameter('id', $id);

        $qb->orderBy('p.name', 'ASC');

        $arr = $qb->getQuery()->setMaxResults(25)->getArrayResult();

        return [
            'pets' => $arr
        ];
    }

}
