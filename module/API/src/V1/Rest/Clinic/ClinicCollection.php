<?php

namespace API\V1\Rest\Clinic;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class ClinicCollection extends Paginator {

    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }

}
