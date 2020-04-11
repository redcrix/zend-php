<?php

namespace API\V1\Rpc\AddHistory;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\Common\Collections\ArrayCollection;
use API\V1\Entity\Pet;
use API\V1\Entity\History;
use API\V1\Entity\Veterinary;
use API\V1\Entity\TherapeuticPlan;
use API\V1\Entity\Mucous;
use API\V1\Entity\Diagnosis;
use API\V1\Entity\VitalSigns;
use API\V1\Entity\VaccineRecord;
use API\V1\Entity\Desparasitation;
use API\V1\Entity\ReproductiveState;
use API\V1\Entity\PreviousDiseases;
use API\V1\Entity\Surgery;
use API\V1\Entity\Allergy;
use API\V1\Entity\FamilyBackground;
use API\V1\Entity\Hospitalization;
use API\V1\Entity\Clinic;

/**
 * RPC para adicionar historias a um pet
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, InetPet
 * @version 1.0.0
 */
class AddHistoryController extends AbstractActionController {

    /**
     * Construtor padrão
     */
    use \API\V1\Util\Comum\ConstructorUtils;

    public function addHistoryAction() {
        $permitidos = ['employee', 'manager'];
        if (!$this->isAutorized($permitidos)) {
            return $this->sendError(401, 'Permission denied!');
        }

        if (!$this->user->isVeterinary()) {
            return $this->sendError(401, 'Permission denied, user must be vet!');
        }

        $data = (object) $this->bodyParams();
        $pet = $this->getPet($data->petId);

        $this->updateHospitalization($data, $pet);

        $veterinary = $this->getVeterinary();

        $record = $pet->getPetRecord();

        if ($data->sinaisUpdate) {
            $record->getVitalSigns()->add($this->getSignal($data, $record));
        }

        $vacinas = $this->getVacinas($data, $record);
        foreach ($vacinas as $vacina) {
            $record->getVaccines()->add($vacina);
        }

        $despa = $this->getDesparasitations($data, $record);
        if ($despa) {
            $record->getDesparasitations()->add($despa);
        }

        $reprod = $this->getReproductiveState($data, $record);
        if ($reprod) {
            $record->getReproductiveState()->add($reprod);
        }

        $antecedentes = $this->getAntecedentes($data, $record);
        foreach ($antecedentes as $a) {
            $record->getPreviousDiseases()->add($a);
        }

        $cirurgias = $this->getCirurgias($data, $record);
        foreach ($cirurgias as $s) {
            $record->getSurgeries()->add($s);
        }

        $alergias = $this->getAlergias($data, $record);
        foreach ($alergias as $s) {
            $record->getAllergies()->add($s);
        }

        $familia = $this->getFamilias($data, $record);
        foreach ($familia as $f) {
            $record->getFamilyBackground()->add($f);
        }

        if (!!$data->feeding) {
            $record->setFeeding($data->feeding);
        }

        if (!!$data->habitatt) {
            $record->setHabitatt($data->habitatt);
        }

        $session = json_decode($this->user->getSession());
        if (!isset($session->clinica)) {
            $clinic = $this->getClinic();
        } else {
            $clinic = $this->em->find(Clinic::class, $session->clinica->id);
        }

        $history = new History();
        $history->setAttitude($data->attitude)
                ->setCorporalCondition($data->corporalCondition)
                ->setCreation(new \DateTime())
                ->setClinic($clinic)
                ->setDiagnosticImpression(!!$data->impression ? $data->impression : '')
                ->setDifferentialDiagnosis(!!$data->differentialDiagnosis ? $data->differentialDiagnosis : '')
                ->setHydratationState($data->hydratationState)
                ->setInterpretation(!!$data->interpretation ? $data->interpretation : '')
                ->setPetRecord($record)
                ->setPresumptiveDiagnosis($data->presumptiveDiagnosis)
                ->setSituation(!!$data->situation ? $data->situation : '')
                ->setTherapeuticPlan($this->getMedicamentos($data, $history))
                ->setMucous($this->getMucous($data, $history))
                ->setDiagnosis($this->getExames($data, $history))
                ->setVeterinary($veterinary);

        $record->getHistories()->add($history);



        $this->em->persist($history);
        $this->em->persist($record);
        $this->em->flush();

        return [
            'status' => $pet->getId()
        ];
    }
    
