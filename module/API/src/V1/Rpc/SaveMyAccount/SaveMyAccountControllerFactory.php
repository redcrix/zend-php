<?php
namespace API\V1\Rpc\SaveMyAccount;

class SaveMyAccountControllerFactory
{
    public function __invoke($controllers)
    {
        return new SaveMyAccountController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
