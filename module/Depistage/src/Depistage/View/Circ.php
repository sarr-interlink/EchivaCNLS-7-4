<?php

namespace Depistage\View;

use GtnDataTables\View\AbstractDecorator;

class Circ extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Circonstance</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        return $object['Circ'];
    }

}
