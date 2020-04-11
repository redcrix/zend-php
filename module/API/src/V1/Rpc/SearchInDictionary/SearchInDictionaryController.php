<?php

namespace API\V1\Rpc\SearchInDictionary;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\I18n;

/**
 * RPC para buscar termos em um dicionário
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class SearchInDictionaryController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function searchInDictionaryAction() {
        $data = (object) $this->bodyParams();

        $qb = $this->em->createQueryBuilder()
                ->select(['i'])
                ->from(I18n::class, 'i')
                ->where('i.lang = :lang')
                ->setParameter('lang', $data->lang['lang']);

        if (isset($data->term)) {
            $buscar = [
                'i.value LIKE :busca',
                'i.title LIKE :busca'
            ];

            $qb->andWhere(\join(' OR ', $buscar));
            $qb->setParameter('busca', "%{$data->term}%");
        }

        $dicionario = $qb->orderBy('i.value', 'ASC')
                ->getQuery()
                ->getArrayResult();
        return [
            'dictionary' => $dicionario
        ];
    }

}
