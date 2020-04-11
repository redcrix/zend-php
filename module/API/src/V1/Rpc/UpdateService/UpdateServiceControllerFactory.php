<?php
namespace API\V1\Rpc\UpdateService;

class UpdateServiceControllerFactory
{
    public function __invoke($controllers)
    {
        return new UpdateServiceController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
