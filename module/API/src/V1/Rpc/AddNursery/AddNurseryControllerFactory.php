<?php
namespace API\V1\Rpc\AddNursery;

class AddNurseryControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddNurseryController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
