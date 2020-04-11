<?php

namespace API\V1\Rpc\CheckEmailToken;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;
use API\V1\Entity\EmailToken;

/**
 * RPC para checar se um token é válido
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class CheckEmailTokenController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function checkEmailTokenAction() {
        $data = (object) $this->bodyParams();

        $qb = $this->em->createQueryBuilder();
        $qb->select(['e']);
        $qb->from(EmailToken::class, 'e');
        $qb->where('e.token = :token');
        $qb->andWhere('e.isUsed = 0');
        $qb->setParameter('token', $data->token);
        $qb->orderBy('e.dateSend', 'DESC');
        $email = $qb->getQuery()->getResult();

        return count($email) > 0 ?
                ['status' => 'ok'] :
                new ApiProblemResponse(new ApiProblem(401, 'Inválid token.'));
    }

}
