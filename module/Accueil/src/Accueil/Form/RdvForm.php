<?php

namespace Accueil\Form;

use Zend\Form\Form;

class RdvForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('accueilRDV');

        $this->setAttribute('method', 'post');
        $this->setInputFilter($filter = new \Zend\InputFilter\InputFilter());

        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'Rdv_Horo',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Date du RDV',
            ),
        ));
    }

}
