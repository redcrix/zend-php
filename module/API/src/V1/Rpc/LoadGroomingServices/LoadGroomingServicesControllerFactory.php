<?php
namespace API\V1\Rpc\LoadGroomingServices;

class LoadGroomingServicesControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadGroomingServicesController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
