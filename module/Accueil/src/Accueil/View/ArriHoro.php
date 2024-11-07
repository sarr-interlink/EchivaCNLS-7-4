<?php

namespace Accueil\View;

use GtnDataTables\View\AbstractDecorator;

class ArriHoro extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Arrivée</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        if (!isset($object['ArriHoro'])) {
            $object['ArriHoro'] = 0;
        }
        if ($object['ArriHoro'] == 0) {
            if ($this->IsAllowed()->isAllowed('Accueil\Controller\Accueil', 'rdv')) {
                $return = '<a title="Arrivée" class="btn btn-sm btn-primary btn-outline btn-rounded" href="' . $this->url('accueil', array('action' => 'rdv', 'Nume' => $object['Nume'])) . '">'
                        . '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>'
                        . '</a>';
            } else {
                $return = "";
            }
        } else {
            $return = $object['ArriHoro'];
        }
        return $return;
    }

}
