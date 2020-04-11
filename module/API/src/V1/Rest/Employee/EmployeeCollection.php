<?php

namespace API\V1\Rest\Employee;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class EmployeeCollection extends Paginator {

    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }

}
