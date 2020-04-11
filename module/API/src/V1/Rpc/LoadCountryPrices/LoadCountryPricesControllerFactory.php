<?php
namespace API\V1\Rpc\LoadCountryPrices;

class LoadCountryPricesControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadCountryPricesController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
