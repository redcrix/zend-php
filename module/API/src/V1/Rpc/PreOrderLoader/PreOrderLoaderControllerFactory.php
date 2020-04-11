<?php
namespace API\V1\Rpc\PreOrderLoader;

class PreOrderLoaderControllerFactory
{
    public function __invoke($controllers)
    {
        return new PreOrderLoaderController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
