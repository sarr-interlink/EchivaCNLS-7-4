<?php

namespace ZfcUser\Form;

use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;

class Base extends ProvidesEventsForm {

    public function __construct() {
        parent::__construct();

        $this->add(array(
            'name' => 'username',
            'options' => array(
                'label' => 'Identifiant',
            ),
            'attributes' => array(
                'type' => 'text',
                'placeholder' => 'Identifiant',
                'class' => 'form-control',
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'type' => 'email',
                'placeholder' => 'Email',
                'class' => 'form-control',
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'display_name',
            'options' => array(
                'label' => 'Nom et Prénom',
            ),
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'placeholder' => 'Nom et Prénom',
                'required' => 'required',
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'password',
            'options' => array(
                'label' => 'Mot de passe',
            ),
            'attributes' => array(
                'type' => 'password',
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Mot de passe',
            ),
        ));

        $this->add(array(
            'name' => 'passwordVerify',
            'type' => 'password',
            'options' => array(
                'label' => 'Vérification du mot de passe',
            ),
            'attributes' => array(
                'type' => 'password',
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => 'Vérification du Mot de passe',
            ),
        ));

        $this->add(array(
            'type' => 'select',
            'name' => 'profil',
            'options' => array(
                'label' => 'Profils',
            ),
            'attributes' => array(
                'multiple' => 'multiple',
                'required' => 'required',
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true',
            ),
        ));
        $this->add(array(
            'type' => 'select',
            'name' => 'centre',
            'options' => array(
                'label' => 'Centre',
            ),
            'attributes' => array(
                'required' => 'required',
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true',
            ),
        ));

        $submitElement = new Element\Button('submit');
        $submitElement
                ->setLabel('Submit')
                ->setAttributes(array(
                    'type' => 'submit',
                    'class' => 'center btn btn-primary btn-lg btn-block',
                    'data-dismiss' => 'modal'
        ));

        $this->add($submitElement, array(
            'priority' => -100,
        ));

        $this->add(array(
            'name' => 'userId',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'type' => 'hidden'
            ),
        ));

        // @TODO: Fix this... getValidator() is a protected method.
        //$csrf = new Element\Csrf('csrf');
        //$csrf->getValidator()->setTimeout($this->getRegistrationOptions()->getUserFormTimeout());
        //$this->add($csrf);

        $this->getEventManager()->trigger('init', $this);
    }

    public function init() {
        
    }

}
