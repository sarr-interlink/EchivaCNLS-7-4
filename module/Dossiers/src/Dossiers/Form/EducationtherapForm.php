<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

class EducationtherapForm extends Fieldset implements InputFilterProviderInterface {

    public $Eval;
    public $Typ_;
    public $Contobs;
    public $Supp;
    public $Apci;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
        
        $this->add(array(
            'name' => 'subFormEducationtheraphidden',
            'attributes' => array(
                'type' => 'text',
                'id' => 'subFormEducationtheraphidden',
            ),
        ));
        $this->add(array(
            'name' => 'Listobsecons',
            'type' => 'Select',
            'attributes' => array(
                'multiple' => 'multiple',
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                
            ),
            'options' => array(
                'value_options' => array('date1' => 'Affiche detail obsecons',),
            )
        ));
        $this->add(array(
            'name' => 'Ajoutobsecons',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Ajouter',
                'class' => 'btn btn-success',
            ),
        ));
        $this->add(array(
            'name' => 'Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Dat_obsecons',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date',
            ),
        ));
        $this->add(array(
            'name' => 'Eval',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',                
                'id' => 'Eval',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Evaluation de l\'observance par le conseiller',
                'value_options' => $this->Eval,
            )
        ));
        $this->add(array(
            'name' => 'Typ_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Typ_obsecons',
            ),
            'options' => array(
                'label' => 'Type de RDV',
                'empty_option' => '',
                'value_options' => $this->Typ_,
            )
        ));
        $this->add(array(
            'name' => 'Cont',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                
                'id' => 'Contobsecons',
            ),
            'options' => array(
                'label' => 'Contexte',
                'empty_option' => '',
                'value_options' => $this->Contobs,
            )
        ));
        $this->add(array(
            'name' => 'Supp',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Supp',
            ),
            'options' => array(
                'label' => 'Support utilisé',
                'empty_option' => '',
                'value_options' => $this->Supp,
            )
        ));
        $this->add(array(
            'name' => 'Apci',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Apci',
            ),
            'options' => array(
                'label' => 'Appréciation',
                'empty_option' => '',
                'value_options' => $this->Apci,
            )
        ));
        $this->add(array(
            'name' => 'Nota',
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'form-control',
                'id' => 'Notaobsecons',
            ),
            'options' => array(
                'label' => 'Observations',
            ),
        ));
        $this->add(array(
            'name' => 'Var0',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Var0obsecons',
            ),
            'options' => array(
                'label' => 'Variable 1',
            ),
        ));
        $this->add(array(
            'name' => 'Var1',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Var1obsecons',
            ),
            'options' => array(
                'label' => 'Variable 2',
            ),
        ));
        $this->add(array(
            'name' => 'RDV',
            'attributes' => array(
                'type' => 'button',
                'value' => 'RDV',
                'class' => 'btn btn-success',
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'Listobsecons' => array(
                'required' => false,
            ),
            'Eval' => array(
                'required' => false,
            ),
            'Typ_' => array(
                'required' => false,
            ),
            'Cont' => array(
                'required' => false,
            ),
            'Supp' => array(
                'required' => false,
            ),
            'Apci' => array(
                'required' => false,
            ),
        );
    }

}
