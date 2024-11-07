<?php

namespace Accueil\View;

use GtnDataTables\View\AbstractDecorator;

class Pnom extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Prénom</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        return $object['Pnom'];
    }

}
