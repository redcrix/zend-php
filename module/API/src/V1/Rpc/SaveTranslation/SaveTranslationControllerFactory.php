<?php
namespace API\V1\Rpc\SaveTranslation;

class SaveTranslationControllerFactory
{
    public function __invoke($controllers)
    {
        return new SaveTranslationController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
