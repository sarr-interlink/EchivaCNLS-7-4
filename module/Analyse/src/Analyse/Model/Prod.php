<?php

namespace Analyse\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Prod implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
    public $Cont;
    public $Dci_;
    public $Dci_Desi;
    public $Dosa;
    public $DosaDesi;
    public $Gale;
    public $GaleDesi;
    public $Marq;
    public $Nomb;
    public $Prix;
    public $Typ_;
    public $Unit;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = (isset($data['Nume'])) ? $data['Nume'] : NULL;
		$this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
		$this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
		$this->Cont = (isset($data['Cont'])) ? $data['Cont'] : NULL;
		$this->Dci_ = (isset($data['Dci_'])) ? $data['Dci_'] : NULL;
		$this->Dci_Desi = (isset($data['Dci_Desi'])) ? $data['Dci_Desi'] : NULL;
		$this->Dosa = (isset($data['Dosa'])) ? $data['Dosa'] : NULL;
		$this->DosaDesi = (isset($data['DosaDesi'])) ? $data['DosaDesi'] : NULL;
		$this->Gale = (isset($data['Gale'])) ? $data['Gale'] : NULL;
		$this->GaleDesi = (isset($data['GaleDesi'])) ? $data['GaleDesi'] : NULL;
		$this->Marq = (isset($data['Marq'])) ? $data['Marq'] : NULL;
		$this->Nomb = (isset($data['Nomb'])) ? $data['Nomb'] : NULL;
		$this->Prix = (isset($data['Prix'])) ? $data['Prix'] : NULL;
		$this->Typ_ = (isset($data['Typ_'])) ? $data['Typ_'] : NULL;
		$this->Unit = (isset($data['Unit'])) ? $data['Unit'] : NULL;
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
