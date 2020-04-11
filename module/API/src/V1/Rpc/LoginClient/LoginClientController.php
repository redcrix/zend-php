<?php

namespace API\V1\Rpc\LoginClient;

use API\V1\Entity\User;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;
use API\V1\Rpc\ActiveUser\ActiveUserController;

/**
 * RPC para autenticação de um usuário padrão
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoginClientController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    /**
     * Autentica um usuário mediante senha
     * 
     * @return array | ApiProblemResponse
     */
    public function loginClientAction() {
        $data = (object) $this->bodyParams();
        $user = $this->userQuery($data->username);

        if (!$user) {
            return $this->rejectLogin('Wrong password or username.');
        }
        $check = $this->validateResult($user);

        if ($check->error) {
            return $check->message;
        }

        if (\get_class($user) == User::class) {
            $oauth2 = $this->oauth2Login($user, $data->password);
            if (!isset($oauth2->access_token)) {
                return $this->rejectLogin('Wrong password or username.');
            }
            return $this->loginDataProcess($user, $oauth2);
        }

        return $this->rejectLogin('Wrong password or username.');
    }

    /**
     * Processa dados de acessos
     * 
     * @param User $user
     * @param stdClass $oauth2
     * @return array
     */
    private function loginDataProcess(User $user, $oauth2) {
        $userReturn = $user->getShortData();
        if ($user->getRole() != 'owner') {
            $userReturn['menu'] = ActiveUserController::$menu[$user->getRole()];
        } else {
            $activeUser = new ActiveUserController($this->em);
            $userReturn['menu'] = $activeUser->getPets($user);
        }
        return [
            'token' => $oauth2->access_token
                // 'usuario' => $userReturn
        ];
    }

    /**
     * Rejeita uma conexão
     * 
     * @param string $message
     * @return ApiProblemResponse
     */
    private function rejectLogin($message) {
        return new ApiProblemResponse(
                new ApiProblem(401, $message)
        );
    }

    /**
     * Validação inicial de um usuário
     * Verifica se um usuário existe, está bloqueado, deletado ou com e-mail verificado
     * 
     * @param User | null $user
     * @return stdClass
     */
    private function validateResult(User $user) {
        $message = null;

        if (!$user) {
            $message = $this->rejectLogin('Unregistered user.');
        } else {
            if ($user->getBlocked()) {
                $message = $this->rejectLogin('Blocked user.');
            }

            if ($user->getDeleted()) {
                $message = $this->rejectLogin('Deleted user.');
            }

            if (!$user->getEmailConfirmation()) {
                $message = $this->rejectLogin('Unverified e-mail.');
            }
        }

        return (object) ['error' => !!$message, 'message' => $message];
    }

    /**
     * Retorna o usuário solicitado
     * 
     * @param stdClass $username
     * @return ArrayCollection
     */
    private function userQuery($username) {
        $qb = $this->em->createQueryBuilder();
        $qb->select(['u']);
        $qb->from(User::class, 'u');
        $qb->where('u.username = :user');
        $qb->andWhere('u.blocked = false');
        $qb->andWhere('u.deleted = false');
        $qb->setParameter('user', $username);
        return $qb->getQuery()
                        ->getOneOrNullResult();
    }

    /**
     * Efetua login Oauth2 
     * 
     * @param User $user
     * @param string $password
     * @return stdClass
     */
    private function oauth2Login(User $user, $password) {
        $vars = json_encode([
            'username' => $user->getUsername(),
            'password' => $password,
            'grant_type' => 'password',
            'client_id' => 'app',
            'client_secret' => 'v3PpQ1CXRgsSOcG6NHUKkO7tRD1djmdUGs4RrYkZ45CLYqfKkLpAG'
        ]);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config['api-externo'] . '/oauth');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
        $server_output = curl_exec($ch);
        curl_close($ch);
        return json_decode($server_output);
    }

}
