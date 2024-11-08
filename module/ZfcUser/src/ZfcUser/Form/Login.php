<?php

namespace ZfcUser\Form;

use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;
use ZfcUser\Options\AuthenticationOptionsInterface;

class Login extends ProvidesEventsForm {

    /**
     * @var AuthenticationOptionsInterface
     */
    protected $authOptions;

    public function __construct($name, AuthenticationOptionsInterface $options) {
        $this->setAuthenticationOptions($options);
        parent::__construct($name);

        $this->add(array(
            'type' => 'select',
            'name' => 'center',
            'options' => array(
                'label' => 'Center',
            ),
            'attributes' => array(
                'required' => 'required',
                'class' => 'land-form-control',
                'data-live-search' => 'true',
            ),
        ));


        $this->add(array(
            'name' => 'identity',
            'options' => array(
                'label' => '',
            ),
            'attributes' => array(
                'type' => 'text',
                'id' => 'userName',
                'data-length' => '5,15',
                'placeholder' => 'Identifiant Ou Email',
                'class' => 'land-form-control',
                'required' => 'required'
            ),
        ));

        $emailElement = $this->get('identity');
        $label = $emailElement->getLabel('label');
        // @TODO: make translation-friendly
        foreach ($this->getAuthenticationOptions()->getAuthIdentityFields() as $mode) {
            $label = (!empty($label) ? $label . ' or ' : '') . ucfirst($mode);
        }
        $emailElement->setLabel($label);
        //
        $this->add(array(
            'name' => 'credential',
            'type' => 'password',
            'options' => array(
                'label' => 'Password',
            ),
            'attributes' => array(
                'type' => 'password',
                'id' => 'password',
                'class' => 'land-form-control',
                'placeholder' => 'Mot de passe',
                'required' => 'required'
            ),
        ));

        // @todo: Fix this
        // 1) getValidator() is a protected method
        // 2) i don't believe the login form is actually being validated by the login action
        // (but keep in mind we don't want to show invalid username vs invalid password or
        // anything like that, it should just say "login failed" without any additional info)
        //$csrf = new Element\Csrf('csrf');
        //$csrf->getValidator()->setTimeout($options->getLoginFormTimeout());
        //$this->add($csrf);

        $submitElement = new Element\Button('submit');
        $submitElement
                ->setLabel('Se connecter')
                ->setAttributes(array(
                    'type' => 'submit',
                    'class' => 'land-btn-submit land-btn pull-right',
                    'data-dismiss' => 'modal',
        ));

        $this->add($submitElement, array(
            'priority' => -100,
        ));

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * Set Authentication-related Options
     *
     * @param AuthenticationOptionsInterface $authOptions
     * @return Login
     */
    public function setAuthenticationOptions(AuthenticationOptionsInterface $authOptions) {
        $this->authOptions = $authOptions;
        return $this;
    }

    /**
     * Get Authentication-related Options
     *
     * @return AuthenticationOptionsInterface
     */
    public function getAuthenticationOptions() {
        return $this->authOptions;
    }

}
