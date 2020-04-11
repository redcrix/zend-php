<?php

namespace API\V1\Rpc\UploadProntuarioPdf;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Rest\Image\ImageResource;
use API\V1\Entity\Pet;
use API\V1\Entity\HistoryPdf;

/**
 * RPC para upload de prontuário
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class UploadProntuarioPdfController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function uploadProntuarioPdfAction() {
        $permitidos = ['owner'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }
        $data = (object) $this->bodyParams();

        if (!$this->isOwnerPet($data)) {
            return $this->sendError(401, 'Permission denied!');
        }

        $fileR = new ImageResource($this->em);
        $pdf = $fileR->saveInternal($data->arquivo);

        $pet = $this->em->find(Pet::class, $data->pet);

        $atendimento = new HistoryPdf();
        $atendimento->setPdf($pdf)
                ->setCreation(new \DateTime())
                ->setPet($pet);
        
        $pet->getHistoriesPdf()->add($atendimento);

        $this->em->persist($atendimento);
        $this->em->persist($pet);
        $this->em->flush();
        // print_r($data);

        return [
            'file' => [
                'id' => $atendimento->getId(),
                'creation' => $atendimento->getCreation(),
                'pdf' => $atendimento->getPdf()->getData()
            ]
        ];
    }

    private function isOwnerPet($data) {
        $pet = $this->em->createQueryBuilder()
                ->select('p')
                ->from(Pet::class, 'p')
                ->join('p.owner', 'o')
                ->join('o.user', 'u')
                ->where('u.id = :user')
                ->andWhere('p.id = :pet')
                ->setParameter('user', $this->user->getId())
                ->setParameter('pet', $data->pet)
                ->getQuery()
                ->getOneOrNullResult();

        return !!$pet;
    }

}
