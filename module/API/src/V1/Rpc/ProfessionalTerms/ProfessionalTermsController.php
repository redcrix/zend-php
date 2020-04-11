<?php

namespace API\V1\Rpc\ProfessionalTerms;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\TermsProfessional;

/**
 * RPC para termos profissionais
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class ProfessionalTermsController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function professionalTermsAction() {
        $data = (object) $this->bodyParams();

        $termo = $this->em->createQueryBuilder()
                ->select(['t'])
                ->from(TermsProfessional::class, 't')
                ->where('t.lang = :lang')
                ->setParameter('lang', $data->lang)
                ->setMaxResults(1)
                ->getQuery()
                ->getArrayResult();
        
        if(count($termo) == 0) {
            $termo = $this->em->createQueryBuilder()
                ->select(['t'])
                ->from(TermsProfessional::class, 't')
                ->where('t.lang = :lang')
                ->setParameter('lang', 'en')
                ->setMaxResults(1)
                ->getQuery()
                ->getArrayResult();
        }

        return [
            'terms' => $termo[0]
        ];
    }

}
