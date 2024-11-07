<?php

namespace Laboratoire\View;

use GtnDataTables\View\AbstractDecorator;

class ArriHoro extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Arrivée</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        $return = $object['ArriHoro'];
        return $return;
    }

}
