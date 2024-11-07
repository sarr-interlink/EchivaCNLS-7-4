<?php

namespace Dossiers\View;

use GtnDataTables\View\AbstractDecorator;

class OuvrDat extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Date d\'ouverture</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        return $object['OuvrDat_'];
    }

}
