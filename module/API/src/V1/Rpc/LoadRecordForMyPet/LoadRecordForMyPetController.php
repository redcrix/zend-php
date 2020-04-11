<?php

namespace API\V1\Rpc\LoadRecordForMyPet;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\HistoryAction;
use API\V1\Entity\GroomingHistory;
use API\V1\Entity\Pet;

/**
 * RPC para carregar prontuário do pet
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoadRecordForMyPetController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function loadRecordForMyPetAction() {
        $permitidos = ['owner'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();
        $session = json_decode($this->user->getSession());

        $history = $data->history;
        $entity = Pet::class;

        $dql = <<<DQL
                SELECT 
                    f, a, tp, hd, dl, a, av, h, hp, hpa, q,
                    partial p.{id, sex, name, birthdate, race, specie},
                    partial o.{id},
                    partial ou.{id, name, username},
                    partial au.{id, name, username},
                    partial huc.{id, name, username},
                    partial hur.{id, name, username},
                    partial c.{id, name}
                FROM {$entity} p
                LEFT JOIN p.photo f
                LEFT JOIN p.owner o
                LEFT JOIN o.user ou
                LEFT JOIN p.histories h
                LEFT JOIN p.historiesPdf hp
                LEFT JOIN p.qrCode q
                LEFT JOIN hp.pdf hpa
                LEFT JOIN h.actions a
                LEFT JOIN a.veterinary av
                LEFT JOIN av.user au
                LEFT JOIN h.clinic c
                LEFT JOIN h.therapeuticPlan tp
                LEFT JOIN h.diagnosis hd
                LEFT JOIN hd.resultFile dl
                LEFT JOIN h.userCreation huc
                LEFT JOIN h.userRelease hur
                WHERE p.id = :pet
                ORDER BY a.creation DESC, tp.creation DESC, hd.dia DESC 
DQL;

        $rs = $this->em->createQuery($dql)
                ->setParameter('pet', $data->id)
                ->getArrayResult();

        $pet = $rs[0];
        if ($pet['owner']['user']['id'] != $this->user->getId()) {
            return $this->sendError(403, 'Permission denied!');
        }

        if (count($pet['histories']) > 0) {
            $pet['history'] = $pet['histories'][0];
            $pet['history']['actions'] = $this->getActions($pet['histories'][0]);
        }

        unset($pet['histories']);
        return [
            'pet' => $pet,
            'servicos' => $this->getGroomingServices($data)
        ];
    }

    private function getActions($history) {
        $entity = HistoryAction::class;
        $dql = <<<DQL
                SELECT a, v, h, c
                FROM {$entity} a
                JOIN a.history h
                JOIN h.clinic c
                JOIN a.veterinary v
                WHERE h.id = :id
                ORDER BY a.creation DESC
DQL;

        $action = $this->em->createQuery($dql)
                ->setParameter('id', $history['id'])
                ->getResult();

        $return = [];
        foreach ($action as $v) {
            $a = $v->getData();
            $a['clinic'] = $v->getHistory()->getClinic()->getName();
            $return[$a['category']][] = $a;
        }

        return $return;
    }

    private function getPetInfo($data) {
        $entity = Pet::class;
        $dql = <<<DQL
                SELECT 
                    partial p.{id, sex, name, birthdate, race, specie},
                    r, f, b, v, d, rs, a, pd, s, vs, vt, tp, hd, dl, q, hp, hpa,
                    partial h.{id, creation, corporalCondition, attitude, hydratationState},
                    partial u.{id, name, username},
                    partial o.{id},
                    partial ou.{id, name, username},
                    partial c.{id, name}
                FROM {$entity} p
                LEFT JOIN p.qrCode q
                LEFT JOIN p.photo f
                LEFT JOIN p.owner o
                LEFT JOIN o.user ou
                LEFT JOIN p.petRecord r
                LEFT JOIN r.historiesPdf hp
                LEFT JOIN hp.pdf hpa
                LEFT JOIN r.familyBackground b
                LEFT JOIN r.vaccines v
                LEFT JOIN r.desparasitations d
                LEFT JOIN r.reproductiveState rs
                LEFT JOIN r.allergies a
                LEFT JOIN r.previousDiseases pd
                LEFT JOIN r.surgeries s
                LEFT JOIN r.vitalSigns vs
                LEFT JOIN r.histories h
                LEFT JOIN h.clinic c
                LEFT JOIN h.therapeuticPlan tp
                LEFT JOIN h.diagnosis hd
                LEFT JOIN hd.resultFile dl
                LEFT JOIN h.veterinary vt
                LEFT JOIN vt.user u
                WHERE p.id = :pet
                ORDER BY v.creation DESC, d.creation DESC, 
                    rs.creation DESC, vs.creation DESC, h.creation DESC, hp.creation DESC
DQL;

        $rs = $this->em->createQuery($dql)
                ->setParameter('pet', $data->id)
                ->getArrayResult();

        return [
            'hospitalization' => ['pet' => $rs[0]],
            'servicos' => $this->getGroomingServices($data)
        ];
    }

    private function getGroomingServices($data) {
        $session = json_decode($this->user->getSession());

        $arr = $this->em->createQueryBuilder()
                ->select('h')
                ->from(GroomingHistory::class, 'h')
                ->join('h.clinic', 'c')
                ->join('h.pet', 'p')
                ->where('p.id = :pet')
                ->setParameter('pet', $data->id)
                ->orderBy('h.creation', 'DESC')
                ->getQuery()
                ->setMaxResults(50)
                ->getArrayResult();

        return $arr;
    }

    private function isOwnerPet($data) {
        $pet = $this->em->createQueryBuilder()
                ->select('p')
                ->from(Pet::class, 'p')
                ->join('p.owner', 'o')
                ->join('o.user', 'u')
                ->where('u.id = :user')
                ->andWhere('p.id = :pet')
                ->setParameter('user', $this->user->getId())
                ->setParameter('pet', $data->id)
                ->getQuery()
                ->getOneOrNullResult();

        return !!$pet;
    }

}
