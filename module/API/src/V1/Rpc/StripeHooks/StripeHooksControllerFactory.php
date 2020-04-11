<?php

namespace API\V1\Rpc\StripeHooks;

class StripeHooksControllerFactory {

    public function __invoke($controllers) {
        return new StripeHooksController(
                $controllers->get('Doctrine\ORM\EntityManager'), $controllers->get('Config')
        );
    }

}
