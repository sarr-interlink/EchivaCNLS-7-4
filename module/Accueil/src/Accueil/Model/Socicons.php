<?php

namespace Accueil\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Socicons implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
    public $Acte;
    public $ActeDesi;
    public $Conc;
    public $Dat_;
    public $Doss;
    public $Moti;
    public $Nota;
    protected $inputFilter;

    public function exchangeArray($data) {
		$this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
		$this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
		$this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
		$this->Acte = (isset($data['Acte'])) ? $data['Acte'] : NULL;
		$this->ActeDesi = (isset($data['ActeDesi'])) ? $data['ActeDesi'] : NULL;
		$this->Conc = (isset($data['Conc'])) ? $data['Conc'] : NULL;
		$this->Dat_ = (isset($data['Dat_'])) ? $data['Dat_'] : NULL;
		$this->Doss = (isset($data['Doss'])) ? $data['Doss'] : NULL;
		$this->Moti = (isset($data['Moti'])) ? $data['Moti'] : NULL;
		$this->Nota = (isset($data['Nota'])) ? $data['Nota'] : NULL;
		
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
