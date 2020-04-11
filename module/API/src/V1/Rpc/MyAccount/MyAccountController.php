<?php

namespace API\V1\Rpc\MyAccount;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\User;

/**
 * RPC para pegar dados do usuário logado
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class MyAccountController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function myAccountAction() {
        $this->getUser();

        $qb = $this->em->createQueryBuilder();
        $qb->select('u', 'f', 'a');
        $qb->from(User::class, 'u');
        $qb->leftJoin('u.photo', 'f');
        $qb->leftJoin('u.address', 'a');
        $qb->where('u.deleted = false');
        $qb->andWhere('u.id = :id');
        $qb->setParameter('id', $this->user->getId());
        $user = $qb->getQuery()->getArrayResult();

        if (count($user) == 1) {
            $user = $user[0];
            unset($user['password']);
            unset($user['deleted']);
            unset($user['blocked']);
            unset($user['session']);
            return [
                'user' => $user
            ];
        }
    }

}
