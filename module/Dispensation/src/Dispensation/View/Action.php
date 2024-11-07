<?php

namespace Dispensation\View;

use GtnDataTables\View\AbstractDecorator;

class Action extends AbstractDecorator {

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
        $res = "";
        if ($this->IsAllowed()->isAllowed('Dispensation\Controller\Dispensation', 'add')) {
        $res .='<a title="Délivrer" class="btn btn-sm btn-primary btn-outline btn-rounded" href="' . $this->url('dispensation', array('action' => 'add', 'Nume' => $object['Nume'])) . '">'
                . '<span class="glyphicon flaticon-pills" aria-hidden="true"></span>'
                . '</a>';        
        }
        return $res;
    }

}
