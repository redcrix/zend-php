<?php
namespace API\V1\Rpc\LoadNursery;

class LoadNurseryControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadNurseryController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
