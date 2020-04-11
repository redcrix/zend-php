<?php

namespace API\V1\Rest\Clinic;

class ClinicResourceFactory {

    public function __invoke($services) {
        return new ClinicResource(
                $services->get('Doctrine\ORM\EntityManager'), $services->get('Config')
        );
    }

}
