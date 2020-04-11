<?php
namespace API\V1\Rpc\AllRaces;

class AllRacesControllerFactory
{
    public function __invoke($controllers)
    {
        return new AllRacesController();
    }
}
