<?php
namespace API\V1\Rpc\AddExame;

class AddExameControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddExameController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
