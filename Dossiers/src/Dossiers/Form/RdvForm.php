<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class RdvForm extends Form implements InputFilterProviderInterface {
    public $ObseMoti;
    public $Obse;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {

        /**/
       
       $this->add(array(
            'name' => 'RdvDat_',
            'attributes' => array(
                'type' => 'datetime-local',
                'class' => 'form-control',
                'id' => 'RdvDat_',
                //'min' => date('Y-m-d\TH:i'),
                'value' => date('Y-m-d\TH:i'),
            ),
            'options' => array(
                'label' => 'Date de rendez-vous',
            ),
        ));
       $this->add(array(
            'name' => 'Motifrdv',
             'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' =>'Motifrdv'
            ),
            'options' => array(
                'label' => 'Motif de RDV',
                'empty_option' => '',
                'value_options' => array(
                    'Consultation sociale' => 'Consultation sociale',
                    'Consultation psy' => 'Consultation psychologique',
                    'Consultation méd.' => 'Consultation médical',
                    'ETP' => 'Education thérapeutique',
                )
            ),
        ));
        /**/
    }

    public function getInputFilterSpecification() {
        return array(
        'Motifrdv' => array(
        'required' => false,
        ),
        );
    }
}
