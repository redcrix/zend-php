<?php
namespace API\V1\Rpc\ForgotPassword;

class ForgotPasswordControllerFactory
{
    public function __invoke($controllers)
    {
        return new ForgotPasswordController(
                $controllers->get('Doctrine\ORM\EntityManager'),
                $controllers->get('Config')
        );
    }
}
