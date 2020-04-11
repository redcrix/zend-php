<?php
namespace API\V1\Rest\User;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class UserCollection extends Paginator
{
    public function __construct($collection) {
        parent::__construct(new ArrayAdapter($collection));
    }
}
