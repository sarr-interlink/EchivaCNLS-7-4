<?php

namespace ZfcUser\Form;

use ZfcBase\Form\ProvidesEventsForm;
use ZfcUser\Options\AuthenticationOptionsInterface;

class ChangeEmail extends ProvidesEventsForm
{
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
            ),
        ));

        $this->add(array(
            'name' => 'newIdentity',
            'options' => array(
                'label' => 'Nouveau Adresse e-mail',
            ),
            'attributes' => array(
                'type' => 'text',
                'placeholder' => 'Nouveau Adresse e-mail',
            ),
        ));

        $this->add(array(
            'name' => 'newIdentityVerify',
            'options' => array(
                'label' => 'Vérifier le nouveau Adresse e-mail',
            ),
            'attributes' => array(
                'type' => 'text',
                'placeholder' => 'Vérifier le nouveau Adresse e-mail',
            ),
        ));

        $this->add(array(
            'name' => 'credential',
            'type' => 'password',
            'options' => array(
                'label' => 'Mot de passe',
            ),
            'attributes' => array(
                'type' => 'password',
                'placeholder' => 'Mot de passe',
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
