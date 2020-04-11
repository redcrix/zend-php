<?php
namespace API\V1\Rpc\LoginClient;

class LoginClientControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoginClientController(
                $controllers->get('Doctrine\ORM\EntityManager'),
                $controllers->get('Config')
        );
    }
}
