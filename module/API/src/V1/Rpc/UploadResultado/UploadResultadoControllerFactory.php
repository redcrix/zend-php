<?php
namespace API\V1\Rpc\UploadResultado;

class UploadResultadoControllerFactory
{
    public function __invoke($controllers)
    {
        return new UploadResultadoController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
