<?php

namespace Laboratoire\View;

use GtnDataTables\View\AbstractDecorator;

class Age extends AbstractDecorator {

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
        return $object['Age_'];
    }

}
