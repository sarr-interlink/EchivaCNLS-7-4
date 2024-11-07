<?php

namespace Communaute\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Comm implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
    public $Acti;
    public $Dat_;
    public $Nota;
    public $count;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
        $this->Util = (isset($data['Util']) && !empty($data['Util'])) ? $data['Util'] : null;
        $this->Modi = (isset($data['Modi']) && !empty($data['Modi'])) ? $data['Modi'] : null;
        $this->Acti = (isset($data['Acti']) && !empty($data['Acti'])) ? $data['Acti'] : null;
        $this->Dat_ = (isset($data['Dat_']) && !empty($data['Dat_'])) ? $data['Dat_'] : null;
        $this->Nota = (isset($data['Nota']) && !empty($data['Nota'])) ? $data['Nota'] : null;
        $this->count = (isset($data['count']) && !empty($data['count'])) ? $data['count'] : 0;
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
