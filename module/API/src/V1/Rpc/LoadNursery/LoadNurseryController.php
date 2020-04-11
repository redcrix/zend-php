<?php

namespace API\V1\Rpc\LoadNursery;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Clinic;

/**
 * RPC para recuperar uma enfermaria
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoadNurseryController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function loadNurseryAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $session = json_decode($this->user->getSession());

        $clinic = $this->em->createQueryBuilder()
                ->select(['c', 'n', 'p', 'o', 'u', 'f', 'qr'])
                ->from(Clinic::class, 'c')
                ->leftJoin('c.nursery', 'n')
                ->leftJoin('n.pets', 'p')
                ->leftJoin('p.qrCode', 'qr')
                ->leftJoin('p.photo', 'f')
                ->leftJoin('p.owner', 'o')
                ->leftJoin('o.user', 'u')
                ->where('c.id = :id')
                ->setParameter('id', $session->clinica->id)
                ->getQuery()
                ->getArrayResult();

        $pets = [];
        foreach ($clinic[0]['nursery']['pets'] as $pet) {
            $pets[] = $pet;
        }

        return [
            'pets' => $pets
        ];
    }

}
