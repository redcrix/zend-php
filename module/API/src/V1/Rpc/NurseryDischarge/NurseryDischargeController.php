<?php

namespace API\V1\Rpc\NurseryDischarge;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Clinic;
use API\V1\Entity\Pet;
use API\V1\Entity\History;

/**
 * RPC para dar alta a um pet
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class NurseryDischargeController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function nurseryDischargeAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $session = json_decode($this->user->getSession());
        $data = (object) $this->bodyParams();

        $clinic = $this->em->createQueryBuilder()
                ->select(['c', 'n', 'p',])
                ->from(Clinic::class, 'c')
                ->leftJoin('c.nursery', 'n')
                ->leftJoin('n.pets', 'p')
                ->where('c.id = :id')
                ->andWhere('p.id = :pet')
                ->setParameter('id', $session->clinica->id)
                ->setParameter('pet', $data->id)
                ->getQuery()
                ->getSingleResult();

        $pet = $this->em->find(Pet::class, $data->id);
        $clinic->getNursery()->getPets()->removeElement($pet);

        $this->em->persist($clinic->getNursery());
        $this->em->flush();

        $this->closeHistory($pet, $clinic);
        
        return [
            'status' => 'ok'
        ];
    }

    private function closeHistory(Pet $pet, Clinic $clinica) {
        $history = $this->em->createQueryBuilder()
                ->select(['h'])
                ->from(History::class, 'h')
                ->join('h.clinic', 'c')
                ->join('h.pet', 'p')
                ->where('c.id = :id')
                ->andWhere('p.id = :pet')
                ->andWhere('h.release IS NULL')
                ->setParameter('id', $clinica->getId())
                ->setParameter('pet', $pet->getId())
                ->getQuery()
                ->getSingleResult();

        $history->setRelease(new \DateTime())
                ->setUserRelease($this->user);

        $this->em->persist($history);
        $this->em->flush();
    }

}
