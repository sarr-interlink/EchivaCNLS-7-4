<?php

namespace Parametres\Form;

use Zend\Form\Form;

class DciForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('DciForm');

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

        $this->add(array(
            'type' => 'Select',
            'name' => 'Typ_',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Type',
                'value_options' => array(
                    '1' => 'Medicaments',
                    '3' => 'Arv',
                    '2' => 'Consommables',
                    '4' => 'Laboratoire',
                ),
            )
        ));
    }

}
