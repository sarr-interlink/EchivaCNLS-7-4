<?php

namespace Analyse\Form;

use Zend\Form\Form;

class UseForm extends Form {

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
            'name' => 'Type',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'value' => 'jour',
            ),
            'options' => array(
                'label' => 'Par',
                'value_options' => array(
                    'jour' => array('value' =>'jour','label' =>'Jour'),
                    'semaine' => array('value' =>'semaine','label' =>'Semaine'),
                    'moi' => array('value' =>'moi','label' =>'Mois'),
                ),
                
            )
        ));
        $this->add(array(
            'name' => 'Jusque',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Jusqu\'au',
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
