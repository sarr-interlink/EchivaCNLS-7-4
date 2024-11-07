<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\InputFilter\InputFilter;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class RefForm extends Form implements InputFilterProviderInterface{


    public function __construct() {
// we want to ignore the name passed
        parent::__construct('');
        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'Ref_doss',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control ',
                'id' => 'Ref_doss',
            ),
            'options' => array(
                'label' => 'N° Dossier',
            ),
        ));
    }

    public function getInputFilterSpecification() {
    return array(
            'Ref_doss' => array(
                'required' => false,
        )
            );
    }

}
