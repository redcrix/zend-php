<?php
namespace API\V1\Rpc\LoadDictionary;

class LoadDictionaryControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadDictionaryController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
