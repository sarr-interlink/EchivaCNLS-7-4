<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class SocialautreForm extends Fieldset implements InputFilterProviderInterface {

    public $SociAutrCommActi;
    public $SociAutrNutrFreq;
    public $SociAutrNutrComp;
    public $SociAutrEconProf;
    public $SociAutrEconNive;
    public $SociAutrResiStat;
    public $SociAutrHabiQual;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('accueil');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
        $this->add(array(
            'name' => 'SociAutrCommParo',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'SociAutrCommParo',
            ),
            'options' => array(
                'label' => 'Groupe de parole',
            ),
        ));
        $this->add(array(
            'name' => 'SociAutrCommActi',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Activité',
                'empty_option' => '',
                'value_options' => $this->SociAutrCommActi,
            )
        ));
        $this->add(array(
            'name' => 'SociAutrNutrFreq',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Fréquence',
                'empty_option' => '',
                'value_options' => $this->SociAutrNutrFreq,
            )
        ));
        $this->add(array(
            'name' => 'SociAutrNutrComp',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Composition',
                'empty_option' => '',
                'value_options' => $this->SociAutrNutrComp,
            )
        ));
        $this->add(array(
            'name' => 'SociAutrNutrAide',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'SociAutrNutrAide',
            ),
            'options' => array(
                'label' => 'Aide alimentaire',
            ),
        ));
        $this->add(array(
            'name' => 'SociAutrEconProf',  
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Profil social',
                'empty_option' => '',
                'value_options' => $this->SociAutrEconProf,
            )
        ));
        $this->add(array(
            'name' => 'SociAutrEconNive', 
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Niveau socio-éco.',
                'empty_option' => '',
                'value_options' => $this->SociAutrEconNive,
            )
        ));
        $this->add(array(
            'name' => 'SociAutrResiStat', 
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Statut de résidence',
                'empty_option' => '',
                'value_options' => $this->SociAutrResiStat,
            )
        ));
        $this->add(array(
            'name' => 'SociAutrHabiQual',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => "Qualité de l'habitat",
                'empty_option' => '',
                'value_options' => $this->SociAutrHabiQual,
            )
        ));
        $this->add(array(
            'name' => 'SociAutrEconEau_',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'SociAutrEconEau_',
            ),
            'options' => array(
                'label' => 'Eau',
            ),
        ));
        $this->add(array(
            'name' => 'SociAutrEconElec',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'SociAutrEconElec',
            ),
            'options' => array(
                'label' => 'Electricité',
            ),
        ));
        $this->add(array(
            'name' => 'SociAutrEconLatr',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'SociAutrEconLatr',
            ),
            'options' => array(
                'label' => 'Latrine',
            ),
        ));
        $this->add(array(
            'name' => 'SociAutrEconRefr',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'SociAutrEconRefr',
            ),
            'options' => array(
                'label' => 'Réfrigérateur',
            ),
        ));
        $this->add(array(
            'name' => 'SociAutrAgr_Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date',
            ),
        ));
        $this->add(array(
            'name' => 'SociAutrAgr_Mont',
            'attributes' => array(
                'type' => 'nombre',
                'class' => 'form-control',
                'min' => '0',
            ),
            'options' => array(
                'label' => 'Montant',
            ),
        ));
        $this->add(array(
            'name' => 'SociAutrAgr_Suiv',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Suivi',
            ),
        ));
        /**/
    }

    public function getInputFilterSpecification() {
        return array(
        'SociAutrCommActi' => array(
        'required' => false,
        ),
        'SociAutrNutrFreq' => array(
        'required' => false,
        ),
        'SociAutrNutrComp' => array(
        'required' => false,
        ),
        'SociAutrEconProf' => array(
        'required' => false,
        ),
        'SociAutrEconNive' => array(
        'required' => false,
        ),
        'SociAutrResiStat' => array(
        'required' => false,
        ),
        'SociAutrHabiQual' => array(
        'required' => false,
        ),
        );
    }

}
