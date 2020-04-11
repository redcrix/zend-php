<?php

namespace API\V1\Rpc\AllRaces;

use Zend\Mvc\Controller\AbstractActionController;

class AllRacesController extends AbstractActionController {

    public function allRacesAction() {
        $json = json_decode(file_get_contents(__DIR__ . '/racesDogs.json'));
        $arr = [];
        foreach ($json as $value) {
            foreach ($value as $v) {
                foreach ($v as $r) {
                    $r = (object) $r;
                    if($r->race != '') {
                        $arr[] = $r->race;
                    }
                }
            }
        }

        echo json_encode($arr);
        die();
    }

}
