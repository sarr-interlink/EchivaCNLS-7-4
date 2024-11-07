<?php

namespace Communaute\Form;

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
                'value' => '1',
            ),
            'options' => array(
                'label' => 'Par',
                'value_options' => array(
                    '1' => array('value' =>'1','label' =>'Jour'),
                    '2' => array('value' =>'2','label' =>'Semaine'),
                    '3' => array('value' =>'3','label' =>'Mois'),
                ),
                
            )
        ));
        
        $this->add(array(
            'name' => 'Jusque',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
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
