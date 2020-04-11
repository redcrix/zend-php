<?php
namespace API\V1\Rpc\CheckEmailToken;

class CheckEmailTokenControllerFactory
{
    public function __invoke($controllers)
    {
        return new CheckEmailTokenController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
