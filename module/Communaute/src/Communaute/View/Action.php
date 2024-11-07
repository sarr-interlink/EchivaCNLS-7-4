<?php

namespace Communaute\View;

use GtnDataTables\View\AbstractDecorator;

class Action extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        if (($this->IsAllowed()->isAllowed('Communaute\Controller\Communaute', 'edit'))
                || ($this->IsAllowed()->isAllowed('Communaute\Controller\Communaute', 'more'))
                || ($this->IsAllowed()->isAllowed('Communaute\Controller\Communaute', 'delete'))) {
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
        if ($this->IsAllowed()->isAllowed('Communaute\Controller\Communaute', 'more')) {
            $res = '<a  title="Detail" class="btn btn-sm btn-info btn-outline btn-rounded" '
                . 'href="' . $this->url('communaute', array('action' => 'more', 'Nume' => $object['Nume'])). '">'
                . '<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a> ';
        }

        if ($this->IsAllowed()->isAllowed('Communaute\Controller\Communaute', 'edit')) {
            $res .= '<a title="Modifier" class="btn btn-sm btn-primary btn-outline btn-rounded" '
                . 'href="' . $this->url('communaute', array('action' => 'edit', 'Nume' => $object['Nume'])) . '">'
                . '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>'
                . '</a> ';
        }
        
        if ($this->IsAllowed()->isAllowed('Communaute\Controller\Communaute', 'delete')) {
            $res .= '<a data-toggle="modal" data-target="#infos" title="Supprimer" class="btn btn-sm btn-danger btn-outline btn-rounded" href="' . $this->url('communaute', array('action' => 'delete', 'Nume' => $object['Nume'])) . '">'
                . ' <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'
                . ' </a> ';
        }
        return $res;
    }
}
