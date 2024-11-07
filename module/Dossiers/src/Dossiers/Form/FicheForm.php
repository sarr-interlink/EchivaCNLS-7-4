<?php

namespace Dossiers\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Dossiers\Entity\Fiche;
use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class FicheForm extends Fieldset implements InputFilterProviderInterface {

    public $RensLoca;
    public $RensOuvrUnit;
    public $RensQuar;
    public $RensNati;
    public $RensMatr;
    public $RensDeceCaus;
    public $RensProf;
    public $RensEtud;
    public $RensChrg;
    public $RensOev_Type;
    public $RensOev_Sani;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('subFormFiche');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
        $this->add(array(
            'name' => 'RensNom_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input-sm',
                'id' => 'RensNom_',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Nom',
            ),
        ));
        $this->add(array(
            'name' => 'Imc_info',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Imc_doss',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Conc_info',
            'attributes' => array(
                'type' => 'text',
                'id' => 'Concdoss',
            ),
            'options' => array(
                'label' => '',
            ),
        ));
        $this->add(array(
            'name' => 'Ref_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Ref_',
                'readonly' => 'readonly',
            ),
            'options' => array(
                'label' => 'N° dossier',
            ),
        ));
        $this->add(array(
            'name' => 'RensPnom',
            'attributes' => array(
                'type' => 'text',
                'id' => 'RensPnom',
                'class' => 'form-control',
				'required' => 'required',
            ),
            'options' => array(
                'label' => 'Prénoms',
            ),
        ));
        /**/
        $this->add(array(
            'name' => 'RensNaisDat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'RensNaisDat_',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),		
            ),
            'options' => array(
                'label' => 'Date de naissance',
            ),
        ));
        $this->add(array(
            'name' => 'RensAge_',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
                'id' => 'RensAge_',
				'required' => 'required',
				'min' =>'0',
				'max'=>'120'	
            ),
            'options' => array(
                'label' => 'Age',
            ),
        ));
        $this->add(array(
            'name' => 'RensOev_',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'RensOev_',
            ),
            'options' => array(
                'label' => 'OEV',
            ),
        ));
        $this->add(array(
            'name' => 'RensSexe',
            'type' => 'Zend\Form\Element\Radio',
            'id' => 'RensSexe',
            'attributes' => array(
                'value' => '1',
				'required' => 'required',
            ),
            'options' => array(
                'label' => 'Sexe',
                'value_options' => array(
                    '1' => array('value' =>'1','label' =>'Masculin'),
                    '2' => array('value' =>'2','label' =>'Féminin'),
                ),
                
            )
        ));
        $this->add(array(
            'name' => 'OuvrDat_',
             'attributes' => array(
               'type' => 'date',
                'class' => 'form-control',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date d\'ouverture',
            ),
        ));
        $this->add(array(
            'name' => 'RensOuvrUnit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Ouverture par',
                'empty_option' => '',
                'value_options' => $this->RensOuvrUnit,
            )
        ));
        $this->add(array(
            'name' => 'RensSuiv',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Suivi par',
                'empty_option' => '',
                'value_options' => $this->RensOuvrUnit,
            )
        ));
        $this->add(array(
            'name' => 'RensSui2',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Et',
                'empty_option' => '',
                'value_options' => $this->RensOuvrUnit,
            )
        ));
        $this->add(array(
            'name' => 'RensLoca',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => "Localité de residence",
                'value_options' => $this->RensLoca,
            )
        ));
        $this->add(array(
            'name' => 'RensProv',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => "Localité de provenance",
                'value_options' => $this->RensLoca,
            )
        ));
        $this->add(array(
            'name' => 'RensQuar',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Quartier',
                'empty_option' => '',
                'value_options' => array(
                    'M.' => 'Masculin',
                    'Mme' => 'Féminin',
                ),
                'value_options' => $this->RensQuar,
            )
        ));
        $this->add(array(
            'name' => 'RensAdre',
            'attributes' => array(
                'type' => 'Zend\Form\Element\Textarea',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Adresse',
            ),
        ));
        $this->add(array(
            'name' => 'RensTel_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Teléphone',
            ),
        ));
        $this->add(array(
            'name' => 'RensVoya',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'RensVoya',
            ),
            'options' => array(
                'label' => 'En voyage',
            ),
        ));
        $this->add(array(
            'name' => 'RensNon_Suiv',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'RensNon_Suiv',
            ),
            'options' => array(
                'label' => 'Non suivi',
            ),
        ));
        $this->add(array(
            'name' => 'RensNon_SuivDat_',
             'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Depuis le',
            ),
        ));
        $this->add(array(
            'name' => 'RensDeceDat_',
             'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'RensDeceDat_',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date de décès',
            ),
        ));
        $this->add(array(
            'name' => 'RensDeceCaus',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Cause',
                'empty_option' => '',
                'value_options' => $this->RensDeceCaus,
            )
        ));
        $this->add(array(
            'name' => 'RensDoub',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Doublon du n°',
            ),
        ));
        $this->add(array(
            'name' => 'RensNaisLieu',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Lieu de naissance',
            ),
        ));
        $this->add(array(
            'name' => 'RensNati',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Nationalité',
                'empty_option' => '',
                'value_options' => $this->RensNati,
            )
        ));
        $this->add(array(
            'name' => 'RensMatr',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Situation matrimoniale',
                'empty_option' => '',
                'value_options' => $this->RensMatr,
            )
        ));
        $this->add(array(
            'name' => 'RensOev_Etab',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Etablissement scolaire',
            ),
        ));
        $this->add(array(
            'name' => 'RensProf',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Profession',
                'empty_option' => '',
                'value_options' => $this->RensProf,
            )
        ));
        $this->add(array(
            'name' => 'RensProfPrec',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Préciser',
            ),
        ));
        $this->add(array(
            'name' => 'RensEtud',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Niveau d\'études',
                'empty_option' => '',
                'value_options' => $this->RensEtud,
            )
        ));
        $this->add(array(
            'name' => 'RensOev_Sani',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Situation sanitaire',
                'empty_option' => '',
                'value_options' => $this->RensOev_Sani,
            )
        ));
        $this->add(array(
            'name' => 'RensOev_Type',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Type d\'OEV',
                'empty_option' => '',
                'value_options' => $this->RensOev_Type,
            )
        ));
        $this->add(array(
            'name' => 'RensIarvDat_',
             'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date d\'inclusion IAARV',
            ),
        ));
        $this->add(array(
            'name' => 'RensIarvNume',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'N° IAARV',
            ),
        ));
        $this->add(array(
            'name' => 'RensPtmeNume',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'N° PTME',
            ),
        ));
        $this->add(array(
            'name' => 'RensChrg',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Prise en charge',
                'empty_option' => '',
                'value_options' => $this->RensChrg,
            )
        ));
        $this->add(array(
            'name' => 'RensVar0',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Variable libre 1',
            ),
        ));
        $this->add(array(
            'name' => 'RensVar1',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Variable libre 2',
            ),
        ));
        $this->add(array(
            'name' => 'Postit__',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Postit__',
                
            ),
            'options' => array(
                'label' => 'Postit',
            ),
        ));
    }

    public function getInputFilterSpecification() {

        return array(
            'RensNom_' => array(
                'required' => true,
            ),
            'RensNaisDat_' => array(
                'required' => false,
            ),
            'RensSexe' => array(
                'required' => true,
            ),
            'RensOuvrUnit' => array(
                'required' => false,
            ),
            'RensSuiv' => array(
                'required' => false,
            ),
            'RensSui2' => array(
                'required' => false,
            ),
            'RensLoca' => array(
                'required' => false,
            ),
            'RensQuar' => array(
                'required' => false,
            ),
            'RensDeceCaus' => array(
                'required' => false,
            ),
            'RensNati' => array(
                'required' => false,
            ),
            'RensMatr' => array(
                'required' => false,
            ),
            'RensProf' => array(
                'required' => false,
            ),
            'RensEtud' => array(
                'required' => false,
            ),
            'RensOev_Sani' => array(
                'required' => false,
            ),
            'RensOev_Type' => array(
                'required' => false,
            ),
            'RensChrg' => array(
                'required' => false,
            ),
        );
    }

}
