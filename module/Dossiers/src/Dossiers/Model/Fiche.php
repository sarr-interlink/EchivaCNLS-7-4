<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Fiche implements InputFilterAwareInterface {

    public $RensNom_;
    public $Ref_;
    public $RensPnom;
    public $RensNaisDat_;
    public $RensAge_;
    public $RensOev_;
    public $RensSexe;
    public $OuvrDat_;
    public $RensOuvrUnit;
    public $RensSuiv;
    public $RensSui2;
    public $RensLoca;
    public $RensQuar;
    public $RensAdre;
    public $RensTel_;
    public $RensVoya;
    public $RensNon_Suiv;
    public $RensNon_SuivDat_;
    public $RensDeceDat_;
    public $RensDeceCaus;
    public $RensDoub;
    public $RensNaisLieu;
    public $RensNati;
    public $RensMatr;
    public $RensOev_Etab;
    public $RensProf;
    public $RensProfPrec;
    public $RensEtud;
    public $RensOev_Sani;
    public $RensOev_Type;
    public $RensIarvDat_;
    public $RensIarvNume;
    public $RensPtmeNume;
    public $RensChrg;
    public $RensVar0;
    public $RensVar1;
    public $RensProv;
    public $Postit__;
    public $Imc_info;
    public $Conc_info;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
        $this->OuvrDat_ = (isset($data['OuvrDat_'])) ? $data['OuvrDat_'] : NULL;
        $this->Ref_ = (isset($data['Ref_'])) ? $data['Ref_'] : NULL;
        $this->RensAdre = (isset($data['RensAdre'])) ? $data['RensAdre'] : NULL;
        $this->RensAge_ = (isset($data['RensAge_'])) ? $data['RensAge_'] : NULL;
        $this->RensChrg = (isset($data['RensChrg'])) ? $data['RensChrg'] : NULL;
        $this->RensDeceCaus = (isset($data['RensDeceCaus'])) ? $data['RensDeceCaus'] : NULL;
        $this->RensDeceDat_ = (isset($data['RensDeceDat_'])) ? preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $data['RensDeceDat_']) : NULL;
        $this->RensDoub = (isset($data['RensDoub'])) ? $data['RensDoub'] : NULL;
        $this->RensEmpl = (isset($data['RensEmpl'])) ? $data['RensEmpl'] : NULL;
        $this->RensEthn = (isset($data['RensEthn'])) ? $data['RensEthn'] : NULL;
        $this->RensEtud = (isset($data['RensEtud'])) ? $data['RensEtud'] : NULL;
        $this->RensExonArv_ = (isset($data['RensExonArv_'])) ? $data['RensExonArv_'] : NULL;
        $this->RensExonTota = (isset($data['RensExonTota'])) ? $data['RensExonTota'] : NULL;
        $this->RensIarvDat_ = (isset($data['RensIarvDat_'])) ? preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $data['RensIarvDat_']) : NULL;
        $this->RensIarvNume = (isset($data['RensIarvNume'])) ? $data['RensIarvNume'] : NULL;
        $this->RensLang = (isset($data['RensLang'])) ? $data['RensLang'] : NULL;
        $this->RensLoca = (isset($data['RensLoca'])) ? $data['RensLoca'] : NULL;
        $this->RensMatr = (isset($data['RensMatr'])) ? $data['RensMatr'] : NULL;
        $this->RensNaisDat_ = (isset($data['RensNaisDat_'])) ? preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $data['RensNaisDat_']) : NULL;
        $this->RensNaisLieu = (isset($data['RensNaisLieu'])) ? $data['RensNaisLieu'] : NULL;
        $this->RensNati = (isset($data['RensNati'])) ? $data['RensNati'] : NULL;
        $this->RensNom_ = (isset($data['RensNom_'])) ? $data['RensNom_'] : NULL;
        $this->RensNon_Suiv = (isset($data['RensNon_Suiv'])) ? $data['RensNon_Suiv'] : NULL;
        $this->RensNon_SuivDat_ = (isset($data['RensNon_SuivDat_'])) ? preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $data['RensNon_SuivDat_']) : NULL;
        $this->RensNumeUme_ = (isset($data['RensNumeUme_'])) ? $data['RensNumeUme_'] : NULL;
        $this->RensOev_ = (isset($data['RensOev_'])) ? $data['RensOev_'] : NULL;
        $this->RensOev_Etab = (isset($data['RensOev_Etab'])) ? $data['RensOev_Etab'] : NULL;
        $this->RensOev_Sani = (isset($data['RensOev_Sani'])) ? $data['RensOev_Sani'] : NULL;
        $this->RensOev_Type = (isset($data['RensOev_Type'])) ? $data['RensOev_Type'] : NULL;
        $this->RensOuvrUnit = (isset($data['RensOuvrUnit'])) ? $data['RensOuvrUnit'] : NULL;
        $this->RensPnom = (isset($data['RensPnom'])) ? $data['RensPnom'] : NULL;
        $this->RensProf = (isset($data['RensProf'])) ? $data['RensProf'] : NULL;
        $this->RensProfPrec = (isset($data['RensProfPrec'])) ? $data['RensProfPrec'] : NULL;
        $this->RensPtmeNume = (isset($data['RensPtmeNume'])) ? $data['RensPtmeNume'] : NULL;
        $this->RensQuar = (isset($data['RensQuar'])) ? $data['RensQuar'] : NULL;
        $this->RensSexe = (isset($data['RensSexe'])) ? $data['RensSexe'] : NULL;
        $this->RensSui2 = (isset($data['RensSui2'])) ? $data['RensSui2'] : NULL;
        $this->RensSuiv = (isset($data['RensSuiv'])) ? $data['RensSuiv'] : NULL;
        $this->RensTel_ = (isset($data['RensTel_'])) ? $data['RensTel_'] : NULL;
        $this->RensVar0 = (isset($data['RensVar0'])) ? $data['RensVar0'] : NULL;
        $this->RensVar1 = (isset($data['RensVar1'])) ? $data['RensVar1'] : NULL;
        $this->RensVoya = (isset($data['RensVoya'])) ? $data['RensVoya'] : NULL;
        $this->RensProv = (isset($data['RensProv'])) ? $data['RensProv'] : NULL;
        $this->Postit__ = (isset($data['Postit__'])) ? $data['Postit__'] : NULL;
        $this->Imc_info = (isset($data['Imc_info'])) ? $data['Imc_info'] : NULL;
        $this->Conc_info = (isset($data['Conc_info'])) ? $data['Conc_info'] : NULL;
        
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
