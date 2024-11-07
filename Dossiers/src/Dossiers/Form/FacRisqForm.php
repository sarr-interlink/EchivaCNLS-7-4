<?php

namespace Dossiers\Form;

use Zend\Form\Form;

class FacRisqForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('accueil');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
        $this->add(array(
            'name' => 'MediRisqMultfactrisque',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'MediRisqMultfactrisque',
            ),
            'options' => array(
                'label' => 'Multipartenariat',
            ),
        ));

        $this->add(array(
            'name' => 'MediRisqOccaMultfactrisque',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'MediRisqOccaMultfactrisque',
            ),
            'options' => array(
                'label' => 'Partenaire occas.',
            ),
        ));

        $this->add(array(
            'name' => 'MediRisqPolyMultfactrisque',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'MediRisqPolyMultfactrisque',
            ),
            'options' => array(
                'label' => 'Polygamie',
            ),
        ));

        $this->add(array(
            'name' => 'MediRisqPartMultfactrisque',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'MediRisqPartMultfactrisque',
            ),
            'options' => array(
                'label' => 'Partenaire VIH+',
            ),
        ));

        $this->add(array(
            'name' => 'MediRisqHomoMultfactrisque',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'MediRisqHomoMultfactrisque',
            ),
            'options' => array(
                'label' => 'Rapports homo.',
            ),
        ));

        $this->add(array(
            'name' => 'MediRisqTranMultfactrisque',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'MediRisqTranMultfactrisque',
            ),
            'options' => array(
                'label' => 'Transfusion',
            ),
        ));

        $this->add(array(
            'name' => 'MediRisqScarMultfactrisque',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'MediRisqScarMultfactrisque',
            ),
            'options' => array(
                'label' => 'Scarification',
            ),
        ));

        $this->add(array(
            'name' => 'MediRisqPiquMultfactrisque',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'MediRisqPiquMultfactrisque',
            ),
            'options' => array(
                'label' => 'Piqûre accid.',
            ),
        ));

        $this->add(array(
            'name' => 'MediRisqMereMultfactrisque',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'MediRisqMereMultfactrisque',
            ),
            'options' => array(
                'label' => 'Mère VIH+',
            ),
        ));
        $this->add(array(
            'name' => 'MediRisqPresMultfactrisque',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
				'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'MediRisqPresMultfactrisque',
            ),
            'options' => array(
                'label' => 'Utilisation du préservatif',
                'empty_option' => '',
                'value_options' => array(
                    'Toujours' => 'Toujours',
                    'Souvent' => 'Souvent',
                    'Rarement' => 'Rarement',
                    'Jamais' => 'Jamais',
                ),
            )
        ));
        $this->add(array(
            'name' => 'CloseFacRisq',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Fermer',
                'class' => 'btn btn-success',
                'data-dismiss' => 'modal',
                'id' => 'CloseFacRisq',
            ),
            'options' => array(
                'label' => 'Fermer',
            ),
        ));
        /**/
    }

}
