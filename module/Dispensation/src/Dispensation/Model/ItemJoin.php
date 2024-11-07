<?php

namespace Dispensation\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class ItemJoin implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
    public $Dat_;
    public $Dest;
    public $Doss;
    public $Expi;
    public $Fabr;
    public $Lot_;
    public $MediCons;
    public $MediConsPrsc;
    public $NombBoit;
    public $NombUnit;
    public $Paim;
    public $Prod;
    public $Sour;
    public $count;
    public $prefixe;
    public $Dci_;
    public $Dci_Desi;
    public $Dosa;
    public $DosaDesi;
    public $Gale;
    public $GaleDesi;
    public $Designation;
    public $Typ_;
    
    /*public $prefixe;*/
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
        $this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
        $this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
        $this->Dat_ = (isset($data['Dat_'])) ? $data['Dat_'] : NULL;
        $this->Dest = (isset($data['Dest'])) ? $data['Dest'] : NULL;
        $this->Doss = (isset($data['Doss'])) ? $data['Doss'] : NULL;
        $this->Expi = (isset($data['Expi'])) ? $data['Expi'] : NULL;
        $this->Fabr = (isset($data['Fabr'])) ? $data['Fabr'] : NULL;
        $this->Lot_ = (isset($data['Lot_'])) ? $data['Lot_'] : NULL;
        $this->MediCons = (isset($data['MediCons'])) ? $data['MediCons'] : NULL;
        $this->MediConsPrsc = (isset($data['MediConsPrsc'])) ? $data['MediConsPrsc'] : NULL;
        $this->NombBoit = (isset($data['NombBoit'])) ? $data['NombBoit'] : NULL;
        $this->NombUnit = (isset($data['NombUnit'])) ? $data['NombUnit'] : NULL;
        $this->Paim = (isset($data['Paim'])) ? $data['Paim'] : NULL;
        $this->Prod = (isset($data['Prod'])) ? $data['Prod'] : NULL;
        $this->Sour = (isset($data['Sour'])) ? $data['Sour'] : NULL;
        $this->count = (isset($data['count'])) ? $data['count'] : NULL;
        $this->prefixe = (isset($data['prefixe'])) ? $data['prefixe'] : NULL;
        $this->Dci_ = (isset($data['Dci_'])) ? $data['Dci_'] : NULL;
        $this->Dci_Desi = (isset($data['Dci_Desi'])) ? $data['Dci_Desi'] : NULL;
        $this->Dosa = (isset($data['Dosa'])) ? $data['Dosa'] : NULL;
        $this->DosaDesi = (isset($data['DosaDesi'])) ? $data['DosaDesi'] : NULL;
        $this->Gale = (isset($data['Gale'])) ? $data['Gale'] : NULL;
        $this->GaleDesi = (isset($data['GaleDesi'])) ? $data['GaleDesi'] : NULL;
        $this->Designation = (isset($data['Designation'])) ? $data['Designation'] : NULL;
        $this->Typ_= (isset($data['Typ_'])) ? $data['Typ_'] : NULL;
    }

    // Add the following method:
    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name' => 'id',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'artist',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'title',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                        ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
