<?php

namespace Parametres\Form;

use Zend\Form\Form;

class DroitsForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('Droits');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
    }

}
