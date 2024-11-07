<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class PTMEForm extends Fieldset implements InputFilterProviderInterface {

    public $EvolGros;
    public $EchoResu;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
       
        $this->add(array(
            'name' => 'subFormPtmehidden',
            'attributes' => array(
                'type' => 'text',
                'id' => 'subFormPtmehidden',
            ),
        ));
       $this->add(array(
            'name' => 'Ajoutptmegros',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Ajouter',
                'class' => 'btn btn-success',
                'id' => 'Ajoutptmegros',
            ),
            'options' => array(
                'label' => 'Grossesses',
            ),
        ));
        $this->add(array(
            'name' => 'Listptmegros',
            'type' => 'Select',
            'attributes' => array(
                'multiple' => 'multiple',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => ' ',
                'empty_option' => '',
                'value_options' => array('date1' => 'Affiche date ptmegros',),
            )
        ));
    }

    public function getInputFilterSpecification() {
        return array(
        'Listptmegros' => array(
        'required' => false,
        ),
            );
    }

}
