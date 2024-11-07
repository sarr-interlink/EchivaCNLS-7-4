<?php

namespace Dispensation\View;

use GtnDataTables\View\AbstractDecorator;

class Lot extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>N° Lot</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        //return '';
        return $object['Lot_'];
    }

}
