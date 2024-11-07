<?php

namespace Parametres\Form;

use Zend\Form\Form;

class ProfilForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('Profil');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'rid',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'role_name',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Profil',
            ),
        ));

        $this->add(array(
            'name' => 'status',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Statut',
                'value_options' => array(
                    'Active' => 'Actif',
                    'Inactive' => 'Inactif',
                ),
            )
        ));
    }

}
