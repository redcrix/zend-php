<?php

namespace API\V1\Rpc\CadastroLandingpage;

class CadastroLandingpageControllerFactory {

    public function __invoke($controllers) {
        return new CadastroLandingpageController(
                $controllers->get('Doctrine\ORM\EntityManager'), $controllers->get('Config')
        );
    }

}
