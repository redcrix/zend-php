<?php
namespace API\V1\Rpc\AddPetClinic;

class AddPetClinicControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddPetClinicController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
