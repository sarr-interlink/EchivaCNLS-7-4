<?php

namespace Accueil\View;

use GtnDataTables\View\AbstractDecorator;

class Action extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        if (($this->IsAllowed()->isAllowed('Accueil\Controller\Accueil', 'edit'))
                || ($this->IsAllowed()->isAllowed('Accueil\Controller\Accueil', 'delete'))) {
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
        if ($this->IsAllowed()->isAllowed('Accueil\Controller\Accueil', 'edit')) {
            $res = '<a title="Modifier" class="btn btn-sm btn-primary btn-outline btn-rounded" href="' . $this->url('accueil', array('action' => 'edit', 'Nume' => $object['Nume'])) . '">'
                    . '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>'
                    . '</a> ';
        }

        if ($this->IsAllowed()->isAllowed('Accueil\Controller\Accueil', 'delete')) {
            $res .= '<a data-toggle="modal" data-target="#delete" title="Supprimer" class="btn btn-sm btn-danger btn-outline btn-rounded" href="' . $this->url('accueil', array('action' => 'delete', 'Nume' => $object['Nume'])) . '">'
                    . '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>'
                    . '</a>';
        }
        return $res;
    }

}