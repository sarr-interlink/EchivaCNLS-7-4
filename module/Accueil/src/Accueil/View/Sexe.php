<?php

namespace Accueil\View;

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
        if($object['Sexe'] == "M."){
            return "Masculin";
        }
        if($object['Sexe'] == "Mme"){
            return "Féminin";
        }
        
        return $object['Sexe'];
    }

}
