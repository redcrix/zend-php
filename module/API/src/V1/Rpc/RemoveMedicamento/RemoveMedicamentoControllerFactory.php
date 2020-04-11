<?php
namespace API\V1\Rpc\RemoveMedicamento;

class RemoveMedicamentoControllerFactory
{
    public function __invoke($controllers)
    {
        return new RemoveMedicamentoController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
