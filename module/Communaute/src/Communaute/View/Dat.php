<?php

namespace Communaute\View;

use GtnDataTables\View\AbstractDecorator;

class Dat extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Date</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        if(isset($object['Dat_'])){
            return $object['Dat_'];
        } else {
            return "";
        }
    }

}
