<?php

namespace Dossiers\Form;

use Zend\Form\Form;

class IntolForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {

        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'Arv_IntoCase',
            'options' => array(
                'label' => '',
                'value_options' => array(
                    'Eruption cutanée' => 'Eruption cutanée',
                    'Anémie' => 'Anémie',
                    'Hépatite cytolytique' => 'Hépatite cytolytique',
                    'Neuropathie périphérique' => 'Neuropathie périphérique',
                    'Nausées/vomissements' => 'Nausées/vomissements',
                    'Diarrhée' => 'Diarrhée',
                    'Pancréatite' => 'Pancréatite',
                    'Trouble neuro-sensoriels' => 'Trouble neuro-sensoriels',
                    'Acidose lactique' => 'Acidose lactique',
                    'Colique néphrétique' => 'Colique néphrétique',
                    'Lypodystrophie' => 'Lypodystrophie',
                    'Fatigue' => 'Fatigue',
                ),
            )
        ));
        $this->add(array(
            'name' => 'submitintol',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Fermer',
                'class' => 'btn btn-primary',
                'data-dismiss' => 'modal',
                'id' => 'submitintol',
            ),
            'options' => array(
                'label' => 'Fermer',
            ),
        ));
    }

}
