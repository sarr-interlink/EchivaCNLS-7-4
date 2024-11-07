<?php

namespace Parametres\Form;

use Zend\Form\Form;

class DosaForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('DosaForm');

        $this->setAttribute('method', 'post');
        $this->setInputFilter($filter = new \Zend\InputFilter\InputFilter());

        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'Desi',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Désignation',
            ),
        ));

    }

}
