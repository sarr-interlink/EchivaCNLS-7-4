<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class PTMEGrossesseForm extends Fieldset implements InputFilterProviderInterface {

    public $EvolGros;
    public $EchoResu;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
       $this->add(array(
            'name' => 'SaisDat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'SaisDat_',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date de saisi',
            ),
        ));
        $this->add(array(
            'name' => 'EnfaViva',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'id' => 'EnfaViva',
				
            ),
            'options' => array(
                'label' => 'Nombre d\'enfants vivants',
            ),
        ));
        $this->add(array(
            'name' => 'AnteGest',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'AnteGest',
            ),
            'options' => array(
                'label' => 'Gestité',
            ),
        ));
        $this->add(array(
            'name' => 'AntePari',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'AntePari',
            ),
            'options' => array(
                'label' => 'Parité',
            ),
        ));

        $this->add(array(
            'name' => 'AnteFcs_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'AnteFcs_',
            ),
            'options' => array(
                'label' => 'FCS',
            ),
        ));
        $this->add(array(
            'name' => 'AnteIvg_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'AnteIvg_',
            ),
            'options' => array(
                'label' => 'IVG',
            ),
        ));
        $this->add(array(
            'name' => 'AnteCesa',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'AnteCesa',
            ),
            'options' => array(
                'label' => 'Césariennes',
            ),
        ));

        $this->add(array(
            'name' => 'Ddr_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Ddr_',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date des dernières règles',
            ),
        ));
        $this->add(array(
            'name' => 'Term',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Term',
            ),
            'options' => array(
                'label' => 'Termes à l\'ouverture',
            ),
        ));
       $this->add(array(
            'name' => 'TermDdr_Echo',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'TermDdr_Echo',
            ),
            'options' => array(
                'label' => '',
                'value_options' => array(
                    '1' => array(
                        'label' => 'Par DDR',
                        'value' => 1,
                        'attributes' => array(
                            'id' => 'TermDdr',
                        ),
                    ),
                    '2' => array(
                        'label' => 'Par Echo.',
                        'value' => 2,
                        'attributes' => array(
                            'id' => 'TermEcho',
                        ),
                    ),
                ),
            )
        ));
        $this->add(array(
            'name' => 'EchoResu',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'EchoResu',
            ),
            'options' => array(
                'label' => 'Résultat échographique',
                'empty_option' => '',
                'value_options' => $this->EchoResu,
            )
        ));
        $this->add(array(
            'name' => 'AccoPrev',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'AccoPrev',
                'min' => '1910-01-01',
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date prévue d\'accouchement',
            ),
        ));
        $this->add(array(
            'name' => 'EvolGros',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'EvolGros',
            ),
            'options' => array(
                'label' => 'Evolution de la grossesse',
                'empty_option' => '',
                'value_options' => $this->EvolGros,
            )
        ));
        $this->add(array(
            'name' => 'Arv_Trai',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Arv_Trai',
            ),
            'options' => array(
                'label' => 'Protocole PTME choisi',
                'empty_option' => '',
                'value_options' => array(
                    'Trithérapie' => 'Trithérapie',
                    'AZT' => 'AZT',
                    'NVP' => 'NVP',
                    'AZT+NVP' => 'AZT+NVP',
                    'Poursuite traitement en cours' => 'Poursuite traitement en cours',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Arv_Debu',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Arv_Debu',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date de début',
            ),
        ));
    }

    public function getInputFilterSpecification() {
     return array(
        'TermDdr_Echo' => array(
        'required' => false,
        ),
        'EchoResu' => array(
        'required' => false,
        ),
        'EvolGros' => array(
        'required' => false,
        ),
        'Arv_Trai' => array(
        'required' => false,
        ),
        'Concsocicons' => array(
        'required' => false,
        ),
        );   
    }

}
