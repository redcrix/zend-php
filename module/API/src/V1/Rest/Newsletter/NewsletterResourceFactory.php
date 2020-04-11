<?php
namespace API\V1\Rest\Newsletter;

class NewsletterResourceFactory
{
    public function __invoke($services)
    {
        return new NewsletterResource($services->get('Doctrine\ORM\EntityManager'));
    }
}
