<?php

namespace Dossiers\View;

use GtnDataTables\View\AbstractDecorator;

class RensAge extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
         return '<b>Âge</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        return $object['RensAge_'];
    }

}
