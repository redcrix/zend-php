<?php

namespace API\V1\Rpc\ChangeClinic;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * RPC para atualizar a clínica de um funcionário
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class ChangeClinicController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function changeClinicAction() {
        $permitidos = ['employee'];
        if (!$this->isAutorized($permitidos)) {
            return new ApiProblem(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();

        $session = json_decode($this->user->getSession());
        $session->clinica = $data;
        $this->user->setSession(json_encode($session));
        $this->em->persist($this->user);
        $this->em->flush();

        return [
            'session' => $session
        ];
    }

}
