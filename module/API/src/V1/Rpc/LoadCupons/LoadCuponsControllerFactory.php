<?php
namespace API\V1\Rpc\LoadCupons;

class LoadCuponsControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadCuponsController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
