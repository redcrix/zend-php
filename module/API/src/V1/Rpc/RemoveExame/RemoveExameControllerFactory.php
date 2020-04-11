<?php
namespace API\V1\Rpc\RemoveExame;

class RemoveExameControllerFactory
{
    public function __invoke($controllers)
    {
        return new RemoveExameController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
