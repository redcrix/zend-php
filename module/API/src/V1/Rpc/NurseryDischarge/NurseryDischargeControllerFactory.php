<?php
namespace API\V1\Rpc\NurseryDischarge;

class NurseryDischargeControllerFactory
{
    public function __invoke($controllers)
    {
        return new NurseryDischargeController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
