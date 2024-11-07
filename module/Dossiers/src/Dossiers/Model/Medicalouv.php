<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Medicalouv implements InputFilterAwareInterface {

    public $MediRefe;
    public $MediCsi_;
    public $Arv_Lign;
    public $Arv_Desi;
    public $Arv0;
    public $Arv1;
    public $Arv2;
    public $Arv3;
    public $Arv4;
    public $Arv5;
    public $Arv6;
    public $Arv7;
    public $Arv8;
    public $Arv9;
    public $MediDepiNume;
    public $MediDepiCirc;
    public $MediDepiDat_;
    public $MediSeroouv;
    public $MediSeroTyp_;
    public $AffOuvrDat_;
    public $FormFact;
    public $MediAnte;
    public $MediAnteCase;
    public $FormStatOms;
    public $MediAnteArv_;
    public $MediCdc_;
    public $MediKarn;
    public $MediDiag;
    public $MediVar0;
    public $MediVar1;
    public $MediRisqHomo;
    public $MediRisqMere;
    public $MediRisqMult;
    public $MediRisqOcca;
    public $MediRisqPart;
    public $MediRisqPiqu;
    public $MediRisqPoly;
    public $MediRisqPres;
    public $MediRisqScar;
    public $MediRisqTran;
    /*     * subform* */
    public $subFormMedicalOuvFact;
    public $subFormMedicalOuvMedi;
    /*     * * */
    protected $inputFilter;

    public function exchangeArray($data) {
    $this->Arv_Lign = (isset($data['Arv_Lign'])) ? $data['Arv_Lign'] : NULL;
    $this->Arv_Desi = (isset($data['Arv_Desi'])) ? $data['Arv_Desi'] : NULL;
    $this->Arv0 = (isset($data['Arv0'])) ? $data['Arv0'] : NULL;
    $this->Arv1 = (isset($data['Arv1'])) ? $data['Arv1'] : NULL;
    $this->Arv2 = (isset($data['Arv2'])) ? $data['Arv2'] : NULL;
    $this->Arv3 = (isset($data['Arv3'])) ? $data['Arv3'] : NULL;
    $this->Arv4 = (isset($data['Arv4'])) ? $data['Arv4'] : NULL;
    $this->Arv5 = (isset($data['Arv5'])) ? $data['Arv5'] : NULL;
    $this->Arv6 = (isset($data['Arv6'])) ? $data['Arv6'] : NULL;
    $this->Arv7 = (isset($data['Arv7'])) ? $data['Arv7'] : NULL;
    $this->Arv8 = (isset($data['Arv8'])) ? $data['Arv8'] : NULL;
    $this->Arv9 = (isset($data['Arv9'])) ? $data['Arv9'] : NULL;
    $this->MediAnte = (isset($data['MediAnte'])) ? $data['MediAnte'] : NULL;
    $this->MediAnteCase = (isset($data['MediAnteCase'])) ? $data['MediAnteCase'] : NULL;
	$this->MediAnteArv_ = (isset($data['MediAnteArv_'])) ? $data['MediAnteArv_'] : NULL;
	$this->MediCdc_ = (isset($data['MediCdc_'])) ? $data['MediCdc_'] : NULL;
	$this->MediCsi_ = (isset($data['MediCsi_'])) ? $data['MediCsi_'] : NULL;
	$this->MediDepiCirc = (isset($data['MediDepiCirc'])) ? $data['MediDepiCirc'] : NULL;
	$this->MediDepiNume = (isset($data['MediDepiNume'])) ? $data['MediDepiNume'] : NULL;
	$this->MediDepiDat_ = (isset($data['MediDepiDat_'])) ? $data['MediDepiDat_'] : NULL;
	$this->MediDiag = (isset($data['MediDiag'])) ? $data['MediDiag'] : NULL;
	$this->MediKarn = (isset($data['MediKarn'])) ? $data['MediKarn'] : NULL;
	$this->MediRefe = (isset($data['MediRefe'])) ? $data['MediRefe'] : NULL;
	$this->MediSero = (isset($data['MediSero'])) ? $data['MediSero'] : NULL;
	$this->MediSeroTyp_ = (isset($data['MediSeroTyp_'])) ? $data['MediSeroTyp_'] : NULL;
	$this->MediVar0 = (isset($data['MediVar0'])) ? $data['MediVar0'] : NULL;
	$this->MediVar1 = (isset($data['MediVar1'])) ? $data['MediVar1'] : NULL;
	$this->MediRisqHomo = (isset($data['MediRisqHomo'])) ? $data['MediRisqHomo'] : NULL;
	$this->MediRisqMere = (isset($data['MediRisqMere'])) ? $data['MediRisqMere'] : NULL;
	$this->MediRisqMult = (isset($data['MediRisqMult'])) ? $data['MediRisqMult'] : NULL;
	$this->MediRisqOcca = (isset($data['MediRisqOcca'])) ? $data['MediRisqOcca'] : NULL;
	$this->MediRisqPart = (isset($data['MediRisqPart'])) ? $data['MediRisqPart'] : NULL;
	$this->MediRisqPiqu = (isset($data['MediRisqPiqu'])) ? $data['MediRisqPiqu'] : NULL;
	$this->MediRisqPoly = (isset($data['MediRisqPoly'])) ? $data['MediRisqPoly'] : NULL;
	$this->MediRisqPres = (isset($data['MediRisqPres'])) ? $data['MediRisqPres'] : NULL;
	$this->MediRisqScar = (isset($data['MediRisqScar'])) ? $data['MediRisqScar'] : NULL;
	$this->MediRisqTran = (isset($data['MediRisqTran'])) ? $data['MediRisqTran'] : NULL;
	//$this->AffOuvrDat_ = (isset($data['OuvrDat_'])) ? $data['OuvrDat_'] : NULL;
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
