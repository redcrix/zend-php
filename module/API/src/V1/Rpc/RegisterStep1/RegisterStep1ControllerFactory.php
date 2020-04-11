<?php

namespace API\V1\Rpc\RegisterStep1;

class RegisterStep1ControllerFactory {

    public function __invoke($controllers) {
        return new RegisterStep1Controller($controllers->get('Doctrine\ORM\EntityManager'));
    }

}
