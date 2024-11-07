<?php

namespace Communaute\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Depi implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
    public $Age_;
    public $Circ;
    public $ConfDat_;
    public $ConfRetr;
    public $ConfSero;
    public $ConfSeroTyp_;
    public $Dat_;
    public $DejaSero;
    public $DejaSeroTyp_;
    public $Matr;
    public $Nb__Chrg;
    public $Nom_;
    public $Pnom;
    public $Prof;
    public $Ref_;
    public $Sexe;
    public $Tel_;
    public $TestDat_;
    public $TestRetr;
    public $TestSero;
    public $TestSeroTyp_;
    public $ObsTest;
    public $ObsConf;
    public $Observation;
    public $count;
    protected $inputFilter;

    public function exchangeArray($data) {
		
		$this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
		$this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
		$this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
		$this->Age_ = (isset($data['Age_'])) ? $data['Age_'] : NULL;
		$this->Circ = (isset($data['Circ'])) ? $data['Circ'] : NULL;
		$this->ConfDat_ = (isset($data['ConfDat_'])) ? $data['ConfDat_'] : NULL;
		$this->ConfRetr = (isset($data['ConfRetr'])) ? $data['ConfRetr'] : NULL;
		$this->ConfSero = (isset($data['ConfSero'])) ? $data['ConfSero'] : NULL;
		$this->ConfSeroTyp_ = (isset($data['ConfSeroTyp_'])) ? $data['ConfSeroTyp_'] : NULL;
		$this->Dat_ = (isset($data['Dat_'])) ? $data['Dat_'] : NULL;
		$this->DejaSero = (isset($data['DejaSero'])) ? $data['DejaSero'] : NULL;
		$this->DejaSeroTyp_ = (isset($data['DejaSeroTyp_'])) ? $data['DejaSeroTyp_'] : NULL;
		$this->Matr = (isset($data['Matr'])) ? $data['Matr'] : NULL;
		$this->Nb__Chrg = (isset($data['Nb__Chrg'])) ? $data['Nb__Chrg'] : NULL;
		$this->Nom_ = (isset($data['Nom_'])) ? $data['Nom_'] : NULL;
		$this->Pnom = (isset($data['Pnom'])) ? $data['Pnom'] : NULL;
		$this->Prof = (isset($data['Prof'])) ? $data['Prof'] : NULL;
		$this->Ref_ = (isset($data['Ref_'])) ? $data['Ref_'] : NULL;
		$this->Sexe = (isset($data['Sexe'])) ? $data['Sexe'] : NULL;
		$this->Tel_ = (isset($data['Tel_'])) ? $data['Tel_'] : NULL;
		$this->TestDat_ = (isset($data['TestDat_'])) ? $data['TestDat_'] : NULL;
		$this->TestRetr = (isset($data['TestRetr'])) ? $data['TestRetr'] : NULL;
		$this->TestSero = (isset($data['TestSero'])) ? $data['TestSero'] : NULL;
		$this->TestSeroTyp_ = (isset($data['TestSeroTyp_'])) ? $data['TestSeroTyp_'] : NULL;

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
