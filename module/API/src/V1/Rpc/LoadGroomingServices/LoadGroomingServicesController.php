<?php

namespace API\V1\Rpc\LoadGroomingServices;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Pet;
use API\V1\Entity\Clinic;
use API\V1\Entity\GroomingService;

/**
 * RPC para carregar informações do pet e serviços da clinica
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoadGroomingServicesController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function loadGroomingServicesAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();
        $entity = Pet::class;

        $dql = <<<DQL
                SELECT 
                    f,
                    partial p.{id, sex, name, birthdate, race, specie},
                    partial o.{id},
                    partial ou.{id, name, username}
                FROM {$entity} p
                LEFT JOIN p.photo f
                LEFT JOIN p.owner o
                LEFT JOIN o.user ou
                WHERE p.id = :pet
DQL;

        $rs = $this->em->createQuery($dql)
                ->setParameter('pet', $data->id)
                ->getArrayResult();

        $session = json_decode($this->user->getSession());

        $pet = $this->em->find(Pet::class, $data->id);
        $clinic = $this->em->find(Clinic::class, $session->clinica->id);
        $pet->addClinic($clinic);
        $this->em->persist($pet);
        $this->em->persist($clinic);
        $this->em->flush();

        $services = $this->em->createQueryBuilder()
                ->select('s')
                ->from(GroomingService::class, 's')
                ->join('s.clinic', 'c')
                ->where('c.id = :id')
                ->andWhere('s.deleted = false')
                ->setParameter('id', $session->clinica->id)
                ->orderBy('s.name')
                ->getQuery()
                ->getArrayResult();

        return [
            'petInfo' => $rs[0],
            'services' => $services
        ];
    }

}
