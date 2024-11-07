<?php

namespace Accueil\View;

use GtnDataTables\View\AbstractDecorator;

class RdvHoro extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Rendez-Vous</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        return $object['Rdv_Horo'];
    }

}
