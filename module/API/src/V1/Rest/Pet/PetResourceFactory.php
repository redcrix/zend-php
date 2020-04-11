<?php
namespace API\V1\Rest\Pet;

class PetResourceFactory
{
    public function __invoke($services)
    {
        return new PetResource(
                $services->get('Doctrine\ORM\EntityManager'),
                $services->get('Config')
                );
    }
}
