<?php
namespace API\V1\Rest\User;

class UserResourceFactory
{
    public function __invoke($services)
    {
        return new UserResource(
                $services->get('Doctrine\ORM\EntityManager'),
                $services->get('Config')
        );
    }
}
