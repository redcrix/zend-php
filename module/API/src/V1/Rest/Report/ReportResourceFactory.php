<?php
namespace API\V1\Rest\Report;

class ReportResourceFactory
{
    public function __invoke($services)
    {
        return new ReportResource($services->get('Doctrine\ORM\EntityManager'));
    }
}
