<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class SocialserologieForm extends Fieldset implements InputFilterProviderInterface {

    public $MediDepiCirc;
    public $SociConjInfoCaus;
    public $SociFamiAtti;
    public $MediCsi_;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {

       $this->add(array(
            'name' => 'MediRefe',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'MediRefe',
            ),
            'options' => array(
                'label' => 'Référé par',
            ),
        ));
        $this->add(array(
            'name' => 'MediCsi_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'MediCsi_',
            ),
            'options' => array(
                'label' => 'Centre',
                'empty_option' => '',
                'value_options' => $this->MediCsi_,
            )
        ));
        $this->add(array(
            'name' => 'MediDepiNume',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'MediDepiNume',
            ),
            'options' => array(
                'label' => 'N° au centre',
            ),
        ));
        $this->add(array(
            'name' => 'MediDepiCirc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'MediDepiCirc',
            ),
            'options' => array(
                'label' => 'Circonstance',
                'empty_option' => '',
                'value_options' => $this->MediDepiCirc,
            )
        ));
        $this->add(array(
            'name' => 'MediDepiDat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'MediDepiDat_',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date',
            ),
        ));
        $this->add(array(
            'name' => 'MediSero',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'MediSero',
            ),
            'options' => array(
                'label' => 'Sérologie',
                'value_options' => array(
                    '1' => 'Positive',
                    '2' => 'Négative',
                    '3' => 'Indeterminée',
                ),
            )
        ));
        $this->add(array(
            'name' => 'MediSeroTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'MediSeroTyp_',
            ),
            'options' => array(
                'label' => '',
                'empty_option' => '',
                'value_options' => array(
                    'Sans précision' => 'Sans précision',
                    'VIH 1' => 'VIH 1',
                    'VIH 2' => 'VIH 2',
                    'VIH 1+2' => 'VIH 1+2',
                ),
            )
        ));
        $this->add(array(
            'name' => 'SociConjInfo',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Conjoint informé',
                'value_options' => array(
                    '1' => 'Oui',
                    '2' => 'Non',
                    '3' => '?',
                ),
            )
        ));

        $this->add(array(
            'name' => 'SociConjInfoCaus',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Si non, cause',
                'empty_option' => '',
                'value_options' => $this->SociConjInfoCaus,
            )
        ));
        $this->add(array(
            'name' => 'SociFamiInfo',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Famille informée',
                'value_options' => array(
                    '1' => 'Oui',
                    '2' => 'Non',
                    '3' => '?',
                ),
            )
        ));
        $this->add(array(
            'name' => 'SociFamiAtti',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Attitude de la famille',
                'empty_option' => '',
                'value_options' => $this->SociFamiAtti,
            )
        ));
        $this->add(array(
            'name' => 'SociPersInfo',
            'attributes' => array(
                'type' => 'Zend\Form\Element\Textarea',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Autres personnes informées / autres informations',
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
        'MediCsi_' => array(
        'required' => false,
        ),
        'MediDepiCirc' => array(
        'required' => false,
        ),
        'MediSero' => array(
        'required' => false,
        ),
        'MediSeroTyp_' => array(
        'required' => false,
        ),
        'SociConjInfo' => array(
        'required' => false,
        ),
        'SociConjInfoCaus' => array(
        'required' => false,
        ),
        'SociFamiInfo' => array(
        'required' => false,
        ),
        'SociFamiAtti' => array(
        'required' => false,
        ),
        );
    }

}
