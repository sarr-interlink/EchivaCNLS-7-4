<?php

namespace Dispensation\Form;

use Zend\Form\Form;

class ObsForm extends Form {

    public $ObseMoti;
    public $Obse;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('accueil');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {

        /**/
         $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'ObseCase_1',
             'attributes' => array(
                'class' => 'form-control',
                'id' => 'ObseCase_1',
            ),
            'options' => array(
                'label' => 'Observances',
                'value_options' => array(
                    '1' => 'Assidu aux RDV',
                    '2' => 'Comptage des comprimés OK',
                    '3' => 'Intolérances',
                ),
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'ObseCase_2',
             'attributes' => array(
                'class' => 'form-control',
                'id' => 'ObseCase_2',
            ),
            'options' => array(
                'label' => 'Education thérapeutique',
                'value_options' => array(
                    '4' => 'Fait preuve d\'interêt',
                    '5' => 'Restitue correctement la posologie',
                    '6' => 'Réagit correctement en cas de prise manquée',
                ),
            )
        ));
        $this->add(array(
            'name' => 'ObseManq',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'ObseManq',
            ),
            'options' => array(
                'label' => 'Nb prise manquées la semaine dernière',
            ),
        ));
        $this->add(array(
            'name' => 'ObseMoti',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'ObseMoti',
            ),
            'options' => array(
                'label' => 'Motif de non observance',
                'empty_option' => '',
                'value_options' => $this->ObseMoti,
            )
        ));
        $this->add(array(
            'name' => 'Obse',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Obse',
            ),
            'options' => array(
                'label' => 'Conclusion',
                'empty_option' => '',
                'value_options' => $this->Obse,
            )
        ));
        $this->add(array(
            'name' => 'ObseNota',
            'attributes' => array(
                'type' => 'textarea',
                'class' => 'form-control',
                'id' => 'ObseNota',
            ),
            'options' => array(
                'label' => 'Commentaire',
            ),
        ));
        $this->add(array(
            'name' => 'CloseObs',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Fermer',
                'class' => 'btn btn-primary',
                'data-dismiss' => 'modal',
                'id' => 'closeobs',
            ),
            'options' => array(
                'label' => 'Fermer',
            ),
        ));
        /**/
    }

}
