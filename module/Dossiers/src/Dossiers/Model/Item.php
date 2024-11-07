<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Item implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
    public $Chrg;
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
	public $Prov;
	public $Sour;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
        $this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
        $this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
        $this->Chrg = (isset($data['Chrg'])) ? $data['Chrg'] : NULL;
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
        $this->Prov = (isset($data['Prov'])) ? $data['Prov'] : NULL;
        $this->Sour = (isset($data['Sour'])) ? $data['Sour'] : NULL;
       
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
