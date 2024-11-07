<?php

namespace Communaute\Form;

use Zend\Form\Form;

class DossForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('DossForm');
        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'Commhidden',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Commhidden',
            ),
        ));
		$this->add(array(
            'name' => 'Except_doss',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'Except_doss',
            ),
            'options' => array(
                'label' => 'Exception',
            ),
        ));
        $this->add(array(
            'name' => 'Ref_doss',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Ref_doss',
            ),
            'options' => array(
                'label' => 'N° dossier',
            ),
        ));
        $this->add(array(
            'name' => 'Motif',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Motif',
            ),
            'options' => array(
                'label' => 'Motif',
            ),
        ));
    }

}
