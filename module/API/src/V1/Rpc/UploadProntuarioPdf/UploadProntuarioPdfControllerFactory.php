<?php
namespace API\V1\Rpc\UploadProntuarioPdf;

class UploadProntuarioPdfControllerFactory
{
    public function __invoke($controllers)
    {
        return new UploadProntuarioPdfController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
