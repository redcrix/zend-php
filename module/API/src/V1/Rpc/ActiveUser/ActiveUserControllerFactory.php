<?php
namespace API\V1\Rpc\ActiveUser;

class ActiveUserControllerFactory
{
    public function __invoke($controllers)
    {
        return new ActiveUserController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
