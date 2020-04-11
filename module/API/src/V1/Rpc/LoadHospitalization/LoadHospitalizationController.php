<?php

namespace API\V1\Rpc\LoadHospitalization;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Hospitalization;

/**
 * RPC para carregar informações de hospitalização do pet
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoadHospitalizationController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function loadHospitalizationAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        if (!$this->user->isVeterinary()) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();

        $entity = Hospitalization::class;

        $dql = <<<DQL
                SELECT 
                    ho,
                    partial p.{id, sex, name, birthdate, race, specie},
                    r, f, b, v, d, rs, a, pd, s, vs, vt, tp,
                    partial h.{id, creation, corporalCondition, attitude},
                    partial u.{id, name, username},
                    partial o.{id},
                    partial ou.{id, name, username}
                FROM {$entity} ho
                LEFT JOIN ho.pet p
                LEFT JOIN p.photo f
                LEFT JOIN p.owner o
                LEFT JOIN o.user ou
                LEFT JOIN p.petRecord r
                LEFT JOIN r.familyBackground b
                LEFT JOIN r.vaccines v
                LEFT JOIN r.desparasitations d
                LEFT JOIN r.reproductiveState rs
                LEFT JOIN r.allergies a
                LEFT JOIN r.previousDiseases pd
                LEFT JOIN r.surgeries s
                LEFT JOIN r.vitalSigns vs
                LEFT JOIN r.histories h
                LEFT JOIN h.therapeuticPlan tp
                LEFT JOIN h.veterinary vt
                LEFT JOIN vt.user u
                WHERE p.id = :pet AND ho.release IS NULL
                ORDER BY ho.id DESC, v.creation DESC, d.creation DESC, 
                    rs.creation DESC, vs.creation DESC, h.creation DESC
DQL;

        $rs = $this->em->createQuery($dql)
                ->setParameter('pet', $data->id)
                ->getArrayResult();

        return [
            'hospitalization' => $rs[0]
        ];
    }

}
