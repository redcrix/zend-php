<?php

namespace API\V1\Rpc\PasswordChangeToken;

class PasswordChangeTokenControllerFactory {

    public function __invoke($controllers) {
        return new PasswordChangeTokenController(
                $controllers->get('Doctrine\ORM\EntityManager'), $controllers->get('Config')
        );
    }

}
