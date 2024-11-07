<?php

namespace Depistage\View;

use GtnDataTables\View\AbstractDecorator;

class Ref extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>N° dépistage</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        return $object['Ref_'];
    }

}
