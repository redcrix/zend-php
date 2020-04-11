<?php
namespace API\V1\Rpc\SearchPet;

class SearchPetControllerFactory
{
    public function __invoke($controllers)
    {
        return new SearchPetController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
