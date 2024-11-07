<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class PTMEJumeau2Form extends Fieldset implements InputFilterProviderInterface {

    public $EnfDeceCaus;
    public $Cli;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
       $this->add(array(
            'name' => 'Enf1Nom_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Enf1Nom_',
            ),
            'options' => array(
                'label' => 'Nom',
            ),
        ));

        $this->add(array(
            'name' => 'Enf1Pnom',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Enf1Pnom',
            ),
            'options' => array(
                'label' => 'Prénom',
            ),
        ));
        $this->add(array(
            'name' => 'Enf1Ume_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Enf1Ume_',
            ),
            'options' => array(
                'label' => 'N° UME',
            ),
        ));
        $this->add(array(
            'name' => 'Enf1Sexe',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Enf1Sexe',
            ),
            'options' => array(
                'label' => 'Sexe',
                'value_options' => array(
                    '1' => array(
                        'label' => 'Masculin',
                        'value' => 1,
                        'attributes' => array(
                            'class' => 'form-control',
                            'id' => 'enf1sexemasc',
                        ),
                    ),
                    '2' => array(
                        'label' => 'Feminin',
                        'value' => 2,
                        'attributes' => array(
                            'class' => 'form-control',
                            'id' => 'enf1sexefem',
                        ),
                    ),
                    
                ),
            )
        ));
        $this->add(array(
            'name' => 'Enf1Nais',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Enf1Nais',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Naissance: Date',
            ),
        ));
        $this->add(array(
            'name' => 'Enf1Poid',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'id' => 'Enf1Poid',
            ),
            'options' => array(
                'label' => 'Poids',
            ),
        ));
        $this->add(array(
            'name' => 'Enf1Apga',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Enf1Apga',
            ),
            'options' => array(
                'label' => 'APGAR',
            ),
        ));
        $this->add(array(
            'name' => 'Enf1Nato',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'Enf1Nato',
            ),
            'options' => array(
                'label' => 'Transfert en néo-natologie',
            ),
        ));
        $this->add(array(
            'name' => 'Enf1Nvp_Debu',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf1Nvp_Debu',
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
            'name' => 'Enf1Nvp_Nomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'id' => 'Enf1Nvp_Nomb',
            ),
            'options' => array(
                'label' => 'Nb prises',
            ),
        ));
        $this->add(array(
            'name' => 'Enf1Azt_Debu',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf1Azt_Debu',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'AZT',
                'value_options' => array(
                    'J0' => 'J0',
                    'J1' => 'J2',
                    'J3' => 'J3',
                    'J4' => 'J4',
                    '>J5' => '>J5',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Enf1Azt_Dure',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'id' => 'Enf1Azt_Dure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Enf1Pcr0Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Enf1Pcr0Dat_',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'PCR 1',
            ),
        ));
        $this->add(array(
            'name' => 'Enf1Pcr0Resu',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf1Pcr0Resu',
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
            'name' => 'Enf1Pcr1Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Enf1Pcr1Dat_',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'PCR 2',
            ),
        ));
        $this->add(array(
            'name' => 'Enf1Pcr1Resu',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf1Pcr1Resu',
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
            'name' => 'Enf1Pcr2Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Enf1Pcr2Dat_',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'PCR 3',
            ),
        ));
        $this->add(array(
            'name' => 'Enf1Pcr2Resu',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf1Pcr2Resu',
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
            'name' => 'Enf1SeroDat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Enf1SeroDat_',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Sérologie',
            ),
        ));
      $this->add(array(
            'name' => 'Enf1Sero',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Enf1Sero',
            ),
            'options' => array(
                'label' => '',
                'value_options' => array(
                    '1' => array(
                        'label' => 'Positive',
                        'value' => 1,
                        'attributes' => array(
                            'id' => 'Enf1Seroposi',
                        ),
                    ),
                    '2' => array(
                        'label' => 'Neg',
                        'value' => 2,
                        'attributes' => array(
                            'id' => 'Enf1Seronega',
                        ),
                    ),
                    '3' => array(
                        'label' => 'Indetermin.',
                        'value' => 3,
                        'attributes' => array(
                            'id' => 'Enf1Seroinde',
                        ),
                    ),
                    
                ),
            )
        ));
        $this->add(array(
            'name' => 'Enf1SeroTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf1SeroTyp_',
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
            'name' => 'Enf1DeceDat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Enf1DeceDat_',
				'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Décès',
            ),
        ));
        $this->add(array(
            'name' => 'Enf1DeceCaus',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Enf1DeceCaus',
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
                'id' => 'Dat_ptmejumcons',
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
				'id' => 'Poidptmejumcons',
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
                'id' => 'Allaptmejumcons',
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
                'id' => 'Cli0ptmejumcons',
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
                'id' => 'Motiptmejumcons',
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
                'id' => 'MotiCaseptmejumcons',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        /**/
    }

    public function getInputFilterSpecification() {
      return array(
        'Enf1Sexe' => array(
        'required' => false,
        ),
        'Enf1Nato' => array(
        'required' => false,
        ),
        'Enf1Nvp_Debu' => array(
        'required' => false,
        ),
        'Enf1Azt_Debu' => array(
        'required' => false,
        ),
        'Enf1Pcr0Resu' => array(
        'required' => false,
        ),
        'Enf1Pcr1Resu' => array(
        'required' => false,
        ),
        'Enf1Pcr2Resu' => array(
        'required' => false,
        ),
        'Enf1Sero' => array(
        'required' => false,
        ),
        'Enf1SeroTyp_' => array(
        'required' => false,
        ),
        'Enf1DeceCaus' => array(
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
