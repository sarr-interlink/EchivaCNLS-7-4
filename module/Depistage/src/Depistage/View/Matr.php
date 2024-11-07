<?php

namespace Depistage\View;

use GtnDataTables\View\AbstractDecorator;

class Matr extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Situation matrimoniale</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        return $object['Matr'];
    }

}
