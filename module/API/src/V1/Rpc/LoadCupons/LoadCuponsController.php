<?php
namespace API\V1\Rpc\LoadCupons;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Cupom;
use API\V1\Entity\Promoter;

class LoadCuponsController extends AbstractActionController
{
    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;
    
    public function loadCuponsAction()
    {
        $permitidos = ['promoter'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $arr = $this->em->createQueryBuilder()
                ->select('c')
                ->from(Cupom::class, 'c')
                ->join('c.promoter', 'p')
                ->join('p.user', 'u')
                ->where('u.deleted = false')
                ->andWhere('u.id = :user')
                ->setParameter('user', $this->user->getId())
                ->orderBy('c.cupom', 'ASC')
                ->getQuery()
                ->getArrayResult();

        $result = $this->getBaseDiscount();
        
        return [
            'cupons' => $arr,
            'base' => $result['base'],
            'commission' => $result['commission']
        ];
    }
    
    private function getBaseDiscount() {
        $promoter = $this->em->createQueryBuilder()
                ->select('p')
                ->from(Promoter::class, 'p')
                ->join('p.user', 'u')
                ->where('u.deleted = false')
                ->andWhere('u.id = :user')
                ->setParameter('user', $this->user->getId())
                ->getQuery()
                ->getSingleResult();
        
        return [
            'base' => $promoter->getBase(),
            'commission' => $promoter->getCommission()
        ];
    }
}
