<?php
namespace API\V1\Rpc\LoadServices;

class LoadServicesControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadServicesController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
