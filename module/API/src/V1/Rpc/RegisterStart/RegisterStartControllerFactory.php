<?php
namespace API\V1\Rpc\RegisterStart;

class RegisterStartControllerFactory
{
    public function __invoke($controllers)
    {
        return new RegisterStartController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
