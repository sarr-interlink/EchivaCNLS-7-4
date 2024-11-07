<?php

namespace Communaute\View;

use GtnDataTables\View\AbstractDecorator;

class Acti extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Activité</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        if(isset($object['Acti'])){
            return $object['Acti'];
        } else {
            return "";
        }
    }

}
