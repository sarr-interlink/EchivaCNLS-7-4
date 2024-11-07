<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class SocialsocialForm extends Fieldset implements InputFilterProviderInterface {

    public $Concsocial;
    public $Motifsocial;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('SocialsocialForm');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {

        $this->add(array(
            'name' => 'subFormSocialSocialhidden',
            'attributes' => array(
                'type' => 'text',
                'id' => 'subFormSocialSocialhidden',
            ),
        ));
        //gestion rdv
         $this->add(array(
            'name' => 'subFormRdvhidden',
            'attributes' => array(
                'type' => 'text',
                'id' => 'subFormRdvhidden',
            ),
        ));
        $this->add(array(
            'name' => 'Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'Dat_soci',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date',
            ),
        ));
        $this->add(array(
            'name' => 'Acte',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Acte',
            ),
            'options' => array(
                'label' => 'Acte',
                'value_options' => array(
                    '1' => array(
                        'label' => 'Consultation sociale',
                        'value' => 1,
                        'attributes' => array(
                            'id' => 'concsocial',
                        ),
                    ),
                    '2' => array(
                        'label' => 'Visite à domicile',
                        'value' => 2,
                        'attributes' => array(
                            'id' => 'visdom',
                        ),
                    ),
                    '3' => array(
                        'label' => "Visite à l\'hôpital",
                        'value' => 3,
                        'attributes' => array(
                            'id' => 'vishop',
                        ),
                    ),
                ),
            )
        ));
        $this->add(array(
            'name' => 'Moti',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Moti_soci',
            ),
            'options' => array(
                'label' => 'Motif',
                'empty_option' => ' ',
                'value_options' => $this->Motifsocial,
            )
        ));
        $this->add(array(
            'name' => 'Conc',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Conc_soci',
            ),
            'options' => array(
                'label' => 'Conclusion',
                'empty_option' => ' ',
                'value_options' => $this->Concsocial,
            )
        ));
        $this->add(array(
            'name' => 'Nota',
            'attributes' => array(
                'type' => 'Zend\Form\Element\Textarea',
                'class' => 'form-control',
                'id' => 'Nota_soci',
            ),
            'options' => array(
                'label' => 'Commentaire',
            ),
        ));
       $this->add(array(
            'name' => 'addsoci',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Ajouter',
                'id' => 'addsoci',
                'class' => 'btn btn-success',
            ),
            'options' => array(
                'label' => 'Ajouter',
            ),
        ));
    }

    public function getInputFilterSpecification() {
        return array(
            'Listsocicons' => array(
                'required' => false,
            ),
            'Dat_' => array(
                'required' => false,
            ),
            'Acte' => array(
                'required' => false,
            ),
            'Moti' => array(
                'required' => false,
            ),
            'Conc' => array(
                'required' => false,
            ),
        );
    }

}
