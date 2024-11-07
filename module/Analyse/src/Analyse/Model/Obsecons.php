<?php

namespace Analyse\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Obsecons implements InputFilterAwareInterface {

        public $Nume;
	public $Util;
	public $Modi;
	public $Apci;
	public $ApprDat_;
	public $ApprReta;
	public $Comp;
	public $Cont;
	public $Dat_;
	public $Doss;
	public $Eval;
	public $Nota;
	public $Obje;
	public $Obse;
	public $Ques;
	public $Rdv_Dat_;
	public $Rdv_Heur;
	public $Rdv_Minu;
	public $Supp;
	public $Typ_;
	public $Var0;
	public $Var1;
	public $RensAge_;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = (isset($data['Nume'])) ? $data['Nume'] : NULL;
		$this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
		$this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
		$this->Apci = (isset($data['Apci'])) ? $data['Apci'] : NULL;
		$this->ApprDat_ = (isset($data['ApprDat_'])) ? $data['ApprDat_'] : NULL;
		$this->ApprReta = (isset($data['ApprReta'])) ? $data['ApprReta'] : NULL;
		$this->Comp = (isset($data['Comp'])) ? $data['Comp'] : NULL;
		$this->Cont = (isset($data['Cont'])) ? $data['Cont'] : NULL;
		$this->Dat_ = (isset($data['Dat_'])) ? $data['Dat_'] : NULL;
		$this->Doss = (isset($data['Doss'])) ? $data['Doss'] : NULL;
		$this->Eval = (isset($data['Eval'])) ? $data['Eval'] : NULL;
		$this->Nota = (isset($data['Nota'])) ? $data['Nota'] : NULL;
		$this->Obje = (isset($data['Obje'])) ? $data['Obje'] : NULL;
		$this->Obse = (isset($data['Obse'])) ? $data['Obse'] : NULL;
		$this->Ques = (isset($data['Ques'])) ? $data['Ques'] : NULL;
		$this->Rdv_Dat_ = (isset($data['Rdv_Dat_'])) ? $data['Rdv_Dat_'] : NULL;
		$this->Rdv_Heur = (isset($data['Rdv_Heur'])) ? $data['Rdv_Heur'] : NULL;
		$this->Rdv_Minu = (isset($data['Rdv_Minu'])) ? $data['Rdv_Minu'] : NULL;
		$this->Supp = (isset($data['Supp'])) ? $data['Supp'] : NULL;
		$this->Typ_ = (isset($data['Typ_'])) ? $data['Typ_'] : NULL;
		$this->Var0 = (isset($data['Var0'])) ? $data['Var0'] : NULL;
		$this->Var1 = (isset($data['Var1'])) ? $data['Var1'] : NULL;
                $this->RensAge_ = (isset($data['RensAge_'])) ? $data['RensAge_'] : NULL;
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
