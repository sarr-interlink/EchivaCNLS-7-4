<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class MedicalouvertureForm extends Fieldset implements InputFilterProviderInterface {

    public $MediDepiCirc;
    public $SociConjInfoCaus;
    public $MediCsi_;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('accueil');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
        /**/
        	$this->add(array(
            'name' => 'MediRefe',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'MediRefeouv',
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
                'id' => 'MediCsi_ouv',
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
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'MediDepiNumeouv',
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
                'id' => 'MediDepiCircouv',
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
                'id' => 'MediDepiDat_ouv',
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
                'id' => 'MediSeroouv',
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
                'id' => 'MediSeroTyp_ouv',
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
            'name' => 'Arv_Lign',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' => '0',
                'id' => 'Arv_Lign',
            ),
            'options' => array(
                'label' => 'Ligne',
            ),
        ));
        
        $this->add(array(
            'name' => 'AffOuvrDat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'readonly' => true,
            ),
            'options' => array(
                'label' => "Date d'ouverture",
            ),
        ));
          $this->add(array(
            'name' => 'Arv_Desi',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv_Desi',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Arv_Desival',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
		'min' => '0',
		'readonly' => 'readonly',
                'id' => 'Arv_Desival',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Arv0',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv0',
            ),
        ));
        $this->add(array(
            'name' => 'Arv1',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv1',
            ),
        ));
        $this->add(array(
            'name' => 'Arv2',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv2',
            ),
        ));
        $this->add(array(
            'name' => 'Arv3',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv3',
            ),
        ));
        $this->add(array(
            'name' => 'Arv4',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv4',
            ),
        ));
        $this->add(array(
            'name' => 'Arv5',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv5',
            ),
        ));
        $this->add(array(
            'name' => 'Arv6',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv6',
            ),
        ));
        $this->add(array(
            'name' => 'Arv7',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv7',
            ),
        ));
        $this->add(array(
            'name' => 'Arv8',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv8',
            ),
        ));
        $this->add(array(
            'name' => 'Arv9',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv9',
            ),
        ));
         $this->add(array(
            'name' => 'Arv_Desi',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv_Desi',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Arv_Desival',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
				'min' => '0',
				'readonly' => 'readonly',
                'id' => 'Arv_Desival',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'FormFact',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Afficher',
                'class' => 'btn btn-success',
            ),
            'options' => array(
                'label' => 'Facteur de risque',
            ),
        ));
        $this->add(array(
            'name' => 'MediAnte',
            'attributes' => array(
                'type' => 'Zend\Form\Element\Textarea',
                'class' => 'form-control',
                'id' => 'MediAnte',
            ),
            'options' => array(
                'label' => 'Antécédents Médicaux',
            ),
        ));
        $this->add(array(
            'name' => 'MediAnteCase',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'MediAnteCase',
            ),
            'options' => array(
                'label' => 'Médicaux',
            ),
        ));
        $this->add(array(
            'name' => 'FormStatOms',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Afficher',
                'class' => 'btn btn-success',
            ),
        ));
        $this->add(array(
            'name' => 'MediAnteArv_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'ARV',
            ),
        ));
        $this->add(array(
            'name' => 'MediCdc_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Stade CDC',
                'empty_option' => '',
                'value_options' => array(
                    'A' => 'A',
                    'A1' => 'A1',
                    'A2' => 'A2',
                    'A3' => 'A3',
                    'B' => 'B',
                    'B1' => 'B1',
                    'B2' => 'B2',
                    'B3' => 'B3',
                    'C' => 'C',
                    'C1' => 'C1',
                    'C2' => 'C2',
                    'C3' => 'C3',
                ),
            )
        ));
        $this->add(array(
            'name' => 'MediKarn',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Karnovsky',
                'value_options' => array(
                    '0' => '0',
                    '10' => '10',
                    '20' => '20',
                    '30' => '30',
                    '40' => '40',
                    '50' => '50',
                    '60' => '60',
                    '70' => '70',
                    '80' => '80',
                    '90' => '90',
                    '100' => '100',
                ),
            )
        ));
        $this->add(array(
            'name' => 'MediDiag',
            'attributes' => array(
                'type' => 'Zend\Form\Element\Textarea',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Diagnostic',
            ),
        ));
        $this->add(array(
            'name' => 'MediVar0',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Variable libre 1',
            ),
        ));
        $this->add(array(
            'name' => 'MediVar1',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Variable libre 2',
            ),
        ));
         $this->add(array(
            'name' => 'MediRisqMult',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'MediRisqMult',
            ),
            
        ));

        $this->add(array(
            'name' => 'MediRisqOcca',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'MediRisqOcca',
            ),
            
        ));

        $this->add(array(
            'name' => 'MediRisqPoly',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'MediRisqPoly',
            ),
            
        ));

        $this->add(array(
            'name' => 'MediRisqPart',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'MediRisqPart',
            ),
            
        ));

        $this->add(array(
            'name' => 'MediRisqHomo',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'MediRisqHomo',
            ),
            
        ));

        $this->add(array(
            'name' => 'MediRisqTran',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'MediRisqTran',
            ),
            
        ));

        $this->add(array(
            'name' => 'MediRisqScar',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'MediRisqScar',
            ),
            
        ));

        $this->add(array(
            'name' => 'MediRisqPiqu',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'MediRisqPiqu',
            ),
           
        ));

        $this->add(array(
            'name' => 'MediRisqMere',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'MediRisqMere',
            ),
            
        ));
        $this->add(array(
            'name' => 'MediRisqPres',
            'type' => 'text',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'MediRisqPres',
            ),
        ));
        
        
        
        
        
    }

    public function getInputFilterSpecification() {
      return array(
        'MediRefe' => array(
        'required' => false,
        ),
        'MediCsi_' => array(
        'required' => false,
        ),
        'MediDepiNume' => array(
        'required' => false,
        ),
        'MediDepiCirc' => array(
        'required' => false,
        ),
        'MediDepiDat_' => array(
        'required' => false,
        ),
        'MediSero' => array(
        'required' => false,
        ),
        'MediSeroTyp_' => array(
        'required' => false,
        ),
        'MediCdc_' => array(
        'required' => false,
        ),
        'MediKarn' => array(
        'required' => false,
        ),
        );  
    }

}
