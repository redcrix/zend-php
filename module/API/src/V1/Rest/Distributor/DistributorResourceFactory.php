<?php
namespace API\V1\Rest\Distributor;

class DistributorResourceFactory
{
    public function __invoke($services)
    {
        return new DistributorResource(
                $services->get('Doctrine\ORM\EntityManager'),
                $services->get('Config')
        );
    }
}
