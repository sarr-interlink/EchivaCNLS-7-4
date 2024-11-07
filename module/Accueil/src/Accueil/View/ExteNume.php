<?php

namespace Accueil\View;

use GtnDataTables\View\AbstractDecorator;

class ExteNume extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>ExteNume</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        return $object['ExteNume'];
    }

}
