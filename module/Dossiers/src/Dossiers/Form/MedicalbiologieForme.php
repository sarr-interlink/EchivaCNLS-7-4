<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class MedicalbiologieForm extends Fieldset implements InputFilterProviderInterface {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }
    public function initialise(){
       
        /**/
        $this->add(array(
            /* le contenu se trouve dans la table entr */
            'name' => 'InitAffichEntr',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Afficher',
                'class' => 'btn btn-success',
            ),
        ));
        $this->add(array(
            'name' => 'AjoutEntr',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Ajouter',
                'class' => 'btn btn-success',
            ),
        ));
        $this->add(array(
            'name' => 'ListEntr',
            'type' => 'Select',
            'attributes' => array(
                'multiple' => 'multiple',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => '',
                'value_options' => array(
                    '' => 'Affiche labo desi',),
            )
        ));

		
       /**/

    }

    public function getInputFilterSpecification() {
         return array(
            'ListEntr' => array(
                'required' => false,
            ),
            'Ptme' => array(
                'required' => false,
            ),
    );
    }

}
