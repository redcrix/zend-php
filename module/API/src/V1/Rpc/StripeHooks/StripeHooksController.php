<?php

namespace API\V1\Rpc\StripeHooks;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Rest\Image\ImageResource;
use API\V1\Entity\PreOrder;
use API\V1\Entity\Order;
use API\V1\Entity\Owner;
use API\V1\Entity\User;
use API\V1\Entity\Address;
use API\V1\Entity\Pet;
use API\V1\Rest\Pet\PetResource;
use Endroid\QrCode\QrCode;

/**
 * RPC para webhook Stripe
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class StripeHooksController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function stripeHooksAction() {
        $data = (object) $this->bodyParams();
        $file = date('Y-m-d-i-s');

        $data->sessionStripe = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        file_put_contents($this->config['stripe-folder'] . $file . '-data.json', json_encode($data));

        \Stripe\Stripe::setApiKey($this->config['stripe']);
        $endpoint_secret = 'whsec_oGAm1cOBMlGPqW9ZgMBXlQvru7eXcWG4';

        // $payload = json_encode($data);
        /*
          $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
          $event = null;

          try {
          $event = \Stripe\Webhook::constructEvent(
          $data, $sig_header, $endpoint_secret
          );
          } catch (\UnexpectedValueException $e) {
          return $this->sendError(400, 'Valor inesperado');
          } catch (\Stripe\Exception\SignatureVerificationException $e) {
          return $this->sendError(400, 'Erro de assinatura');
          } catch (\Exception $e) {
          file_put_contents($this->config['stripe-folder'] . $file . '-erro.json', json_encode($data));
          return $this->sendError(401, 'Erro geral');
          }
         */
        switch ($data->type) {
            case 'checkout.session.completed':
                return $this->processarPagamento((object) $data->data['object']);
                break;
            default:
                return $this->sendError(400, 'Payload inválido');
                break;
        }
        return $this->sendError(400, 'Payload inválido');
    }

    private function processarPagamento($session) {

        $preOrder = $this->em->createQueryBuilder()
                ->select('r')
                ->from(PreOrder::class, 'r')
                ->where('r.stripe = :id')
                ->setParameter('id', $session->id)
                ->getQuery()
                ->getSingleResult();

        $end = json_decode($preOrder->getEtapa2());

        $address = new Address();
        $address->setAddress($end->endereco)
                ->setNumber($end->numero)
                ->setAddress2($end->bairro)
                ->setAddress3($end->complemento)
                ->setCity($end->cidade)
                ->setState($end->estado)
                ->setZipcode($end->cep)
                ->setCountry($end->pais);

        $user = $this->getUser($preOrder->getEmail());
        $user->setAddress($address)
                ->setBlocked(false)
                ->setCreation(new \DateTime())
                ->setDeleted(false)
                ->setDocument('')
                ->setEmailConfirmation(false)
                ->setName($preOrder->getName())
                ->setPassword('$$newpassword$$')
                ->setPasswordReset(true)
                ->setPhone($preOrder->getPhone())
                ->setRole('owner')
                ->setSession('{"path": ""}')
                ->setUpdate(new \DateTime())
                ->setUsername($preOrder->getEmail());

        $p = json_decode($preOrder->getEtapa1());

        $owner = new Owner();
        $owner->setUser($user);

        $pet = new Pet();
        $pet->setBirthdate(new \DateTime($p->nascimento))
                ->setColor('')
                ->setName($p->nome)
                ->setOrign($p->origem)
                ->setPedigree('')
                ->setSex($p->sexo)
                ->setRace($p->raca)
                ->setSpecie($p->especie)
                ->setCreation(new \DateTime())
                ->setDeleted(false)
                ->setOwner($owner);

        $owner->getPets()->add($pet);

        $order = new Order();
        $order->setRegister(new \DateTime())
                ->setAddress($address)
                ->setOwner($owner)
                ->setPayment(json_encode($session))
                ->setPet($pet)
                ->setPreOrder($preOrder)
                ->setPrice($session->display_items[0]['amount'])
                ->setCurrency($session->display_items[0]['currency'])
                ->setStatus('order_status_production')
                ->setTracker('');

        $pr = new PetResource($this->em, $this->config);
        $pr->sendOwnerEmail($user);

        $this->em->persist($address);
        $this->em->persist($user);
        $this->em->persist($owner);
        $this->em->persist($pet);
        $this->em->persist($order);

        $this->makeQRCode($pet, $user, $preOrder->getLang());

        $this->em->flush();

        return $this->sendError(200, '{"status": "Payment success!"');
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
    }

    private function getUser($user) {
        $arr = $this->em->getRepository(User::class)->findBy(['username' => $user]);

        if (count($arr) > 0) {
            return $arr[0];
        }

        return new User();
    }

}
