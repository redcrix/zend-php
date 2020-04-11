<?php
namespace API\V1\Rpc\LoadGroomingInfo;

class LoadGroomingInfoControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadGroomingInfoController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
