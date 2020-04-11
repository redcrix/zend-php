<?php

namespace API\V1\Rpc\ActiveUser;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\User;
use API\V1\Entity\Distributor;
use API\V1\Entity\Clinic;
use API\V1\Entity\Owner;

/**
 * RPC para recuperar usuário logado
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class ActiveUserController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    static public $menu = [
        'admin' => [
            [
                'destino' => '/dashboard',
                'menu' => '',
                'nome' => 'menu_aside_dashboard',
                'niveis' => '0',
                'icone' => 'line-chart'
            ],
            [
                'destino' => '/pets',
                'menu' => '',
                'nome' => 'menu_aside_pets',
                'niveis' => '0',
                'icone' => 'paw'
            ],
            [
                'destino' => '/sales-report',
                'menu' => '',
                'nome' => 'menu_aside_sales_report',
                'niveis' => '0',
                'icone' => 'file-text'
            ],
            [
                'destino' => '/distributors',
                'menu' => '',
                'nome' => 'menu_aside_distributors',
                'niveis' => '0',
                'icone' => 'address-book'
            ],
            [
                'destino' => '/promoter',
                'menu' => '',
                'nome' => 'Promotores',
                'niveis' => '0',
                'icone' => 'handshake-o'
            ],
            [
                'destino' => '/clinics',
                'menu' => '',
                'nome' => 'menu_aside_clinics',
                'niveis' => '0',
                'icone' => 'hospital-o'
            ],
            [
                'destino' => '/admins',
                'menu' => '',
                'nome' => 'menu_aside_admins',
                'niveis' => '0',
                'icone' => 'users'
            ],
            [
                'destino' => '/prices',
                'menu' => '',
                'nome' => 'menu_aside_prices',
                'niveis' => '0',
                'icone' => 'money'
            ],
            [
                'destino' => '/languages',
                'menu' => '',
                'nome' => 'menu_aside_languages',
                'niveis' => '0',
                'icone' => 'language'
            ]
        ],
        'promoter' => [
            [
                'destino' => '/dashboard',
                'menu' => '',
                'nome' => 'menu_aside_dashboard',
                'niveis' => '0',
                'icone' => 'line-chart'
            ],
            [
                'destino' => '/ticket',
                'menu' => '',
                'nome' => 'menu_aside_ticket',
                'niveis' => '0',
                'icone' => 'ticket'
            ],
            [
                'destino' => '/sales-report',
                'menu' => '',
                'nome' => 'menu_aside_sales_report',
                'niveis' => '0',
                'icone' => 'file-text'
            ]
        ],
        'distributor' => [
            [
                'destino' => '/dashboard',
                'menu' => '',
                'nome' => 'menu_aside_dashboard',
                'niveis' => '0',
                'icone' => 'line-chart'
            ],
            [
                'destino' => '/distributors',
                'menu' => '',
                'nome' => 'menu_aside_distributors',
                'niveis' => '0',
                'icone' => 'address-book'
            ],
            [
                'destino' => '/clinics',
                'menu' => '',
                'nome' => 'menu_aside_clinics',
                'niveis' => '0',
                'icone' => 'hospital-o'
            ],
            [
                'destino' => '/sales-report',
                'menu' => '',
                'nome' => 'menu_aside_sales_report',
                'niveis' => '0',
                'icone' => 'file-text'
            ]
        ],
        'subdistributor' => [
            [
                'destino' => '/dashboard',
                'menu' => '',
                'nome' => 'menu_aside_dashboard',
                'niveis' => '0',
                'icone' => 'line-chart'
            ],
            [
                'destino' => '/clinics',
                'menu' => '',
                'nome' => 'menu_aside_clinics',
                'niveis' => '0',
                'icone' => 'hospital-o'
            ],
            [
                'destino' => '/sales-report',
                'menu' => '',
                'nome' => 'menu_aside_sales_report',
                'niveis' => '0',
                'icone' => 'file-text'
            ]
        ],
        'manager' => [
            [
                'destino' => '/dashboard',
                'menu' => '',
                'nome' => 'menu_aside_dashboard',
                'niveis' => '0',
                'icone' => 'line-chart'
            ],
            [
                'destino' => '/nursery',
                'menu' => '',
                'nome' => 'menu_aside_nursery',
                'niveis' => '0',
                'icone' => 'heartbeat'
            ],
            [
                'destino' => '/pets',
                'menu' => '',
                'nome' => 'menu_aside_pets',
                'niveis' => '0',
                'icone' => 'paw'
            ],
            [
                'destino' => '/employees',
                'menu' => '',
                'nome' => 'menu_aside_employees',
                'niveis' => '0',
                'icone' => 'users'
            ],
            [
                'destino' => '/grooming-config',
                'menu' => '',
                'nome' => 'menu_aside_grooming_config',
                'niveis' => '0',
                'icone' => 'gears'
            ],
            [
                'destino' => '/sales-report',
                'menu' => '',
                'nome' => 'menu_aside_sales_report',
                'niveis' => '0',
                'icone' => 'file-text'
            ]
        ],
        'employee' => [
            [
                'destino' => '/dashboard',
                'menu' => '',
                'nome' => 'menu_aside_dashboard',
                'niveis' => '0',
                'icone' => 'line-chart'
            ],
            [
                'destino' => '/nursery',
                'menu' => '',
                'nome' => 'menu_aside_nursery',
                'niveis' => '0',
                'icone' => 'heartbeat'
            ],
            [
                'destino' => '/pets',
                'menu' => '',
                'nome' => 'menu_aside_pets',
                'niveis' => '0',
                'icone' => 'paw'
            ]
        ],
    ];

    /**
     * Recupera um usuário logado
     * @return array
     */
    public function activeUserAction() {
        $identity = $this->getIdentity();
        $oauth2Identity = $identity->getAuthenticationIdentity();
        $user = $this->em->createQueryBuilder()
                ->select(['u', 'f', 'v'])
                ->from(User::class, 'u')
                ->leftJoin('u.photo', 'f')
                ->leftJoin('u.veterinary', 'v')
                ->where('u.blocked = false')
                ->andWhere('u.deleted = false')
                ->andWhere('u.emailConfirmation = true')
                ->andWhere('u.role != :role')
                ->andWhere('u.username = :user')
                ->setParameter('role', 'employee')
                ->setParameter('user', $oauth2Identity['user_id'])
                ->getQuery()
                ->getOneOrNullResult();

        if (!!$user) {
            # Para gerentes
            $retorno = $user->getShortData();

            if ($user->getRole() == 'owner') {
                $retorno['menu'] = $this->getPets($user);
            } else {
                $retorno['menu'] = self::$menu[$user->getRole()];
            }


            if ($user->getRole() === 'distributor') {
                $qb = $this->em->createQueryBuilder();
                $qb->select(['d', 'u']);
                $qb->from(Distributor::class, 'd');
                $qb->join('d.user', 'u');
                $qb->where('u.role = :role');
                $qb->andWhere('u.deleted = false');
                $qb->andWhere('u.id = :id');
                $qb->setParameter('role', 'distributor');
                $qb->setParameter('id', $user->getId());
                $distributor = $qb->getQuery()->getSingleResult();
                if (!$distributor->getMaster()) {
                    $retorno['menu'] = self::$menu['subdistributor'];
                }
            }

            if ($user->getRole() === 'manager') {
                $retorno['clinica'] = $this->getClinic($user);
                $retorno['isVeterinary'] = $user->isVeterinary();
                if ($user->isVeterinary()) {
                    $retorno['veterinary'] = $user->getVeterinary()->getDocument();
                }
            }
            return [
                'usuario' => $retorno
            ];
        } else {
            # Para employee
            $user = $this->em->createQueryBuilder()
                    ->select(['u', 'f', 'v'])
                    ->from(User::class, 'u')
                    ->leftJoin('u.photo', 'f')
                    ->leftJoin('u.veterinary', 'v')
                    ->where('u.blocked = false')
                    ->andWhere('u.deleted = false')
                    ->andWhere('u.emailConfirmation = true')
                    ->andWhere('u.role = :role')
                    ->andWhere('u.username = :user')
                    ->setParameter('role', 'employee')
                    ->setParameter('user', $oauth2Identity['user_id'])
                    ->getQuery()
                    ->getOneOrNullResult();

            if (!!$user) {
                $retorno = $user->getShortData();
                $retorno['menu'] = self::$menu['employee'];
                $retorno['clinicas'] = $this->getClinics($user);
                $retorno['isVeterinary'] = $user->isVeterinary();
                if ($user->isVeterinary()) {
                    $retorno['veterinary'] = $user->getVeterinary()->getDocument();
                }
                return [
                    'usuario' => $retorno
                ];
            }
        }
        return [
            'usuario' => false
        ];
    }

    public function getPets(User $user) {
        $entity = Owner::class;
        $dql = <<<DQL
                SELECT 
                    partial o.{id}, partial p.{id, name}
                FROM {$entity} o
                LEFT JOIN o.pets p
                JOIN o.user u
                WHERE u.id = :id
                ORDER BY p.name ASC
DQL;

        $arr = $this->em->createQuery($dql)
                ->setParameter('id', $user->getId())
                ->getArrayResult();

        $menu = [];
        $menu[] = [
            'destino' => '/dashboard',
            'menu' => '',
            'nome' => 'menu_aside_dashboard',
            'niveis' => '0',
            'icone' => 'line-chart'
        ];
        
        foreach ($arr[0]['pets'] as $pet) {
            $menu[] = [
                'destino' => '/my-pet/' . $pet['id'],
                'menu' => '',
                'nome' => $pet['name'],
                'niveis' => '0',
                'icone' => 'paw'
            ];
        }

        return $menu;
    }

    /**
     * Retorna lista de clínicas
     * @param integer $id
     */
    private function getClinics(User $user) {
        $clinicas = $this->em->createQueryBuilder()
                ->select(['c', 'e'])
                ->from(Clinic::class, 'c')
                ->join('c.employees', 'e')
                ->join('e.user', 'u')
                ->where('u.blocked = false')
                ->andWhere('u.deleted = false')
                ->andWhere('u.emailConfirmation = true')
                ->andWhere('u.role = :role')
                ->andWhere('u.id = :id')
                ->andWhere('c.deleted = false')
                ->setParameter('role', 'employee')
                ->setParameter('id', $user->getId())
                ->getQuery()
                ->getResult();

        $arr = [];
        foreach ($clinicas as $c) {
            $arr[] = [
                'name' => $c->getName(),
                'verified' => $c->getVerified(),
                'id' => $c->getId()
            ];
        }

        $session = json_decode($user->getSession());
        if (!isset($session->clinica)) {
            $session->clinica = $arr[0];
            $user->setSession(json_encode($session));
            $this->em->persist($user);
            $this->em->flush();
        }

        return $arr;
    }

    /**
     * Retorna lista de clinica
     * @param integer $id
     */
    private function getClinic(User $user) {
        $clinica = $this->em->createQueryBuilder()
                ->select(['c', 'm'])
                ->from(Clinic::class, 'c')
                ->join('c.manager', 'm')
                ->join('m.user', 'u')
                ->where('u.blocked = false')
                ->andWhere('u.deleted = false')
                ->andWhere('u.emailConfirmation = true')
                ->andWhere('u.role = :role')
                ->andWhere('u.id = :id')
                ->andWhere('c.deleted = false')
                ->setParameter('role', 'manager')
                ->setParameter('id', $user->getId())
                ->getQuery()
                ->getSingleResult();

        $session = json_decode($user->getSession());
        if (!isset($session->clinica)) {
            $session->clinica = [
                'name' => $clinica->getName(),
                'verified' => $clinica->getVerified(),
                'id' => $clinica->getId()
            ];
            $user->setSession(json_encode($session));
            $this->em->persist($user);
            $this->em->flush();
        }

        return [
            'name' => $clinica->getName(),
            'verified' => $clinica->getVerified(),
            'id' => $clinica->getId()
        ];
    }

}
