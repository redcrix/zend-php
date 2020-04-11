<?php

namespace API\V1\Rpc\AddNursery;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Clinic;
use API\V1\Entity\Nursery;
use API\V1\Entity\Pet;
use API\V1\Entity\History;

/**
 * RPC para adicionar pets a enfermaria da clinica
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class AddNurseryController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function addNurseryAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }
        $data = (object) $this->bodyParams();

        $session = json_decode($this->user->getSession());
        $clinic = $this->em->createQueryBuilder()
                ->select(['c', 'n'])
                ->from(Clinic::class, 'c')
                ->leftJoin('c.nursery', 'n')
                ->where('c.id = :id')
                ->setParameter('id', $session->clinica->id)
                ->getQuery()
                ->getSingleResult();

        $nursery = $clinic->getNursery();
        if (!isset($nursery)) {
            $nursery = new Nursery();
            $nursery->setClinic($clinic)
                    ->setRoomName('Nursery');
            $clinic->setNursery($nursery);

            $this->em->persist($nursery);
            $this->em->persist($clinic);
        }

        $pet = $this->em->find(Pet::class, $data->id);

        $nursery = $clinic->getNursery();
        $nursery->getPets()->add($pet);
        $this->em->persist($nursery);

        $dia = new \DateTime();
        
        $history = new History();
        $history->setClinic($clinic)
                ->setCreation($dia)
                ->setNursery($nursery)
                ->setPet($pet)
                ->setUserCreation($this->user);
         
        $pet->getHistories()->add($history);
        
        $pet->addClinic($clinic);
        
        $this->em->persist($clinic);
        $this->em->persist($history);
        $this->em->persist($pet);
        $this->em->flush();

        return [
            'status' => 'ok'
        ];
    }

}
