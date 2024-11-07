<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Trans implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Doss;
    public $Ref_;
    public $Dat_;
    public $Motif;
    public $Structure_source;
    public $Structure_destination;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "06".hexdec(uniqid());
        $this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
        $this->Doss = (isset($data['Doss'])) ? $data['Doss'] : NULL;
        $this->Ref_ = (isset($data['Ref_'])) ? $data['Ref_'] : NULL;
        $this->Dat_ = (isset($data['Dat_'])) ? $data['Dat_'] : NULL;
        $this->Motif = (isset($data['Motif'])) ? $data['Motif'] : NULL;
        $this->Structure_source = (isset($data['Structure_source'])) ? $data['Structure_source'] : NULL;
        $this->Structure_destination = (isset($data['Structure_destination'])) ? $data['Structure_destination'] : NULL;
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