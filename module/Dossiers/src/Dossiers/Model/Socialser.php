<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Socialser implements InputFilterAwareInterface {

    public $MediRefe;
    public $MediCsi_;
    public $MediDepiNume;
    public $MediDepiCirc;
    public $MediDepiDat_;
    public $MediSero;
    public $MediSeroTyp_;
    public $SociConjInfo;
    public $SociConjInfoCaus;
    public $SociFamiInfo;
    public $SociFamiAtti;
    public $SociPersInfo;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->MediCsi_ = (isset($data['MediCsi_'])) ? $data['MediCsi_'] : NULL;
        $this->MediDepiCirc = (isset($data['MediDepiCirc'])) ? $data['MediDepiCirc'] : NULL;
        $this->MediDepiDat_ = (isset($data['MediDepiDat_'])) ? $data['MediDepiDat_'] : NULL;
        $this->MediDepiNume = (isset($data['MediDepiNume'])) ? $data['MediDepiNume'] : NULL;
        $this->MediRefe = (isset($data['MediRefe'])) ? $data['MediRefe'] : NULL;
        $this->MediSero = (isset($data['MediSero'])) ? $data['MediSero'] : NULL;
        $this->MediSeroTyp_ = (isset($data['MediSeroTyp_'])) ? $data['MediSeroTyp_'] : NULL;
        $this->SociConjInfo = (isset($data['SociConjInfo'])) ? $data['SociConjInfo'] : NULL;
        $this->SociConjInfoCaus = (isset($data['SociConjInfoCaus'])) ? $data['SociConjInfoCaus'] : NULL;
        $this->SociFamiAtti = (isset($data['SociFamiAtti'])) ? $data['SociFamiAtti'] : NULL;
        $this->SociFamiInfo = (isset($data['SociFamiInfo'])) ? $data['SociFamiInfo'] : NULL;
        $this->SociPersInfo = (isset($data['SociPersInfo'])) ? $data['SociPersInfo'] : NULL;
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
