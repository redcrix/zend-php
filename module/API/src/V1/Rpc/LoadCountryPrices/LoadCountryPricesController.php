<?php

namespace API\V1\Rpc\LoadCountryPrices;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\CountryPrice;

/**
 * RPC para recuperar valores por países e moedas
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class LoadCountryPricesController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function loadCountryPricesAction() {
        # return $this->update();
        $paises = $this->em->createQueryBuilder()
                ->select(['c'])
                ->from(CountryPrice::class, 'c')
                ->orderBy('c.country', 'ASC')
                ->getQuery()
                ->getArrayResult();
        return [
            'countries' => $paises,
            'atual' => $this->getPaisAtual()
        ];
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

    private function getPaisAtual() {
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

    private function update() {
        $paises = json_decode(file_get_contents(__DIR__ . '/paises.json'));
        $moedas = json_decode(file_get_contents(__DIR__ . '/moedas.json'));

        $i = 0;
        foreach ($paises as $sigla => $p) {
            $pais = new CountryPrice();
            $pais->setCountry($p)
                    ->setCurrency($moedas->{$sigla})
                    ->setPrice(0);
            $this->em->persist($pais);

            $i++;
            if ($i > 15) {
                $i = 0;
                $this->em->flush();
            }
        }

        $this->em->flush();
        return [
            'status' => 'ok'
        ];
    }

}
