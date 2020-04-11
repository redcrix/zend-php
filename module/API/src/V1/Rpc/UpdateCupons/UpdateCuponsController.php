<?php

namespace API\V1\Rpc\UpdateCupons;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Cupom;
use API\V1\Entity\Promoter;

class UpdateCuponsController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    private $promoter;

    public function updateCuponsAction() {
        $permitidos = ['promoter'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();

        $this->getPromoter();

        $this->remover($data->remover);
        $this->salvar($data->atualizar);

        return [
            'status' => 'ok'
        ];
    }

    private function getPromoter() {
        $this->promoter = $this->em->createQueryBuilder()
                ->select('p', 'c')
                ->from(Promoter::class, 'p')
                ->join('p.user', 'u')
                ->leftJoin('p.cupons', 'c')
                ->where('u.deleted = false')
                ->andWhere('u.id = :user')
                ->setParameter('user', $this->user->getId())
                ->getQuery()
                ->getSingleResult();
    }

    private function salvar($arr) {
        $i = 0;
        foreach ($arr as $s) {
            $s = (object) $s;
            if ($s->id == 'novo') {
                $cupom = new Cupom();
                $cupom->setDeleted(false)
                        ->setPromoter($this->promoter);
            } else {
                $cupom = $this->em->find(Cupom::class, $s->id);
            }

            if ($s->discount > $this->promoter->getCommission()) {
                die('Parametro inválido!');
            }

            $cupom->setCupom($s->cupom)
                    ->setDiscount($s->discount);

            $this->em->persist($cupom);

            $i++;
            if ($i > 20) {
                $this->em->flush();
            }
        }
        $this->em->flush();
    }

    private function remover($arr) {
        $i = 0;
        foreach ($arr as $id) {
            $cupom = $this->em->find(Cupom::class, $id);
            $cupom->setDeleted(true);
            $this->em->remove($cupom);

            $i++;
            if ($i > 20) {
                $this->em->flush();
            }
        }
        $this->em->flush();
    }

}
