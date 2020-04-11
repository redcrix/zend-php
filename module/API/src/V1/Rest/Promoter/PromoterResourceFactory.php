<?php

namespace API\V1\Rest\Promoter;

class PromoterResourceFactory {

    public function __invoke($services) {
        return new PromoterResource(
                $services->get('Doctrine\ORM\EntityManager'), $services->get('Config')
        );
    }

}
