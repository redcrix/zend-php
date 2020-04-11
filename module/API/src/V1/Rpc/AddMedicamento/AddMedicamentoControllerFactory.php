<?php
namespace API\V1\Rpc\AddMedicamento;

class AddMedicamentoControllerFactory
{
    public function __invoke($controllers)
    {
        return new AddMedicamentoController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
