<?php
namespace API\V1\Rpc\LoadHistorial;

class LoadHistorialControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadHistorialController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
