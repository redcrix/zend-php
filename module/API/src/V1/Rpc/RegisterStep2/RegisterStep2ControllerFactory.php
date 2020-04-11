<?php

namespace API\V1\Rpc\RegisterStep2;

class RegisterStep2ControllerFactory {

    public function __invoke($controllers) {
        return new RegisterStep2Controller(
                $controllers->get('Doctrine\ORM\EntityManager'), $controllers->get('Config')
        );
    }

}
