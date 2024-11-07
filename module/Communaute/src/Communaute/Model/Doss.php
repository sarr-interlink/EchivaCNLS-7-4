<?php

namespace Communaute\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Doss implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
    public $Arv_Desi;
    public $Arv_Lign;
    public $Arv0;
    public $Arv1;
    public $Arv2;
    public $Arv3;
    public $BiolDern;
    public $Cta_Ume_;
    public $Info;
    public $MediAnte;
    public $MediAnteArv_;
    public $MediAnteCase;
    public $MediCdc_;
    public $MediCsi_;
    public $MediDepiCirc;
    public $MediDepiDat_;
    public $MediDepiNume;
    public $MediDiag;
    public $MediKarn;
    public $MediRefe;
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
    public $MediSero;
    public $MediSeroTyp_;
    public $MediTail;
    public $MediVar0;
    public $MediVar1;
    public $OuvrDat_;
    public $Postit__;
    public $Ref_;
    public $Ref2;
    public $RensAdre;
    public $RensAge_;
    public $RensChrg;
    public $RensDeceCaus;
    public $RensDeceDat_;
    public $RensDoub;
    public $RensEmpl;
    public $RensEthn;
    public $RensEtud;
    public $RensExonArv_;
    public $RensExonTota;
    public $RensIarvDat_;
    public $RensIarvNume;
    public $RensLang;
    public $RensLoca;
    public $RensMatr;
    public $RensNaisDat_;
    public $RensNaisLieu;
    public $RensNati;
    public $RensNom_;
    public $RensNon_Suiv;
    public $RensNon_SuivDat_;
    public $RensNumeUme_;
    public $RensOev_;
    public $RensOev_Etab;
    public $RensOev_Sani;
    public $RensOev_Type;
    public $RensOuvrUnit;
    public $RensPnom;
    public $RensProf;
    public $RensProfPrec;
    public $RensPtmeNume;
    public $RensQuar;
    public $RensSexe;
    public $RensSui2;
    public $RensSuiv;
    public $RensTel_;
    public $RensVar0;
    public $RensVar1;
    public $RensVoya;
    public $SociAutrAgr_Dat_;
    public $SociAutrAgr_Mont;
    public $SociAutrAgr_Suiv;
    public $SociAutrCommActi;
    public $SociAutrCommParo;
    public $SociAutrEconEau_;
    public $SociAutrEconElec;
    public $SociAutrEconLatr;
    public $SociAutrEconNive;
    public $SociAutrEconProf;
    public $SociAutrEconRefr;
    public $SociAutrHabiQual;
    public $SociAutrNutrAide;
    public $SociAutrNutrComp;
    public $SociAutrNutrFreq;
    public $SociAutrResiStat;
    public $SociConjAge_;
    public $SociConjInfo;
    public $SociConjInfoCaus;
    public $SociConjPrec;
    public $SociConjProf;
    public $SociConjRef_;
    public $SociConjSani;
    public $SociConjVih_Chrg;
    public $SociEnfaChrg;
    public $SociEnfaScol;
    public $SociEnfaVih_;
    public $SociEnfaVih_Chrg;
    public $SociFamiAtti;
    public $SociFamiInfo;
    public $SociFinaAdre;
    public $SociFinaChrg;
    public $SociFinaNom_;
    public $SociFinaPnom;
    public $SociFinaPrec;
    public $SociFinaProf;
    public $SociOev_Lien;
    public $SociPersChrg;
    public $SociPersInfo;
    public $SociPersVih_;
    public $SociRefu;
    public $SociUrgeAdre;
    public $SociUrgeNom_;
    public $SociUrgePnom;
    public $SociUrgeTel_;
    public $Tran;
    public $TranDat_;
    public $TranSite;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
	$this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
	$this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
	$this->Arv_Desi = (isset($data['Arv_Desi'])) ? $data['Arv_Desi'] : NULL;
	$this->Arv_Lign = (isset($data['Arv_Lign'])) ? $data['Arv_Lign'] : NULL;
	$this->Arv0 = (isset($data['Arv0'])) ? $data['Arv0'] : NULL;
	$this->Arv1 = (isset($data['Arv1'])) ? $data['Arv1'] : NULL;
	$this->Arv2 = (isset($data['Arv2'])) ? $data['Arv2'] : NULL;
	$this->Arv3 = (isset($data['Arv3'])) ? $data['Arv3'] : NULL;
	$this->BiolDern = (isset($data['BiolDern'])) ? $data['BiolDern'] : NULL;
	$this->Cta_Ume_ = (isset($data['Cta_Ume_'])) ? $data['Cta_Ume_'] : NULL;
	$this->Info = (isset($data['Info'])) ? $data['Info'] : NULL;
	$this->MediAnte = (isset($data['MediAnte'])) ? $data['MediAnte'] : NULL;
	$this->MediAnteArv_ = (isset($data['MediAnteArv_'])) ? $data['MediAnteArv_'] : NULL;
	$this->MediAnteCase = (isset($data['MediAnteCase'])) ? $data['MediAnteCase'] : NULL;
	$this->MediCdc_ = (isset($data['MediCdc_'])) ? $data['MediCdc_'] : NULL;
	$this->MediCsi_ = (isset($data['MediCsi_'])) ? $data['MediCsi_'] : NULL;
	$this->MediDepiCirc = (isset($data['MediDepiCirc'])) ? $data['MediDepiCirc'] : NULL;
	$this->MediDepiDat_ = (isset($data['MediDepiDat_'])) ? $data['MediDepiDat_'] : NULL;
	$this->MediDepiNume = (isset($data['MediDepiNume'])) ? $data['MediDepiNume'] : NULL;
	$this->MediDiag = (isset($data['MediDiag'])) ? $data['MediDiag'] : NULL;
	$this->MediKarn = (isset($data['MediKarn'])) ? $data['MediKarn'] : NULL;
	$this->MediRefe = (isset($data['MediRefe'])) ? $data['MediRefe'] : NULL;
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
	$this->MediSero = (isset($data['MediSero'])) ? $data['MediSero'] : NULL;
	$this->MediSeroTyp_ = (isset($data['MediSeroTyp_'])) ? $data['MediSeroTyp_'] : NULL;
	$this->MediTail = (isset($data['MediTail'])) ? $data['MediTail'] : NULL;
	$this->MediVar0 = (isset($data['MediVar0'])) ? $data['MediVar0'] : NULL;
	$this->MediVar1 = (isset($data['MediVar1'])) ? $data['MediVar1'] : NULL;
	$this->OuvrDat_ = (isset($data['OuvrDat_'])) ? $data['OuvrDat_'] : NULL;
	$this->Postit__ = (isset($data['Postit__'])) ? $data['Postit__'] : NULL;
	$this->Ref_ = (isset($data['Ref_'])) ? $data['Ref_'] : NULL;
	$this->Ref2 = (isset($data['Ref2'])) ? $data['Ref2'] : NULL;
	$this->RensAdre = (isset($data['RensAdre'])) ? $data['RensAdre'] : NULL;
	$this->RensAge_ = (isset($data['RensAge_'])) ? $data['RensAge_'] : NULL;
	$this->RensChrg = (isset($data['RensChrg'])) ? $data['RensChrg'] : NULL;
	$this->RensDeceCaus = (isset($data['RensDeceCaus'])) ? $data['RensDeceCaus'] : NULL;
	$this->RensDeceDat_ = (isset($data['RensDeceDat_'])) ? preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4',  $data['RensDeceDat_'].' 00:00:00' ) : NULL;
	$this->RensDoub = (isset($data['RensDoub'])) ? $data['RensDoub'] : NULL;
	$this->RensEmpl = (isset($data['RensEmpl'])) ? $data['RensEmpl'] : NULL;
	$this->RensEthn = (isset($data['RensEthn'])) ? $data['RensEthn'] : NULL;
	$this->RensEtud = (isset($data['RensEtud'])) ? $data['RensEtud'] : NULL;
	$this->RensExonArv_ = (isset($data['RensExonArv_'])) ? $data['RensExonArv_'] : NULL;
	$this->RensExonTota = (isset($data['RensExonTota'])) ? $data['RensExonTota'] : NULL;
	$this->RensIarvDat_ = (isset($data['RensIarvDat_'])) ? preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4',  $data['RensIarvDat_'].' 00:00:00' ) : NULL;
	$this->RensIarvNume = (isset($data['RensIarvNume'])) ? $data['RensIarvNume'] : NULL;
	$this->RensLang = (isset($data['RensLang'])) ? $data['RensLang'] : NULL;
	$this->RensLoca = (isset($data['RensLoca'])) ? $data['RensLoca'] : NULL;
	$this->RensMatr = (isset($data['RensMatr'])) ? $data['RensMatr'] : NULL;
        $this->RensNaisDat_ = (isset($data['RensNaisDat_'])) ? preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4',  $data['RensNaisDat_'].' 00:00:00' ) : NULL;               
        $this->RensNaisLieu = (isset($data['RensNaisLieu'])) ? $data['RensNaisLieu'] : NULL;
	$this->RensNati = (isset($data['RensNati'])) ? $data['RensNati'] : NULL;
	$this->RensNom_ = (isset($data['RensNom_'])) ? $data['RensNom_'] : NULL;
	$this->RensNon_Suiv = (isset($data['RensNon_Suiv'])) ? $data['RensNon_Suiv'] : NULL;
	$this->RensNon_SuivDat_ = (isset($data['RensNon_SuivDat_'])) ? preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4',  $data['RensNon_SuivDat_'].' 00:00:00' ) : NULL;
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
	$this->SociConjAge_ = (isset($data['SociConjAge_'])) ? $data['SociConjAge_'] : NULL;
	$this->SociConjInfo = (isset($data['SociConjInfo'])) ? $data['SociConjInfo'] : NULL;
	$this->SociConjInfoCaus = (isset($data['SociConjInfoCaus'])) ? $data['SociConjInfoCaus'] : NULL;
	$this->SociConjPrec = (isset($data['SociConjPrec'])) ? $data['SociConjPrec'] : NULL;
	$this->SociConjProf = (isset($data['SociConjProf'])) ? $data['SociConjProf'] : NULL;
	$this->SociConjRef_ = (isset($data['SociConjRef_'])) ? $data['SociConjRef_'] : NULL;
	$this->SociConjSani = (isset($data['SociConjSani'])) ? $data['SociConjSani'] : NULL;
	$this->SociConjVih_Chrg = (isset($data['SociConjVih_Chrg'])) ? $data['SociConjVih_Chrg'] : NULL;
	$this->SociEnfaChrg = (isset($data['SociEnfaChrg'])) ? $data['SociEnfaChrg'] : NULL;
	$this->SociEnfaScol = (isset($data['SociEnfaScol'])) ? $data['SociEnfaScol'] : NULL;
	$this->SociEnfaVih_ = (isset($data['SociEnfaVih_'])) ? $data['SociEnfaVih_'] : NULL;
	$this->SociEnfaVih_Chrg = (isset($data['SociEnfaVih_Chrg'])) ? $data['SociEnfaVih_Chrg'] : NULL;
	$this->SociFamiAtti = (isset($data['SociFamiAtti'])) ? $data['SociFamiAtti'] : NULL;
	$this->SociFamiInfo = (isset($data['SociFamiInfo'])) ? $data['SociFamiInfo'] : NULL;
	$this->SociFinaAdre = (isset($data['SociFinaAdre'])) ? $data['SociFinaAdre'] : NULL;
	$this->SociFinaChrg = (isset($data['SociFinaChrg'])) ? $data['SociFinaChrg'] : NULL;
	$this->SociFinaNom_ = (isset($data['SociFinaNom_'])) ? $data['SociFinaNom_'] : NULL;
	$this->SociFinaPnom = (isset($data['SociFinaPnom'])) ? $data['SociFinaPnom'] : NULL;
	$this->SociFinaPrec = (isset($data['SociFinaPrec'])) ? $data['SociFinaPrec'] : NULL;
	$this->SociFinaProf = (isset($data['SociFinaProf'])) ? $data['SociFinaProf'] : NULL;
	$this->SociOev_Lien = (isset($data['SociOev_Lien'])) ? $data['SociOev_Lien'] : NULL;
	$this->SociPersChrg = (isset($data['SociPersChrg'])) ? $data['SociPersChrg'] : NULL;
	$this->SociPersInfo = (isset($data['SociPersInfo'])) ? $data['SociPersInfo'] : NULL;
	$this->SociPersVih_ = (isset($data['SociPersVih_'])) ? $data['SociPersVih_'] : NULL;
	$this->SociRefu = (isset($data['SociRefu'])) ? $data['SociRefu'] : NULL;
	$this->SociUrgeAdre = (isset($data['SociUrgeAdre'])) ? $data['SociUrgeAdre'] : NULL;
	$this->SociUrgeNom_ = (isset($data['SociUrgeNom_'])) ? $data['SociUrgeNom_'] : NULL;
	$this->SociUrgePnom = (isset($data['SociUrgePnom'])) ? $data['SociUrgePnom'] : NULL;
	$this->SociUrgeTel_ = (isset($data['SociUrgeTel_'])) ? $data['SociUrgeTel_'] : NULL;
	$this->Tran = (isset($data['Tran'])) ? $data['Tran'] : NULL;
	$this->TranDat_ = (isset($data['TranDat_'])) ? $data['TranDat_'] : NULL;
	$this->TranSite = (isset($data['TranSite'])) ? $data['TranSite'] : NULL;
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
