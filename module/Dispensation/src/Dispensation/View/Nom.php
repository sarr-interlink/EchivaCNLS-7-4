<?php

namespace Dispensation\View;

use GtnDataTables\View\AbstractDecorator;

class Nom extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Nom</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        return $object['Nom_'];
    }

}
