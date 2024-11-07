<?php

namespace Dispensation\View;

use GtnDataTables\View\AbstractDecorator;

class Actionhist extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        if ($this->IsAllowed()->isAllowed('Dispensation\Controller\Dispensation', 'add')) {
        return '<b>Action</b>';
        }
        return '';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        //print_r($object);
        $res = "";
         $dat=substr($object['Expi'], 0, -9);
       $dat=explode("-", $dat);
       $date=$dat[2]."/".$dat[1]."/".$dat[0];
        if ($this->IsAllowed()->isAllowed('Dispensation\Controller\Dispensation', 'add')) {
        
            $res .='<a title="Supprimer" class="btn btn-sm btn-danger btn-outline btn-rounded" data-toggle="modal" id="'.$object['Prod']."#".$object['Fabr']."#".$object['Lot_']."#".$date."#".$object['NombUnit']."#".$object['Nume']."#".$object['MediCons']."#".$object['MediConsPrsc'].'" href="#deletemodalform">'
                . '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'
                . '</a>';        
            //$res .='<a title="Supprimer" class="btn btn-sm btn-danger btn-outline btn-rounded" id="'.$object['Prod']."#".$object['Fabr']."#".$object['Lot_']."#".$date."#".$object['NombUnit'].'"  href="' . $this->url('dispensation', array('action' => 'delete', 'Nume' => $object['Nume'])) . '">'
              //  . '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'
               // . '</a>';        
        }
       // print_r($res);
        return $res;
    }

}
