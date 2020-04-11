<?php

namespace API\V1\Rpc\SendContact;

class SendContactControllerFactory {

    public function __invoke($controllers) {
        return new SendContactController(
                $controllers->get('Doctrine\ORM\EntityManager'), $controllers->get('Config')
        );
    }

}
