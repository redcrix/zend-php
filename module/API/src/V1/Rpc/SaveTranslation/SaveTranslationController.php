<?php

namespace API\V1\Rpc\SaveTranslation;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\I18n;

/**
 * RPC para persistir uma tradução
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class SaveTranslationController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function saveTranslationAction() {
        $permitidos = ['admin'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }
        
        $data = (object) $this->bodyParams();
        $termo = $this->em->find(I18n::class, $data->id);
        $termo->setValue($data->term);

        $this->em->persist($termo);
        $this->em->flush();

        return [
            'status' => 'saved'
        ];
    }

}
