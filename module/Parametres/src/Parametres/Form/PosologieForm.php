<?php

namespace Parametres\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

class PosologieForm extends Form implements InputFilterProviderInterface {
    public $ArvPrsc;
    public $MedDci_;
 public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('posologie');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
        $this->add(array(
            'name' => 'PosoDefa',
            'attributes' => array(
                'type' => 'text',
                'id' => 'PosoDefa',
            ),
        ));
        
        $this->add(array(
            'name' => 'MedDci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control MedDci selectpicker',
                'data-live-search'=>'true',
                'id' => 'MedDci_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->MedDci_,
            )
        ));
        $this->add(array(
            'name' => 'MedForm',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control selectpicker',
                'data-live-search'=>'true',
                'id' => 'MedForm',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'MedNomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
				'id' => 'MedNomb',
            ),
            'options' => array(
                'label' => 'Nombre',
            ),
        ));
        $this->add(array(
            'name' => 'MedUnit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control selectpicker',
                'data-live-search'=>'true',
                'id' => 'MedUnit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Unité',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'MedFois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control selectpicker',
                'data-live-search'=>'true',
                'id' => 'MedFois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'MedDure',
            'attributes' => array(
                'type' => 'number',
				'min' => '0',
                'class' => 'MedSui form-control',
                'id' => 'MedDure',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'MedDureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control selectpicker',
                'data-live-search'=>'true',
                'id' => 'MedDureTyp_',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Type',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
		
		$this->add(array(
            'name' => 'ArvPrsc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control ArvPrsc selectpicker',
                'data-live-search'=>'true',
                'id' => 'ArvPrsc'
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->ArvPrsc,
            )
        ));
        $this->add(array(
            'name' => 'ArvForm',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control selectpicker',
                'data-live-search'=>'true',
                'id' => 'ArvForm',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'ArvNomb',
            'attributes' => array(
                'type' => 'number',
                'class' => 'MedSui form-control',
				'min' =>'0',
                'id' => 'ArvNomb',
            ),
            'options' => array(
                'label' => 'Nombre',
            ),
        ));
        $this->add(array(
            'name' => 'ArvUnit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control',
                'data-live-search'=>'true',
                'id' => 'ArvUnit',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Unité',
                'value_options' => array(
                    'cp' => 'cp',
                    'ml' => 'ml',
                ),
            )
        ));
        $this->add(array(
            'name' => 'ArvFois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'MedSui form-control selectpicker',
                'data-live-search'=>'true',
                'id' => 'ArvFois',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));
       
        
    }

     public function getInputFilterSpecification() {
        return array(
            'Afftype' => array(
                'required' => false,
            )
        );
    }
}
