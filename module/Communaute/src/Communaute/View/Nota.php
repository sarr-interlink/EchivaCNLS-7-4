<?php

namespace Communaute\View;

use GtnDataTables\View\AbstractDecorator;

class Nota extends AbstractDecorator {

    /**
     * @return string
     */
    public function decorateTitle() {
        return '<b>Commentaire</b>';
    }

    /**
     * @param Server $object
     * @param $context
     * @return string
     */
    public function decorateValue($object, $context = null) {
        return $this->escapeHtml($object['Nota']);
    }

}
