<?php

namespace API\V1\Util\Doctrine;

use Doctrine\ORM\Id\AbstractIdGenerator;
use Doctrine\ORM\EntityManager;
use API\V1\Entity\Pet;

/**
 * Gerador de ID para prontuário
 */
class ProntuarioIdGenerator extends AbstractIdGenerator {

    public function generate(EntityManager $em, $entity) {
        $entity_name = $em->getClassMetadata(get_class($entity))->getName();

        $rs = $em->getRepository(Pet::class)->findAll();

        /**
         * @todo Implementar MySQL function para ID rand
         */
        for ($i = 0; $i < 10; $i++) {
            if (($i * 100000000) > count($rs)) {
                $min_value = $i * 100000000;
                $max_value = (($i + 1) * 100000000) - 1;
                break;
            }
        }

        $max_attempts = $min_value - $max_value;
        $attempt = 0;

        while (true) {
            $id = mt_rand($min_value, $max_value);
            $item = $em->find($entity_name, $id);

            if (!$item) {
                return $id;
            }

            $attempt++;
            if ($attempt > $max_attempts) {
                throw new \Exception('PetIdGenerator worked hardly, but failed to generate unique ID :(');
            }
        }
    }

}
