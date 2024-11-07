<?php

namespace Dossiers\Form;

use Zend\Form\Form;

class MotiHdjForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {

        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'motihdj',
            'options' => array(
                'label' => '4',
                'value_options' => array(
                    'Diarrhées et vomissements' => 'Diarrhées et vomissements',
                    'Altération de l’état général' => 'Altération de l’état général',
                    'Candidose buccale' => 'Candidose buccale',
                    'Anémie' => 'Anémie',
                    'Paludisme' => 'Paludisme',
                    'Fièvre intermittente' => 'Fièvre intermittente',
                    'Pneumopathies' => 'Pneumopathies',
                    'Autres' => 'Autres'
                ),
            )
        ));
    }

}
