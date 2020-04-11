<?php
namespace API\V1\Rpc\LoadRecordForMyPet;

class LoadRecordForMyPetControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadRecordForMyPetController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
