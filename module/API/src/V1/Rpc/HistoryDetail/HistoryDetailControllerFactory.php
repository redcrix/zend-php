<?php
namespace API\V1\Rpc\HistoryDetail;

class HistoryDetailControllerFactory
{
    public function __invoke($controllers)
    {
        return new HistoryDetailController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
