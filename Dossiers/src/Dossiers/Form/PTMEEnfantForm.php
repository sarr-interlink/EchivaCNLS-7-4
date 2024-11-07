<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class PTMEEnfantForm extends Fieldset implements InputFilterProviderInterface {

    public $EnfDeceCaus;
    public $Cli;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
      
        //pour insertion enfa et jumeau 
        $this->add(array(
            'name' => 'subFormPtmeEnfhidden',
            'attributes' => array(
                'type' => 'text',
                'id' => 'subFormPtmeEnfhidden',
            ),
        ));
        
        $this->add(array(
            'name' => 'Enf0Nom_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Enf0Nom_',
            ),
            'options' => array(
                'label' => 'Nom',
            ),
        ));

        $this->add(array(
            'name' => 'Enf0Pnom',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Enf0Pnom',
            ),
            'options' => array(
                'label' => 'Prénom',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0Ume_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Enf0Ume_',
            ),
            'options' => array(
                'label' => 'N° UME',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0Sexe',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Enf0Sexe',
            ),
            'options' => array(
                'label' => 'Sexe',
                'value_options' => array(
                    '1' => array(
                        'label' => 'Masculin',
                        'value' => 1,
                        'attributes' => array(
                            'class' => 'form-control',
                            'id' => 'enf0sexemasc',
                        ),
                    ),
                    '2' => array(
                        'label' => 'Feminin',
                        'value' => 2,
                        'attributes' => array(
                            'class' => 'form-control',
                            'id' => 'enf0sexefem',
                        ),
                    ),
                    
                ),
            )   
        ));
        $this->add(array(
            'name' => 'Enf0Nais',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Enf0Nais',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Naissance: Date',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0Poid',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'id' => 'Enf0Poid',
            ),
            'options' => array(
                'label' => 'Poids',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0Apga',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Enf0Apga',
            ),
            'options' => array(
                'label' => 'APGAR',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0Nato',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'Enf0Nato',
            ),
            'options' => array(
                'label' => 'Transfert en néo-natologie',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0Nvp_Debu',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf0Nvp_Debu',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Début NVP',
                'value_options' => array(
                    'J0' => 'J0',
                    'J1' => 'J1',
                    'J2' => 'J2',
                    'J3' => 'J3',
                    'J4' => 'J4',
                    '>J5' => '>J5',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Enf0Nvp_Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'id' => 'Enf0Nvp_Nomb',
            ),
            'options' => array(
                'label' => 'Nb prises',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0Azt_Debu',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf0Azt_Debu',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'AZT',
                'value_options' => array(
                    'J0' => 'J0',
                    'J1' => 'J1',
                    'J2' => 'J2',
                    'J3' => 'J3',
                    'J4' => 'J4',
                    '>J5' => '>J5',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Enf0Azt_Dure',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'id' => 'Enf0Azt_Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0Pcr0Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Enf0Pcr0Dat_',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'PCR 1',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0Pcr0Resu',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf0Pcr0Resu',
            ),
            'options' => array(
                'label' => '',
                'empty_option' => '',
                'value_options' => array(
                    'Positif' => 'Positif',
                    'Négatif' => 'Négatif',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Enf0Pcr1Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Enf0Pcr1Dat_',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'PCR 2',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0Pcr1Resu',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf0Pcr1Resu',
            ),
            'options' => array(
                'label' => '',
                'empty_option' => '',
                'value_options' => array(
                    'Positif' => 'Positif',
                    'Négatif' => 'Négatif',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Enf0Pcr2Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Enf0Pcr2Dat_',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'PCR 3',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0Pcr2Resu',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf0Pcr2Resu',
            ),
            'options' => array(
                'label' => '',
                'empty_option' => '',
                'value_options' => array(
                    'Positif' => 'Positif',
                    'Négatif' => 'Négatif',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Enf0SeroDat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Enf0SeroDat_',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Sérologie',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0Sero',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Enf0Sero',
            ),
            'options' => array(
                'label' => '',
                'value_options' => array(
                    '1' => array(
                        'label' => 'Positive',
                        'value' => 1,
                        'attributes' => array(
                            'id' => 'Enf0Seroposi',
                        ),
                    ),
                    '2' => array(
                        'label' => 'Neg',
                        'value' => 2,
                        'attributes' => array(
                            'id' => 'Enf0Seronega',
                        ),
                    ),
                    '3' => array(
                        'label' => 'Indetermin.',
                        'value' => 3,
                        'attributes' => array(
                            'id' => 'Enf0Seroinde',
                        ),
                    ),
                    
                ),
            )
        ));
        $this->add(array(
            'name' => 'Enf0SeroTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf0SeroTyp_',
            ),
            'options' => array(
                'label' => ' ',
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
            'name' => 'Enf0DeceDat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Enf0DeceDat_',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Décès',
            ),
        ));
        $this->add(array(
            'name' => 'Enf0DeceCaus',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf0DeceCaus',
            ),
            'options' => array(
                'label' => 'Cause',
                'empty_option' => '',
                'value_options' => $this->EnfDeceCaus,
            )
        ));

        $this->add(array(
            'name' => 'Listptmeenfacons',
            'type' => 'Select',
            'attributes' => array(
                'multiple' => 'multiple',
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Consultations de suivi',
                'value_options' => array('date1' => 'Affiche date',),
            )
        ));
        $this->add(array(
            'name' => 'Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Dat_ptmeenfacons',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date',
            ),
        ));
        $this->add(array(
            'name' => 'Ajoutptmeenfacons',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Ajouter',
                'class' => 'btn btn-success',
                'id' => 'Ajoutptmeenfacons',
            ),
        ));
        $this->add(array(
            'name' => 'Poid',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'id' => 'Poidptmeenfacons',
            ),
            'options' => array(
                'label' => 'Poids',
            ),
        ));
        $this->add(array(
            'name' => 'Alla',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Allaptmeenfacons',
            ),
            'options' => array(
                'label' => 'Allaitement',
                'empty_option' => '',
                'value_options' => array(
                    'Maternel' => 'Maternel',
                    'Artificiel' => 'Artificiel',
                    'Mixte' => 'Mixte',
                    'Maternel strict' => 'Maternel strict',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Cli0',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Cli0ptmeenfacons',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Etat clinique',
                'value_options' => $this->Cli,
            )
        ));
        $this->add(array(
            'name' => 'FormMotifs',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Afficher',
                'class' => 'btn btn-success',
            ),
        ));
        $this->add(array(
            'name' => 'Moti',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Motiptmeenfacons',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'MotiCase',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'MotiCaseptmeenfacons',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        /**/
    }

    public function getInputFilterSpecification() {
      return array(
        'Enf0Sexe' => array(
        'required' => false,
        ),
        'Enf0Nato' => array(
        'required' => false,
        ),
        'Enf0Nvp_Debu' => array(
        'required' => false,
        ),
        'Enf0Azt_Debu' => array(
        'required' => false,
        ),
        'Enf0Pcr0Resu' => array(
        'required' => false,
        ),
        'Enf0Pcr1Resu' => array(
        'required' => false,
        ),
        'Enf0Pcr2Resu' => array(
        'required' => false,
        ),
        'Enf0Sero' => array(
        'required' => false,
        ),
        'Enf0SeroTyp_' => array(
        'required' => false,
        ),
        'Enf0DeceCaus' => array(
        'required' => false,
        ),
        'Listptmeenfacons' => array(
        'required' => false,
        ),
        'Alla' => array(
        'required' => false,
        ),
        'Cli0' => array(
        'required' => false,
        ),
        );      
    }

}
