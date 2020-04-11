<?php

namespace API\V1\Rpc\UpdateService;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\GroomingService;
use API\V1\Entity\Clinic;

/**
 * RPC para atualização de serviços
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class UpdateServiceController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function updateServiceAction() {
        $permitidos = ['manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $this->bodyParams();

        $this->remover($data->remover);
        $this->salvar($data->atualizar);
        
        return [
            'status' => 'ok'
        ];
    }

    private function salvar($arr) {
        $session = json_decode($this->user->getSession());
        $clinic = $this->em->find(Clinic::class, $session->clinica->id);

        $i = 0;
        foreach ($arr as $s) {
            $s = (object) $s;
            if ($s->id == 'novo') {
                $service = new GroomingService();
                $service->setClinic($clinic);
            } else {
                $service = $this->em->find(GroomingService::class, $s->id);
            }

            $service->setName($s->name)
                    ->setPrice($s->price);
            $this->em->persist($service);

            $i++;
            if ($i > 20) {
                $this->em->flush();
            }
        }
        $this->em->flush();
    }

    private function remover($arr) {
        $i = 0;
        foreach ($arr as $id) {
            $service = $this->em->find(GroomingService::class, $id);
            $service->setDeleted(true);
            $this->em->persist($service);

            $i++;
            if ($i > 15) {
                $this->em->flush();
            }
        }
        $this->em->flush();
    }

}
