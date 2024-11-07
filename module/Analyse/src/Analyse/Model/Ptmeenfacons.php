<?php

namespace Analyse\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Ptmeenfacons implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
    public $Alla;
    public $Cli0;
    public $Cli1;
    public $Dat_;
    public $Doss;
    public $Enfa;
    public $Gros;
    public $Moti;
    public $MotiCase;
    public $Poid;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = (isset($data['Nume'])) ? $data['Nume'] : NULL;
		$this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
		$this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
		$this->Alla = (isset($data['Alla'])) ? $data['Alla'] : NULL;
		$this->Cli0 = (isset($data['Cli0'])) ? $data['Cli0'] : NULL;
		$this->Cli1 = (isset($data['Cli1'])) ? $data['Cli1'] : NULL;
		$this->Dat_ = (isset($data['Dat_'])) ? $data['Dat_'] : NULL;
		$this->Doss = (isset($data['Doss'])) ? $data['Doss'] : NULL;
		$this->Enfa = (isset($data['Enfa'])) ? $data['Enfa'] : NULL;
		$this->Gros = (isset($data['Gros'])) ? $data['Gros'] : NULL;
		$this->Moti = (isset($data['Moti'])) ? $data['Moti'] : NULL;
		$this->MotiCase = (isset($data['MotiCase'])) ? $data['MotiCase'] : NULL;
		$this->Poid = (isset($data['Poid'])) ? $data['Poid'] : NULL;
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
