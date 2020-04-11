<?php
namespace API\V1\Rest\I18n;

class I18nResourceFactory
{
    public function __invoke($services)
    {
        return new I18nResource($services->get('Doctrine\ORM\EntityManager'));
    }
}
