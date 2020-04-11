<?php
namespace API\V1\Rpc\SearchInDictionary;

class SearchInDictionaryControllerFactory
{
    public function __invoke($controllers)
    {
        return new SearchInDictionaryController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
