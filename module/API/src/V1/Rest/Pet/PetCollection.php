<?php

namespace API\V1\Rest\Pet;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class PetCollection extends Paginator {

    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }

}
