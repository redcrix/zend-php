<?php

namespace API\V1\Rpc\LoadPrices;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\CountryPrice;

/**
 * RPC para carregar preços por paises
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoadPricesController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function loadPricesAction() {
        $permitidos = ['admin'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $arr = $this->em->createQueryBuilder()
                ->select('r')
                ->from(CountryPrice::class, 'r')
                ->orderBy('r.country', 'ASC')
                ->getQuery()
                ->getArrayResult();

        return [
            'prices' => $arr
        ];
    }

}
