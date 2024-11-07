<?php

namespace Analyse\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Ptmegros implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
    public $AccoAzt_Nomb;
    public $AccoDat_;
    public $AccoEpis;
    public $AccoForc;
    public $AccoLieu;
    public $AccoNaisNomb;
    public $AccoNvp_Nomb;
    public $AccoPrev;
    public $AccoPris2h__;
    public $AccoRupt;
    public $AccoVoie;
    public $AnteCesa;
    public $AnteFcs_;
    public $AnteGest;
    public $AnteIvg_;
    public $AntePari;
    public $Arv_Debu;
    public $Arv_Trai;
    public $Ddr_;
    public $Doss;
    public $EchoResu;
    public $Enf0Apga;
    public $Enf0Azt_Debu;
    public $Enf0Azt_Dure;
    public $Enf0DeceCaus;
    public $Enf0DeceDat_;
    public $Enf0Nais;
    public $Enf0Nato;
    public $Enf0Nom_;
    public $Enf0Nvp_Debu;
    public $Enf0Nvp_Nomb;
    public $Enf0Pcr0Dat_;
    public $Enf0Pcr0Resu;
    public $Enf0Pcr1Dat_;
    public $Enf0Pcr1Resu;
    public $Enf0Pcr2Dat_;
    public $Enf0Pcr2Resu;
    public $Enf0Pnom;
    public $Enf0Poid;
    public $Enf0Sero;
    public $Enf0SeroDat_;
    public $Enf0SeroTyp_;
    public $Enf0Sexe;
    public $Enf0Ume_;
    public $Enf1Apga;
    public $Enf1Azt_Debu;
    public $Enf1Azt_Dure;
    public $Enf1DeceCaus;
    public $Enf1DeceDat_;
    public $Enf1Nais;
    public $Enf1Nato;
    public $Enf1Nom_;
    public $Enf1Nvp_Debu;
    public $Enf1Nvp_Nomb;
    public $Enf1Pcr0Dat_;
    public $Enf1Pcr0Resu;
    public $Enf1Pcr1Dat_;
    public $Enf1Pcr1Resu;
    public $Enf1Pcr2Dat_;
    public $Enf1Pcr2Resu;
    public $Enf1Pnom;
    public $Enf1Poid;
    public $Enf1Sero;
    public $Enf1SeroDat_;
    public $Enf1SeroTyp_;
    public $Enf1Sexe;
    public $Enf1Ume_;
    public $EnfaViva;
    public $EvolGros;
    public $SaisDat_;
    public $Term;
    public $TermDdr_Echo;
    public $Var0;
    public $Var1;
    public $count;
    public $RensAge_;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = (isset($data['Nume'])) ? $data['Nume'] : NULL;
		$this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
		$this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
		$this->AccoAzt_Nomb = (isset($data['AccoAzt_Nomb'])) ? $data['AccoAzt_Nomb'] : NULL;
		$this->AccoDat_ = (isset($data['AccoDat_'])) ? $data['AccoDat_'] : NULL;
		$this->AccoEpis = (isset($data['AccoEpis'])) ? $data['AccoEpis'] : NULL;
		$this->AccoForc = (isset($data['AccoForc'])) ? $data['AccoForc'] : NULL;
		$this->AccoLieu = (isset($data['AccoLieu'])) ? $data['AccoLieu'] : NULL;
		$this->AccoNaisNomb = (isset($data['AccoNaisNomb'])) ? $data['AccoNaisNomb'] : NULL;
		$this->AccoNvp_Nomb = (isset($data['AccoNvp_Nomb'])) ? $data['AccoNvp_Nomb'] : NULL;
		$this->AccoPrev = (isset($data['AccoPrev'])) ? $data['AccoPrev'] : NULL;
		$this->AccoPris2h__ = (isset($data['AccoPris2h__'])) ? $data['AccoPris2h__'] : NULL;
		$this->AccoRupt = (isset($data['AccoRupt'])) ? $data['AccoRupt'] : NULL;
		$this->AccoVoie = (isset($data['AccoVoie'])) ? $data['AccoVoie'] : NULL;
		$this->AnteCesa = (isset($data['AnteCesa'])) ? $data['AnteCesa'] : NULL;
		$this->AnteFcs_ = (isset($data['AnteFcs_'])) ? $data['AnteFcs_'] : NULL;
		$this->AnteGest = (isset($data['AnteGest'])) ? $data['AnteGest'] : NULL;
		$this->AnteIvg_ = (isset($data['AnteIvg_'])) ? $data['AnteIvg_'] : NULL;
		$this->AntePari = (isset($data['AntePari'])) ? $data['AntePari'] : NULL;
		$this->Arv_Debu = (isset($data['Arv_Debu'])) ? $data['Arv_Debu'] : NULL;
		$this->Arv_Trai = (isset($data['Arv_Trai'])) ? $data['Arv_Trai'] : NULL;
		$this->Ddr_ = (isset($data['Ddr_'])) ? $data['Ddr_'] : NULL;
		$this->Doss = (isset($data['Doss'])) ? $data['Doss'] : NULL;
		$this->EchoResu = (isset($data['EchoResu'])) ? $data['EchoResu'] : NULL;
		$this->Enf0Apga = (isset($data['Enf0Apga'])) ? $data['Enf0Apga'] : NULL;
		$this->Enf0Azt_Debu = (isset($data['Enf0Azt_Debu'])) ? $data['Enf0Azt_Debu'] : NULL;
		$this->Enf0Azt_Dure = (isset($data['Enf0Azt_Dure'])) ? $data['Enf0Azt_Dure'] : NULL;
		$this->Enf0DeceCaus = (isset($data['Enf0DeceCaus'])) ? $data['Enf0DeceCaus'] : NULL;
		$this->Enf0DeceDat_ = (isset($data['Enf0DeceDat_'])) ? $data['Enf0DeceDat_'] : NULL;
		$this->Enf0Nais = (isset($data['Enf0Nais'])) ? $data['Enf0Nais'] : NULL;
		$this->Enf0Nato = (isset($data['Enf0Nato'])) ? $data['Enf0Nato'] : NULL;
		$this->Enf0Nom_ = (isset($data['Enf0Nom_'])) ? $data['Enf0Nom_'] : NULL;
		$this->Enf0Nvp_Debu = (isset($data['Enf0Nvp_Debu'])) ? $data['Enf0Nvp_Debu'] : NULL;
		$this->Enf0Nvp_Nomb = (isset($data['Enf0Nvp_Nomb'])) ? $data['Enf0Nvp_Nomb'] : NULL;
		$this->Enf0Pcr0Dat_ = (isset($data['Enf0Pcr0Dat_'])) ? $data['Enf0Pcr0Dat_'] : NULL;
		$this->Enf0Pcr0Resu = (isset($data['Enf0Pcr0Resu'])) ? $data['Enf0Pcr0Resu'] : NULL;
		$this->Enf0Pcr1Dat_ = (isset($data['Enf0Pcr1Dat_'])) ? $data['Enf0Pcr1Dat_'] : NULL;
		$this->Enf0Pcr1Resu = (isset($data['Enf0Pcr1Resu'])) ? $data['Enf0Pcr1Resu'] : NULL;
		$this->Enf0Pcr2Dat_ = (isset($data['Enf0Pcr2Dat_'])) ? $data['Enf0Pcr2Dat_'] : NULL;
		$this->Enf0Pcr2Resu = (isset($data['Enf0Pcr2Resu'])) ? $data['Enf0Pcr2Resu'] : NULL;
		$this->Enf0Pnom = (isset($data['Enf0Pnom'])) ? $data['Enf0Pnom'] : NULL;
		$this->Enf0Poid = (isset($data['Enf0Poid'])) ? $data['Enf0Poid'] : NULL;
		$this->Enf0Sero = (isset($data['Enf0Sero'])) ? $data['Enf0Sero'] : NULL;
		$this->Enf0SeroDat_ = (isset($data['Enf0SeroDat_'])) ? $data['Enf0SeroDat_'] : NULL;
		$this->Enf0SeroTyp_ = (isset($data['Enf0SeroTyp_'])) ? $data['Enf0SeroTyp_'] : NULL;
		$this->Enf0Sexe = (isset($data['Enf0Sexe'])) ? $data['Enf0Sexe'] : NULL;
		$this->Enf0Ume_ = (isset($data['Enf0Ume_'])) ? $data['Enf0Ume_'] : NULL;
		$this->Enf1Apga = (isset($data['Enf1Apga'])) ? $data['Enf1Apga'] : NULL;
		$this->Enf1Azt_Debu = (isset($data['Enf1Azt_Debu'])) ? $data['Enf1Azt_Debu'] : NULL;
		$this->Enf1Azt_Dure = (isset($data['Enf1Azt_Dure'])) ? $data['Enf1Azt_Dure'] : NULL;
		$this->Enf1DeceCaus = (isset($data['Enf1DeceCaus'])) ? $data['Enf1DeceCaus'] : NULL;
		$this->Enf1DeceDat_ = (isset($data['Enf1DeceDat_'])) ? $data['Enf1DeceDat_'] : NULL;
		$this->Enf1Nais = (isset($data['Enf1Nais'])) ? $data['Enf1Nais'] : NULL;
		$this->Enf1Nato = (isset($data['Enf1Nato'])) ? $data['Enf1Nato'] : NULL;
		$this->Enf1Nom_ = (isset($data['Enf1Nom_'])) ? $data['Enf1Nom_'] : NULL;
		$this->Enf1Nvp_Debu = (isset($data['Enf1Nvp_Debu'])) ? $data['Enf1Nvp_Debu'] : NULL;
		$this->Enf1Nvp_Nomb = (isset($data['Enf1Nvp_Nomb'])) ? $data['Enf1Nvp_Nomb'] : NULL;
		$this->Enf1Pcr0Dat_ = (isset($data['Enf1Pcr0Dat_'])) ? $data['Enf1Pcr0Dat_'] : NULL;
		$this->Enf1Pcr0Resu = (isset($data['Enf1Pcr0Resu'])) ? $data['Enf1Pcr0Resu'] : NULL;
		$this->Enf1Pcr1Dat_ = (isset($data['Enf1Pcr1Dat_'])) ? $data['Enf1Pcr1Dat_'] : NULL;
		$this->Enf1Pcr1Resu = (isset($data['Enf1Pcr1Resu'])) ? $data['Enf1Pcr1Resu'] : NULL;
		$this->Enf1Pcr2Dat_ = (isset($data['Enf1Pcr2Dat_'])) ? $data['Enf1Pcr2Dat_'] : NULL;
		$this->Enf1Pcr2Resu = (isset($data['Enf1Pcr2Resu'])) ? $data['Enf1Pcr2Resu'] : NULL;
		$this->Enf1Pnom = (isset($data['Enf1Pnom'])) ? $data['Enf1Pnom'] : NULL;
		$this->Enf1Poid = (isset($data['Enf1Poid'])) ? $data['Enf1Poid'] : NULL;
		$this->Enf1Sero = (isset($data['Enf1Sero'])) ? $data['Enf1Sero'] : NULL;
		$this->Enf1SeroDat_ = (isset($data['Enf1SeroDat_'])) ? $data['Enf1SeroDat_'] : NULL;
		$this->Enf1SeroTyp_ = (isset($data['Enf1SeroTyp_'])) ? $data['Enf1SeroTyp_'] : NULL;
		$this->Enf1Sexe = (isset($data['Enf1Sexe'])) ? $data['Enf1Sexe'] : NULL;
		$this->Enf1Ume_ = (isset($data['Enf1Ume_'])) ? $data['Enf1Ume_'] : NULL;
		$this->EnfaViva = (isset($data['EnfaViva'])) ? $data['EnfaViva'] : NULL;
		$this->EvolGros = (isset($data['EvolGros'])) ? $data['EvolGros'] : NULL;
		$this->SaisDat_ = (isset($data['SaisDat_'])) ? $data['SaisDat_'] : NULL;
		$this->Term = (isset($data['Term'])) ? $data['Term'] : NULL;
		$this->TermDdr_Echo = (isset($data['TermDdr_Echo'])) ? $data['TermDdr_Echo'] : NULL;
		$this->count = (isset($data['count'])) ? $data['count'] : NULL;
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
