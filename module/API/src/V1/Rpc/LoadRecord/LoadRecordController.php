<?php

namespace API\V1\Rpc\LoadRecord;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\GroomingHistory;
use API\V1\Entity\Pet;
use API\V1\Entity\History;
use API\V1\Entity\HistoryAction;
use API\V1\Entity\Clinic;

/**
 * RPC para carregar prontuário do pet
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoadRecordController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function loadRecordAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $isVet = $this->user->isVeterinary();
        $data = (object) $this->bodyParams();
        $session = json_decode($this->user->getSession());

        if (isset($data->history)) {
            if ($data->history == 'novo') {
                return $this->getOnlyInfo($data);
            }
            $history = $data->history;
        } else {
            $history = $this->em->createQueryBuilder()
                    ->select(['h'])
                    ->from(History::class, 'h')
                    ->join('h.pet', 'p')
                    ->join('h.clinic', 'c')
                    ->where('p.id = :id')
                    ->andWhere('c.id = :clinic')
                    ->andWhere('h.release IS NULL')
                    ->setParameter('id', $data->id)
                    ->setParameter('clinic', $session->clinica->id)
                    ->getQuery()
                    ->getOneOrNullResult();
            $history = $history->getId();
        }

        $clinic = $this->em->find(Clinic::class, $session->clinica->id);
        $clinic = $clinic->getName();

        $entity = Pet::class;

        $dql = <<<DQL
                SELECT 
                    f, a, tp, hd, dl, a, av, h,
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
                AND h.id = :history
                ORDER BY a.creation DESC, tp.creation DESC, hd.dia DESC 
DQL;

        $rs = $this->em->createQuery($dql)
                ->setParameter('pet', $data->id)
                ->setParameter('history', $history)
                ->getArrayResult();

        $pet = $rs[0];
        $pet['history'] = $pet['histories'][0];
        $pet['history']['actions'] = $this->getActions($pet['histories'][0], $clinic);

        unset($pet['histories']);
        return [
            'pet' => $pet,
            'isVeterinary' => $isVet,
            'servicos' => $this->getGroomingServices($data)
        ];
    }

    private function getOnlyInfo($data) {

        $entity = Pet::class;
        $dql = <<<DQL
                SELECT 
                    f, a, tp, hd, dl, a, av, h,
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
        $pet['history'] = null;
        unset($pet['histories']);
        return [
            'pet' => $pet,
            'isVeterinary' => false,
            'servicos' => $this->getGroomingServices($data)
        ];
    }

    private function getActions($history, $clinic) {
        $entity = HistoryAction::class;
        $dql = <<<DQL
                SELECT a, v
                FROM {$entity} a
                JOIN a.history h
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
            $a['clinic'] = $clinic;
            $return[$a['category']][] = $a;
        }

        return $return;
    }

    private function getGroomingServices($data) {
        // $session = json_decode($this->user->getSession());

        $arr = $this->em->createQueryBuilder()
                ->select('h')
                ->from(GroomingHistory::class, 'h')
                ->join('h.pet', 'p')
                ->where('p.id = :pet')
                ->setParameter('pet', $data->id)
                ->orderBy('h.creation', 'DESC')
                ->getQuery()
                ->setMaxResults(25)
                ->getArrayResult();

        return $arr;
    }

}
