<?php
namespace API\V1\Rpc\LoadPrices;

class LoadPricesControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadPricesController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
