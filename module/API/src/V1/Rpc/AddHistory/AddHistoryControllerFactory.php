<?php
namespace API\V1\Rpc\AddHistory;

class AddHistoryControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddHistoryController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
