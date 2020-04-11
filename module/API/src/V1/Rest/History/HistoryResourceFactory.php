<?php
namespace API\V1\Rest\History;

class HistoryResourceFactory
{
    public function __invoke($services)
    {
        return new HistoryResource($services->get('Doctrine\ORM\EntityManager'));
    }
}
