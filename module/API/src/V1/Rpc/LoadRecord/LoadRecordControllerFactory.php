<?php
namespace API\V1\Rpc\LoadRecord;

class LoadRecordControllerFactory
{
    public function __invoke($controllers)
    {
        return new LoadRecordController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