    private function getClinic() {
        if($this->user->getRole() == 'manager') {
            $clinica = $this->em->createQueryBuilder()
                ->select(['c'])
                ->from(Clinic::class, 'c')
                ->join('c.manager', 'm')
                ->join('m.user', 'u')
                ->where('u.blocked = false')
                ->andWhere('u.deleted = false')
                ->andWhere('u.emailConfirmation = true')
                ->andWhere('u.role = :role')
                ->andWhere('u.id = :id')
                ->andWhere('c.deleted = false')
                ->setParameter('role', 'manager')
                ->setParameter('id', $this->user->getId())
                ->getQuery()
                ->setMaxResults(1)
                ->getSingleResult();
        } else {
            // employee
            $clinica = $this->em->createQueryBuilder()
                ->select(['c'])
                ->from(Clinic::class, 'c')
                ->join('c.manager', 'm')
                ->join('m.user', 'u')
                ->where('u.blocked = false')
                ->andWhere('u.deleted = false')
                ->andWhere('u.emailConfirmation = true')
                ->andWhere('u.role = :role')
                ->andWhere('u.id = :id')
                ->andWhere('c.deleted = false')
                ->setParameter('role', 'employee')
                ->setParameter('id', $this->user->getId())
                ->getQuery()
                ->setMaxResults(1)
                ->getSingleResult();
        }
        return $clinica;
    }

    private function updateHospitalization($data, $pet) {

        $entity = Hospitalization::class;
        $dql = <<<DQL
                SELECT 
                    ho
                FROM {$entity} ho
                LEFT JOIN ho.pet p
                WHERE p.id = :pet
                ORDER BY ho.id DESC
DQL;

        $hosp = $this->em->createQuery($dql)
                ->setParameter('pet', $pet->getId())
                ->setMaxResults(1)
                ->getSingleResult();


        if (isset($data->anamnesics)) {
            $hosp->setAnamnesics($data->anamnesics);
        }

        if (isset($data->reason)) {
            $hosp->setReason($data->reason);
        }

        $this->em->persist($hosp);
    }

    private function getReproductiveState($data, $petRecord) {
        if (!$data->reproductiveState) {
            return false;
        }

        $rep = new ReproductiveState();
        $rep->setCreation(new \DateTime($data->reproductiveDate))
                ->setName($data->reproductiveState)
                ->setPetRecord($petRecord);
        $this->em->persist($rep);
        return $rep;
    }

    private function getDesparasitations($data, $petRecord) {

        if (!$data->desparasitationProduct) {
            return false;
        }
        $des = new Desparasitation();
        $des->setCreation(new \DateTime($data->desparasitationDate))
                ->setName($data->desparasitationProduct)
                ->setPetRecord($petRecord);
        $this->em->persist($des);

        return $des;
    }

    private function getVacinas($data, $petRecord) {
        $vaccines = [];
        foreach ($data as $key => $value) {
            $pattern = '/Ativo/';
            if (preg_match($pattern, $key)) {
                $nome = substr($key, 0, strlen($key) - 5);
                $dia = $data->{$nome . 'Dia'};
                if (!!$value) {
                    $vacine = new VaccineRecord();
                    $vacine->setCreation(new \DateTime($dia))
                            ->setName($nome)
                            ->setPetRecord($petRecord);
                    $this->em->persist($vacine);
                    $vaccines[] = $vacine;
                }
            }
        }
        return $vaccines;
    }

    private function getSignal($data, $petRecord) {
        $signal = new VitalSigns();
        $signal->setCreation(new \DateTime())
                ->setCrt($data->crt)
                ->setHeartRate($data->heartRate)
                ->setPetRecord($petRecord)
                ->setPulse($data->pulse)
                ->setRespiratoryFrequency($data->respiratoryFrequency)
                ->setTemperature($data->temperature)
                ->setWeight($data->weight);
        $this->em->persist($signal);
        return $signal;
    }

