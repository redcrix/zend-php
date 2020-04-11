<?php

namespace API\V1\Rpc\QRCodeTest;

class QRCodeTestControllerFactory {

    public function __invoke($controllers) {
        return new QRCodeTestController($controllers->get('Doctrine\ORM\EntityManager'), $controllers->get('Acelaya\QrCode\Service\QrCodeService'));
    }

}
