<?php
namespace API\V1\Rpc\LoadGroomingPet;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * RPC para recuperar serviços realizados em um pet
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoadGroomingPetController extends AbstractActionController
{
    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;
    public function loadGroomingPetAction()
    {
        /**
         * @todo ainda não necessário
         */
    }
}
