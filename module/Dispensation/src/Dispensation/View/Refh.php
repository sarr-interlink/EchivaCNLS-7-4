<?php

namespace Dispensation\View;

use GtnDataTables\View\AbstractDecorator;

class Refh extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>N° Dossier</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
         return $object['Ref_'];
       // return $object['Doss'];
    }

}
