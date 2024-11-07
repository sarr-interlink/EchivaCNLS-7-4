<?php

namespace ZfcUser\Form;

use ZfcBase\Form\ProvidesEventsForm;
use ZfcUser\Options\AuthenticationOptionsInterface;

class ChangeCentre extends ProvidesEventsForm
{
    /**
     * @var AuthenticationOptionsInterface
     */
    protected $authOptions;

    public function __construct($name, AuthenticationOptionsInterface $options)
    {
        $this->setAuthenticationOptions($options);
        parent::__construct($name);

        $this->add(array(
            'name' => 'identity',
            'options' => array(
                'label' => '',
            ),
            'attributes' => array(
                'type' => 'hidden',
                'placeholder' => 'identity',
            ),
        ));

        $this->add(array(
            'name' => 'credential',
            'type' => 'password',
            'options' => array(
                'label' => 'Current Password',
            ),
            'attributes' => array(
                'type' => 'password',
                'placeholder' => 'Mot de passe actuel',
            ),
        ));

        $this->add(array(
            'name' => 'newCredential',
            'options' => array(
                'label' => 'New Password',
            ),
            'attributes' => array(
                'type' => 'password',
                'placeholder' => 'Nouveau mot de passe',
            ),
        ));

        $this->add(array(
            'name' => 'newCredentialVerify',
            'type' => 'password',
            'options' => array(
                'label' => 'Verify New Password',
            ),
            'attributes' => array(
                'type' => 'password',
                'placeholder' => 'Vérifier le nouveau mot de passe',
            ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'value' => 'Valider',
                'type'  => 'submit',
                'class' => 'center btn btn-primary btn-lg btn-block',
            ),
        ));

        $this->getEventManager()->trigger('init', $this);
    }

    /**
     * Set Authentication-related Options
     *
     * @param AuthenticationOptionsInterface $authOptions
     * @return Login
     */
    public function setAuthenticationOptions(AuthenticationOptionsInterface $authOptions)
    {
        $this->authOptions = $authOptions;
        return $this;
    }

    /**
     * Get Authentication-related Options
     *
     * @return AuthenticationOptionsInterface
     */
    public function getAuthenticationOptions()
    {
        return $this->authOptions;
    }
}
