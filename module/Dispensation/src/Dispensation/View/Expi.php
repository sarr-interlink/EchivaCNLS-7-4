<?php

namespace Dispensation\View;

use GtnDataTables\View\AbstractDecorator;

class Expi extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Date de péremption</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        $dat=substr($object['Expi'], 0, -9);
       $dat=explode("-", $dat);
       $date=$dat[1]."/".$dat[0];
        return $date;
    }

}
