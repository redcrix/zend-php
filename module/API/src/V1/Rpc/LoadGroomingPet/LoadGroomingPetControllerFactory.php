<?php
namespace API\V1\Rpc\LoadGroomingPet;

class LoadGroomingPetControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadGroomingPetController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
