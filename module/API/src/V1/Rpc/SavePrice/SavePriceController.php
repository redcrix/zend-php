<?php

namespace API\V1\Rpc\SavePrice;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\CountryPrice;

/**
 * RPC para salvar preços por paises
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class SavePriceController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function savePriceAction() {

        $permitidos = ['admin'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();

        $price = $this->em->find(CountryPrice::class, $data->id);

        $price->setPrice($data->price);
        $this->em->persist($price);
        $this->em->flush();

        return [
            'price' => 'update'
        ];
    }

}
