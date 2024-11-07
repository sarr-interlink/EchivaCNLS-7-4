<?php

namespace Dispensation\View;

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
        $dat=substr($object['Dat_'], 0, -9);
       /* $dat=explode("-", $dat);
        $date=$dat[2]."/".$dat[1]."/".$dat[0];*/
        return $dat;
      //  return $date;
    }

}
