<?php

namespace API\V1\Rpc\PreOrderLoader;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\PreOrder;

/**
 * RPC para recuperar o uma PreOrder
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class PreOrderLoaderController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function preOrderLoaderAction() {
        $data = (object) $this->bodyParams();

        $order = $this->em->createQueryBuilder()
                ->select('r')
                ->from(PreOrder::class, 'r')
                ->where('r.link = :link')
                ->setParameter('link', $data->link)
                ->setMaxResults(1)
                ->getQuery()
                ->getArrayResult();

        $order[0]['etapa1'] = json_decode($order[0]['etapa1']);
        $order[0]['etapa2'] = json_decode($order[0]['etapa2']);
        return [
            'order' => $order[0],
            'pais' => $this->getPais($order[0]['etapa2'])
        ];
    }

    private function getPais($data) {
        if (!!$data) {
            return $data->pais;
        }

        $ip = $this->get_client_ip();

        $key = 'cb5018052e0c58e59d516e065a9d9d311dd782f0cc68a8f1d39a300d';
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.ipdata.co/' . $ip . '?api-key=' . $key,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = json_decode(curl_exec($curl));
        $err = curl_error($curl);
        curl_close($curl);
        
        return $response->country_name;
    }

    private function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        if ($ipaddress == 'UNKNOWN') {
            die('IP unknown! Please use a valid IP and try again.');
        }

        if ($ipaddress == '127.0.0.1') {
            $ipaddress = '168.227.12.86';
        }
        return $ipaddress;
    }

}
