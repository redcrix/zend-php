<?php

namespace API\V1\Rpc\SavePrice;

class SavePriceControllerFactory {

    public function __invoke($controllers) {
        return new SavePriceController(
                $controllers->get('Doctrine\ORM\EntityManager')
        );
    }

}
