<?php

namespace API\V1\Rpc\AddVaccine;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\HistoryAction;
use API\V1\Entity\Pet;
use API\V1\Entity\Clinic;

/**
 * RPC para adicionar vacina a uma história
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class AddVaccineController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function addVaccineAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }
        $isVet = $this->user->isVeterinary();

        if (!$isVet) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();
        $history = $this->getOpenHistory($data->pet);
        $pet = $this->em->find(Pet::class, $data->pet);
        $vet = $this->getVeterinary();
        $dic = $this->getDicionario();

        $vaccines = [];
        foreach ($data as $key => $value) {
            $pattern = '/Ativo/';
            if (preg_match($pattern, $key)) {
                $nome = substr($key, 0, strlen($key) - 5);
                $dia = $data->{$nome . 'Dia'};
                if (!$dia) {
                    $dia = new \DateTime();
                } else {
                    $dia = new \DateTime($dia);
                }

                if (!!$value) {
                    $vacine = new HistoryAction();
                    $vacine->setCreation($dia)
                            ->setCategory('vaccine')
                            ->setHistory($history)
                            ->setObs('')
                            ->setPet($pet)
                            ->setValue($dic['history_' . $nome])
                            ->setVeterinary($vet);
                    $this->em->persist($vacine);
                    $history->getActions()->add($vacine);
                    $vaccines[] = $vacine;
                }
            }
        }
        
        if (!!$data->outros) {
            $dia = $data->outroData;
            if (!$dia) {
                $dia = new \DateTime();
            } else {
                $dia = new \DateTime($dia);
            }

            $vacine = new HistoryAction();
            $vacine->setCreation($dia)
                    ->setCategory('vaccine')
                    ->setHistory($history)
                    ->setObs('')
                    ->setPet($pet)
                    ->setValue($data->outroName)
                    ->setVeterinary($vet);
            $this->em->persist($vacine);
            $history->getActions()->add($vacine);
            $vaccines[] = $vacine;
        }
        
        $this->em->persist($history);
        $this->em->flush();
        
        $session = json_decode($this->user->getSession());
        $clinic = $this->em->find(Clinic::class, $session->clinica->id);

        $retorno = [];
        foreach ($vaccines as $value) {
            $v = $value->getData();
            $v['clinic'] = $clinic->getName();
            $retorno[] = $v;
        }

        return [
            'vaccines' => $retorno
        ];
    }

}
