<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Conf implements InputFilterAwareInterface {

    public $Nume;
	public $Util;
	public $Modi;
    public $AbrgEspa;
    public $AccuMotiDefa;
    public $AlerMess;
    public $AnalRequ;
    public $AnalRequGene;
    public $Bi00;
    public $Bi01;
    public $Bi02;
    public $Bi03;
    public $Bi04;
    public $Bi05;
    public $Bi06;
    public $Bi11;
    public $Bi12;
    public $Bi13;
    public $ConfAccuPaim;
    public $ConfAler;
    public $ConfComm;
    public $ConfDeliPaim;
    public $ConfDepi;
    public $ConfExon;
    public $ConfExpoOo__;
    public $ConfMediCons;
    public $ConfOev_;
    public $Dat_Vers;
    public $Dat_VersMini;
    public $DeliDiza;
    public $DeliServ;
    public $DocsChem;
	public $DossEthn;
	public $DossLang;
	public $DossRef_Libr;
	public $DossSais;
	public $Ent0;
	public $Ent1;
	public $ExecVers;
	public $Ftp_Auto;
	public $Ftp_Chem;
	public $Ftp_Doss;
	public $Ftp_Jrnl;
	public $Ftp_Motp;
	public $Ftp_Util;
	public $Horo;
	public $IarvNom_;
	public $LaboNom_;
	public $LitsNomb;
	public $MediConsTail;
	public $MenuAccu;
	public $MenuComm;
	public $MenuDepi;
	public $MenuLabo;
	public $MenuOev_;
	public $MoisFile;
    public $MotpAccu;
    public $MotpDoss;
    public $OrdoDupl;
    public $ParaSql_Motp;
    public $PharDeli;
    public $PosoDefa;
    public $Pres;
    public $Reta;
    public $SantPhar;
    public $SauvChe0;
    public $SauvChe1;
    public $SauvChe2;
    public $SauvDat_;
    public $SauvErro;
    public $SauvHeur;
    public $SauvMotp;
    public $SauvNom_;
    public $ServRdv_;
    public $ServRdv_Veri;
    public $SiteCode;
    public $Stoc;
    public $StocItemNume;
    public $TradAngl;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "06".hexdec(uniqid());
		$this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
		$this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
		$this->AbrgEspa = (isset($data['AbrgEspa'])) ? $data['AbrgEspa'] : NULL;
		$this->AccuMotiDefa = (isset($data['AccuMotiDefa'])) ? $data['AccuMotiDefa'] : NULL;
		$this->AlerMess = (isset($data['AlerMess'])) ? $data['AlerMess'] : NULL;
		$this->AnalRequ = (isset($data['AnalRequ'])) ? $data['AnalRequ'] : NULL;
		$this->AnalRequGene = (isset($data['AnalRequGene'])) ? $data['AnalRequGene'] : NULL;
		$this->Bi00 = (isset($data['Bi00'])) ? $data['Bi00'] : NULL;
		$this->Bi01 = (isset($data['Bi01'])) ? $data['Bi01'] : NULL;
		$this->Bi02 = (isset($data['Bi02'])) ? $data['Bi02'] : NULL;
		$this->Bi03 = (isset($data['Bi03'])) ? $data['Bi03'] : NULL;
		$this->Bi04 = (isset($data['Bi04'])) ? $data['Bi04'] : NULL;
		$this->Bi05 = (isset($data['Bi05'])) ? $data['Bi05'] : NULL;
		$this->Bi06 = (isset($data['Bi06'])) ? $data['Bi06'] : NULL;
		$this->Bi11 = (isset($data['Bi11'])) ? $data['Bi11'] : NULL;
		$this->Bi12 = (isset($data['Bi12'])) ? $data['Bi12'] : NULL;
		$this->Bi13 = (isset($data['Bi13'])) ? $data['Bi13'] : NULL;
		$this->ConfAccuPaim = (isset($data['ConfAccuPaim'])) ? $data['ConfAccuPaim'] : NULL;
		$this->ConfAler = (isset($data['ConfAler'])) ? $data['ConfAler'] : NULL;
		$this->ConfComm = (isset($data['ConfComm'])) ? $data['ConfComm'] : NULL;
		$this->ConfDeliPaim = (isset($data['ConfDeliPaim'])) ? $data['ConfDeliPaim'] : NULL;
		$this->ConfDepi = (isset($data['ConfDepi'])) ? $data['ConfDepi'] : NULL;
		$this->ConfExon = (isset($data['ConfExon'])) ? $data['ConfExon'] : NULL;
		$this->ConfExpoOo__ = (isset($data['ConfExpoOo__'])) ? $data['ConfExpoOo__'] : NULL;
		$this->ConfMediCons = (isset($data['ConfMediCons'])) ? $data['ConfMediCons'] : NULL;
		$this->ConfOev_ = (isset($data['ConfOev_'])) ? $data['ConfOev_'] : NULL;
		$this->Dat_Vers = (isset($data['Dat_Vers'])) ? $data['Dat_Vers'] : NULL;
		$this->Dat_VersMini = (isset($data['Dat_VersMini'])) ? $data['Dat_VersMini'] : NULL;
		$this->DeliDiza = (isset($data['DeliDiza'])) ? $data['DeliDiza'] : NULL;
		$this->DeliServ = (isset($data['DeliServ'])) ? $data['DeliServ'] : NULL;
		$this->DocsChem = (isset($data['DocsChem'])) ? $data['DocsChem'] : NULL;
		$this->DossEthn = (isset($data['DossEthn'])) ? $data['DossEthn'] : NULL;
		$this->DossLang = (isset($data['DossLang'])) ? $data['DossLang'] : NULL;
		$this->DossRef_Libr = (isset($data['DossRef_Libr'])) ? $data['DossRef_Libr'] : NULL;
		$this->DossSais = (isset($data['DossSais'])) ? $data['DossSais'] : NULL;
		$this->Ent0 = (isset($data['Ent0'])) ? $data['Ent0'] : NULL;
		$this->Ent1 = (isset($data['Ent1'])) ? $data['Ent1'] : NULL;
		$this->ExecVers = (isset($data['ExecVers'])) ? $data['ExecVers'] : NULL;
		$this->Ftp_Auto = (isset($data['Ftp_Auto'])) ? $data['Ftp_Auto'] : NULL;
		$this->Ftp_Chem = (isset($data['Ftp_Chem'])) ? $data['Ftp_Chem'] : NULL;
		$this->Ftp_Doss = (isset($data['Ftp_Doss'])) ? $data['Ftp_Doss'] : NULL;
		$this->Ftp_Jrnl = (isset($data['Ftp_Jrnl'])) ? $data['Ftp_Jrnl'] : NULL;
		$this->Ftp_Motp = (isset($data['Ftp_Motp'])) ? $data['Ftp_Motp'] : NULL;
		$this->Ftp_Util = (isset($data['Ftp_Util'])) ? $data['Ftp_Util'] : NULL;
		$this->Horo = (isset($data['Horo'])) ? $data['Horo'] : NULL;
		$this->IarvNom_ = (isset($data['IarvNom_'])) ? $data['IarvNom_'] : NULL;
		$this->LaboNom_ = (isset($data['LaboNom_'])) ? $data['LaboNom_'] : NULL;
		$this->LitsNomb = (isset($data['LitsNomb'])) ? $data['LitsNomb'] : NULL;
		$this->MediConsTail = (isset($data['MediConsTail'])) ? $data['MediConsTail'] : NULL;
		$this->MenuAccu = (isset($data['MenuAccu'])) ? $data['MenuAccu'] : NULL;
		$this->MenuComm = (isset($data['MenuComm'])) ? $data['MenuComm'] : NULL;
		$this->MenuDepi = (isset($data['MenuDepi'])) ? $data['MenuDepi'] : NULL;
		$this->MenuLabo = (isset($data['MenuLabo'])) ? $data['MenuLabo'] : NULL;
		$this->MenuOev_ = (isset($data['MenuOev_'])) ? $data['MenuOev_'] : NULL;
		$this->MoisFile = (isset($data['MoisFile'])) ? $data['MoisFile'] : NULL;
		$this->MotpAccu = (isset($data['MotpAccu'])) ? $data['MotpAccu'] : NULL;
		$this->MotpDoss = (isset($data['MotpDoss'])) ? $data['MotpDoss'] : NULL;
		$this->OrdoDupl = (isset($data['OrdoDupl'])) ? $data['OrdoDupl'] : NULL;
		$this->ParaSql_Motp = (isset($data['ParaSql_Motp'])) ? $data['ParaSql_Motp'] : NULL;
		$this->PharDeli = (isset($data['PharDeli'])) ? $data['PharDeli'] : NULL;
		$this->PosoDefa = (isset($data['PosoDefa'])) ? $data['PosoDefa'] : NULL;
		$this->Pres = (isset($data['Pres'])) ? $data['Pres'] : NULL;
		$this->Reta = (isset($data['Reta'])) ? $data['Reta'] : NULL;
		$this->SantPhar = (isset($data['SantPhar'])) ? $data['SantPhar'] : NULL;
		$this->SauvChe0 = (isset($data['SauvChe0'])) ? $data['SauvChe0'] : NULL;
		$this->SauvChe1 = (isset($data['SauvChe1'])) ? $data['SauvChe1'] : NULL;
		$this->SauvChe2 = (isset($data['SauvChe2'])) ? $data['SauvChe2'] : NULL;
		$this->SauvDat_ = (isset($data['SauvDat_'])) ? $data['SauvDat_'] : NULL;
		$this->SauvErro = (isset($data['SauvErro'])) ? $data['SauvErro'] : NULL;
		$this->SauvHeur = (isset($data['SauvHeur'])) ? $data['SauvHeur'] : NULL;
		$this->SauvMotp = (isset($data['SauvMotp'])) ? $data['SauvMotp'] : NULL;
		$this->SauvNom_ = (isset($data['SauvNom_'])) ? $data['SauvNom_'] : NULL;
		$this->ServRdv_ = (isset($data['ServRdv_'])) ? $data['ServRdv_'] : NULL;
		$this->ServRdv_Veri = (isset($data['ServRdv_Veri'])) ? $data['ServRdv_Veri'] : NULL;
		$this->SiteCode = (isset($data['SiteCode'])) ? $data['SiteCode'] : NULL;
		$this->Stoc = (isset($data['Stoc'])) ? $data['Stoc'] : NULL;
		$this->StocItemNume = (isset($data['StocItemNume'])) ? $data['StocItemNume'] : NULL;
		$this->TradAngl = (isset($data['TradAngl'])) ? $data['TradAngl'] : NULL;
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
