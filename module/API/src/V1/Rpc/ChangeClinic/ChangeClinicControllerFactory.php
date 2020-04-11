<?php
namespace API\V1\Rpc\ChangeClinic;

class ChangeClinicControllerFactory
{
    public function __invoke($controllers)
    {
        return new ChangeClinicController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
