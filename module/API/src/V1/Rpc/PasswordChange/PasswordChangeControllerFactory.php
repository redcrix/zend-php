<?php
namespace API\V1\Rpc\PasswordChange;

class PasswordChangeControllerFactory
{
    public function __invoke($controllers)
    {
        return new PasswordChangeController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
