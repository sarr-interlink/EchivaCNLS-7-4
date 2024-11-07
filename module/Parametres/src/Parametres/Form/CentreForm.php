<?php

namespace Parametres\Form;

use Zend\Form\Form;

class CentreForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('Profil');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'Id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        /*$this->add(array(
            'name' => 'Region',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => 'Region',
                'value_options' => array(),
            )
        ));*/
        $this->add(array(
            'name' => 'Region',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Region',
            ),
        ));
        $this->add(array(
            'name' => 'Code_region',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Code de la région',
            ),
        ));
        
        $this->add(array(
            'name' => 'Structure',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Structure de prise en charge',
            ),
        ));
        $this->add(array(
            'name' => 'Code_struct',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Code de la structure de PEC',
            ),
        ));
        $this->add(array(
            'name' => 'Prefixe',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Prefixe',
            ),
        ));
        

        
    }

}
