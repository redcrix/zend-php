<?php

namespace API\V1\Rpc\UpdateLangs;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Language;
use API\V1\Entity\I18n;
use API\V1\Entity\Order;
use API\V1\Entity\Pet;
use API\V1\Entity\User;
use Endroid\QrCode\QrCode;
use API\V1\Rest\Image\ImageResource;

/**
 * RPC para atualizar termos dos dicionarios
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class UpdateLangsController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function updateLangsAction() {
        // return $this->updateQRCodes();
        return $this->updateLang();
    }

    private function updateQRCodes() {
        
        $arr = $this->em->createQueryBuilder()
                ->select(['d', 'p', 'o', 'u', 'po', 'qr'])
                ->from(Order::class, 'd')
                ->join('d.pet', 'p')
                ->leftJoin('p.qrCode', 'qr')
                ->join('d.preOrder', 'po')
                ->join('d.owner', 'o')
                ->join('o.user', 'u')
                ->getQuery()
                ->getResult();
        /*
        $arr = $this->em->createQueryBuilder()
                ->select(['p', 'o', 'u', 'qr'])
                ->from(Pet::class, 'p')
                ->leftJoin('p.qrCode', 'qr')
                ->join('p.owner', 'o')
                ->join('o.user', 'u')
                ->getQuery()
                ->getResult();
        foreach ($arr as $order) {
            $this->makeQRCode(
                    $order, $order->getOwner()->getUser(), 'pt-BR');
        }
        */
        foreach ($arr as $order) {
            $this->makeQRCode(
                    $order->getPet(), $order->getOwner()->getUser(), $order->getPreOrder()->getLang());
        }
        
        return [
            'status' => 'ok'
        ];
    }

    private function makeQRCode(Pet $pet, User $user, $lang) {
        $dicionario = $this->getDicionario($lang);
        $url = $this->config['frontend']['uri'] . '/pet-profile/' . $pet->getId();
        $sex = $pet->getSex() == 'M' ? 'qrcode_sex_male' : 'qrcode_sex_female';

        $message = <<<QRCODE
{$dicionario['qrcode_name']}: {$pet->getName()}
{$dicionario['qrcode_race']}: {$pet->getRace()}
{$dicionario['qrcode_sex']}: {$dicionario[$sex]}
{$dicionario['qrcode_url']}: {$url}
{$dicionario['qrcode_owner']}: {$user->getName()}
{$dicionario['qrcode_cellphone']}: {$user->getPhone()}
{$dicionario['qrcode_email']}: {$user->getUsername()}
QRCODE;
        $qrCode = new QrCode();
        $qrCode->setText($message)
                ->setSize(300)
                ->setPadding(10)
                ->setErrorCorrection('high')
                ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
                ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
                ->setLogo(__DIR__ . "/../../Rest/Pet/logo.png")
                ->setLogoSize(98)
                ->setImageType(QrCode::IMAGE_TYPE_PNG);

        # Persist QRCode
        $imagemResource = new ImageResource($this->em);
        $img = $imagemResource->saveQRCode();
        $qrCode->save($img->dir);

        $pet->setQrCode($img->QRCode);
        $this->em->persist($pet);
        $this->em->flush();
    }

    private function updateText() {
        set_time_limit(0);

        $dic = $this->getDicionario('pt-BR');
        $lang = $this->em->getRepository(Language::class)->findAll();

        $i = 0;
        foreach ($lang as $l) {
            foreach ($dic as $key => $v) {
                $termo = $this->em->getRepository(I18n::class)->findOneBy([
                    'title' => $key,
                    'lang' => $l->getLang()
                ]);

                if ($termo->getValue() == '') {
                    $termo->setValue($dic[$key]);
                    $this->em->persist($termo);
                    $i++;
                }

                if ($i > 15) {
                    $this->em->flush();
                    $i = 0;
                }
            }
        }

        $this->em->flush();
        return [
            'status' => 'ok'
        ];
    }

    private function updateLang() {
        set_time_limit(0);

        $dic = $this->getDicionario('pt-BR');
        $lang = $this->em->getRepository(Language::class)->findAll();

        $i = 0;
        foreach ($lang as $l) {
            foreach ($dic as $key => $v) {
                $termo = $this->em->getRepository(I18n::class)->findOneBy([
                    'title' => $key,
                    'lang' => $l->getLang()
                ]);

                if (!$termo) {
                    $local = $this->em->getRepository(I18n::class)->findOneBy([
                        'title' => $key,
                        'lang' => 'pt-BR'
                    ]);

                    $novo = new I18n();
                    $novo->setLang($l->getLang())
                            ->setTitle($key)
                            ->setValue($dic[$key])
                            ->setLocal($local->getLocal());
                    $this->em->persist($novo);
                    $i++;
                }

                if ($i > 15) {
                    $this->em->flush();
                    $i = 0;
                }
            }
        }

        $this->em->flush();
        return [
            'status' => 'ok'
        ];
    }

}
