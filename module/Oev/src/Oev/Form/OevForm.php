<?php

namespace Oev\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class OevForm extends Form implements InputFilterProviderInterface {

    public $Sani;
    public $Scol;
    public $Diff;

    public function __construct() {
// we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'text',
            ),
        ));
        $this->add(array(
            'name' => 'Ref_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'readonly' => 'readonly',
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
                'id' => 'Nom_',
                'required' => 'required',
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
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Prénoms',
            ),
        ));
        $this->add(array(
            'name' => 'Nais',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
                'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date de naissance',
            ),
        ));
        $this->add(array(
            'name' => 'Age_',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
                'min' => '0',
                'max' => '120',
                'required' => 'required',
            ),
            'options' => array(
                'label' => 'Age',
            ),
        ));
        $this->add(array(
            'name' => 'Sexe',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
                'value' => '1',
            ),
            'options' => array(
                'label' => 'Sexe',
                'value_options' => array(
                    '1' => 'Masculin',
                    '2' => 'Féminin',
                ),
            )
        ));
        $this->add(array(
            'name' => 'PereRef_',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
                'min' => '0',
            ),
            'options' => array(
                'label' => 'N° Dossier du père',
            ),
        ));
        $this->add(array(
            'name' => 'PereDece',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'décédé',
            ),
        ));
        $this->add(array(
            'name' => 'MereRef_',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
                'min' => '0',
            ),
            'options' => array(
                'label' => 'N° Dossier de la mère',
            ),
        ));
        $this->add(array(
            'name' => 'MereDece',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'décédée',
            ),
        ));
        $this->add(array(
            'name' => 'Sani',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true',
            ),
            'options' => array(
                'label' => 'Situation sanitaire',
                'empty_option' => '',
                'value_options' => $this->Sani,
            )
        ));
        $this->add(array(
            'name' => 'Scol',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true',
            ),
            'options' => array(
                'label' => 'Scolarité/formation',
                'empty_option' => '',
                'value_options' => $this->Scol,
            )
        ));
        $this->add(array(
            'name' => 'Diff',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true',
            ),
            'options' => array(
                'label' => 'Difficultés',
                'empty_option' => '',
                'value_options' => $this->Diff,
            )
        ));
        $this->add(array(
            'name' => 'Nota',
            'attributes' => array(
                'type' => 'Zend\Form\Element\Textarea',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Commentaire',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Valider',
                'class' => 'btn btn-primary',
            ),
            'options' => array(
                'label' => 'Valider',
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

    public function getInputFilterSpecification() {
        return array(
            'nume' => array(
                'required' => false,
            )
        );
    }

}
