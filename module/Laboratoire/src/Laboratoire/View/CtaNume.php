<?php

namespace Laboratoire\View;

use GtnDataTables\View\AbstractDecorator;

class CtaNume extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>N° CTA</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        return $object['Cta_Nume'];
    }

}
