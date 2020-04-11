<?php

namespace API\V1\Util\Log;

use Doctrine\ORM\EntityManager;

/**
 * Serviço RPC de ativação de e-mail
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, Useful
 * @version 1.0.0
 */
class Logger {

    /**
     * Gera log de atividade
     * 
     * @param Usuario $cliente
     * @param \DateTime $dia
     * @param stdClass $data
     * @param array $resposta
     * @todo finish this log method
     */
    static public function createLog(EntityManager $em, LogModel $log) {
        
    }

}
