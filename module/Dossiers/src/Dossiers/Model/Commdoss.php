<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Commdoss implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
    public $Comm;
    public $Doss;
    public $Nom_;
    public $Oev_;
    public $Pnom;
    public $Ref_;
    public $Sexe;
    public $Age_;
    public $Montant;
    public $Tuteur;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
        $this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
        $this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
        $this->Comm = (isset($data['Comm'])) ? $data['Comm'] : NULL;
        $this->Doss = (isset($data['Doss'])) ? $data['Doss'] : NULL;
        $this->Nom_ = (isset($data['Nom_'])) ? $data['Nom_'] : NULL;
        $this->Oev_ = (isset($data['Oev_'])) ? $data['Oev_'] : NULL;
        $this->Pnom = (isset($data['Pnom'])) ? $data['Pnom'] : NULL;
        $this->Ref_ = (isset($data['Ref_'])) ? $data['Ref_'] : NULL;
        $this->Sexe = (isset($data['Sexe'])) ? $data['Sexe'] : NULL;
        $this->Age_ = (isset($data['Age_'])) ? $data['Age_'] : NULL;
        $this->Montant = (isset($data['Montant'])) ? $data['Montant'] : NULL;
        $this->Tuteur = (isset($data['Tuteur'])) ? $data['Tuteur'] : NULL;
    }

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