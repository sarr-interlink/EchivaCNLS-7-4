<?php

namespace Communaute\Form;

use Zend\Form\Form;

class CommunauteForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('CommunauteForm');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'required' => 'required',
                'min' => '2004-01-01', 
                'max' => date('Y-m-d'),
                'value' =>date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Acti',
             'required' => 'required',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Activité',
                'empty_option' => ' ',
            )
        ));
        
        $this->add(array(
            'name' => 'Nota',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Commentaire',
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
                'label' => 'val',
            ),
        ));

        $this->add(array(
            'name' => 'rest',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Annuler',
                'class' => 'btn btn-sm btn-default',
                'data-dismiss' => "modal",
                'aria-label' => "Close"
            )
        ));
    }

}
