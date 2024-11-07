<?php

namespace Depistage\View;

use GtnDataTables\View\AbstractDecorator;

class Sexe extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Sexe</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        if ($object['Sexe'] == 1) {
            return "Masculin";
        } else if ($object['Sexe'] == 2) {
            return "Féminin";
        } else {
            return "";
        }
    }

}
