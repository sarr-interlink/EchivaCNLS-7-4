<?php

namespace Pharmacie\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

use Pharmacie\Form\ProdForm;
use Pharmacie\Form\EntreForm;
use Pharmacie\Form\SortieForm;

class PharmacieForm extends Form implements InputFilterProviderInterface {

  
    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('pharmacie');
        $this->setAttribute('method', 'post');
         $entrform = new EntreForm();
        $entrform->setName('EntreForm');
        $this->add($entrform);
         $sortieform = new SortieForm();
        $sortieform->setName('SortieForm');
        $this->add($sortieform);
        $prodform = new ProdForm();
        $prodform->setName('ProdForm');
        $this->add($prodform);
    
        
    }

   
     public function getInputFilterSpecification() {
        return array(
            'Afftype' => array(
                'required' => false,
            )
        );
    }
}
