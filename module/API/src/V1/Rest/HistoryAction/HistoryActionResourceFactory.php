<?php
namespace API\V1\Rest\HistoryAction;

class HistoryActionResourceFactory
{
    public function __invoke($services)
    {
        return new HistoryActionResource($services->get('Doctrine\ORM\EntityManager'));
    }
}
