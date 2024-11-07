<?php

namespace Dispensation\View;

use GtnDataTables\View\AbstractDecorator;

class Ref extends AbstractDecorator {

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
        
       // print_r($object);exit;
        return $object['Ref_'];
    }

}
