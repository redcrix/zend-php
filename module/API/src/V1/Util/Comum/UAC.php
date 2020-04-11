<?php

namespace API\V1\Util\Comum;

use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;

/**
 * Trait com metodos e propriedades para controle de usuário
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
trait UAC {

    /**
     * Lista de controle de acesso de usuário
     * @var array 
     */
    private $uac = [
        'distributor' => [
            'admin' => ['GETALL', 'GET', 'POST', 'DELETE'],
            'distributor' => ['GETALL', 'GET', 'POST', 'DELETE'],
            'manager' => [],
            'employee' => [],
            'owner' => []
        ],
        'clinic' => [
            'admin' => ['GETALL', 'GET', 'POST', 'DELETE'],
            'distributor' => ['GETALL', 'GET', 'POST', 'DELETE'],
            'manager' => ['GET', 'POST'],
            'employee' => [],
            'owner' => []
        ],
        'employee' => [
            'admin' => ['GETALL', 'GET', 'POST', 'DELETE'],
            'distributor' => [],
            'manager' => ['GETALL', 'GET', 'POST', 'DELETE'],
            'employee' => ['GET', 'POST'],
            'owner' => []
        ],
        'history' => [
            'admin' => ['GETALL', 'GET', 'POST', 'DELETE'],
            'distributor' => [],
            'manager' => ['GETALL', 'GET', 'POST', 'DELETE'],
            'employee' => ['GETALL', 'GET', 'POST', 'DELETE'],
            'owner' => ['GET']
        ],
        'newsletter' => [
            'admin' => ['GETALL', 'POST', 'DELETE'],
            'distributor' => [],
            'manager' => [],
            'employee' => [],
            'owner' => []
        ],
        'pet' => [
            'admin' => ['GETALL', 'GET'],
            'distributor' => [],
            'manager' => ['GETALL', 'GET', 'POST', 'DELETE'],
            'employee' => ['GETALL', 'GET', 'POST', 'DELETE'],
            'owner' => ['GETALL', 'GET', 'POST', 'DELETE']
        ],
        'user' => [
            'admin' => ['GETALL', 'GET', 'POST', 'DELETE'],
            'distributor' => [],
            'manager' => [],
            'employee' => [],
            'owner' => []
        ]
    ];

    /**
     * Valida se um usuário pode acessar um end-point
     * @param string $local Rest name
     * @param string $point End-point
     * @return boolean | User
     */
    protected function checkAccess($local, $point) {
        $user = $this->getUser();
        return in_array($point, $this->uac[$local][$user->getRole()]);
    }

    /**
     * Nega acesso a um usuário
     * @return ApiProblemResponse
     */
    protected function accessDenied() {
        return new ApiProblemResponse(
                new ApiProblem(401, 'Permission denied')
        );
    }

}
