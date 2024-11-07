<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Droi implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
	public $Accu;
	public $Anal;
	public $Comm;
	public $Deli;
	public $Depi;
	public $Desi;
	public $DossMedi;
	public $DossObse;
	public $DossPsy_;
	public $DossPtme;
	public $DossRens;
	public $DossSoci;
	public $Droi;
	public $Labo;
	public $Nom_;
	public $Oev_;
	public $Para;
	public $Phar;
	public $PharPara;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
        $this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
        $this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
        $this->Accu = (isset($data['Accu'])) ? $data['Accu'] : NULL;
        $this->Anal = (isset($data['Anal'])) ? $data['Anal'] : NULL;
        $this->Comm = (isset($data['Comm'])) ? $data['Comm'] : NULL;
        $this->Deli = (isset($data['Deli'])) ? $data['Deli'] : NULL;
        $this->Depi = (isset($data['Depi'])) ? $data['Depi'] : NULL;
        $this->Desi = (isset($data['Desi'])) ? $data['Desi'] : NULL;
        $this->DossMedi = (isset($data['DossMedi'])) ? $data['DossMedi'] : NULL;
		$this->DossObse = (isset($data['DossObse'])) ? $data['DossObse'] : NULL;
        $this->DossPsy_ = (isset($data['DossPsy_'])) ? $data['DossPsy_'] : NULL;
        $this->DossPtme = (isset($data['DossPtme'])) ? $data['DossPtme'] : NULL;
        $this->DossRens = (isset($data['DossRens'])) ? $data['DossRens'] : NULL;
        $this->DossSoci = (isset($data['DossSoci'])) ? $data['DossSoci'] : NULL;
        $this->Droi = (isset($data['Droi'])) ? $data['Droi'] : NULL;
        $this->Labo = (isset($data['Labo'])) ? $data['Labo'] : NULL;
        $this->Nom_ = (isset($data['Nom_'])) ? $data['Nom_'] : NULL;
        $this->Oev_ = (isset($data['Oev_'])) ? $data['Oev_'] : NULL;
        $this->Para = (isset($data['Para'])) ? $data['Para'] : NULL;
        $this->Phar = (isset($data['Phar'])) ? $data['Phar'] : NULL;
        $this->PharPara = (isset($data['PharPara'])) ? $data['PharPara'] : NULL;
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
