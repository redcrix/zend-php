<?php
namespace API\V1\Rpc\MyAccount;

class MyAccountControllerFactory
{
    public function __invoke($controllers)
    {
        return new MyAccountController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
