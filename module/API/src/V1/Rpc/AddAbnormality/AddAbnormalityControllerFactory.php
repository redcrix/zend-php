<?php
namespace API\V1\Rpc\AddAbnormality;

class AddAbnormalityControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddAbnormalityController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
