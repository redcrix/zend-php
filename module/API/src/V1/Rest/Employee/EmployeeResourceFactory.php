<?php

namespace API\V1\Rest\Employee;

class EmployeeResourceFactory {

    public function __invoke($services) {
        return new EmployeeResource(
                $services->get('Doctrine\ORM\EntityManager'), $services->get('Config')
        );
    }

}
