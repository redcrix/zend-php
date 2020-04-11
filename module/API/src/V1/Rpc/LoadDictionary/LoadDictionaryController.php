<?php

namespace API\V1\Rpc\LoadDictionary;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\I18n;

/**
 * RPC para recuperar lista de dicionario para tradução
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoadDictionaryController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function loadDictionaryAction() {
        $data = (object) $this->bodyParams();
        $dicionario = $this->em->createQueryBuilder()
                ->select(['i'])
                ->from(I18n::class, 'i')
                ->where('i.lang = :lang')
                ->setParameter('lang', $data->lang)
                ->orderBy('i.id', 'DESC')
                ->getQuery()
                ->getArrayResult();
        return [
            'dictionary' => $dicionario
        ];
    }

}
