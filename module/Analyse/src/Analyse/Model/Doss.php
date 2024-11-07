<?php

namespace Analyse\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Doss implements InputFilterAwareInterface {

    public $Nume;
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
		$this->Nume = (isset($data['Nume']) &&!empty($data['Nume'])) ? $data['Nume'] : NULL;
		$this->Util = (isset($data['Util']) &&!empty($data['Util'])) ? $data['Util'] : NULL;
		$this->Modi = (isset($data['Modi']) &&!empty($data['Modi'])) ? $data['Modi'] : NULL;
		$this->Arv_Desi = (isset($data['Arv_Desi']) &&!empty($data['Arv_Desi'])) ? $data['Arv_Desi'] : NULL;
		$this->Arv_Lign = (isset($data['Arv_Lign']) &&!empty($data['Arv_Lign'])) ? $data['Arv_Lign'] : NULL;
		$this->Arv0 = (isset($data['Arv0']) &&!empty($data['Arv0'])) ? $data['Arv0'] : NULL;
		$this->Arv1 = (isset($data['Arv1']) &&!empty($data['Arv1'])) ? $data['Arv1'] : NULL;
		$this->Arv2 = (isset($data['Arv2']) &&!empty($data['Arv2'])) ? $data['Arv2'] : NULL;
		$this->Arv3 = (isset($data['Arv3']) &&!empty($data['Arv3'])) ? $data['Arv3'] : NULL;
		$this->BiolDern = (isset($data['BiolDern']) &&!empty($data['BiolDern'])) ? $data['BiolDern'] : NULL;
		$this->Cta_Ume_ = (isset($data['Cta_Ume_']) &&!empty($data['Cta_Ume_'])) ? $data['Cta_Ume_'] : NULL;
		$this->Info = (isset($data['Info']) &&!empty($data['Info'])) ? $data['Info'] : NULL;
		$this->MediAnte = (isset($data['MediAnte']) &&!empty($data['MediAnte'])) ? $data['MediAnte'] : NULL;
		$this->MediAnteArv_ = (isset($data['MediAnteArv_']) &&!empty($data['MediAnteArv_'])) ? $data['MediAnteArv_'] : NULL;
		$this->MediAnteCase = (isset($data['MediAnteCase']) &&!empty($data['MediAnteCase'])) ? $data['MediAnteCase'] : NULL;
		$this->MediCdc_ = (isset($data['MediCdc_']) &&!empty($data['MediCdc_'])) ? $data['MediCdc_'] : NULL;
		$this->MediCsi_ = (isset($data['MediCsi_']) &&!empty($data['MediCsi_'])) ? $data['MediCsi_'] : NULL;
		$this->MediDepiCirc = (isset($data['MediDepiCirc']) &&!empty($data['MediDepiCirc'])) ? $data['MediDepiCirc'] : NULL;
		$this->MediDepiDat_ = (isset($data['MediDepiDat_']) &&!empty($data['MediDepiDat_'])) ? $data['MediDepiDat_'] : NULL;
		$this->MediDepiNume = (isset($data['MediDepiNume']) &&!empty($data['MediDepiNume'])) ? $data['MediDepiNume'] : NULL;
		$this->MediDiag = (isset($data['MediDiag']) &&!empty($data['MediDiag'])) ? $data['MediDiag'] : NULL;
		$this->MediKarn = (isset($data['MediKarn']) &&!empty($data['MediKarn'])) ? $data['MediKarn'] : NULL;
		$this->MediRefe = (isset($data['MediRefe']) &&!empty($data['MediRefe'])) ? $data['MediRefe'] : NULL;
		$this->MediRisqHomo = (isset($data['MediRisqHomo']) &&!empty($data['MediRisqHomo'])) ? $data['MediRisqHomo'] : NULL;
		$this->MediRisqMere = (isset($data['MediRisqMere']) &&!empty($data['MediRisqMere'])) ? $data['MediRisqMere'] : NULL;
		$this->MediRisqMult = (isset($data['MediRisqMult']) &&!empty($data['MediRisqMult'])) ? $data['MediRisqMult'] : NULL;
		$this->MediRisqOcca = (isset($data['MediRisqOcca']) &&!empty($data['MediRisqOcca'])) ? $data['MediRisqOcca'] : NULL;
		$this->MediRisqPart = (isset($data['MediRisqPart']) &&!empty($data['MediRisqPart'])) ? $data['MediRisqPart'] : NULL;
		$this->MediRisqPiqu = (isset($data['MediRisqPiqu']) &&!empty($data['MediRisqPiqu'])) ? $data['MediRisqPiqu'] : NULL;
		$this->MediRisqPoly = (isset($data['MediRisqPoly']) &&!empty($data['MediRisqPoly'])) ? $data['MediRisqPoly'] : NULL;
		$this->MediRisqPres = (isset($data['MediRisqPres']) &&!empty($data['MediRisqPres'])) ? $data['MediRisqPres'] : NULL;
		$this->MediRisqScar = (isset($data['MediRisqScar']) &&!empty($data['MediRisqScar'])) ? $data['MediRisqScar'] : NULL;
		$this->MediRisqTran = (isset($data['MediRisqTran']) &&!empty($data['MediRisqTran'])) ? $data['MediRisqTran'] : NULL;
		$this->MediSero = (isset($data['MediSero']) &&!empty($data['MediSero'])) ? $data['MediSero'] : NULL;
		$this->MediSeroTyp_ = (isset($data['MediSeroTyp_']) &&!empty($data['MediSeroTyp_'])) ? $data['MediSeroTyp_'] : NULL;
		$this->MediTail = (isset($data['MediTail']) &&!empty($data['MediTail'])) ? $data['MediTail'] : NULL;
		$this->MediVar0 = (isset($data['MediVar0']) &&!empty($data['MediVar0'])) ? $data['MediVar0'] : NULL;
		$this->MediVar1 = (isset($data['MediVar1']) &&!empty($data['MediVar1'])) ? $data['MediVar1'] : NULL;
		$this->OuvrDat_ = (isset($data['OuvrDat_']) && $data['OuvrDat_']!='0000-00-00 00:00:00') ? substr($data['OuvrDat_'], 0, -9) : NULL;
		$this->Postit__ = (isset($data['Postit__']) &&!empty($data['Postit__'])) ? $data['Postit__'] : NULL;
		$this->Ref_ = (isset($data['Ref_']) &&!empty($data['Ref_'])) ? $data['Ref_'] : NULL;
		$this->Ref2 = (isset($data['Ref2']) &&!empty($data['Ref2'])) ? $data['Ref2'] : NULL;
		$this->RensAdre = (isset($data['RensAdre']) &&!empty($data['RensAdre'])) ? $data['RensAdre'] : NULL;
		$this->RensAge_ = (isset($data['RensAge_']) &&!empty($data['RensAge_'])) ? $data['RensAge_'] : NULL;
		$this->RensChrg = (isset($data['RensChrg']) &&!empty($data['RensChrg'])) ? $data['RensChrg'] : NULL;
		$this->RensDeceCaus = (isset($data['RensDeceCaus']) &&!empty($data['RensDeceCaus'])) ? $data['RensDeceCaus'] : NULL;
		$this->RensDeceDat_ = (isset($data['RensDeceDat_']) && $data['RensDeceDat_']!='0000-00-00 00:00:00') ? substr($data['RensDeceDat_'], 0, -9) : NULL;
		$this->RensDoub = (isset($data['RensDoub']) &&!empty($data['RensDoub'])) ? $data['RensDoub'] : NULL;
		$this->RensEmpl = (isset($data['RensEmpl']) &&!empty($data['RensEmpl'])) ? $data['RensEmpl'] : NULL;
		$this->RensEthn = (isset($data['RensEthn']) &&!empty($data['RensEthn'])) ? $data['RensEthn'] : NULL;
$this->RensEtud = (isset($data['RensEtud']) &&!empty($data['RensEtud'])) ? $data['RensEtud'] : NULL;
$this->RensExonArv_ = (isset($data['RensExonArv_']) &&!empty($data['RensExonArv_'])) ? $data['RensExonArv_'] : NULL;
$this->RensExonTota = (isset($data['RensExonTota']) &&!empty($data['RensExonTota'])) ? $data['RensExonTota'] : NULL;
$this->RensIarvDat_ = (isset($data['RensIarvDat_']) &&!empty($data['RensIarvDat_'])) ? $data['RensIarvDat_'] : NULL;
$this->RensIarvNume = (isset($data['RensIarvNume']) &&!empty($data['RensIarvNume'])) ? $data['RensIarvNume'] : NULL;
$this->RensLang = (isset($data['RensLang']) &&!empty($data['RensLang'])) ? $data['RensLang'] : NULL;
$this->RensLoca = (isset($data['RensLoca']) &&!empty($data['RensLoca'])) ? $data['RensLoca'] : NULL;
$this->RensMatr = (isset($data['RensMatr']) &&!empty($data['RensMatr'])) ? $data['RensMatr'] : NULL;
$this->RensNaisDat_ = (isset($data['RensNaisDat_']) &&!empty($data['RensNaisDat_'])) ? $data['RensNaisDat_'] : NULL;
$this->RensNaisLieu = (isset($data['RensNaisLieu']) &&!empty($data['RensNaisLieu'])) ? $data['RensNaisLieu'] : NULL;
$this->RensNati = (isset($data['RensNati']) &&!empty($data['RensNati'])) ? $data['RensNati'] : NULL;
$this->RensNom_ = (isset($data['RensNom_']) &&!empty($data['RensNom_'])) ? $data['RensNom_'] : NULL;
$this->RensNon_Suiv = (isset($data['RensNon_Suiv']) &&!empty($data['RensNon_Suiv'])) ? $data['RensNon_Suiv'] : NULL;
$this->RensNon_SuivDat_ = (isset($data['RensNon_SuivDat_']) &&!empty($data['RensNon_SuivDat_'])) ? $data['RensNon_SuivDat_'] : NULL;
$this->RensNumeUme_ = (isset($data['RensNumeUme_']) &&!empty($data['RensNumeUme_'])) ? $data['RensNumeUme_'] : NULL;
$this->RensOev_ = (isset($data['RensOev_']) &&!empty($data['RensOev_'])) ? $data['RensOev_'] : NULL;
$this->RensOev_Etab = (isset($data['RensOev_Etab']) &&!empty($data['RensOev_Etab'])) ? $data['RensOev_Etab'] : NULL;
$this->RensOev_Sani = (isset($data['RensOev_Sani']) &&!empty($data['RensOev_Sani'])) ? $data['RensOev_Sani'] : NULL;
$this->RensOev_Type = (isset($data['RensOev_Type']) &&!empty($data['RensOev_Type'])) ? $data['RensOev_Type'] : NULL;
$this->RensOuvrUnit = (isset($data['RensOuvrUnit']) &&!empty($data['RensOuvrUnit'])) ? $data['RensOuvrUnit'] : NULL;
$this->RensPnom = (isset($data['RensPnom']) &&!empty($data['RensPnom'])) ? $data['RensPnom'] : NULL;
$this->RensProf = (isset($data['RensProf']) &&!empty($data['RensProf'])) ? $data['RensProf'] : NULL;
$this->RensProfPrec = (isset($data['RensProfPrec']) &&!empty($data['RensProfPrec'])) ? $data['RensProfPrec'] : NULL;
$this->RensPtmeNume = (isset($data['RensPtmeNume']) &&!empty($data['RensPtmeNume'])) ? $data['RensPtmeNume'] : NULL;
$this->RensQuar = (isset($data['RensQuar']) &&!empty($data['RensQuar'])) ? $data['RensQuar'] : NULL;
$this->RensSexe = (isset($data['RensSexe']) &&!empty($data['RensSexe'])) ? $data['RensSexe'] : NULL;
$this->RensSui2 = (isset($data['RensSui2']) &&!empty($data['RensSui2'])) ? $data['RensSui2'] : NULL;
$this->RensSuiv = (isset($data['RensSuiv']) &&!empty($data['RensSuiv'])) ? $data['RensSuiv'] : NULL;
$this->RensTel_ = (isset($data['RensTel_']) &&!empty($data['RensTel_'])) ? $data['RensTel_'] : NULL;
$this->RensVar0 = (isset($data['RensVar0']) &&!empty($data['RensVar0'])) ? $data['RensVar0'] : NULL;
$this->RensVar1 = (isset($data['RensVar1']) &&!empty($data['RensVar1'])) ? $data['RensVar1'] : NULL;
$this->RensVoya = (isset($data['RensVoya']) &&!empty($data['RensVoya'])) ? $data['RensVoya'] : NULL;
$this->SociAutrAgr_Dat_ = (isset($data['SociAutrAgr_Dat_']) &&!empty($data['SociAutrAgr_Dat_'])) ? $data['SociAutrAgr_Dat_'] : NULL;
$this->SociAutrAgr_Mont = (isset($data['SociAutrAgr_Mont']) &&!empty($data['SociAutrAgr_Mont'])) ? $data['SociAutrAgr_Mont'] : NULL;
$this->SociAutrAgr_Suiv = (isset($data['SociAutrAgr_Suiv']) &&!empty($data['SociAutrAgr_Suiv'])) ? $data['SociAutrAgr_Suiv'] : NULL;
$this->SociAutrCommActi = (isset($data['SociAutrCommActi']) &&!empty($data['SociAutrCommActi'])) ? $data['SociAutrCommActi'] : NULL;
$this->SociAutrCommParo = (isset($data['SociAutrCommParo']) &&!empty($data['SociAutrCommParo'])) ? $data['SociAutrCommParo'] : NULL;
$this->SociAutrEconEau_ = (isset($data['SociAutrEconEau_']) &&!empty($data['SociAutrEconEau_'])) ? $data['SociAutrEconEau_'] : NULL;
$this->SociAutrEconElec = (isset($data['SociAutrEconElec']) &&!empty($data['SociAutrEconElec'])) ? $data['SociAutrEconElec'] : NULL;
$this->SociAutrEconLatr = (isset($data['SociAutrEconLatr']) &&!empty($data['SociAutrEconLatr'])) ? $data['SociAutrEconLatr'] : NULL;
$this->SociAutrEconNive = (isset($data['SociAutrEconNive']) &&!empty($data['SociAutrEconNive'])) ? $data['SociAutrEconNive'] : NULL;
$this->SociAutrEconProf = (isset($data['SociAutrEconProf']) &&!empty($data['SociAutrEconProf'])) ? $data['SociAutrEconProf'] : NULL;
$this->SociAutrEconRefr = (isset($data['SociAutrEconRefr']) &&!empty($data['SociAutrEconRefr'])) ? $data['SociAutrEconRefr'] : NULL;
$this->SociAutrHabiQual = (isset($data['SociAutrHabiQual']) &&!empty($data['SociAutrHabiQual'])) ? $data['SociAutrHabiQual'] : NULL;
$this->SociAutrNutrAide = (isset($data['SociAutrNutrAide']) &&!empty($data['SociAutrNutrAide'])) ? $data['SociAutrNutrAide'] : NULL;
$this->SociAutrNutrComp = (isset($data['SociAutrNutrComp']) &&!empty($data['SociAutrNutrComp'])) ? $data['SociAutrNutrComp'] : NULL;
$this->SociAutrNutrFreq = (isset($data['SociAutrNutrFreq']) &&!empty($data['SociAutrNutrFreq'])) ? $data['SociAutrNutrFreq'] : NULL;
$this->SociAutrResiStat = (isset($data['SociAutrResiStat']) &&!empty($data['SociAutrResiStat'])) ? $data['SociAutrResiStat'] : NULL;
$this->SociConjAge_ = (isset($data['SociConjAge_']) &&!empty($data['SociConjAge_'])) ? $data['SociConjAge_'] : NULL;
$this->SociConjInfo = (isset($data['SociConjInfo']) &&!empty($data['SociConjInfo'])) ? $data['SociConjInfo'] : NULL;
$this->SociConjInfoCaus = (isset($data['SociConjInfoCaus']) &&!empty($data['SociConjInfoCaus'])) ? $data['SociConjInfoCaus'] : NULL;
$this->SociConjPrec = (isset($data['SociConjPrec']) &&!empty($data['SociConjPrec'])) ? $data['SociConjPrec'] : NULL;
$this->SociConjProf = (isset($data['SociConjProf']) &&!empty($data['SociConjProf'])) ? $data['SociConjProf'] : NULL;
$this->SociConjRef_ = (isset($data['SociConjRef_']) &&!empty($data['SociConjRef_'])) ? $data['SociConjRef_'] : NULL;
$this->SociConjSani = (isset($data['SociConjSani']) &&!empty($data['SociConjSani'])) ? $data['SociConjSani'] : NULL;
$this->SociConjVih_Chrg = (isset($data['SociConjVih_Chrg']) &&!empty($data['SociConjVih_Chrg'])) ? $data['SociConjVih_Chrg'] : NULL;
$this->SociEnfaChrg = (isset($data['SociEnfaChrg']) &&!empty($data['SociEnfaChrg'])) ? $data['SociEnfaChrg'] : NULL;
$this->SociEnfaScol = (isset($data['SociEnfaScol']) &&!empty($data['SociEnfaScol'])) ? $data['SociEnfaScol'] : NULL;
$this->SociEnfaVih_ = (isset($data['SociEnfaVih_']) &&!empty($data['SociEnfaVih_'])) ? $data['SociEnfaVih_'] : NULL;
$this->SociEnfaVih_Chrg = (isset($data['SociEnfaVih_Chrg']) &&!empty($data['SociEnfaVih_Chrg'])) ? $data['SociEnfaVih_Chrg'] : NULL;
$this->SociFamiAtti = (isset($data['SociFamiAtti']) &&!empty($data['SociFamiAtti'])) ? $data['SociFamiAtti'] : NULL;
$this->SociFamiInfo = (isset($data['SociFamiInfo']) &&!empty($data['SociFamiInfo'])) ? $data['SociFamiInfo'] : NULL;
$this->SociFinaAdre = (isset($data['SociFinaAdre']) &&!empty($data['SociFinaAdre'])) ? $data['SociFinaAdre'] : NULL;
$this->SociFinaChrg = (isset($data['SociFinaChrg']) &&!empty($data['SociFinaChrg'])) ? $data['SociFinaChrg'] : NULL;
$this->SociFinaNom_ = (isset($data['SociFinaNom_']) &&!empty($data['SociFinaNom_'])) ? $data['SociFinaNom_'] : NULL;
$this->SociFinaPnom = (isset($data['SociFinaPnom']) &&!empty($data['SociFinaPnom'])) ? $data['SociFinaPnom'] : NULL;
$this->SociFinaPrec = (isset($data['SociFinaPrec']) &&!empty($data['SociFinaPrec'])) ? $data['SociFinaPrec'] : NULL;
$this->SociFinaProf = (isset($data['SociFinaProf']) &&!empty($data['SociFinaProf'])) ? $data['SociFinaProf'] : NULL;
$this->SociOev_Lien = (isset($data['SociOev_Lien']) &&!empty($data['SociOev_Lien'])) ? $data['SociOev_Lien'] : NULL;
$this->SociPersChrg = (isset($data['SociPersChrg']) &&!empty($data['SociPersChrg'])) ? $data['SociPersChrg'] : NULL;
$this->SociPersInfo = (isset($data['SociPersInfo']) &&!empty($data['SociPersInfo'])) ? $data['SociPersInfo'] : NULL;
$this->SociPersVih_ = (isset($data['SociPersVih_']) &&!empty($data['SociPersVih_'])) ? $data['SociPersVih_'] : NULL;
$this->SociRefu = (isset($data['SociRefu']) &&!empty($data['SociRefu'])) ? $data['SociRefu'] : NULL;
$this->SociUrgeAdre = (isset($data['SociUrgeAdre']) &&!empty($data['SociUrgeAdre'])) ? $data['SociUrgeAdre'] : NULL;
$this->SociUrgeNom_ = (isset($data['SociUrgeNom_']) &&!empty($data['SociUrgeNom_'])) ? $data['SociUrgeNom_'] : NULL;
$this->SociUrgePnom = (isset($data['SociUrgePnom']) &&!empty($data['SociUrgePnom'])) ? $data['SociUrgePnom'] : NULL;
$this->SociUrgeTel_ = (isset($data['SociUrgeTel_']) &&!empty($data['SociUrgeTel_'])) ? $data['SociUrgeTel_'] : NULL;
$this->Tran = (isset($data['Tran']) &&!empty($data['Tran'])) ? $data['Tran'] : NULL;
$this->TranDat_ = (isset($data['TranDat_']) &&!empty($data['TranDat_'])) ? $data['TranDat_'] : NULL;
$this->TranSite = (isset($data['TranSite']) &&!empty($data['TranSite'])) ? $data['TranSite'] : NULL;
$this->count = (isset($data['count'])) ? $data['count'] : NULL;
$this->RensProv = (isset($data['RensProv'])) ? $data['RensProv'] : NULL;
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
