<?php

namespace Analyse\Form;

use Zend\Form\Form;

class RappForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('UseForm');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'datedebmoi',
            'attributes' => array(
                'type' => 'month',
                'class' => 'form-control',
                'value' => date('Y-m'),
            ),
            'options' => array(
                'label' => 'Moi',
            ),
        ));
        $this->add(array(
            'name' => 'daterappmoi',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Moi',
            ),
        ));
        $this->add(array(
            'name' => 'datedeb',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'value' => date('Y-m-01'),
            ),
            'options' => array(
                'label' => 'date',
            ),
        ));
        $this->add(array(
            'name' => 'datefin',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'value' => date('Y-m-t'),
            ),
            'options' => array(
                'label' => 'date',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Valider',
                'class' => 'btn btn-success',
            ),
            'options' => array(
                'label' => 'Valider',
            ),
        ));

    }

}
