<?php

namespace API\V1\Rpc\QRCodeTest;

use Zend\Mvc\Controller\AbstractActionController;
use Endroid\QrCode\QrCode;

class QRCodeTestController extends AbstractActionController {

    use \API\V1\Util\Comum\ConstructorUtils;

    public function qRCodeTestAction() {

        $message = <<<QRCODE
Nome: Totó
Raça: Dobermann
Sexo: Masculino
URL: https://inetpet.com/pet-profile/42
Proprietário: Marcus Borges
Celular: +5511945420103
Email: yahuchanam@gmail.com
QRCODE;
        /*
          $qrCodeData = $this->config->getQrCodeContent(
          $message, 'png'
          );
          file_put_contents(__DIR__ . '/qrcode.png', $qrCodeData);
          die('deu certo');
         * 
         */
        $qrCode = new QrCode();
        $qrCode->setText($message)
                ->setSize(300)
                ->setPadding(10)
                ->setErrorCorrection('high')
                ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
                ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
                // Path to your logo with transparency
                ->setLogo(__DIR__ . "/logo.png")
                // Set the size of your logo, default is 48
                ->setLogoSize(98)
                ->setImageType(QrCode::IMAGE_TYPE_PNG)
        ;

        $qrCode->save(__DIR__ . '/qrcode.png');
        die('aeee');
    }

}
