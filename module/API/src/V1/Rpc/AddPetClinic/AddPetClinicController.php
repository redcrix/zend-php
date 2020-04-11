<?php
namespace API\V1\Rpc\AddPetClinic;

use Zend\Mvc\Controller\AbstractActionController;
use API\V1\Entity\Clinic;
use API\V1\Entity\Pet;

/**
 * RPC para adicionar pets a clinica
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class AddPetClinicController extends AbstractActionController
{
    
    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;
    
    public function addPetClinicAction()
    {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }
        $data = (object) $this->bodyParams();

        $session = json_decode($this->user->getSession());
        $clinic = $this->em->createQueryBuilder()
                ->select(['c'])
                ->from(Clinic::class, 'c')
                ->where('c.id = :id')
                ->setParameter('id', $session->clinica->id)
                ->getQuery()
                ->getSingleResult();

        $pet = $this->em->find(Pet::class, $data->id);
        $pet->addClinic($clinic);

        $this->em->persist($pet);
        $this->em->persist($clinic);
        $this->em->flush();

        return [
            'status' => 'ok'
        ];
    }
}
