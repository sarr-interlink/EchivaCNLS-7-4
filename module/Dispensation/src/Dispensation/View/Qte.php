<?php

namespace Dispensation\View;

use GtnDataTables\View\AbstractDecorator;

class Qte extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        if ($this->IsAllowed()->isAllowed('Dispensation\Controller\Dispensation', 'add')) {
        return '<b>Quantité</b>';
        }
        return '';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
			return $object['NombUnit']/*." ".$object['GaleDesi']*/;
    }

}
