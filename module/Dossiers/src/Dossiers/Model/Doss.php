<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Doss implements InputFilterAwareInterface {

    public $Nume;
    public $subFormFiche;
    public $subFormSocial;
    public $Modi;
    public $Util;
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
    public $count;
    public $RensProv;
    public $Imc_info;
    public $Conc_info;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = (!empty($data['Nume'])) ? $data['Nume'] : "14".hexdec(uniqid());
	$this->Util = (!empty($data['Util'])) ? $data['Util'] : Null;
	$this->Modi = (!empty($data['Modi'])) ? $data['Modi'] : Null;
	$this->Arv_Desi = (!empty($data['Arv_Desi'])) ? $data['Arv_Desi'] : Null;
	$this->Arv_Lign = (!empty($data['Arv_Lign'])) ? $data['Arv_Lign'] : Null;
	$this->Arv0 = (!empty($data['Arv0'])) ? $data['Arv0'] : Null;
	$this->Arv1 = (!empty($data['Arv1'])) ? $data['Arv1'] : Null;
	$this->Arv2 = (!empty($data['Arv2'])) ? $data['Arv2'] : Null;
	$this->Arv3 = (!empty($data['Arv3'])) ? $data['Arv3'] : Null;
	$this->BiolDern = (!empty($data['BiolDern'])) ? $data['BiolDern'] : Null;
	$this->Cta_Ume_ = (!empty($data['Cta_Ume_'])) ? $data['Cta_Ume_'] : Null;
	$this->Info = (!empty($data['Info'])) ? $data['Info'] : Null;
	$this->MediAnte = (!empty($data['MediAnte'])) ? $data['MediAnte'] : Null;
	$this->MediAnteArv_ = (!empty($data['MediAnteArv_'])) ? $data['MediAnteArv_'] : Null;
	$this->MediAnteCase = (!empty($data['MediAnteCase'])) ? $data['MediAnteCase'] : Null;
	$this->MediCdc_ = (!empty($data['MediCdc_'])) ? $data['MediCdc_'] : Null;
	$this->MediCsi_ = (!empty($data['MediCsi_'])) ? $data['MediCsi_'] : Null;
	$this->MediDepiCirc = (!empty($data['MediDepiCirc'])) ? $data['MediDepiCirc'] : Null;
	$this->MediDepiDat_ = (!empty($data['MediDepiDat_'])) ? $data['MediDepiDat_'] : Null;
	$this->MediDepiNume = (!empty($data['MediDepiNume'])) ? $data['MediDepiNume'] : Null;
	$this->MediDiag = (!empty($data['MediDiag'])) ? $data['MediDiag'] : Null;
	$this->MediKarn = (!empty($data['MediKarn'])) ? $data['MediKarn'] : Null;
	$this->MediRefe = (!empty($data['MediRefe'])) ? $data['MediRefe'] : Null;
	$this->MediRisqHomo = (!empty($data['MediRisqHomo'])) ? $data['MediRisqHomo'] : Null;
	$this->MediRisqMere = (!empty($data['MediRisqMere'])) ? $data['MediRisqMere'] : Null;
	$this->MediRisqMult = (!empty($data['MediRisqMult'])) ? $data['MediRisqMult'] : Null;
	$this->MediRisqOcca = (!empty($data['MediRisqOcca'])) ? $data['MediRisqOcca'] : Null;
	$this->MediRisqPart = (!empty($data['MediRisqPart'])) ? $data['MediRisqPart'] : Null;
	$this->MediRisqPiqu = (!empty($data['MediRisqPiqu'])) ? $data['MediRisqPiqu'] : Null;
	$this->MediRisqPoly = (!empty($data['MediRisqPoly'])) ? $data['MediRisqPoly'] : Null;
	$this->MediRisqPres = (!empty($data['MediRisqPres'])) ? $data['MediRisqPres'] : Null;
	$this->MediRisqScar = (!empty($data['MediRisqScar'])) ? $data['MediRisqScar'] : Null;
	$this->MediRisqTran = (!empty($data['MediRisqTran'])) ? $data['MediRisqTran'] : Null;
	$this->MediSero = (!empty($data['MediSero'])) ? $data['MediSero'] : Null;
	$this->MediSeroTyp_ = (!empty($data['MediSeroTyp_'])) ? $data['MediSeroTyp_'] : Null;
	$this->MediTail = (!empty($data['MediTail'])) ? $data['MediTail'] : Null;
	$this->MediVar0 = (!empty($data['MediVar0'])) ? $data['MediVar0'] : Null;
	$this->MediVar1 = (!empty($data['MediVar1'])) ? $data['MediVar1'] : Null;
	$this->OuvrDat_ = (!empty($data['OuvrDat_'])) ? $data['OuvrDat_'] : Null;
	$this->Postit__ = (!empty($data['Postit__'])) ? $data['Postit__'] : Null;
	$this->Ref_ = (!empty($data['Ref_'])) ? $data['Ref_'] : Null;
	$this->Ref2 = (!empty($data['Ref2'])) ? $data['Ref2'] : Null;
	$this->RensAdre = (!empty($data['RensAdre'])) ? $data['RensAdre'] : Null;
	$this->RensAge_ = (!empty($data['RensAge_'])) ? $data['RensAge_'] : Null;
        $this->RensChrg = (!empty($data['RensChrg'])) ? $data['RensChrg'] : Null;
	$this->RensDeceCaus = (!empty($data['RensDeceCaus'])) ? $data['RensDeceCaus'] : Null;
	$this->RensDeceDat_ = (!empty($data['RensDeceDat_'])) ? preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4',  $data['RensDeceDat_'] ) : Null;
	$this->RensDoub = (!empty($data['RensDoub'])) ? $data['RensDoub'] : Null;
	$this->RensEmpl = (!empty($data['RensEmpl'])) ? $data['RensEmpl'] : Null;
	$this->RensEthn = (!empty($data['RensEthn'])) ? $data['RensEthn'] : Null;
	$this->RensEtud = (!empty($data['RensEtud'])) ? $data['RensEtud'] : Null;
	$this->RensExonArv_ = (!empty($data['RensExonArv_'])) ? $data['RensExonArv_'] : Null;
	$this->RensExonTota = (!empty($data['RensExonTota'])) ? $data['RensExonTota'] : Null;
	$this->RensIarvDat_ = (!empty($data['RensIarvDat_'])) ? preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4',  $data['RensIarvDat_'] ) : Null;
	$this->RensIarvNume = (!empty($data['RensIarvNume'])) ? $data['RensIarvNume'] : Null;
	$this->RensLang = (!empty($data['RensLang'])) ? $data['RensLang'] : Null;
	$this->RensLoca = (!empty($data['RensLoca'])) ? $data['RensLoca'] : Null;
	$this->RensMatr = (!empty($data['RensMatr'])) ? $data['RensMatr'] : Null;
        $this->RensNaisDat_ = (!empty($data['RensNaisDat_'])) ? preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4',  $data['RensNaisDat_'] ) : Null;               
        $this->RensNaisLieu = (!empty($data['RensNaisLieu'])) ? $data['RensNaisLieu'] : Null;
	$this->RensNati = (!empty($data['RensNati'])) ? $data['RensNati'] : Null;
	$this->RensNom_ = (!empty($data['RensNom_'])) ? $data['RensNom_'] : Null;
	$this->RensNon_Suiv = (!empty($data['RensNon_Suiv'])) ? $data['RensNon_Suiv'] : Null;
	$this->RensNon_SuivDat_ = (!empty($data['RensNon_SuivDat_'])) ? preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4',  $data['RensNon_SuivDat_'] ) : Null;
	$this->RensNumeUme_ = (!empty($data['RensNumeUme_'])) ? $data['RensNumeUme_'] : Null;
	$this->RensOev_ = (!empty($data['RensOev_'])) ? $data['RensOev_'] : Null;
	$this->RensOev_Etab = (!empty($data['RensOev_Etab'])) ? $data['RensOev_Etab'] : Null;
	$this->RensOev_Sani = (!empty($data['RensOev_Sani'])) ? $data['RensOev_Sani'] : Null;
	$this->RensOev_Type = (!empty($data['RensOev_Type'])) ? $data['RensOev_Type'] : Null;
	$this->RensOuvrUnit = (!empty($data['RensOuvrUnit'])) ? $data['RensOuvrUnit'] : Null;
	$this->RensPnom = (!empty($data['RensPnom'])) ? $data['RensPnom'] : Null;
	$this->RensProf = (!empty($data['RensProf'])) ? $data['RensProf'] : Null;
	$this->RensProfPrec = (!empty($data['RensProfPrec'])) ? $data['RensProfPrec'] : Null;
	$this->RensPtmeNume = (!empty($data['RensPtmeNume'])) ? $data['RensPtmeNume'] : Null;
	$this->RensQuar = (!empty($data['RensQuar'])) ? $data['RensQuar'] : Null;
	$this->RensSexe = (!empty($data['RensSexe'])) ? $data['RensSexe'] : Null;
	$this->RensSui2 = (!empty($data['RensSui2'])) ? $data['RensSui2'] : Null;
	$this->RensSuiv = (!empty($data['RensSuiv'])) ? $data['RensSuiv'] : Null;
	$this->RensTel_ = (!empty($data['RensTel_'])) ? $data['RensTel_'] : Null;
	$this->RensVar0 = (!empty($data['RensVar0'])) ? $data['RensVar0'] : Null;
	$this->RensVar1 = (!empty($data['RensVar1'])) ? $data['RensVar1'] : Null;
	$this->RensVoya = (!empty($data['RensVoya'])) ? $data['RensVoya'] : Null;
	$this->SociAutrAgr_Dat_ = (!empty($data['SociAutrAgr_Dat_'])) ? $data['SociAutrAgr_Dat_'] : Null;
	$this->SociAutrAgr_Mont = (!empty($data['SociAutrAgr_Mont'])) ? $data['SociAutrAgr_Mont'] : Null;
	$this->SociAutrAgr_Suiv = (!empty($data['SociAutrAgr_Suiv'])) ? $data['SociAutrAgr_Suiv'] : Null;
	$this->SociAutrCommActi = (!empty($data['SociAutrCommActi'])) ? $data['SociAutrCommActi'] : Null;
	$this->SociAutrCommParo = (!empty($data['SociAutrCommParo'])) ? $data['SociAutrCommParo'] : Null;
	$this->SociAutrEconEau_ = (!empty($data['SociAutrEconEau_'])) ? $data['SociAutrEconEau_'] : Null;
	$this->SociAutrEconElec = (!empty($data['SociAutrEconElec'])) ? $data['SociAutrEconElec'] : Null;
	$this->SociAutrEconLatr = (!empty($data['SociAutrEconLatr'])) ? $data['SociAutrEconLatr'] : Null;
	$this->SociAutrEconNive = (!empty($data['SociAutrEconNive'])) ? $data['SociAutrEconNive'] : Null;
	$this->SociAutrEconProf = (!empty($data['SociAutrEconProf'])) ? $data['SociAutrEconProf'] : Null;
	$this->SociAutrEconRefr = (!empty($data['SociAutrEconRefr'])) ? $data['SociAutrEconRefr'] : Null;
	$this->SociAutrHabiQual = (!empty($data['SociAutrHabiQual'])) ? $data['SociAutrHabiQual'] : Null;
	$this->SociAutrNutrAide = (!empty($data['SociAutrNutrAide'])) ? $data['SociAutrNutrAide'] : Null;
	$this->SociAutrNutrComp = (!empty($data['SociAutrNutrComp'])) ? $data['SociAutrNutrComp'] : Null;
	$this->SociAutrNutrFreq = (!empty($data['SociAutrNutrFreq'])) ? $data['SociAutrNutrFreq'] : Null;
	$this->SociAutrResiStat = (!empty($data['SociAutrResiStat'])) ? $data['SociAutrResiStat'] : Null;
	$this->SociConjAge_ = (!empty($data['SociConjAge_'])) ? $data['SociConjAge_'] : Null;
	$this->SociConjInfo = (!empty($data['SociConjInfo'])) ? $data['SociConjInfo'] : Null;
	$this->SociConjInfoCaus = (!empty($data['SociConjInfoCaus'])) ? $data['SociConjInfoCaus'] : Null;
	$this->SociConjPrec = (!empty($data['SociConjPrec'])) ? $data['SociConjPrec'] : Null;
	$this->SociConjProf = (!empty($data['SociConjProf'])) ? $data['SociConjProf'] : Null;
	$this->SociConjRef_ = (!empty($data['SociConjRef_'])) ? $data['SociConjRef_'] : Null;
	$this->SociConjSani = (!empty($data['SociConjSani'])) ? $data['SociConjSani'] : Null;
	$this->SociConjVih_Chrg = (!empty($data['SociConjVih_Chrg'])) ? $data['SociConjVih_Chrg'] : Null;
	$this->SociEnfaChrg = (!empty($data['SociEnfaChrg'])) ? $data['SociEnfaChrg'] : Null;
	$this->SociEnfaScol = (!empty($data['SociEnfaScol'])) ? $data['SociEnfaScol'] : Null;
	$this->SociEnfaVih_ = (!empty($data['SociEnfaVih_'])) ? $data['SociEnfaVih_'] : Null;
	$this->SociEnfaVih_Chrg = (!empty($data['SociEnfaVih_Chrg'])) ? $data['SociEnfaVih_Chrg'] : Null;
	$this->SociFamiAtti = (!empty($data['SociFamiAtti'])) ? $data['SociFamiAtti'] : Null;
	$this->SociFamiInfo = (!empty($data['SociFamiInfo'])) ? $data['SociFamiInfo'] : Null;
	$this->SociFinaAdre = (!empty($data['SociFinaAdre'])) ? $data['SociFinaAdre'] : Null;
	$this->SociFinaChrg = (!empty($data['SociFinaChrg'])) ? $data['SociFinaChrg'] : Null;
	$this->SociFinaNom_ = (!empty($data['SociFinaNom_'])) ? $data['SociFinaNom_'] : Null;
	$this->SociFinaPnom = (!empty($data['SociFinaPnom'])) ? $data['SociFinaPnom'] : Null;
	$this->SociFinaPrec = (!empty($data['SociFinaPrec'])) ? $data['SociFinaPrec'] : Null;
	$this->SociFinaProf = (!empty($data['SociFinaProf'])) ? $data['SociFinaProf'] : Null;
	$this->SociOev_Lien = (!empty($data['SociOev_Lien'])) ? $data['SociOev_Lien'] : Null;
	$this->SociPersChrg = (!empty($data['SociPersChrg'])) ? $data['SociPersChrg'] : Null;
	$this->SociPersInfo = (!empty($data['SociPersInfo'])) ? $data['SociPersInfo'] : Null;
	$this->SociPersVih_ = (!empty($data['SociPersVih_'])) ? $data['SociPersVih_'] : Null;
	$this->SociRefu = (!empty($data['SociRefu'])) ? $data['SociRefu'] : Null;
	$this->SociUrgeAdre = (!empty($data['SociUrgeAdre'])) ? $data['SociUrgeAdre'] : Null;
	$this->SociUrgeNom_ = (!empty($data['SociUrgeNom_'])) ? $data['SociUrgeNom_'] : Null;
	$this->SociUrgePnom = (!empty($data['SociUrgePnom'])) ? $data['SociUrgePnom'] : Null;
	$this->SociUrgeTel_ = (!empty($data['SociUrgeTel_'])) ? $data['SociUrgeTel_'] : Null;
	$this->Tran = (!empty($data['Tran'])) ? $data['Tran'] : Null;
	$this->TranDat_ = (!empty($data['TranDat_'])) ? $data['TranDat_'] : Null;
	$this->TranSite = (!empty($data['TranSite'])) ? $data['TranSite'] : Null;
        $this->count = (isset($data['count']) && !empty($data['count'])) ? $data['count'] : 0;
        $this->RensProv = (isset($data['RensProv']) && !empty($data['RensProv'])) ? $data['RensProv'] : 0;
        $this->Imc_info = (isset($data['Imc_info']) && !empty($data['Imc_info'])) ? $data['Imc_info'] : Null;
        $this->Conc_info = (isset($data['Conc_info']) && !empty($data['Conc_info'])) ? $data['Conc_info'] : Null;
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
