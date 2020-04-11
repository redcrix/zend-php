<?php

namespace API\V1\Rpc\RegisterProfessional;

class RegisterProfessionalControllerFactory {

    public function __invoke($controllers) {
        return new RegisterProfessionalController(
                $controllers->get('Doctrine\ORM\EntityManager'), $controllers->get('Config')
        );
    }

}
