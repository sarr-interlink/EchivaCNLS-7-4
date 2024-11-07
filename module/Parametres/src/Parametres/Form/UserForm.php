<?php

namespace Parametres\Form;

use Zend\Form\Form;

class UserForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('user');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'user_id',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'type' => 'select',
            'name' => 'profil',
            'attributes' => array(
                'multiple' => 'multiple',
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true',
            ),
            'options' => array(
                'label' => 'Profils',
                )
        ));
    }

}
