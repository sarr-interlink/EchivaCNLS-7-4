<?php

namespace Pharmacie\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

class IndexForm extends Form implements InputFilterProviderInterface {


    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('IndexForm');
        $this->setAttribute('method', 'post');
      
      /* $this->add(array(
            'name' => 'Afftype',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Afftype',
                'value' => '1',
            ),
            'options' => array(
                'label' => 'Stock de pharmacie',
                'value_options' => array(
                    '1' => 'Medicaments courants',
                    '3' => 'ARV',
                    '2' => 'Consommables',
                    '4' => 'Laboratoire',
                ),
            )
        ));*/
    }

   public function getInputFilterSpecification() {
        return array(
            'Afftype' => array(
                'required' => false,
            )
        );
    }

}
