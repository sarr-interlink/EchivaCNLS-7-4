<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class SocialenfantsForm extends Fieldset implements InputFilterProviderInterface {

    public $Sani;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('accueil');
        $this->setAttribute('method', 'post');
        
    }

    public function initialise() {
        /**/
$this->add(array(
            'name' => 'Listsocienfa',
            'type' => 'Select',
            'attributes' => array(
                'multiple' => 'multiple',
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
            ),
            'options' => array(
                'label' => ' ',
                'value_options' => array(),
            )
        ));
        $this->add(array(
            'name' => 'Ajoutsocienfa',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Ajouter',
                'class' => 'btn btn-success',
                'id' => 'Ajoutsocienfa',
            ),
        ));
 $this->add(array(
            'name' => 'subFormSocialEnfhidden',
            'attributes' => array(
                'type' => 'text',
                'id' => 'subFormSocialEnfhidden',
            ),
        ));
        $this->add(array(
            'name' => 'Pnom',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Pnomsocienfa',
            ),
            'options' => array(
                'label' => 'Prénom',
            ),
        ));
        $this->add(array(
            'name' => 'Sani',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Sanisocienfa',
            ),
            'options' => array(
                'label' => 'Situation sanitaire',
                'empty_option' => '',
                'value_options' => $this->Sani,
            )
        ));
        $this->add(array(
            'name' => 'Ref_socienfa',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Ref_socienfa',
            ),
            'options' => array(
                'label' => 'N° Dossier',
            ),
        ));

        $this->add(array(
            'name' => 'SoutSoci',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'SoutSoci',
            ),
            'options' => array(
                'label' => 'sociales',
            ),
        ));
        $this->add(array(
            'name' => 'SoutScol',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'SoutScol',
            ),
            'options' => array(
                'label' => 'scolaires',
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
        'Listsocienfa' => array(
        'required' => false,
        ),
        'Sani' => array(
        'required' => false,
        ),
        'SoutSoci' => array(
        'required' => false,
        ),
        'SoutScol' => array(
        'required' => false,
        ),
       
        );
    }

}
