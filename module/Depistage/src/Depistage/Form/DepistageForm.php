<?php

namespace Depistage\Form;

use Zend\Form\Form;

class DepistageForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('DepistageForm');
        $this->setAttribute('method', 'post');
        $this->setInputFilter($filter = new \Zend\InputFilter\InputFilter());

        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'Ref_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input',
                'readonly' => 'readonly',
            ),
            'options' => array(
                'label' => 'N° dépistage',
            ),
        ));

        $this->add(array(
            'name' => 'Nom_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input',
            ),
            'options' => array(
                'label' => 'Nom',
            ),
        ));

        $this->add(array(
            'name' => 'Pnom',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input',
            ),
            'options' => array(
                'label' => 'Prénoms',
            ),
        ));

        $this->add(array(
            'name' => 'Age_',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control input',
                'required' => 'required',
                'min' => '1',
                'max' => '150',
            ),
            'options' => array(
                'label' => 'Âge',
            ),
        ));

        $this->add(array(
            'name' => 'Sexe',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control input',
            ),
            'options' => array(
                'label' => 'Sexe',
                'value_options' => array(
                    '1' => 'Masculin',
                    '2' => 'Féminin',
                ),
            )
        ));

        $filter->add(array(
            'name' => 'Sexe',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Circ',
            'required' => false,
            'attributes' => array(
                'class' => 'selectpicker form-control input',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Circonstance du dépistage',
                'empty_option' => '',
            )
        ));

        $filter->add(array(
            'name' => 'Circ',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Matr',
            'required' => false,
            'attributes' => array(
                'class' => 'selectpicker form-control input',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Situation matrimoniale',
                'empty_option' => '',
            )
        ));

        $filter->add(array(
            'name' => 'Matr',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Prof',
            'required' => false,
            'attributes' => array(
                'class' => 'selectpicker form-control input',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Profession',
                'empty_option' => '',
            )
        ));

        $filter->add(array(
            'name' => 'Prof',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Nb__Chrg',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control input',
                'min' => '0',
                'max' => '99',
                'value' => 0
            ),
            'options' => array(
                'label' => 'Nb de personnes à charge',
            ),
        ));

        $this->add(array(
            'name' => 'Tel_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control input',
            ),
            'options' => array(
                'label' => 'Téléphone',
            ),
        ));

        $this->add(array(
            'name' => 'DejaSero',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control input',
            ),
            'options' => array(
                'label' => 'Déjà dépisté(e)',
                'value_options' => array(
                    '1' => 'Positive',
                    '2' => 'Négative',
                    '3' => 'Indéterminée',
                ),
            )
        ));

        $filter->add(array(
            'name' => 'DejaSero',
            'required' => false,
            'allow_empty' => true,
        ));
        $this->add(array(
            'name' => 'DejaSeroTyp_',
            'attributes' => array(
                'id' => 'DejaSeroTyp_',
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'DejaSeroTyp_select',
            'attributes' => array(
                'id' => 'DejaSeroTyp_select',
                'class' => 'selectpicker form-control input',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => ' ',
                'empty_option' => '',
                'value_options' => array(
                    '' => '',
                    'Sans précision' => 'Sans précision',
                    'VIH1' => 'VIH1',
                    'VIH2' => 'VIH2',
                    'VIH 1+2' => 'VIH 1+2',
                ),
            )
        ));

        $filter->add(array(
            'name' => 'DejaSeroTyp_select',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control input',
                'required' => 'required',
                'min' => '2004-01-01', 
                'max' => date('Y-m-d'),
                'value' => date('Y-m-d'),
            ),
            'options' => array(
                //'label' => 'Date du conseil pré-test',
                'label' => 'Conseil pré-test',
            ),
        ));

        $this->add(array(
            'name' => 'TestDat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control input',
            ),
            'options' => array(
                'label' => 'Date du prélévement',
            ),
        ));

        $this->add(array(
            'name' => 'TestSero',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control input',
            ),
            'options' => array(
                'label' => 'Sérologie',
                'value_options' => array(
                    '1' => 'Positive',
                    '2' => 'Négative',
                    '3' => 'Indéterminée',
                ),
            )
        ));

        $filter->add(array(
            'name' => 'TestSero',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'TestSeroTyp_',
            'attributes' => array(
                'class' => 'selectpicker form-control input',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => ' ',
                'empty_option' => '',
                'value_options' => array(
                    '' => '',
                    'Sans précision' => 'Sans précision',
                    'VIH1' => 'VIH1',
                    'VIH2' => 'VIH2',
                    'VIH 1+2' => 'VIH 1+2',
                ),
            )
        ));

        $filter->add(array(
            'name' => 'TestSeroTyp_',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'TestRetr',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control input',
            ),
            'options' => array(
                'label' => 'Date du retrait',
            ),
        ));

        $this->add(array(
            'name' => 'ConfDat_',
            'attributes' => array(
                'type' => 'date',
                'id' => 'ConfDat_',
                'class' => 'form-control input',
            ),
            'options' => array(
                'label' => 'Date du prélévement',
            ),
        ));

        $this->add(array(
            'name' => 'ConfSero',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control input',
            ),
            'options' => array(
                'label' => 'Sérologie',
                'value_options' => array(
                    '1' => 'Positive',
                    '2' => 'Négative',
                    '3' => 'Indéterminée',
                ),
            )
        ));

        $filter->add(array(
            'name' => 'ConfSero',
            'required' => false,
            'allow_empty' => true,
        ));

         $this->add(array(
            'name' => 'ConfSeroTyp_',
            'attributes' => array(
                'id' => 'ConfSeroTyp_',
               
            ),
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'ConfSeroTyp_select',
            'attributes' => array(
                'id' => 'ConfSeroTyp_select',
                'class' => 'selectpicker form-control input',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => ' ',
                'empty_option' => '',
                'value_options' => array(
                    '' => '',
                    'Sans précision' => 'Sans précision',
                    'VIH1' => 'VIH1',
                    'VIH2' => 'VIH2',
                    'VIH 1+2' => 'VIH 1+2',
                ),
            )
        ));

        $filter->add(array(
            'name' => 'ConfSeroTyp_select',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'ConfRetr',
            'attributes' => array(
                'type' => 'date',
                'id' => 'ConfRetr',
                'class' => 'form-control input',
            ),
            'options' => array(
                'label' => 'Date du retrait',
            ),
        ));

        $this->add(array(
            'name' => 'ObsTest',
            'attributes' => array(
                'type' => 'Textarea',
                'class' => 'form-control ',
                'rows' => 8
            ),
            'options' => array(
                'label' => 'Observation',
            ),
        ));

        $this->add(array(
            'name' => 'ObsConf',
            'attributes' => array(
                'type' => 'Textarea',
                'class' => 'form-control input',
                'rows' => 8
            ),
            'options' => array(
                'label' => 'Observation',
            ),
        ));

        $this->add(array(
            'name' => 'Observation',
            'attributes' => array(
                'type' => 'Textarea',
                'class' => 'form-control input',
                'rows' => 8
            ),
            'options' => array(
                'label' => 'Observation',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Valider',
                'class' => 'btn btn-success',
            ),
            'options' => array(
                'label' => 'val',
            ),
        ));

        $this->add(array(
            'name' => 'rest',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Annuler',
                'class' => 'btn btn-sm btn-default',
                'data-dismiss' => "modal",
                'aria-label' => "Close"
            )
        ));
    }

}
