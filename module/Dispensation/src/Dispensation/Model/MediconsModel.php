<?php

namespace Dispensation\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class MediconsModel implements InputFilterAwareInterface {

    public $Nume;
    public $Arv0Serv;
    public $Arv1Serv;
    public $Arv2Serv;
    public $Arv3Serv;
    public $Arv4Serv;
    public $Arv5Serv;
    public $Arv6Serv;
    public $Arv7Serv;
    public $Arv8Serv;
    public $Arv9Serv;
    public $Med0Serv;
    public $Med1Serv;
    public $Med2Serv;
    public $Med3Serv;
    public $Med4Serv;
    public $Med5Serv;
    public $Med6Serv;
    public $Med7Serv;
    public $Med8Serv;
    public $Med9Serv;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
        $this->Arv0Serv = (isset($data['Arv0Serv'])) ? $data['Arv0Serv'] : NULL;
        $this->Arv2Serv = (isset($data['Arv2Serv'])) ? $data['Arv2Serv'] : NULL;
        $this->Arv3Serv = (isset($data['Arv3Serv'])) ? $data['Arv3Serv'] : NULL;
        $this->Arv4Serv = (isset($data['Arv4Serv']) && !empty($data['Arv4Serv'])) ? $data['Arv4Serv'] : NULL;
        $this->Arv5Serv = (isset($data['Arv5Serv']) && !empty($data['Arv5Serv'])) ? $data['Arv5Serv'] : NULL;
        $this->Arv6Serv = (isset($data['Arv6Serv']) && !empty($data['Arv6Serv'])) ? $data['Arv6Serv'] : NULL;
        $this->Arv7Serv = (isset($data['Arv7Serv']) && !empty($data['Arv7Serv'])) ? $data['Arv7Serv'] : NULL;
        $this->Arv8Serv = (isset($data['Arv8Serv']) && !empty($data['Arv8Serv'])) ? $data['Arv8Serv'] : NULL;
        $this->Arv9Serv = (isset($data['Arv9Serv']) && !empty($data['Arv9Serv'])) ? $data['Arv9Serv'] : NULL;
        $this->Med0Serv = (isset($data['Med0Serv'])) ? $data['Med0Serv'] : NULL;
        $this->Med1Serv = (isset($data['Med1Serv'])) ? $data['Med1Serv'] : NULL;
        $this->Med2Serv = (isset($data['Med2Serv'])) ? $data['Med2Serv'] : NULL;
        $this->Med3Serv = (isset($data['Med3Serv'])) ? $data['Med3Serv'] : NULL;
        $this->Med4Serv = (isset($data['Med4Serv'])) ? $data['Med4Serv'] : NULL;
        $this->Med5Serv = (isset($data['Med5Serv'])) ? $data['Med5Serv'] : NULL;
        $this->Med6Serv = (isset($data['Med6Serv']) && !empty($data['Med6Serv'])) ? $data['Med6Serv'] : NULL;
        $this->Med7Serv = (isset($data['Med7Serv']) && !empty($data['Med7Serv'])) ? $data['Med7Serv'] : NULL;
        $this->Med8Serv = (isset($data['Med8Serv']) && !empty($data['Med8Serv'])) ? $data['Med8Serv'] : NULL;
        $this->Med9Serv = (isset($data['Med9Serv']) && !empty($data['Med9Serv'])) ? $data['Med9Serv'] : NULL;
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
