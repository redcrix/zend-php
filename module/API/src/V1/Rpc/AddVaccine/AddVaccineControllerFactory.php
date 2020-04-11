<?php
namespace API\V1\Rpc\AddVaccine;

class AddVaccineControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddVaccineController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
