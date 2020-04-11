<?php

namespace API\V1\Rpc\RegisterStep2;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\PreOrder;
use API\V1\Entity\CountryPrice;

/**
 * RPC para persistir dados da etapa 1 após registro
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class RegisterStep2Controller extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function registerStep2Action() {
        $data = (object) $this->bodyParams();

        $order = $this->em->createQueryBuilder()
                ->select('r')
                ->from(PreOrder::class, 'r')
                ->where('r.link = :link')
                ->setParameter('link', $data->id)
                ->setMaxResults(1)
                ->getQuery()
                ->getSingleResult();

        $order->setEtapa2(json_encode($data));
        $price = $this->getPrice($data->pais);

        $this->em->persist($order);
        $this->em->flush();

        return [
            'session' => $this->stripe($order, $price)
        ];
    }

    private function getPrice($pais) {
        return $this->em->createQueryBuilder()
                        ->select('r')
                        ->from(CountryPrice::class, 'r')
                        ->where('r.country = :pais')
                        ->setParameter('pais', $pais)
                        ->setMaxResults(1)
                        ->getQuery()
                        ->getSingleResult();
    }

    private function stripe(PreOrder $order, CountryPrice $price) {
        $dic = $this->getDicionario();
        \Stripe\Stripe::setApiKey($this->config['stripe']);
        $session = \Stripe\Checkout\Session::create([
                    'payment_method_types' => ['card'], // , 'ideal', 'sepa_debit'
                    'line_items' => [[
                    'name' => $dic['checkout_product_name'],
                    'description' => $dic['checkout_product_desc'],
                    'images' => [$this->config['inetpet-image']],
                    'amount' => $price->getPrice(),
                    'currency' => strtolower($price->getCurrency()),
                    'quantity' => 1,
                        ]],
                    'success_url' => $this->config['inetpet-checkout-sucess'] . '/' . $order->getId() . '/{CHECKOUT_SESSION_ID}',
                    'cancel_url' => $this->config['inetpet-checkout-cancel'] . '/' . $order->getLink(),
        ]);

        $order->setStripe($session->id);
        $this->em->persist($order);
        $this->em->flush();

        return $session->id;
    }

}
