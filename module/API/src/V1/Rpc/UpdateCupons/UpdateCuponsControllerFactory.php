<?php
namespace API\V1\Rpc\UpdateCupons;

class UpdateCuponsControllerFactory
{
    public function __invoke($controllers)
    {
        return new UpdateCuponsController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
