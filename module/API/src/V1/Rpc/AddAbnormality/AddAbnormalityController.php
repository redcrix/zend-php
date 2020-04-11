<?php

namespace API\V1\Rpc\AddAbnormality;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\HistoryAction;
use API\V1\Entity\Pet;
use API\V1\Entity\Clinic;

/**
 * RPC para adicionar anormalidades
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class AddAbnormalityController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function addAbnormalityAction() {
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

        $dia = new \DateTime();
        $abnomalities = [];
        foreach ($data as $key => $value) {
            if (property_exists($data, $key . 'Obs') && $value) {
                $obs = !!$data->{$key . 'Obs'} ? $data->{$key . 'Obs'} : '';
                $abnormality = new HistoryAction();
                $abnormality->setCreation($dia)
                        ->setCategory('abnormality')
                        ->setHistory($history)
                        ->setObs($obs)
                        ->setPet($pet)
                        ->setValue($data->{$key . 'Value'})
                        ->setVeterinary($vet);

                $this->em->persist($abnormality);
                $history->getActions()->add($abnormality);
                $abnomalities[] = $abnormality;
            }
        }

        $this->em->persist($history);
        $this->em->flush();

        $session = json_decode($this->user->getSession());
        $clinic = $this->em->find(Clinic::class, $session->clinica->id);

        $retorno = [];
        foreach ($abnomalities as $value) {
            $v = $value->getData();
            $v['clinic'] = $clinic->getName();
            $retorno[] = $v;
        }

        return [
            'abnormality' => $retorno
        ];
    }

}
