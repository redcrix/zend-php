<?php

namespace API\V1\Rpc\RegisterStep1;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\PreOrder;

/**
 * RPC para persistir dados da etapa 1 após registro
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class RegisterStep1Controller extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function registerStep1Action() {
        $data = (object) $this->bodyParams();

        $order = $this->em->createQueryBuilder()
                ->select('r')
                ->from(PreOrder::class, 'r')
                ->where('r.link = :link')
                ->setParameter('link', $data->id)
                ->setMaxResults(1)
                ->getQuery()
                ->getSingleResult();

        $order->setEtapa1(json_encode($data));

        $this->em->persist($order);
        $this->em->flush();

        return [
            'status' => 'ok'
        ];
    }

}
