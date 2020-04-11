<?php

namespace API\V1\Rpc\LoadServices;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\GroomingService;

/**
 * RPC para recuperar de serviços
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoadServicesController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function loadServicesAction() {
        $permitidos = ['manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $session = json_decode($this->user->getSession());

        $arr = $this->em->createQueryBuilder()
                ->select('s')
                ->from(GroomingService::class, 's')
                ->join('s.clinic', 'c')
                ->where('s.deleted = false')
                ->andWhere('c.id = :clinic')
                ->setParameter('clinic', $session->clinica->id)
                ->orderBy('s.name', 'ASC')
                ->getQuery()
                ->getArrayResult();

        return [
            'services' => $arr
        ];
    }

}
