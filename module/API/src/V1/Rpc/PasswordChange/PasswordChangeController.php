<?php

namespace API\V1\Rpc\PasswordChange;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Crypt\Password\Bcrypt;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\ApiProblem\ApiProblem;

/**
 * RPC para troca de senha de um usuário
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class PasswordChangeController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    /**
     * Troca a senha de um usuário
     */
    public function passwordChangeAction() {
        $data = (object) $this->bodyParams();
        $this->getUser();

        $crypt = new Bcrypt();
        $pass = $crypt->create($data->password);

        if ($crypt->verify($data->old, $this->user->getPassword())) {
            $this->user->setPassword($pass)
                    ->setUpdate(new \DateTime());

            $this->em->persist($this->user);
            $this->em->flush();

            return [
                'status' => true,
                'message' => 'Password change'
            ];
        }

        return new ApiProblemResponse(
                new ApiProblem(401, 'Password wrong')
        );
    }

}
