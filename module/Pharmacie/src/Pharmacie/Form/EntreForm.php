<?php

namespace Pharmacie\Form;

use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;

use Pharmacie\Form\ProdForm;

class EntreForm extends Form implements InputFilterProviderInterface {

    public $Prov;
    public $Fabr;
    public $Chrg;
    public $Prod;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('pharmacie');
        $this->setAttribute('method', 'post');
         $prodform = new ProdForm();
        $prodform->setName('ProdForm');
        $this->add($prodform);
    }

    public function initialise() {
        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'text',
            ),
        ));
        
          $this->add(array(
            'name' => 'Prod',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
                'id' => 'Prod',
				'required' => 'required',
            ),
            'options' => array(
                'label' => 'Produit',
                'empty_option' => '',
                'value_options' => $this->Prod,
            )
        ));
        $this->add(array(
            'name' => 'Lot_',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
				'required' => 'required',
				
            ),
            'options' => array(
                'label' => 'N° de lot',
            ),
        ));
         $this->add(array(
            'name' => 'Expi',
             'attributes' => array(
               'type' => 'date',
                'class' => 'form-control',
				'min' => '2004-01-01',
                'max' => '2045-01-01',
                 'required' => 'required',
		 ),
            'options' => array(
                'label' => 'Date de péremption',
            ),
        ));
         /*$this->add(array(
            'name' => 'Expi_moi',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
				'required' => 'required',
            ),
            'options' => array(
                'label' => 'Date de péremption',
                'empty_option' => '',
                'value_options' => array(
                    '01' => '01 - janvier',
                    '02' => '02 - févier',
                    '03' => '03 - mars',
                    '04' => '04 - avril',
                    '05' => '05 - mai',
                    '06' => '06 - juin',
                    '07' => '07 - juillet',
                    '08' => '08 - aout',
                    '09' => '09 - septembre',
                    '10' => '10 - octobre',
                    '11' => '11 - novembre',
                    '12' => '12 - decembre',
                ),
            )
        ));
          $this->add(array(
            'name' => 'Expi_annee',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
				'required' => 'required',
            ),
            'options' => array(
                'empty_option' => '',
                'value_options' => array(
                    '2005' => '2005',
                    '2006' => '2006',
                    '2007' => '2007',
                    '2008' => '2008',
                    '2009' => '2009',
                    '2010' => '2010',
                    '2011' => '2011',
                    '2012' => '2012',
                    '2013' => '2013',
                    '2014' => '2014',
                    '2015' => '2015',
                    '2016' => '2016',
                    '2017' => '2017',
                    '2018' => '2018',
                    '2019' => '2019',
                    '2020' => '2020',
                    '2021' => '2021',
                    '2022' => '2022',
                    '2023' => '2023',
                    '2024' => '2024',
                    '2025' => '2025',
                    '2026' => '2026',
                    '2027' => '2027',
                    '2028' => '2028',
                    '2029' => '2029',
                    '2030' => '2030',
                ),
            )
        ));*/
        $this->add(array(
            'name' => 'NombBoit',
            'attributes' => array(
                'type' => 'number',
                'class' => 'form-control',
				'min' =>'0',
				'required'=>'required'
            ),
            'options' => array(
                'label' => "Nombre d'unité",
            ),
        ));
         $this->add(array(
            'name' => 'Prov',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true',
				'required' => 'required',
            ),
            'options' => array(
                'label' => 'Provenance',
                'empty_option' => '',
                'value_options' => $this->Prov,
            )
        ));
          $this->add(array(
            'name' => 'Fabr',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true'
            ),
            'options' => array(
                'label' => 'Fabricant',
                'empty_option' => '',
                'value_options' => $this->Fabr,
            )
        ));
           $this->add(array(
            'name' => 'Chrg',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search'=>'true'
            ),
            'options' => array(
                'label' => 'Prise en charge',
                'empty_option' => '',
                'value_options' => $this->Chrg,
            )
        ));
        $this->add(array(
            'name' => 'Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
				'value' => date('Y-m-d'),
                ),
            'options' => array(
                'label' => 'Date d\'entrée',
            ),
        ));
         $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Valider l\'entrée',
                'class' => 'btn btn-success',
            ),
            'options' => array(
                'label' => 'val',
            ),
        ));
        $this->add(array(
            'name' => 'rest',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Annuler',
                'class' => 'btn btn-sm btn-default',
                'data-dismiss' => "modal",
                'aria-label' => "Close"
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
