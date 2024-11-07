<?php

namespace Pharmacie\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

class SortieForm extends Form implements InputFilterProviderInterface {
    public $Dest;
 public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('sortiestock');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
        $this->add(array(
            'name' => 'Numehidden',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Nume',
            ),
        ));
        
        $this->add(array(
            'name' => 'Afftype',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Afftype',
                'value' => '1',
            ),
            'options' => array(
                'label' => 'Stock de pharmacie',
                'value_options' => array(
                    '1' => 'Medicaments courants',
                    '3' => 'ARV',
                    '2' => 'Consommables',
                    '4' => 'Laboratoire',
                ),
            )
        ));
        
        
        $this->add(array(
            'name' => 'NombBoit',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
                'id' => 'NombBoit',
				'min' => '0',
            ),
            'options' => array(
                'label' => 'Nombre d\'unité',
            ),
        ));
        $this->add(array(
            'name' => 'Dest',
            'type' => 'Select',
             'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true',
				'id' => 'Dest'
            ),
            'options' => array(
                'label' => 'Vers',
                'empty_option' => '',
                'value_options' => $this->Dest,
            )
        ));
        $this->add(array(
            'name' => 'Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'value' => date('Y-m-d')
            ),
            'options' => array(
                'label' => 'Date',
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Valider',
                'class' => 'btn btn-success',
            ),
            'options' => array(
                'label' => 'Valider',
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

     public function getInputFilterSpecification() {
        return array(
            'Afftype' => array(
                'required' => false,
            )
        );
    }
}
