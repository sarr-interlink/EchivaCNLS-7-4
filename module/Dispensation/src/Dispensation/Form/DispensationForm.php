<?php

namespace Dispensation\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Dispensation\Form\DispensationForm;

class DispensationForm extends Form implements InputFilterProviderInterface {

    public function __construct() {
// we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'text',
				'id' => 'Nume',
            ),
        ));
        
$this->add(array(
            'name' => 'Prod',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
        ));
$this->add(array(
            'name' => 'Ref_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
    
            'options' => array(
                'label' => 'N° dossier',
            ),
        ));
$this->add(array(
            'name' => 'Fabr',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
        ));
$this->add(array(
            'name' => 'Stoc',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'stoc',
            ),
        ));
$this->add(array(
            'name' => 'Obsehidden',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Obsehidden',
            ),
        ));
$this->add(array(
            'name' => 'Mediconshidden',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Mediconshidden',
            ),
        ));
$this->add(array(
            'name' => 'Itemhidden',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Itemhidden',
            ),
        ));

$this->add(array(
            'name' => 'Doss',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'N° dossier',
            ),
        ));
$this->add(array(
            'name' => 'Afftype',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Afftype',
                'value' => '1',
            ),
            'options' => array(
                'label' => 'Stock',
                'value_options' => array(
                    '1' => 'Medicaments',
                    '2' => 'Consommables',
                ),
            )
        ));
        $this->add(array(
            'name' => 'NombUnit',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
                'id' => 'NombUnit',
				'min' => '0'
            ),
            'options' => array(
                'label' => 'Nombre',
            ),
        ));
        $this->add(array(
            'name' => 'Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Dat_',
                'value' => date("Y-m-d"),
            ),
            'options' => array(
                'label' => 'Date',
            ),
        ));
        $this->add(array(
            'name' => 'delivrer',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Délivrer',
                'class' => 'btn btn-success',
            ),
            'options' => array(
                'label' => 'val',
            ),
        ));
        $this->add(array(
            'name' => 'observance',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Observance',
                'class' => 'btn btn-success',
            ),
            'options' => array(
                'label' => 'val',
            ),
        ));
        $this->add(array(
            'name' => 'Nota',
            'attributes' => array(
                'type' => 'text',
                'readonly' => 'readonly',
                'class' => 'form-control',
                'id' => 'Nota',
                'rows' => '5',
            ),
            'options' => array(
                'label' => 'Médicaments délivrés',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Valider',
                'class' => 'btn btn-success',
                'id' => 'submit',
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

    public function getInputFilterSpecification() {
        return array(
            'Nume' => array(
                'required' => false,
            )
        );
    }

}
