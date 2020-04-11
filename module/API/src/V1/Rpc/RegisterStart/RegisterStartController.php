<?php

namespace API\V1\Rpc\RegisterStart;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Newsletter;
use API\V1\Entity\PreOrder;

/**
 * RPC para Registrar clientes orgânicos
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class RegisterStartController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function registerStartAction() {
        $data = (object) $this->bodyParams();

        if ($data->client_secret != 'v3PpQ1CXRgsSOcG6NHUKkO7tRD1djmdUGs4RrYkZ45CLYqfKkLpAG') {
            return [
                'link' => 'boatentativamasnaofoidestavez.com'
            ];
        }

        # PreOrder
        $link = $this->preorder($data);

        # Newsletter
        $this->newsletter($data);

        return [
            'link' => $link
        ];
    }

    private function preorder($data) {
        $preorder = new PreOrder();
        $preorder->setEmail($data->email)
                ->setLang($data->lang)
                ->setName($data->name)
                ->setPet($data->pet)
                ->setPhone($data->phone)
                ->setBase($data->promoter)
                ->setRegister(new \DateTime())
                ->setLink('---');
        $this->em->persist($preorder);
        $this->em->flush();

        $link = $this->getLink($preorder);

        $preorder->setLink($link);
        $this->em->persist($preorder);
        $this->em->flush();
        return $link;
    }

    private function getLink(PreOrder $preorder) {
        return md5($preorder->getId()) . md5('Ymdhis') . md5(rand(100, 999));
    }

    private function newsletter($data) {
        $newsletter = new Newsletter();
        $newsletter->setEmail($data->email)
                ->setLang($data->lang)
                ->setName($data->name)
                ->setPet($data->pet)
                ->setPhone($data->phone)
                ->setRegister(new \DateTime())
                ->setType('owner');
        $this->em->persist($newsletter);
        $this->em->flush();
    }

}
