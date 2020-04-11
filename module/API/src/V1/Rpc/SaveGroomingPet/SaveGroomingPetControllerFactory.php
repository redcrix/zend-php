<?php
namespace API\V1\Rpc\SaveGroomingPet;

class SaveGroomingPetControllerFactory
{
    public function __invoke($controllers)
    {
        return new SaveGroomingPetController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
