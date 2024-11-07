<?php

namespace Accueil\Form;

use Zend\Form\Form;

class AccueilForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('accueil');

        $this->setAttribute('method', 'post');
        $this->setInputFilter($filter = new \Zend\InputFilter\InputFilter());

        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'Cta_Nume',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
              /*  'min' => '1',
                'max' => '999999',*/
            ),
            'options' => array(
                'label' => 'N° Dossier',
            ),
        ));

        $this->add(array(
            'name' => 'Nom_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Nom',
            ),
        ));

        $this->add(array(
            'name' => 'Pnom',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Prénoms',
            ),
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'Prec',
            'attributes' => array(
                'multiple' => 'multiple',
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Examen biologique',
                'empty_option' => '',
            )
        ));

        $filter->add(array(
            'name' => 'Prec',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'Moti',
            'attributes' => array(
                'multiple' => 'multiple',
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Motif',
                'empty_option' => '',
            )
        ));

        $filter->add(array(
            'name' => 'Moti',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Sexe',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'primary',
                'value' => 'M.'
            ),
            'options' => array(
                'label' => 'Sexe',
                'value_options' => array(
                    'M.' => 'Masculin',
                    'Mme' => 'Féminin',
                ),
            )
        ));

        
        $this->add(array(
            'name' => 'Prsc',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Prescripteur',
            ),
        ));

        $this->add(array(
            'name' => 'ExteNume',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'N° externe ou dépistage',
            ),
        ));

        $this->add(array(
            'name' => 'Age_',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
                'min' => '1',
                'max' => '150',
            ),
            'options' => array(
                'label' => 'Âge',
            ),
        ));

        $filter->add(array(
            'name' => 'Age_',
            'required' => false,
            'allow_empty' => false,
        ));
		
	$this->add(array(
            'name' => 'ArriHoro',
            'attributes' => array(
                'type' => 'datetime-local',
                'class' => 'form-control',
                'value' => date('Y-m-d\TH:i'),
            ),
            'options' => array(
                'label' => 'Date',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Valider',
                'class' => 'btn btn-success',
            ),
        ));
        $this->add(array(
            'name' => 'rest',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Annuler',
                'class' => 'btn btn-default',
                'data-dismiss' => "modal",
                'aria-label' => "Close"
            )
        ));
    }

}
