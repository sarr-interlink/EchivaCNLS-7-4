<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class SocialpsyForm extends Fieldset implements InputFilterProviderInterface {

    public $Conc;
    public $Motif;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {

        $this->add(array(
            'name' => 'subFormSocialPsyhidden',
            'attributes' => array(
                'type' => 'text',
                'id' => 'subFormSocialPsyhidden',
            ),
        ));
        $this->add(array(
            'name' => 'Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Dat_psy',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            
            'options' => array(
                'label' => 'Date',
            ),
        ));
        $this->add(array(
            'name' => 'Moti',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Motipsy',
            ),
            'options' => array(
                'label' => 'Motif',
                'empty_option' => '',
                'value_options' => $this->Motif,
            )
        ));
        $this->add(array(
            'name' => 'Conc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Concpsy',
            ),
            'options' => array(
                'label' => 'Conduite à tenir',
                'empty_option' => '',
                'value_options' => $this->Conc,
            )
        ));
        $this->add(array(
            'name' => 'Nota',
            'attributes' => array(
                'type' => 'Zend\Form\Element\Textarea',
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Notapsy',
            ),
            'options' => array(
                'label' => 'Commentaire',
            ),
        ));
        
        /**/
    }

    public function getInputFilterSpecification() {
        return array(
        'Moti' => array(
        'required' => false,
        ),
        'Conc' => array(
        'required' => false,
        ),
        );
    }

}
