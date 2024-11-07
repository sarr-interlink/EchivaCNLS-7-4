<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Fieldset;

class SocialForm extends Fieldset implements InputFilterProviderInterface {

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
	public $SociOev_Lien;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
         $this->add(array(
            'name' => 'SociRefu',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'SociRefu',
            ),
            'options' => array(
                'label' => 'Refuse les visites à domicile',
            ),
        ));
         /**/
         
         /**/
        $this->add(array(
            'name' => 'SociUrgeNom_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Nom',
            ),
        ));
		$this->add(array(
            'name' => 'SociOev_Lien',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Lien de parenté',
                'empty_option' => '',
                'value_options' => $this->SociOev_Lien,
            )
        ));
        $this->add(array(
            'name' => 'SociUrgePnom',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Prénom',
            ),
        ));


        $this->add(array(
            'name' => 'SociUrgeAdre',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Adresse',
            ),
        ));
        $this->add(array(
            'name' => 'SociUrgeTel_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Téléphone',
            ),
        ));
        $this->add(array(
            'name' => 'SociPersChrg',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'max'=>'100'
            ),
            'options' => array(
                'label' => 'Nb de personnes à charge',
            ),
        ));
        $this->add(array(
            'name' => 'SociEnfaChrg',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'max'=>'100'
            ),
            'options' => array(
                'label' => 'Nb d\'enfants à charge',
            ),
        ));
        $this->add(array(
            'name' => 'SociEnfaScol',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'max'=>'100'
            ),
            'options' => array(
                'label' => 'Nb d\'enfants scolarisés',
            ),
        ));
        $this->add(array(
            'name' => 'SociEnfaVih_',
            'attributes' => array(
               'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'max'=>'100'
            ),
            'options' => array(
                'label' => 'Nb d\'enfants infectés',
            ),
        ));
        $this->add(array(
            'name' => 'SociEnfaVih_Chrg',
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
            'name' => 'SociPersVih_',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'max'=>'100'
            ),
            'options' => array(
                'label' => 'Nb d\'adultes infectés dans la famille',
            ),
        ));
        $this->add(array(
            'name' => 'SociConjAge_',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'max'=>'120'
            ),
            'options' => array(
                'label' => 'Age',
            ),
        ));
        $this->add(array(
            'name' => 'SociConjProf',
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
            'name' => 'SociConjPrec',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Préciser',
            ),
        ));
        $this->add(array(
            'name' => 'SociConjSani',
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
            'name' => 'SociConjRef_',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'N° dossier',
            ),
        ));
        $this->add(array(
            'name' => 'SociConjVih_Chrg',
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
            'name' => 'SociFinaNom_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Nom',
            ),
        ));
        $this->add(array(
            'name' => 'SociFinaPnom',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Prénom',
            ),
        ));
        $this->add(array(
            'name' => 'SociFinaAdre',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Adresse',
            ),
        ));
        $this->add(array(
            'name' => 'SociFinaProf',
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
            'name' => 'SociFinaPrec',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Préciser',
            ),
        ));
        $this->add(array(
            'name' => 'SociFinaChrg',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'max'=>'100'
            ),
            'options' => array(
                'label' => 'Nb de pers. à charge',
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
        'SociRefu' => array(
        'required' => false,
        ),
        'SociUrgeNom_' => array(
        'required' => false,
        ),
        'SociUrgePnom' => array(
        'required' => false,
        ),
        'SociUrgeAdre' => array(
        'required' => false,
        ),
        'SociUrgeTel_' => array(
        'required' => false,
        ),
        'SociPersChrg' => array(
        'required' => false,
        ),
        'SociEnfaChrg' => array(
        'required' => false,
        ),
        'SociEnfaScol' => array(
        'required' => false,
        ),
        'SociEnfaVih_' => array(
        'required' => false,
        ),
        'SociEnfaVih_Chrg' => array(
        'required' => false,
        ),
        'SociPersVih_' => array(
        'required' => false,
        ),
        'SociConjAge_' => array(
        'required' => false,
        ),
        'SociConjProf' => array(
        'required' => false,
        ),
        'SociConjPrec' => array(
        'required' => false,
        ),
        'SociConjSani' => array(
        'required' => false,
        ),
        'SociConjRef_' => array(
        'required' => false,
        ),
        'SociConjVih_Chrg' => array(
        'required' => false,
        ),
        'SociFinaNom_' => array(
        'required' => false,
        ),
        'SociFinaPnom' => array(
        'required' => false,
        ),
        'SociFinaAdre' => array(
        'required' => false,
        ),
        'SociFinaProf' => array(
        'required' => false,
        ),
        'SociFinaPrec' => array(
        'required' => false,
        ),
        'SociFinaChrg' => array(
        'required' => false,
        ),
        );
    }

}
