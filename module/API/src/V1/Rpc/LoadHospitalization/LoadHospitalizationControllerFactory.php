<?php
namespace API\V1\Rpc\LoadHospitalization;

class LoadHospitalizationControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadHospitalizationController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
