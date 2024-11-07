<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class MedicalsuiviForm extends Fieldset implements InputFilterProviderInterface {

    public $Contsuiv;
    public $medicons;
    public $Cond;
    public $Hdj_Acte;
    public $Arv_Modi;
    public $Arv0Prsc;
    public $Med0Dci_;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
        $this->add(array(
            'name' => 'subFormMedicalSuihidden',
            'attributes' => array(
                'type' => 'text',
                'id' => 'subFormMedicalSuihidden',
            ),
        ));
        $this->add(array(
            'name' => 'medcouranthidden',
            'attributes' => array(
                'type' => 'text',
                'id' => 'subFormMedicalSuihidden',
            ),
        ));
        $this->add(array(
            'name' => 'Listmedicons',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'mediconsselect',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'value_options' => $this->medicons,
                'label' => 'Date de consultation',
            
				
            )
        ));
        $this->add(array(
            'name' => 'Ajoutmedicons',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Ajouter',
                'class' => 'btn btn-success',
                'id' => 'Ajoutmedicons',
            ),
        ));
        $this->add(array(
            'name' => 'Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'MedSui form-control',
                'id' => 'Dat_medicons',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date',
            ),
        ));
        $this->add(array(
            'name' => 'Ptme',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'Ptme',
            ),
            'options' => array(
                'label' => 'PTME',
            ),
        ));
        $this->add(array(
            'name' => 'Temp',
            'attributes' => array(
                'type' => 'number',
		'min' => '0',
		'max' => '50',
                
                'class' => 'MedSui form-control',
                'id' => 'Temp',
            ),
            'options' => array(
                'label' => 'T°',
            ),
        ));
        $this->add(array(
            'name' => 'Poid',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'max' =>'500',
				'id' => 'Poidmedicons',
            ),
            'options' => array(
                'label' => 'Poids (Kg)',
            ),
        ));
        $this->add(array(
            'name' => 'Tail',
            'attributes' => array(
                'type' => 'number',
                'step' => '0.01',
                'class' => 'MedSui form-control',
				'min' =>'0.00',
				'max' =>'2.00',
				'id' => 'Tail',
            ),
            'options' => array(
                'label' => 'Taille (m)',
            ),
        ));
        $this->add(array(
            'name' => 'Imc_',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
                'readonly' =>'readonly',
                'id' => 'Imc_'
            ),
            'options' => array(
                'label' => 'Imc',
            ),
        ));
        $this->add(array(
            'name' => 'Cont',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Contmedicons',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Contexte',
                'value_options' => $this->Contsuiv,
            )
        ));
       /* $this->add(array(
            'name' => 'FormMotifs',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Afficher',
                'class' => 'btn btn-success',
                'id' => 'FormMotifsmedicons',
            ),
            'options' => array(
                'label' => '',
            ),
        ));*/
        $this->add(array(
            'name' => 'Moti',
            'attributes' => array(
                'type' => 'text',
                'class' => 'MedSui form-control',
                'id' => 'Motimedicons',
            ),
            'options' => array(
                'label' => 'Motifs',
            ),
        ));
        $this->add(array(
            'name' => 'MotiCase',
            'attributes' => array(
                'type' => 'text',
                'id' => 'MotiCasemedsui',
            ),
        ));
        $this->add(array(
            'name' => 'Conc',
            'attributes' => array(
                'type' => 'Zend\Form\Element\Textarea',
                'class' => 'MedSui form-control',
                'id' => 'Concmedicons',
            ),
            'options' => array(
                'label' => 'Conclusion',
            ),
        ));
        $this->add(array(
            'name' => 'ConcCase',
            'attributes' => array(
                'type' => 'text',
                'id' => 'ConcCase',
            ),
        ));
        
        $this->add(array(
            'name' => 'Cond',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Cond',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Conduite à tenir',
                'value_options' => $this->Cond,
            )
        ));
        $this->add(array(
            'name' => 'Cdc_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Cdc_',
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
            'name' => 'Hdj_',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'Hdj_',
            ),
            'options' => array(
                'label' => 'HDJ',
            ),
        ));
        $this->add(array(
            'name' => 'Hdj_Acte',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Hdj_Acte',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Acte',
                'value_options' => $this->Hdj_Acte,
            )
        ));
       $this->add(array(
            'name' => 'RefCHN',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'RefCHN',
            ),
            'options' => array(
                'label' => 'HDJ',
            ),
        ));
       $this->add(array(
            'name' => 'MotiHdjCase',
            'attributes' => array(
                'type' => 'text',
                'id' => 'MotiHdjCase',
            ),
           'options' => array(
                'label' => 'Motif',
            ),
        ));
        $this->add(array(
            'name' => 'Karn',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Karn',
            ),
            'options' => array(
                'label' => 'Karnovsky',
                'empty_option' => '',
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
            'name' => 'Hosp',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'Hosp',
            ),
            'options' => array(
                'label' => 'Hospitalisation',
            ),
        ));
        $this->add(array(
            'name' => 'HospSort',
            'attributes' => array(
                'type' => 'date',
                'class' => 'MedSui form-control',
                'id' => 'HospSort',
                'min' => date('Y-m-d'),
                'max' => '2030-01-01',
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Sortie',
            ),
        ));
        $this->add(array(
            'name' => 'Tb__Exte',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'Tb__Exte',
            ),
            'options' => array(
                'label' => 'Sous antituberculeux',
            ),
        ));
        $this->add(array(
            'name' => 'Arv_Modi',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv_Modi',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Modification',
                'value_options' => $this->Arv_Modi,
            )
        ));
      /*  $this->add(array(
            'name' => 'FormIntol',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Afficher',
                'class' => 'btn btn-success',
                'id' => 'FormIntolmedicons',
            ),
            'options' => array(
                'label' => '',
            ),
        ));*/
        $this->add(array(
            'name' => 'Arv_Into',
            'attributes' => array(
                'type' => 'text',
                'class' => 'MedSui form-control',
                'id' => 'Arv_Into',
            ),
            'options' => array(
                'label' => 'Intolerance',
            ),
        ));
        $this->add(array(
            'name' => 'Arv_IntoCase',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Arv_IntoCase',
            ),
        ));
        $this->add(array(
            'name' => 'Arv0Prsc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control ArvPrsc',
                'data-live-search'=>'true',
                'id' => 'Arv0Prsc'
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Prescription',
                'value_options' => $this->Arv0Prsc,
            )
        ));
        $this->add(array(
            'name' => 'Arv0Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv0Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Arv0Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
                'id' => 'Arv0Nomb',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Arv0Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv0Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'cp' => 'cp',
                    'ml' => 'ml',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv0Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv0Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv0Nota',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv0Nota',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Nota',
                'value_options' => array(
                    'à jeun' => 'à jeun',
                    'pd repas' => 'pd repas',
                    'après repas' => 'après repas',
                    'avant repas' => 'avant repas',
                    'avec ou sans repas' => 'avec ou sans repas',
                    'au coucher' => 'au coucher',
                    '1h av repas ou 2h ap' => '1h av repas ou 2h ap',
                    '1/2 d. pd 15 j.' => '1/2 d. pd 15 j.',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv1Prsc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control ArvPrsc',
                'data-live-search'=>'true',
                'id' => 'Arv1Prsc',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => $this->Arv0Prsc,
            )
        ));
        $this->add(array(
            'name' => 'Arv1Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv1Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
            )
        ));
        $this->add(array(
            'name' => 'Arv1Nomb',
            'attributes' => array(
			'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
                'id' => 'Arv1Nomb',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Arv1Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv1Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'cp' => 'cp',
                    'ml' => 'ml',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv1Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv1Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv1Nota',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv1Nota',
            ),
             'options' => array(
                'empty_option' => '',
                'label' => 'Nota',
                'value_options' => array(
                    'à jeun' => 'à jeun',
                    'pd repas' => 'pd repas',
                    'après repas' => 'après repas',
                    'avant repas' => 'avant repas',
                    'avec ou sans repas' => 'avec ou sans repas',
                    'au coucher' => 'au coucher',
                    '1h av repas ou 2h ap' => '1h av repas ou 2h ap',
                    '1/2 d. pd 15 j.' => '1/2 d. pd 15 j.',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv2Prsc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control ArvPrsc',
                'data-live-search'=>'true',
                'id' => 'Arv2Prsc',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => $this->Arv0Prsc,
            )
        ));
        $this->add(array(
            'name' => 'Arv2Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv2Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
            )
        ));
        $this->add(array(
            'name' => 'Arv2Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Arv2Nomb',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Arv2Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv2Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'cp' => 'cp',
                    'ml' => 'ml',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv2Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv2Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv2Nota',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv2Nota',
            ),
             'options' => array(
                'empty_option' => '',
                'label' => 'Nota',
                'value_options' => array(
                    'à jeun' => 'à jeun',
                    'pd repas' => 'pd repas',
                    'après repas' => 'après repas',
                    'avant repas' => 'avant repas',
                    'avec ou sans repas' => 'avec ou sans repas',
                    'au coucher' => 'au coucher',
                    '1h av repas ou 2h ap' => '1h av repas ou 2h ap',
                    '1/2 d. pd 15 j.' => '1/2 d. pd 15 j.',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv3Prsc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control ArvPrsc',
                'data-live-search'=>'true',
                'id' => 'Arv3Prsc',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => $this->Arv0Prsc,
            )
        ));
        $this->add(array(
            'name' => 'Arv3Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv3Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
            )
        ));
        $this->add(array(
            'name' => 'Arv3Nomb',
            'attributes' => array(
				'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
                'id' => 'Arv3Nomb',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Arv3Unit',
            'type' => 'Select',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Arv3Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'cp' => 'cp',
                    'ml' => 'ml',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv3Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv3Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv3Nota',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv3Nota',
            ),
             'options' => array(
                'empty_option' => '',
                'label' => 'Nota',
                'value_options' => array(
                    'à jeun' => 'à jeun',
                    'pd repas' => 'pd repas',
                    'après repas' => 'après repas',
                    'avant repas' => 'avant repas',
                    'avec ou sans repas' => 'avec ou sans repas',
                    'au coucher' => 'au coucher',
                    '1h av repas ou 2h ap' => '1h av repas ou 2h ap',
                    '1/2 d. pd 15 j.' => '1/2 d. pd 15 j.',
                ),
            )
        ));
         $this->add(array(
            'name' => 'Arv4Prsc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control ArvPrsc',
                'data-live-search'=>'true',
                'id' => 'Arv4Prsc',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => $this->Arv0Prsc,
            )
        ));
        $this->add(array(
            'name' => 'Arv4Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv4Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
            )
        ));
        $this->add(array(
            'name' => 'Arv4Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Arv4Nomb',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Arv4Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv4Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'cp' => 'cp',
                    'ml' => 'ml',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv4Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv4Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv4Nota',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv4Nota',
            ),
             'options' => array(
                'empty_option' => '',
                'label' => 'Nota',
                'value_options' => array(
                    'à jeun' => 'à jeun',
                    'pd repas' => 'pd repas',
                    'après repas' => 'après repas',
                    'avant repas' => 'avant repas',
                    'avec ou sans repas' => 'avec ou sans repas',
                    'au coucher' => 'au coucher',
                    '1h av repas ou 2h ap' => '1h av repas ou 2h ap',
                    '1/2 d. pd 15 j.' => '1/2 d. pd 15 j.',
                ),
            )
        ));
         $this->add(array(
            'name' => 'Arv5Prsc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control ArvPrsc',
                'data-live-search'=>'true',
                'id' => 'Arv5Prsc',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => $this->Arv0Prsc,
            )
        ));
        $this->add(array(
            'name' => 'Arv5Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv5Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
            )
        ));
        $this->add(array(
            'name' => 'Arv5Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Arv5Nomb',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Arv5Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv5Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'cp' => 'cp',
                    'ml' => 'ml',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv5Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv5Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv5Nota',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv5Nota',
            ),
             'options' => array(
                'empty_option' => '',
                'label' => 'Nota',
                'value_options' => array(
                    'à jeun' => 'à jeun',
                    'pd repas' => 'pd repas',
                    'après repas' => 'après repas',
                    'avant repas' => 'avant repas',
                    'avec ou sans repas' => 'avec ou sans repas',
                    'au coucher' => 'au coucher',
                    '1h av repas ou 2h ap' => '1h av repas ou 2h ap',
                    '1/2 d. pd 15 j.' => '1/2 d. pd 15 j.',
                ),
            )
        ));
         $this->add(array(
            'name' => 'Arv6Prsc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control ArvPrsc',
                'data-live-search'=>'true',
                'id' => 'Arv6Prsc',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => $this->Arv0Prsc,
            )
        ));
        $this->add(array(
            'name' => 'Arv6Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv6Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
            )
        ));
        $this->add(array(
            'name' => 'Arv6Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Arv6Nomb',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Arv6Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv6Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'cp' => 'cp',
                    'ml' => 'ml',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv6Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv6Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv6Nota',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv6Nota',
            ),
             'options' => array(
                'empty_option' => '',
                'label' => 'Nota',
                'value_options' => array(
                    'à jeun' => 'à jeun',
                    'pd repas' => 'pd repas',
                    'après repas' => 'après repas',
                    'avant repas' => 'avant repas',
                    'avec ou sans repas' => 'avec ou sans repas',
                    'au coucher' => 'au coucher',
                    '1h av repas ou 2h ap' => '1h av repas ou 2h ap',
                    '1/2 d. pd 15 j.' => '1/2 d. pd 15 j.',
                ),
            )
        ));
         $this->add(array(
            'name' => 'Arv7Prsc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control ArvPrsc',
                'data-live-search'=>'true',
                'id' => 'Arv7Prsc',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => $this->Arv0Prsc,
            )
        ));
        $this->add(array(
            'name' => 'Arv7Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv7Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
            )
        ));
        $this->add(array(
            'name' => 'Arv7Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Arv7Nomb',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Arv7Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv7Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'cp' => 'cp',
                    'ml' => 'ml',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv7Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv7Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv7Nota',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv7Nota',
            ),
             'options' => array(
                'empty_option' => '',
                'label' => 'Nota',
                'value_options' => array(
                    'à jeun' => 'à jeun',
                    'pd repas' => 'pd repas',
                    'après repas' => 'après repas',
                    'avant repas' => 'avant repas',
                    'avec ou sans repas' => 'avec ou sans repas',
                    'au coucher' => 'au coucher',
                    '1h av repas ou 2h ap' => '1h av repas ou 2h ap',
                    '1/2 d. pd 15 j.' => '1/2 d. pd 15 j.',
                ),
            )
        ));
         $this->add(array(
            'name' => 'Arv8Prsc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control ArvPrsc',
                'data-live-search'=>'true',
                'id' => 'Arv8Prsc',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => $this->Arv0Prsc,
            )
        ));
        $this->add(array(
            'name' => 'Arv8Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv8Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
            )
        ));
        $this->add(array(
            'name' => 'Arv8Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Arv8Nomb',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Arv8Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv8Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'cp' => 'cp',
                    'ml' => 'ml',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv8Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv8Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv8Nota',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv8Nota',
            ),
             'options' => array(
                'empty_option' => '',
                'label' => 'Nota',
                'value_options' => array(
                    'à jeun' => 'à jeun',
                    'pd repas' => 'pd repas',
                    'après repas' => 'après repas',
                    'avant repas' => 'avant repas',
                    'avec ou sans repas' => 'avec ou sans repas',
                    'au coucher' => 'au coucher',
                    '1h av repas ou 2h ap' => '1h av repas ou 2h ap',
                    '1/2 d. pd 15 j.' => '1/2 d. pd 15 j.',
                ),
            )
        ));
         $this->add(array(
            'name' => 'Arv9Prsc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control ArvPrsc',
                'data-live-search'=>'true',
                'id' => 'Arv9Prsc',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => $this->Arv0Prsc,
            )
        ));
        $this->add(array(
            'name' => 'Arv9Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv9Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
            )
        ));
        $this->add(array(
            'name' => 'Arv9Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Arv9Nomb',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Arv9Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv9Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'cp' => 'cp',
                    'ml' => 'ml',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv9Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv9Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv9Nota',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv9Nota',
            ),
             'options' => array(
                'empty_option' => '',
                'label' => 'Nota',
                'value_options' => array(
                    'à jeun' => 'à jeun',
                    'pd repas' => 'pd repas',
                    'après repas' => 'après repas',
                    'avant repas' => 'avant repas',
                    'avec ou sans repas' => 'avec ou sans repas',
                    'au coucher' => 'au coucher',
                    '1h av repas ou 2h ap' => '1h av repas ou 2h ap',
                    '1/2 d. pd 15 j.' => '1/2 d. pd 15 j.',
                ),
            )
        ));
        
        $this->add(array(
            'name' => 'Arv_Dure',
            'attributes' => array(
                'type' => 'number',
				'min' => '0',
                'class' => 'MedSui form-control',
                'id' => 'Arv_Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Arv_DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv_DureTyp_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Arv_DureReno',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Arv_DureReno',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'non renouvelable' => 'non renouvelable',
                    'renouvelable 1 fois' => 'renouvelable 1 fois',
                    'renouvelable 2 fois' => 'renouvelable 2 fois',
                    'renouvelable 3 fois' => 'renouvelable 3 fois',
                ),
            )
        ));
        /**/
        $this->add(array(
            'name' => 'Med0Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control MedDci',
                'data-live-search'=>'true',
                'id' => 'Med0Dci_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med0Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med0Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med0Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Med0Nomb',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med0Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med0Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med0Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med0Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med0Dure',
            'attributes' => array(
                'type' => 'number',
				'min' => '0',
                'class' => 'MedSui form-control',
                'id' => 'Med0Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med0DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med0DureTyp_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med1Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control MedDci',
                'data-live-search'=>'true',
                'id' => 'Med1Dci_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med1Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med1Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med1Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Med1Nomb',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med1Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med1Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med1Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med1Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med1Dure',
            'attributes' => array(
                'type' => 'number',
				'min' => '0',
                'class' => 'MedSui form-control',
                'id' => 'Med1Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med1DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med1DureTyp_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med2Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control MedDci',
                'data-live-search'=>'true',
                'id' => 'Med2Dci_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med2Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med2Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med2Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Med2Nomb',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med2Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med2Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med2Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med2Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med2Dure',
            'attributes' => array(
                'type' => 'number',
				'min' => '0',
                'class' => 'MedSui form-control',
                'id' => 'Med2Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med2DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med2DureTyp_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med3Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control MedDci',
                'data-live-search'=>'true',
                'id' => 'Med3Dci_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med3Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med3Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med3Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Med3Nomb',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med3Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med3Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med3Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med3Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med3Dure',
            'attributes' => array(
                'type' => 'number',
				'min' => '0',
                'class' => 'MedSui form-control',
                'id' => 'Med3Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med3DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med3DureTyp_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med4Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control MedDci',
                'data-live-search'=>'true',
                'id' => 'Med4Dci_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med4Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med4Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med4Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Med4Nomb',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med4Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med4Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med4Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med4Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med4Dure',
            'attributes' => array(
                'type' => 'number',
				'min' => '0',
                'class' => 'MedSui form-control',
                'id' => 'Med4Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med4DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med4DureTyp_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med5Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control MedDci',
                'data-live-search'=>'true',
                'id' => 'Med5Dci_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med5Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med5Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med5Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Med5Nomb',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med5Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med5Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med5Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med5Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med5Dure',
            'attributes' => array(
                'type' => 'number',
				'min' => '0',
                'class' => 'MedSui form-control',
                'id' => 'Med5Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med5DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med5DureTyp_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
          $this->add(array(
            'name' => 'Med6Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control MedDci',
                'data-live-search'=>'true',
                'id' => 'Med6Dci_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med6Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med6Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med6Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Med6Nomb',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med6Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med6Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med6Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med6Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med6Dure',
            'attributes' => array(
                'type' => 'number',
				'min' => '0',
                'class' => 'MedSui form-control',
                'id' => 'Med6Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med6DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med6DureTyp_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
          $this->add(array(
            'name' => 'Med7Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control MedDci',
                'data-live-search'=>'true',
                'id' => 'Med7Dci_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med7Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med7Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med7Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Med7Nomb',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med7Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med7Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med7Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med7Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med7Dure',
            'attributes' => array(
                'type' => 'number',
				'min' => '0',
                'class' => 'MedSui form-control',
                'id' => 'Med7Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med7DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med7DureTyp_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));  $this->add(array(
            'name' => 'Med8Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control MedDci',
                'data-live-search'=>'true',
                'id' => 'Med8Dci_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med8Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med8Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med8Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Med8Nomb',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med8Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med8Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med8Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med8Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med8Dure',
            'attributes' => array(
                'type' => 'number',
				'min' => '0',
                'class' => 'MedSui form-control',
                'id' => 'Med8Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med8DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med8DureTyp_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
          $this->add(array(
            'name' => 'Med9Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control MedDci',
                'data-live-search'=>'true',
                'id' => 'Med9Dci_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med9Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med9Form',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med9Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'Med9Nomb',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med9Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med9Unit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med9Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med9Fois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med9Dure',
            'attributes' => array(
                'type' => 'number',
				'min' => '0',
                'class' => 'MedSui form-control',
                'id' => 'Med9Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med9DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'Med9DureTyp_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Presauto',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Prescription autom.',
                'class' => 'btn btn-success',
            ),
        ));
        $this->add(array(
            'name' => 'closemedicourant',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Fermer',
                'class' => 'btn btn-success',
                'data-dismiss' => 'modal',
                'id' => 'closemedicourant',
            ),
              'options' => array(
                'label' => 'Fermer',
            ),
        ));
        $this->add(array(
            'name' => 'SetField',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'multiple' => 'multiple',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
          
        $this->add(array(
            'name' => 'ObseCase',
            'attributes' => array(
                'type' => 'text',
                'id' => 'ObseCase',
            ),
        ));
        $this->add(array(
            'name' => 'ObseManq',
            'attributes' => array(
                'type' => 'text',
                'id' => 'ObseManq',
            ),
           
        ));
        $this->add(array(
            'name' => 'ObseMoti',
            'attributes' => array(
            'type' => 'text',
                'id' => 'ObseMoti',
            ),
           
        ));
        $this->add(array(
            'name' => 'Obse',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Obse',
            ),
           
        ));
        $this->add(array(
            'name' => 'ObseNota',
            'attributes' => array(
                'type' => 'text',
                'id' => 'ObseNota',
            ),
        ));
        $this->add(array(
            'name' => 'FormObs',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Observance',
                'class' => 'btn btn-success',
                'id' => 'FormObs',
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
        $this->add(array(
            'name' => 'Ord',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Ordonnance',
                'class' => 'btn btn-success',
                'id' => 'ord',
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'Listmedicons' => array(
                'required' => false,
            ),
            'Ptme' => array(
                'required' => false,
            ),
            'Cont' => array(
                'required' => false,
            ),
            'Cond' => array(
                'required' => false,
            ),
            'Cdc_' => array(
                'required' => false,
            ),
            'Hdj_' => array(
                'required' => false,
            ),
            'Hdj_Acte' => array(
                'required' => false,
            ),
            'Karn' => array(
                'required' => false,
            ),
            'Hosp' => array(
                'required' => false,
            ),
            'Tb__Exte' => array(
                'required' => false,
            ),
            'Arv_Modi' => array(
                'required' => false,
            ),
            'Arv0Prsc' => array(
                'required' => false,
            ),
            'Arv0Form' => array(
                'required' => false,
            ),
            'Arv0Unit' => array(
                'required' => false,
            ),
            'Arv0Fois' => array(
                'required' => false,
            ),
            'Arv0Nota' => array(
                'required' => false,
            ),
            'Arv1Prsc' => array(
                'required' => false,
            ),
            'Arv1Form' => array(
                'required' => false,
            ),
            'Arv1Unit' => array(
                'required' => false,
            ),
            'Arv1Fois' => array(
                'required' => false,
            ),
            'Arv1Nota' => array(
                'required' => false,
            ),
            'Arv2Prsc' => array(
                'required' => false,
            ),
            'Arv2Form' => array(
                'required' => false,
            ),
            'Arv2Unit' => array(
                'required' => false,
            ),
            'Arv2Fois' => array(
                'required' => false,
            ),
            'Arv2Nota' => array(
                'required' => false,
            ),
            'Arv3Prsc' => array(
                'required' => false,
            ),
            'Arv3Form' => array(
                'required' => false,
            ),
            'Arv3Unit' => array(
                'required' => false,
            ),
            'Arv3Fois' => array(
                'required' => false,
            ),
            'Arv3Nota' => array(
                'required' => false,
            ),
            'Arv4Prsc' => array(
                'required' => false,
            ),
            'Arv4Form' => array(
                'required' => false,
            ),
            'Arv4Unit' => array(
                'required' => false,
            ),
            'Arv4Fois' => array(
                'required' => false,
            ),
            'Arv4Nota' => array(
                'required' => false,
            ),
            'Arv5Prsc' => array(
                'required' => false,
            ),
            'Arv5Form' => array(
                'required' => false,
            ),
            'Arv5Unit' => array(
                'required' => false,
            ),
            'Arv5Fois' => array(
                'required' => false,
            ),
            'Arv5Nota' => array(
                'required' => false,
            ),
            'Arv6Prsc' => array(
                'required' => false,
            ),
            'Arv6Form' => array(
                'required' => false,
            ),
            'Arv6Unit' => array(
                'required' => false,
            ),
            'Arv6Fois' => array(
                'required' => false,
            ),
            'Arv6Nota' => array(
                'required' => false,
            ),
            'Arv7Prsc' => array(
                'required' => false,
            ),
            'Arv7Form' => array(
                'required' => false,
            ),
            'Arv7Unit' => array(
                'required' => false,
            ),
            'Arv7Fois' => array(
                'required' => false,
            ),
            'Arv7Nota' => array(
                'required' => false,
            ),
            'Arv8Prsc' => array(
                'required' => false,
            ),
            'Arv8Form' => array(
                'required' => false,
            ),
            'Arv8Unit' => array(
                'required' => false,
            ),
            'Arv8Fois' => array(
                'required' => false,
            ),
            'Arv8Nota' => array(
                'required' => false,
            ),
            'Arv9Prsc' => array(
                'required' => false,
            ),
            'Arv9Form' => array(
                'required' => false,
            ),
            'Arv9Unit' => array(
                'required' => false,
            ),
            'Arv9Fois' => array(
                'required' => false,
            ),
            'Arv9Nota' => array(
                'required' => false,
            ),
            'Arv_DureTyp_' => array(
                'required' => false,
            ),
            'Arv_DureReno' => array(
                'required' => false,
            ),
			'Med0Dci_' => array(
                'required' => false,
            ),
			'Med0Form' => array(
                'required' => false,
            ),
			'Med0Unit' => array(
                'required' => false,
            ),
			'Med0Fois' => array(
                'required' => false,
            ),
			'Med0DureTyp_' => array(
                'required' => false,
            ),
			'Med1Dci_' => array(
                'required' => false,
            ),
			'Med1Form' => array(
                'required' => false,
            ),
			'Med1Unit' => array(
                'required' => false,
            ),
			'Med1Fois' => array(
                'required' => false,
            ),
			'Med1DureTyp_' => array(
                'required' => false,
            ),
			'Med2Dci_' => array(
                'required' => false,
            ),
			'Med2Form' => array(
                'required' => false,
            ),
			'Med2Unit' => array(
                'required' => false,
            ),
			'Med2Fois' => array(
                'required' => false,
            ),
			'Med2DureTyp_' => array(
                'required' => false,
            ),
			'Med3Dci_' => array(
                'required' => false,
            ),
			'Med3Form' => array(
                'required' => false,
            ),
			'Med3Unit' => array(
                'required' => false,
            ),
			'Med3Fois' => array(
                'required' => false,
            ),
			'Med3DureTyp_' => array(
                'required' => false,
            ),
			'Med4Dci_' => array(
                'required' => false,
            ),
			'Med4Form' => array(
                'required' => false,
            ),
			'Med4Unit' => array(
                'required' => false,
            ),
			'Med4Fois' => array(
                'required' => false,
            ),
			'Med4DureTyp_' => array(
                'required' => false,
            ),
			'Med5Dci_' => array(
                'required' => false,
            ),
			'Med5Form' => array(
                'required' => false,
            ),
			'Med5Unit' => array(
                'required' => false,
            ),
			'Med5Fois' => array(
                'required' => false,
            ),
			'Med5DureTyp_' => array(
                'required' => false,
            ),
			'Med6Dci_' => array(
                'required' => false,
            ),
			'Med6Form' => array(
                'required' => false,
            ),
			'Med6Unit' => array(
                'required' => false,
            ),
			'Med6Fois' => array(
                'required' => false,
            ),
			'Med6DureTyp_' => array(
                'required' => false,
            ),
			'Med7Dci_' => array(
                'required' => false,
            ),
			'Med7Form' => array(
                'required' => false,
            ),
			'Med7Unit' => array(
                'required' => false,
            ),
			'Med7Fois' => array(
                'required' => false,
            ),
			'Med7DureTyp_' => array(
                'required' => false,
            ),
			'Med8Dci_' => array(
                'required' => false,
            ),
			'Med8Form' => array(
                'required' => false,
            ),
			'Med8Unit' => array(
                'required' => false,
            ),
			'Med8Fois' => array(
                'required' => false,
            ),
			'Med8DureTyp_' => array(
                'required' => false,
            ),
			'Med9Dci_' => array(
                'required' => false,
            ),
			'Med9Form' => array(
                'required' => false,
            ),
			'Med9Unit' => array(
                'required' => false,
            ),
			'Med9Fois' => array(
                'required' => false,
            ),
			'Med9DureTyp_' => array(
                'required' => false,
            ),
			
			
        );
    }

}
