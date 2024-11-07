<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Socialaut implements InputFilterAwareInterface {

    public $SociAutrCommParo;
    public $SociAutrCommActi;
    public $SociAutrNutrFreq;
    public $SociAutrNutrComp;
    public $SociAutrNutrAide;
    public $SociAutrEconProf;
    public $SociAutrEconNive;
    public $SociAutrResiStat;
    public $SociAutrHabiQual;
    public $SociAutrEconEau_;
    public $SociAutrEconElec;
    public $SociAutrEconLatr;
    public $SociAutrEconRefr;
    public $SociAutrAgr_Dat_;
    public $SociAutrAgr_Mont;
    public $SociAutrAgr_Suiv;
    protected $inputFilter;

    public function exchangeArray($data) {
       $this->SociAutrAgr_Dat_ = (isset($data['SociAutrAgr_Dat_'])) ? $data['SociAutrAgr_Dat_'] : NULL;
	$this->SociAutrAgr_Mont = (isset($data['SociAutrAgr_Mont'])) ? $data['SociAutrAgr_Mont'] : NULL;
	$this->SociAutrAgr_Suiv = (isset($data['SociAutrAgr_Suiv'])) ? $data['SociAutrAgr_Suiv'] : NULL;
	$this->SociAutrCommActi = (isset($data['SociAutrCommActi'])) ? $data['SociAutrCommActi'] : NULL;
	$this->SociAutrCommParo = (isset($data['SociAutrCommParo'])) ? $data['SociAutrCommParo'] : NULL;
	$this->SociAutrEconEau_ = (isset($data['SociAutrEconEau_'])) ? $data['SociAutrEconEau_'] : NULL;
	$this->SociAutrEconElec = (isset($data['SociAutrEconElec'])) ? $data['SociAutrEconElec'] : NULL;
	$this->SociAutrEconLatr = (isset($data['SociAutrEconLatr'])) ? $data['SociAutrEconLatr'] : NULL;
	$this->SociAutrEconNive = (isset($data['SociAutrEconNive'])) ? $data['SociAutrEconNive'] : NULL;
	$this->SociAutrEconProf = (isset($data['SociAutrEconProf'])) ? $data['SociAutrEconProf'] : NULL;
	$this->SociAutrEconRefr = (isset($data['SociAutrEconRefr'])) ? $data['SociAutrEconRefr'] : NULL;
	$this->SociAutrHabiQual = (isset($data['SociAutrHabiQual'])) ? $data['SociAutrHabiQual'] : NULL;
	$this->SociAutrNutrAide = (isset($data['SociAutrNutrAide'])) ? $data['SociAutrNutrAide'] : NULL;
	$this->SociAutrNutrComp = (isset($data['SociAutrNutrComp'])) ? $data['SociAutrNutrComp'] : NULL;
	$this->SociAutrNutrFreq = (isset($data['SociAutrNutrFreq'])) ? $data['SociAutrNutrFreq'] : NULL;
	$this->SociAutrResiStat = (isset($data['SociAutrResiStat'])) ? $data['SociAutrResiStat'] : NULL;
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
