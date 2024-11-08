<?php

namespace Analyse\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class MinPtmegros implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $AccoDat_;
    public $AccoPrev;
    public $SaisDat_;
    public $Doss;
    public $count;
    public $Min;
    public $Max;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = (isset($data['Nume'])) ? $data['Nume'] : NULL;
        $this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
        $this->AccoDat_ = (isset($data['AccoDat_'])) ? $data['AccoDat_'] : NULL;
        $this->AccoPrev = (isset($data['AccoPrev'])) ? $data['AccoPrev'] : NULL;
        $this->SaisDat_ = (isset($data['SaisDat_'])) ? $data['SaisDat_'] : NULL;
        $this->Doss = (isset($data['Doss'])) ? $data['Doss'] : NULL;
        $this->Min = (isset($data['Min'])) ? $data['Min'] : NULL;
        $this->Max = (isset($data['Max'])) ? $data['Max'] : NULL;
        $this->count = (isset($data['count'])) ? $data['count'] : NULL;
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
