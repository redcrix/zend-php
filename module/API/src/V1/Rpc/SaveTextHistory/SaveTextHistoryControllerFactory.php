<?php
namespace API\V1\Rpc\SaveTextHistory;

class SaveTextHistoryControllerFactory
{
    public function __invoke($controllers)
    {
        return new SaveTextHistoryController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
