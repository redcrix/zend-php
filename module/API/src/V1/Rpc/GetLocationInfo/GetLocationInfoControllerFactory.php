<?php

namespace API\V1\Rpc\GetLocationInfo;

class GetLocationInfoControllerFactory {

    public function __invoke($controllers) {
        return new GetLocationInfoController(
                $controllers->get('Doctrine\ORM\EntityManager'), $controllers->get('Config')
        );
    }

}
