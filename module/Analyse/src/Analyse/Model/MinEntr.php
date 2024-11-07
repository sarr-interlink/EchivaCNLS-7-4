<?php

namespace Analyse\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class MinEntr implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $ArriHoro;
    public $Rdv_horo;
    public $Cd40;
    public $Pcr0;
    public $Pcr4;
    public $Pcr6;
    public $Dat_;
    public $Doss;
    public $LaboDat_;
    public $count;
    public $RensAge_;
    public $Min;
    public $Max;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = (isset($data['Nume'])) ? $data['Nume'] : null;
        $this->Util = (isset($data['Util'])) ? $data['Util'] : null;
        $this->ArriHoro = (isset($data['ArriHoro'])) ? $data['ArriHoro'] : null;
        $this->Rdv_horo = (isset($data['Rdv_horo'])) ? $data['Rdv_horo'] : null;
        $this->Cd40 = (isset($data['Cd40'])) ? $data['Cd40'] : null;
        $this->Pcr0 = (isset($data['Pcr0'])) ? $data['Pcr0'] : null;
        $this->Pcr4 = (isset($data['Pcr4'])) ? $data['Pcr4'] : null;
        $this->Pcr6 = (isset($data['Pcr6'])) ? $data['Pcr6'] : null;
        $this->Dat_ = (isset($data['Dat_'])) ? $data['Dat_'] : null;
        $this->Doss = (isset($data['Doss'])) ? $data['Doss'] : null;
        $this->LaboDat_ = (isset($data['LaboDat_'])) ? $data['LaboDat_'] : null;
        $this->count = (isset($data['count'])) ? $data['count'] : NULL;
        $this->Min = (isset($data['Min'])) ? $data['Min'] : NULL;
        $this->Max = (isset($data['Max'])) ? $data['Max'] : NULL;
        
    }

    public function someValues(array $array) {
        foreach ($array as $key => $value) {
            $this->$key = $value;
        }
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
