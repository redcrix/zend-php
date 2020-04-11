<?php

namespace API\V1\Rest\HistoryAction;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;
use API\V1\Entity\History;
use API\V1\Entity\HistoryAction;
use API\V1\Entity\Clinic;
use API\V1\Entity\Pet;
use API\V1\Entity\Veterinary;

class HistoryActionResource extends AbstractResourceListener {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data) {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }
        $isVet = $this->user->isVeterinary();

        if (!$isVet) {
            return $this->sendError(401, 'Permission denied!');
        }

        $data = (object) $data;

        $session = json_decode($this->user->getSession());

        if ($data->id == 'novo') {

            $pet = $this->em->find(Pet::class, $data->pet);
            $entity = History::class;
            $dql = <<<DQL
                SELECT h
                FROM {$entity} h
                JOIN h.clinic c
                JOIN h.pet p
                WHERE h.release IS NULL
                AND c.id = :clinic
                AND p.id = :pet
DQL;

            $history = $this->em->createQuery($dql)
                    ->setParameter('clinic', $session->clinica->id)
                    ->setParameter('pet', $pet->getId())
                    ->getSingleResult();

            $veterinary = $this->getVeterinary();

            $action = new HistoryAction();
            $action->setCategory($data->category)
                    ->setHistory($history)
                    ->setPet($pet)
                    ->setVeterinary($veterinary);            
        } else {
            $entity = HistoryAction::class;
            $dql = <<<DQL
                SELECT a
                FROM {$entity} a
                JOIN a.history h
                JOIN h.clinic c
                WHERE h.release IS NULL
                AND a.id = :id
                AND c.id = :clinic
DQL;

            $action = $this->em->createQuery($dql)
                    ->setParameter('id', $data->id)
                    ->setParameter('clinic', $session->clinica->id)
                    ->getSingleResult();
        }

        $action->setValue($data->value)
                ->setCreation(new \DateTime($data->creation))
                ->setObs(!!$data->obs ? $data->obs : '');

        $this->em->persist($action);
        
        if ($data->id == 'novo') {
            $history->getActions()->add($action);
            $this->em->persist($history);
            $this->em->flush();
            $clinic = $this->em->find(Clinic::class, $session->clinica->id);
            $action = $action->getData();
            $action['clinic'] = $clinic->getName();
            return [
                'action' => $action
            ];
        } else {
            $this->em->flush();
            return [
                'action' => $action->getData()
            ];
        }
    }

    protected function getVeterinary() {
        $entity = Veterinary::class;
        $dql = <<<DQL
                SELECT 
                    v
                FROM {$entity} v
                JOIN v.user u
                WHERE u.id = :id
DQL;

        return $this->em->createQuery($dql)
                        ->setParameter('id', $this->user->getId())
                        ->getSingleResult();
    }

    /**
     * Deleta uma ação em uma história
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id) {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }
        $isVet = $this->user->isVeterinary();

        if (!$isVet) {
            return $this->sendError(401, 'Permission denied!');
        }

        $session = json_decode($this->user->getSession());

        $entity = HistoryAction::class;
        $dql = <<<DQL
                SELECT a, h
                FROM {$entity} a
                JOIN a.history h
                JOIN h.clinic c
                WHERE h.release IS NULL
                AND a.id = :id
                AND c.id = :clinic
DQL;

        $action = $this->em->createQuery($dql)
                ->setParameter('id', $id)
                ->setParameter('clinic', $session->clinica->id)
                ->getSingleResult();

        $history = $action->getHistory();
        $history->getActions()->removeElement($action);

        $this->em->remove($action);
        $this->em->persist($history);

        $this->em->flush();

        return true;
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data) {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id) {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = []) {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }
        $isVet = $this->user->isVeterinary();

        if (!$isVet) {
            return $this->sendError(401, 'Permission denied!');
        }

        $session = json_decode($this->user->getSession());
        $clinic = $this->em->find(Clinic::class, $session->clinica->id);

        $entity = HistoryAction::class;
        $dql = <<<DQL
                SELECT a, v
                FROM {$entity} a
                JOIN a.pet p
                JOIN a.veterinary v
                WHERE p.id = :id 
                AND a.category = :category
                ORDER BY a.creation DESC
DQL;

        $action = $this->em->createQuery($dql)
                ->setParameter('id', $params['pet'])
                ->setParameter('category', $params['category'])
                ->getResult();

        $return = [];
        foreach ($action as $v) {
            $value = $v->getData();
            $value['clinic'] = $clinic->getName();
            $return[] = $value;
        }

        return [
            'actions' => $return
        ];
    }

}
