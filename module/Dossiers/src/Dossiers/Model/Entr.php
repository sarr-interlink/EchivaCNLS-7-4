<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Entr implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
    public $Age_;
    public $Arri;
    public $Cta_Nume;
    public $Cta_Ume_;
    public $Nom_;
    public $Doss;
    public $Moti;
    public $Pnom;
    public $Rdv_Heur;
    public $Rdv_Horo;
    public $Sexe;
    public $Ume_Nume;
    public $LaboDat_;
    public $LaboDesi;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
        $this->Util = (isset($data['Util'])) ? $data['Util'] : null;
        $this->Modi = (isset($data['Modi'])) ? $data['Modi'] : date("Y-m-d H:i:s");
        $this->Age_ = (isset($data['Age_'])) ? $data['Age_'] : null;
        $this->Arri = (isset($data['Arri'])) ? $data['Arri'] : null;
        $this->Cta_Nume = (isset($data['Cta_Nume'])) ? $data['Cta_Nume'] : null;
        $this->Cta_Ume_ = (isset($data['Cta_Ume_'])) ? $data['Cta_Ume_'] : null;
        $this->Nom_ = (isset($data['Nom_'])) ? $data['Nom_'] : null;
        $this->Doss = (isset($data['Doss'])) ? $data['Doss'] : null;
        $this->Moti = (isset($data['Moti'])) ? $data['Moti'] : null;
        $this->Pnom = (isset($data['Pnom'])) ? $data['Pnom'] : null;
        $this->Rdv_Heur = (isset($data['Rdv_Heur'])) ? $data['Rdv_Heur'] : null;
        $this->Rdv_Horo = (isset($data['Rdv_Horo'])) ? $data['Rdv_Horo'] : null;
        $this->Sexe = (isset($data['Sexe'])) ? $data['Sexe'] : null;
        $this->Ume_Nume = (isset($data['Ume_Nume'])) ? $data['Ume_Nume'] : null;
        $this->LaboDat_ = (isset($data['LaboDat_'])) ? $data['LaboDat_'] : null;
        $this->LaboDesi = (isset($data['LaboDesi'])) ? $data['LaboDesi'] : null;
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
