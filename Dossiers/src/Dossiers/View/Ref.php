<?php

namespace Dossiers\View;

use GtnDataTables\View\AbstractDecorator;

class Ref extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>N° Dossier</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        
        if($object['RensDeceDat_'] && $object['RensDeceDat_']!=='0000-00-00 00:00:00'){
          $str = '<span class="label label-danger">'. $object['Ref_'] . '</span><br />';
            return $str; 
        }
        
         
        return $object['Ref_'];
    }

}
