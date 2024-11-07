<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class PTMEAccouchementForm extends Fieldset implements InputFilterProviderInterface {

    public $AccoLieu;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('accueil');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
      $this->add(array(
            'name' => 'AccoNvp_Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'id' => 'AccoNvp_Nomb',
            ),
            'options' => array(
                'label' => 'Nombre de prises de Névirapine',
            ),
        ));
        $this->add(array(
            'name' => 'AccoPris2h__',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'AccoPris2h__',
            ),
            'options' => array(
                'label' => '1ère prise moins de 2H avant accouchement',
            ),
        ));
        $this->add(array(
            'name' => 'AccoAzt_Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'id' => 'AccoAzt_Nomb',
            ),
            'options' => array(
                'label' => 'Nombre de prises d\'AZT pendant le travail',
            ),
        ));
        $this->add(array(
            'name' => 'AccoDat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'AccoDat_',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date d\'accouchement',
            ),
        ));
        $this->add(array(
            'name' => 'AccoLieu',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'AccoLieu',
            ),
            'options' => array(
                'label' => 'Lieu d\'accouchement',
                'empty_option' => '',
                'value_options' => $this->AccoLieu,
            )
        ));
        $this->add(array(
            'name' => 'AccoVoie',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'AccoVoie',
            ),
            'options' => array(
                'label' => ' ',
                'value_options' => array(
                    '1' => array(
                        'label' => 'Voie basse',
                        'value' => 1,
                        'attributes' => array(
                            'id' => 'AccoVoiebasse',
                        ),
                    ),
                    '2' => array(
                        'label' => 'Césarienne',
                        'value' => 2,
                        'attributes' => array(
                            'id' => 'AccoVoiecesa',
                        ),
                    ),
                    '3' => array(
                        'label' => 'IVG',
                        'value' => 3,
                        'attributes' => array(
                            'id' => 'AccoVoieivg',
                        ),
                    ),
                    '4' => array(
                        'label' => 'FCS',
                        'value' => 4,
                        'attributes' => array(
                            'id' => 'AccoVoiefcs',
                        ),
                    ),
                ),
            )
        ));
        
        
        $this->add(array(
            'name' => 'AccoRupt',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'AccoRupt',
            ),
            'options' => array(
                'label' => 'Rupture artificielle des membranes',
            ),
        ));
        $this->add(array(
            'name' => 'AccoForc',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'AccoForc',
            ),
            'options' => array(
                'label' => 'Forceps',
            ),
        ));
        $this->add(array(
            'name' => 'AccoEpis',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'AccoEpis',
            ),
            'options' => array(
                'label' => 'Episiotomie',
            ),
        ));
        $this->add(array(
            'name' => 'AccoNaisNomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'id' => 'AccoNaisNomb',
            ),
            'options' => array(
                'label' => "Nombre d'enfants nés",
            ),
        ));
        $this->add(array(
            'name' => 'Var0',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Var0acc',
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
                'id' => 'Var1acc',
            ),
            'options' => array(
                'label' => 'Variable 2',
            ),
        ));
        /**/
    }

    public function getInputFilterSpecification() {
      return array(
        'AccoPris2h__' => array(
        'required' => false,
        ),
        'AccoLieu' => array(
        'required' => false,
        ),
        'AccoVoie' => array(
        'required' => false,
        ),
        'AccoRupt' => array(
        'required' => false,
        ),
        'AccoForc' => array(
        'required' => false,
        ),
        'AccoEpis' => array(
        'required' => false,
        ),
        );     
    }

}
