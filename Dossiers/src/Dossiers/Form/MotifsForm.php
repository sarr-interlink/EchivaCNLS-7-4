<?php

namespace Dossiers\Form;

use Zend\Form\Form;

class MotifsForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {

        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'MotiCase',
            'attributes' => array(
                'id' => 'Moticase',
            ),
            'options' => array(
                'value_options' => array(
                    'Fièvre' => 'Fièvre',
                    'Diarrhée' => 'Diarrhée',
                    'Douleurs abdominales' => 'Douleurs abdominales',
                    'Douleurs anales' => 'Douleurs anales',
                    'Arthralgies' => 'Arthralgies',
                    'Toux' => 'Toux',
                    'Rhinorhée' => 'Rhinorhée',
                    'Dyspnée' => 'Dyspnée',
                    'Dysphalgie' => 'Dysphalgie',
                    'Myalgie' => 'Myalgie',
                    'Nausée' => 'Nausée',
                    'Vomissements' => 'Vomissements',
                    'Anorexie' => 'Anorexie',
                    'Altération du goût' => 'Altération du goût',
                    'Paresthésies' => 'Paresthésies',
                    'Asthénie' => 'Asthénie',
                    'Vertiges' => 'Vertiges',
                    'Céphalées' => 'Céphalées',
                    'Ulcération génitale' => 'Ulcération génitale',
                    'Déficit moteur' => 'Déficit moteur',
                    'Lésions cutanées' => 'Lésions cutanées',
                    'Prurit' => 'Prurit',
                    'Oedème memb.inf.' => 'Oedème memb.inf.',
                    'Altération état gén.' => 'Altération état gén.',
                    'Asymtomatique' => 'Asymtomatique',
                ),
            )
        ));
        $this->add(array(
            'name' => 'submitmoti',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Fermer',
                'class' => 'btn btn-success',
                'data-dismiss' => 'modal',
                'id' => 'submitmoti',
            ),
            'options' => array(
                'label' => 'Fermer',
            ),
        ));
    }

}
