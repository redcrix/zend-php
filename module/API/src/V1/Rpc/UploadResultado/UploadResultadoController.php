<?php

namespace API\V1\Rpc\UploadResultado;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Diagnosis;
use API\V1\Rest\Image\ImageResource;

/**
 * RPC para upload de resultados
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class UploadResultadoController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function uploadResultadoAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }
        $data = (object) $this->bodyParams();

        $exame = $this->em->find(Diagnosis::class, $data->exame);

        $fileR = new ImageResource($this->em);
        $file = $fileR->saveInternal($data->arquivo);

        $exame->setResultIsFile(true)
                ->getResultFile()->add($file);

        $this->em->persist($exame);
        $this->em->flush();
        // print_r($data);

        return [
            'file' => $file->getId()
        ];
    }

}
