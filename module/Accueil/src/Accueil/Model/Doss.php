<?php

namespace Accueil\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Doss implements InputFilterAwareInterface {

    public $Nume;
    public $RensNom_;
    public $RensPnom;
    public $RensAge_;
    public $RensSexe;
    public $Ref_;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
        $this->RensNom_ = (isset($data['RensNom_'])) ? $data['RensNom_'] : NULL;
        $this->RensPnom = (isset($data['RensPnom'])) ? $data['RensPnom'] : NULL;
        $this->RensAge_ = (isset($data['RensAge_'])) ? $data['RensAge_'] : NULL;
        $this->RensSexe = (isset($data['RensSexe'])) ? $data['RensSexe'] : NULL;
        $this->Ref_ = (isset($data['Ref_'])) ? $data['Ref_'] : NULL;
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