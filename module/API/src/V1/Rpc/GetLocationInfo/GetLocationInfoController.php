<?php

namespace API\V1\Rpc\GetLocationInfo;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\CountryPrice;
use API\V1\Entity\Language;

/**
 * RPC para pegar informações de idiomas, moedas e valores por localização
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class GetLocationInfoController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function getLocationInfoAction() {
        $geoData = $this->getData();
        $moeda = $geoData->currency;
        return [
            'currency' => $moeda->symbol,
            'price' => $this->getPrice($moeda->code, $geoData->country_name),
            'country' => $geoData->country_name,
            'lang' => $this->getLang(@$geoData->languages[0]->native)
        ];
    }

    private function getLang($langName) {
        $langs = $this->em->createQueryBuilder()
                ->select('l')
                ->from(Language::class, 'l')
                ->getQuery()
                ->getArrayResult();

        $lang = 'en';
        foreach ($langs as $l) {
            if ($l['name'] == $langName) {
                $lang = $l['lang'];
            }
        }

        return $lang;
    }

    private function getPrice($currency, $pais) {

        $info = $this->em->createQueryBuilder()
                ->select('c')
                ->from(CountryPrice::class, 'c')
                ->where('c.country = :country')
                ->andWhere('c.currency = :currency')
                ->setParameter('country', $pais)
                ->setParameter('currency', $currency)
                ->getQuery()
                ->getSingleResult();

        $ponto = [
            'USD', 'GBP', 'CAD', 'AUD', 'NZD', 'ZAR',
        ];

        if (in_array($currency, $ponto)) {
            return number_format($info->getPrice() / 100, 2, '.', ',');
        }

        return number_format($info->getPrice() / 100, 2, ',', '.');
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

    private function getData() {
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
        return $response;
    }

}
