<?php

namespace Dispensation\View;

use GtnDataTables\View\AbstractDecorator;

class Design extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Designation</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
       // print_r($object);
        //exit;
        return $object['Designation'];
    }

}
