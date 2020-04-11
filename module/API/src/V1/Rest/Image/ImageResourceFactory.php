<?php
namespace API\V1\Rest\Image;

class ImageResourceFactory
{
    public function __invoke($services)
    {
        return new ImageResource($services->get('Doctrine\ORM\EntityManager'));
    }
}
