<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class TransForm extends Form  {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
   

        /**/
   $this->add(array(
            'name' => 'Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Dat_trans',
                //'min' => date('Y-m-d\TH:i'),
                'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date',
            ),
        ));
       $this->add(array(
            'name' => 'Structure_destination',
             'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' =>'Structure_destination'
            ),
            'options' => array(
                'label' => 'Structure de destination',
                'empty_option' => '',
                'value_options' => array(
                )
            ),
        ));
      $this->add(array(
            'name' => 'Motiftrans',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Motiftrans',
            ),
            'options' => array(
                'label' => 'Motif',
            ),
        ));
        /**/
    }

    
}
