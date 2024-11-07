<?php

namespace Laboratoire\View;

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
        if( $object['Sexe'] == "M." || $object['Sexe'] == "1" || $object['Sexe'] == "Mr" ){
           return 'Masculin' ; 
        }
        
        if($object['Sexe'] == "Mme" || $object['Sexe'] == "2"){
            return 'Féminin' ;
        }
        
        return $object['Sexe'];
    }

}
