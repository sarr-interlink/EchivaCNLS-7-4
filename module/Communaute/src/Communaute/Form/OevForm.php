<?php

namespace Communaute\Form;

use Zend\Form\Form;

class OevForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('Oev_Form');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'Ref_oev',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Ref_oev',
            ),
            'options' => array(
                'label' => 'N° OEV',
            ),
        ));
    }

}
