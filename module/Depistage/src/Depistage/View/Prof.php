<?php

namespace Depistage\View;

use GtnDataTables\View\AbstractDecorator;

class Prof extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Profession</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
         return $object['Prof'];
    }

}
