<?php
namespace API\V1\Rpc\UpdateLangs;

class UpdateLangsControllerFactory
{
    public function __invoke($controllers)
    {
        return new UpdateLangsController(
                $controllers->get('Doctrine\ORM\EntityManager'), $controllers->get('Config'));
    }
}
