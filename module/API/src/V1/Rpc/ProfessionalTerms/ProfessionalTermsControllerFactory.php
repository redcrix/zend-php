<?php
namespace API\V1\Rpc\ProfessionalTerms;

class ProfessionalTermsControllerFactory
{
    public function __invoke($controllers)
    {
        return new ProfessionalTermsController($controllers->get('Doctrine\ORM\EntityManager'));
    }
}
