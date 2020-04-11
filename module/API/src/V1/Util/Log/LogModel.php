<?php

namespace API\V1\Util\Log;

/**
 * Modelo de Log para registro de atividades
 * 
 * @author Marcus Borges <yahuchanam@gmail.com>
 * @copyright (c) 2019, iNetPet
 * @version 1.0.0
 */
class LogModel {

    public $usuario;
    public $acao;
    public $clinica;
    public $anterior;
    public $enviado;
    public $resposta;
    public $dia;
    public $erro;

    public function __construct($dados = []) {
        foreach ($dados as $key => $value) {
            if (property_exists(LogModel::class, $key)) {
                $this->{$key} = $value;
            }
        }
    }

}
