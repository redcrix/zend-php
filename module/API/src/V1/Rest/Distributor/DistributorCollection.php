<?php

namespace API\V1\Rest\Distributor;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class DistributorCollection extends Paginator {

    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }

}