    private function getCirurgias($data, $petRecord) {
        $cirurgias = [];
        if (!!$data->surgeries) {
            foreach ($data->surgeries as $v) {
                $v = (object) $v;

                $a = new Surgery();
                $a->setName($v->item)
                        ->setPetRecord($petRecord);
                $this->em->persist($a);
                $cirurgias[] = $a;
            }
        }
        return $cirurgias;
    }

    private function getFamilias($data, $petRecord) {
        $familia = [];
        if (!!$data->familyBackground) {
            foreach ($data->familyBackground as $v) {
                $v = (object) $v;

                $a = new FamilyBackground();
                $a->setName($v->problem)
                        ->setParent($v->parente)
                        ->setPetRecord($petRecord);
                $this->em->persist($a);
                $familia[] = $a;
            }
        }
        return $familia;
    }

    private function getAlergias($data, $petRecord) {
        $alergias = [];
        if (!!$data->allergies) {
            foreach ($data->allergies as $v) {
                $v = (object) $v;

                $a = new Allergy();
                $a->setName($v->item)
                        ->setPetRecord($petRecord);
                $this->em->persist($a);
                $alergias[] = $a;
            }
        }
        return $alergias;
    }

    private function getAntecedentes($data, $petRecord) {
        $antecedentes = [];
        if (!!$data->previousDiseases) {
            foreach ($data->previousDiseases as $v) {
                $v = (object) $v;

                $a = new PreviousDiseases();
                $a->setName($v->problem)
                        ->setPetRecord($petRecord)
                        ->setYear($v->year);
                $this->em->persist($a);
                $antecedentes[] = $a;
            }
        }
        return $antecedentes;
    }

    private function getExames($data, $history) {
        $exames = new ArrayCollection();
        if (!!$data->exames) {
            foreach ($data->exames as $v) {
                $v = (object) $v;

                $e = new Diagnosis();
                $e->setAuthorized(!!$v->autorizado)
                        ->setDia(new \DateTime())
                        ->setHistory($history)
                        ->setLaboratory($v->laboratario)
                        ->setName($v->exame);
                $this->em->persist($e);
                $exames->add($e);
            }
        }
        return $exames;
    }

    private function getMucous($data, $history) {
        $mucous = new ArrayCollection();
        foreach ($data as $key => $value) {
            if (property_exists($data, $key . 'Obs') && $value) {
                $m = new Mucous();
                $m->setHistory($history)
                        ->setName($key)
                        ->setObservations($data->{$key . 'Obs'});
                $this->em->persist($m);
                $mucous->add($m);
            }
        }
        return $mucous;
    }

    private function getMedicamentos($data, $history) {
        $medics = new ArrayCollection();
        if (!!$data->medicamentos) {
            foreach ($data->medicamentos as $m) {
                $m = (object) $m;

                $medic = new TherapeuticPlan();
                $medic->setActivePrinciple($m->medicacao)
                        ->setFrequency($m->frequencia)
                        ->setPosology($m->posologia)
                        ->setPresentation($m->apresentacao)
                        ->setTotalDose($m->total)
                        ->setType($m->type)
                        ->setVia($m->via)
                        ->setHistory($history);
                $this->em->persist($medic);
                $medics->add($medic);
            }
        }
        return $medics;
    }

    private function getVeterinary() {
        return $this->em->createQueryBuilder()
                        ->select('v')
                        ->from(Veterinary::class, 'v')
                        ->join('v.user', 'u')
                        ->where('u.id = :id')
                        ->setParameter('id', $this->user->getId())
                        ->getQuery()
                        ->getSingleResult();
    }

    private function getPet($id) {
        return $this->em->createQueryBuilder()
                        ->select(['p', 'r', 'h'])
                        ->from(Pet::class, 'p')
                        ->join('p.petRecord', 'r')
                        ->leftJoin('r.histories', 'h')
                        ->where('p.id = :id')
                        ->setParameter('id', $id)
                        ->getQuery()
                        ->getSingleResult();
    }

}
