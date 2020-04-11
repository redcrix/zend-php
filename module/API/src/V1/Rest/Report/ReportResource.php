<?php

namespace API\V1\Rest\Report;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use API\V1\Entity\Pet;
use API\V1\Entity\Clinic;
use API\V1\Entity\Distributor;
use API\V1\Entity\Order;

class ReportResource extends AbstractResourceListener {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    /**
     * Processa o relatório
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = []) {
        $permitidos = ['admin', 'distributor', 'manager', 'promoter'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        switch ($this->user->getRole()) {
            case 'manager':
                return $this->clinicReport($params);
                break;
            case 'distributor':
                return $this->distributorReport($params);
                break;
            case 'admin':
                return $this->adminReport($params);
                break;
            case 'promoter':
                return $this->promoterReport($params);
                break;
        }

        return new ReportCollection([]);
    }

    private function adminReport($data) {
        $entity = Distributor::class;
        $dql = <<<DQL
                SELECT 
                    partial d.{id, master},
                    partial du.{id, name},             
                    partial d2.{id, master},
                    partial d2u.{id, name},             
                    partial c.{id},
                    partial c2.{id},
                    partial p.{id},
                    partial p2.{id}
                FROM {$entity} d
                JOIN d.user du
                LEFT JOIN d.clinics c
                LEFT JOIN d.distributors d2
                LEFT JOIN d2.user d2u
                LEFT JOIN d2.clinics c2
                LEFT JOIN c.pets p WITH p.creation BETWEEN :inicio AND :fim 
                LEFT JOIN c2.pets p2 WITH p.creation BETWEEN :inicio AND :fim
                WHERE d.master = true
DQL;

        $arr = $this->em->createQuery($dql)
                ->setParameter('inicio', $data['start'] . ' 00:00:00')
                ->setParameter('fim', $data['end'] . ' 23:59:59')
                ->getArrayResult();

        $retorno = [];
        foreach ($arr as $v) {
            $n = new \stdClass();
            $n->distribuidor = $v['user']['name'];
            $n->clinics = count($v['clinics']);
            $n->pets = 0;
            foreach ($v['clinics'] as $c) {
                $n->pets += count($c['pets']);
            }

            foreach ($v['distributors'] as $d) {
                foreach ($d['clinics'] as $c2) {
                    $n->pets += count($c2['pets']);
                }
            }

            $retorno[] = $n;
        }

        return new ReportCollection($retorno);
    }

    private function promoterReport($data) {

        $entity = Order::class;
        $dql = <<<DQL
                SELECT 
                    partial p.{id},
                    partial c.{id, cupom}
                FROM {$entity} p
                JOIN p.seller u
                LEFT JOIN p.cupom c 
                WHERE u.id = :promoter
                AND p.register BETWEEN :inicio AND :fim
DQL;

        $arr = $this->em->createQuery($dql)
                ->setParameter('promoter', $this->user->getId())
                ->setParameter('inicio', $data['start'] . ' 00:00:00')
                ->setParameter('fim', $data['end'] . ' 23:59:59')
                ->getArrayResult();

        return new ReportCollection($arr);
    }

    private function distributorReport($data) {

        $entity = Clinic::class;
        $dql = <<<DQL
                SELECT 
                    partial c.{id, name},
                    partial m.{id},
                    partial mu.{id, name},                
                    COUNT (p.id) AS pets,
                    COUNT (p2.id) AS total
                FROM {$entity} c
                JOIN c.distributor d
                JOIN d.user du
                JOIN c.manager m
                JOIN m.user mu
                LEFT JOIN c.pets p WITH p.creation BETWEEN :inicio AND :fim 
                LEFT JOIN c.pets p2
                WHERE du.id =:distributor
                GROUP BY c.id
                ORDER BY c.deleted ASC, pets DESC
DQL;

        $arr = $this->em->createQuery($dql)
                ->setParameter('distributor', $this->user->getId())
                ->setParameter('inicio', $data['start'] . ' 00:00:00')
                ->setParameter('fim', $data['end'] . ' 23:59:59')
                ->getArrayResult();

        return new ReportCollection($arr);
    }

    private function clinicReport($data) {
        $session = json_decode($this->user->getSession());

        $entity = Pet::class;
        $dql = <<<DQL
                SELECT 
                    partial p.{id, name, creation},
                    partial o.{id},
                    partial ou.{id, name},
                    partial m.{id},
                    partial mu.{id, name},
                    partial e.{id},
                    partial eu.{id, name}
                FROM {$entity} p
                JOIN p.owner o
                JOIN o.user ou
                LEFT JOIN p.manager m
                LEFT JOIN m.user mu
                LEFT JOIN p.employee e
                LEFT JOIN e.user eu
                JOIN p.clinics c
                WHERE c.id =:clinic
                AND p.creation BETWEEN :inicio AND :fim 
                ORDER BY p.creation DESC
DQL;

        $arr = $this->em->createQuery($dql)
                ->setParameter('clinic', $session->clinica->id)
                ->setParameter('inicio', $data['start'] . ' 00:00:00')
                ->setParameter('fim', $data['end'] . ' 23:59:59')
                ->getArrayResult();

        return new ReportCollection($arr);
    }

}
