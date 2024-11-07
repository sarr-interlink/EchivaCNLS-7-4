<?php

namespace Pharmacie\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

class ProdForm extends Form implements InputFilterProviderInterface {

    public $Dci_;
    public $Dosa;
    public $Gale;
    public $Type;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('pharmacie');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'text',
            ),
        ));
         $this->add(array(
            'name' => 'Afftype',
            'type' => 'Select',
            'attributes' => array(
                'disabled' => 'disabled',
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Afftype',
                'value' => $this->Type,
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
            'name' => 'Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Dci_',
		//		'required' => 'required',
            ),
            'options' => array(
                'label' => 'Désignation',
                'empty_option' => '',
                'value_options' => $this->Dci_,
            )
        ));
         $this->add(array(
            'name' => 'Dosa',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Dosa',
		//		'required' => 'required',
            ),
            'options' => array(
                'label' => 'Dosage',
                'empty_option' => '',
                'value_options' => $this->Dosa,
            )
        ));
         $this->add(array(
            'name' => 'Gale',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Gale',
		//		'required' => 'required',
            ),
            'options' => array(
                'label' => 'Forme',
                'empty_option' => '',
                'value_options' => $this->Gale,
            )
        ));
        $this->add(array(
            'name' => 'Cont',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Cont',
            ),
            'options' => array(
                'label' => 'Contenance (facultative. 1 unite=)',
            ),
        ));
         $this->add(array(
            'name' => 'Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'value_options' => array(
                    'ml' =>'ml',
                    'mg' =>'mg',
                    'g' =>'g',
                    'goutte(s)' =>'goutte(s)',
                    'cuillère(s) mesure' =>'cuillère(s) mesure',
                    'application()' =>'application()',
                    'L' =>'L',
                ),
            )
        ));
          
         $this->add(array(
            'name' => 'validprod',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Valider',
                'class' => 'btn btn-success',
                'id' => 'validprod',
            ),
            'options' => array(
                'label' => 'Valider',
            ),
        ));
         
         $this->add(array(
            'name' => 'reset',
            'attributes' => array(
                'type' => 'reset',
                'value' => 'Annuler',
                'class' => 'btn btn-sm btn-default',
                'id'=> 'reset'
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
