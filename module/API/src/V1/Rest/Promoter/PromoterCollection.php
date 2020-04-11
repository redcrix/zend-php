<?php
namespace API\V1\Rest\Promoter;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class PromoterCollection extends Paginator
{
    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }
}
