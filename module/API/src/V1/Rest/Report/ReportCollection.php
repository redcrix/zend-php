<?php
namespace API\V1\Rest\Report;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class ReportCollection extends Paginator
{    
    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }
}
