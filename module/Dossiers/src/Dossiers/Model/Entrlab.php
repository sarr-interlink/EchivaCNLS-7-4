<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Db\Sql\Expression;

class Entrlab implements InputFilterAwareInterface {

    public $Nume;
    public $Util;
    public $Modi;
    public $Age_;
    public $AiguHoro;
    public $Arri;
    public $ArriHeur;
    public $ArriHoro;
    public $Au00;
    public $Au01;
    public $Au02;
    public $Au03;
    public $Au04;
    public $Au05;
    public $Au06;
    public $Au07;
    public $Au08;
    public $Au09;
    public $Au10;
    public $Au11;
    public $Au12;
    public $Autr;
    public $Bi00;
    public $Bi01;
    public $Bi02;
    public $Bi03;
    public $Bi04;
    public $Bi05;
    public $Bi06;
    public $Bi07;
    public $Bi08;
    public $Bi09;
    public $Bi10;
    public $Bi11;
    public $Bi12;
    public $Bi13;
    public $Bi14;
    public $Bi15;
    public $Bioc;
    public $BiocAu01;
    public $BiocAu02;
    public $BiocAu03;
    public $BiocAu04;
    public $BiocAu05;
    public $Cd4_;
    public $Cd4_Dat_;
    public $Cd40;
    public $Cd41;
    public $Cd42;
    public $Cd43;
    public $Cd44;
    public $Cd45;
    public $Cd46;
    public $Cep0;
    public $Cep1;
    public $Cep2;
    public $Cep3;
    public $Ceph;
    public $Cta_Exte;
    public $Cta_Nume;
    public $Cta_Ume_;
    public $Dat_;
    public $Doss;
    public $ExteNume;
    public $Gou0;
    public $Gou1;
    public $Gou2;
    public $Gou3;
    public $Gou4;
    public $Gou5;
    public $Gout;
    public $Labo;
    public $LaboDat_;
    public $LaboDesi;
    public $Moti;
    public $NaisDat_;
    public $Nf10;
    public $Nf11;
    public $Nf12;
    public $Nf13;
    public $Nf14;
    public $Nf15;
    public $Nf16;
    public $Nf17;
    public $Nf18;
    public $Nf19;
    public $Nf20;
    public $Nf21;
    public $Nfs_;
    public $Nfs0;
    public $Nfs1;
    public $Nfs2;
    public $Nfs3;
    public $Nfs4;
    public $Nfs5;
    public $Nfs6;
    public $Nfs7;
    public $Nfs8;
    public $Nfs9;
    public $Nom_;
    public $Paim;
    public $Pcr_;
    public $Pcr_Dat_;
    public $Pcr0;
    public $Pcr1;
    public $Pcr2;
    public $Pcr3;
    public $Pcr4;
    public $Pcr5;
    public $Pcr6;
    public $Pnom;
    public $Prec;
    public $Prsc;
    public $Rdv_Heur;
    public $Rdv_Horo;
    public $Se10;
    public $Se11;
    public $Se12;
    public $Se13;
    public $Ser0;
    public $Ser1;
    public $Ser2;
    public $Ser3;
    public $Ser4;
    public $Ser5;
    public $Ser6;
    public $Ser7;
    public $Ser8;
    public $Ser9;
    public $Sero;
    public $Sexe;
    public $Ume_Nume;
    public $Uri0;
    public $Uri1;
    public $Uri2;
    public $Uri3;
    public $Uri4;
    public $Uri5;
    public $Uri6;
    public $Urin;
    public $Vag0;
    public $Vag1;
    public $Vag2;
    public $Vag3;
    public $Vag4;
    public $Vagi;
    public $count;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = (isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
        $this->Util = (isset($data['Util']) && !empty($data['Util']) ) ? $data['Util'] : null;
        $this->Modi = date("Y-m-d H:i:s");
        $this->Age_ = (isset($data['Age_']) && !empty($data['Age_'])) ? $data['Age_'] : null;
        $this->AiguHoro = (isset($data['AiguHoro']) && !empty($data['AiguHoro'])) ? $data['AiguHoro'] : null;
        $this->Arri = (isset($data['Arri']) && !empty($data['Arri'])) ? $data['Arri'] : null;
        $this->ArriHeur = (isset($data['ArriHeur']) && !empty($data['ArriHeur'])) ? $data['ArriHeur'] : null;
        $this->ArriHoro = (isset($data['ArriHoro']) && !empty($data['ArriHoro'])) ? $data['ArriHoro'] : null;
        $this->Au00 = (isset($data['Au00']) && !empty($data['Au00'])) ? $data['Au00'] : null;
        $this->Au01 = (isset($data['Au01']) && !empty($data['Au01'])) ? $data['Au01'] : null;
        $this->Au02 = (isset($data['Au02']) && !empty($data['Au02'])) ? $data['Au02'] : null;
        $this->Au03 = (isset($data['Au03']) && !empty($data['Au03'])) ? $data['Au03'] : null;
        $this->Au04 = (isset($data['Au04']) && !empty($data['Au04'])) ? $data['Au04'] : null;
        $this->Au05 = (isset($data['Au05']) && !empty($data['Au05'])) ? $data['Au05'] : null;
        $this->Au06 = (isset($data['Au06']) && !empty($data['Au06'])) ? $data['Au06'] : null;
        $this->Au07 = (isset($data['Au07']) && !empty($data['Au07'])) ? $data['Au07'] : null;
        $this->Au08 = (isset($data['Au08']) && !empty($data['Au08'])) ? $data['Au08'] : null;
        $this->Au09 = (isset($data['Au09']) && !empty($data['Au09'])) ? $data['Au09'] : null;
        $this->Au10 = (isset($data['Au10']) && !empty($data['Au10'])) ? $data['Au10'] : null;
        $this->Au11 = (isset($data['Au11']) && !empty($data['Au11'])) ? $data['Au11'] : null;
        $this->Au12 = (isset($data['Au12']) && !empty($data['Au12'])) ? $data['Au12'] : null;
        $this->Autr = (isset($data['Autr']) && !empty($data['Autr'])) ? $data['Autr'] : null;
        $this->Bi00 = (isset($data['Bi00']) && !empty($data['Bi00'])) ? $data['Bi00'] : null;
        $this->Bi01 = (isset($data['Bi01']) && !empty($data['Bi01'])) ? $data['Bi01'] : null;
        $this->Bi02 = (isset($data['Bi02']) && !empty($data['Bi02'])) ? $data['Bi02'] : null;
        $this->Bi03 = (isset($data['Bi03']) && !empty($data['Bi03'])) ? $data['Bi03'] : null;
        $this->Bi04 = (isset($data['Bi04']) && !empty($data['Bi04'])) ? $data['Bi04'] : null;
        $this->Bi05 = (isset($data['Bi05']) && !empty($data['Bi05'])) ? $data['Bi05'] : null;
        $this->Bi06 = (isset($data['Bi06']) && !empty($data['Bi06'])) ? $data['Bi06'] : null;
        $this->Bi07 = (isset($data['Bi07']) && !empty($data['Bi07'])) ? $data['Bi07'] : null;
        $this->Bi08 = (isset($data['Bi08']) && !empty($data['Bi08'])) ? $data['Bi08'] : null;
        $this->Bi09 = (isset($data['Bi09']) && !empty($data['Bi09'])) ? $data['Bi09'] : null;
        $this->Bi10 = (isset($data['Bi10']) && !empty($data['Bi10'])) ? $data['Bi10'] : null;
        $this->Bi11 = (isset($data['Bi11']) && !empty($data['Bi11'])) ? $data['Bi11'] : null;
        $this->Bi12 = (isset($data['Bi12']) && !empty($data['Bi12'])) ? $data['Bi12'] : null;
        $this->Bi13 = (isset($data['Bi13']) && !empty($data['Bi13'])) ? $data['Bi13'] : null;
        $this->Bi14 = (isset($data['Bi14']) && !empty($data['Bi14'])) ? $data['Bi14'] : null;
        $this->Bi15 = (isset($data['Bi15']) && !empty($data['Bi15'])) ? $data['Bi15'] : null;
        $this->Bioc = (isset($data['Bioc']) && !empty($data['Bioc'])) ? $data['Bioc'] : null;
        $this->BiocAu01 = (isset($data['BiocAu01']) && !empty($data['BiocAu01'])) ? $data['BiocAu01'] : null;
        $this->BiocAu02 = (isset($data['BiocAu02']) && !empty($data['BiocAu02'])) ? $data['BiocAu02'] : null;
        $this->BiocAu03 = (isset($data['BiocAu03']) && !empty($data['BiocAu03'])) ? $data['BiocAu03'] : null;
        $this->BiocAu04 = (isset($data['BiocAu04']) && !empty($data['BiocAu04'])) ? $data['BiocAu04'] : null;
        $this->BiocAu05 = (isset($data['BiocAu05']) && !empty($data['BiocAu05'])) ? $data['BiocAu05'] : null;
        $this->Cd4_ = (isset($data['Cd4_']) && !empty($data['Cd4_'])) ? $data['Cd4_'] : null;
        $this->Cd4_Dat_ = (isset($data['Cd4_Dat_']) && !empty($data['Cd4_Dat_'])) ? $data['Cd4_Dat_'] : null;
        $this->Cd40 = (isset($data['Cd40']) && !empty($data['Cd40'])) ? $data['Cd40'] : null;
        $this->Cd41 = (isset($data['Cd41']) && !empty($data['Cd41'])) ? $data['Cd41'] : null;
        $this->Cd42 = (isset($data['Cd42']) && !empty($data['Cd42'])) ? $data['Cd42'] : null;
        $this->Cd43 = (isset($data['Cd43']) && !empty($data['Cd43'])) ? $data['Cd43'] : null;
        $this->Cd44 = (isset($data['Cd44']) && !empty($data['Cd44'])) ? $data['Cd44'] : null;
        $this->Cd45 = (isset($data['Cd45']) && !empty($data['Cd45'])) ? $data['Cd45'] : null;
        $this->Cd46 = (isset($data['Cd46']) && !empty($data['Cd46'])) ? $data['Cd46'] : null;
        $this->Cep0 = (isset($data['Cep0']) && !empty($data['Cep0'])) ? $data['Cep0'] : null;
        $this->Cep1 = (isset($data['Cep1']) && !empty($data['Cep1'])) ? $data['Cep1'] : null;
        $this->Cep2 = (isset($data['Cep2']) && !empty($data['Cep2'])) ? $data['Cep2'] : null;
        $this->Cep3 = (isset($data['Cep3']) && !empty($data['Cep3'])) ? $data['Cep3'] : null;
        $this->Ceph = (isset($data['Ceph']) && !empty($data['Ceph'])) ? $data['Ceph'] : null;
        $this->Cta_Exte = (isset($data['Cta_Exte']) && !empty($data['Cta_Exte'])) ? $data['Cta_Exte'] : null;
        $this->Cta_Nume = (isset($data['Cta_Nume']) && !empty($data['Cta_Nume'])) ? $data['Cta_Nume'] : null;
        $this->Cta_Ume_ = (isset($data['Cta_Ume_']) && !empty($data['Cta_Ume_'])) ? $data['Cta_Ume_'] : null;
        $this->Dat_ = (isset($data['Dat_']) && !empty($data['Dat_'])) ? $data['Dat_'] : null;
        $this->Doss = (isset($data['Doss']) && !empty($data['Doss'])) ? $data['Doss'] : null;
        $this->ExteNume = (isset($data['ExteNume']) && !empty($data['ExteNume'])) ? $data['ExteNume'] : null;
        $this->Gou0 = (isset($data['Gou0']) && !empty($data['Gou0'])) ? $data['Gou0'] : null;
        $this->Gou1 = (isset($data['Gou1']) && !empty($data['Gou1'])) ? $data['Gou1'] : null;
        $this->Gou2 = (isset($data['Gou2']) && !empty($data['Gou2'])) ? $data['Gou2'] : null;
        $this->Gou3 = (isset($data['Gou3']) && !empty($data['Gou3'])) ? $data['Gou3'] : null;
        $this->Gou4 = (isset($data['Gou4']) && !empty($data['Gou4'])) ? $data['Gou4'] : null;
        $this->Gou5 = (isset($data['Gou5']) && !empty($data['Gou5'])) ? $data['Gou5'] : null;
        $this->Gout = (isset($data['Gout']) && !empty($data['Gout'])) ? $data['Gout'] : null;
        $this->Labo = (isset($data['Labo']) && !empty($data['Labo'])) ? $data['Labo'] : null;
        $this->LaboDat_ = (isset($data['LaboDat_']) && !empty($data['LaboDat_'])) ? $data['LaboDat_'] : null;
        $this->LaboDesi = (isset($data['LaboDesi']) && !empty($data['LaboDesi'])) ? $data['LaboDesi'] : null;
        $this->Moti = (isset($data['Moti']) && !empty($data['Moti'])) ? $data['Moti'] : null;
        $this->NaisDat_ = (isset($data['NaisDat_']) && !empty($data['NaisDat_'])) ? $data['NaisDat_'] : null;
        $this->Nf10 = (isset($data['Nf10']) && !empty($data['Nf10'])) ? $data['Nf10'] : null;
        $this->Nf11 = (isset($data['Nf11']) && !empty($data['Nf11'])) ? $data['Nf11'] : null;
        $this->Nf12 = (isset($data['Nf12']) && !empty($data['Nf12'])) ? $data['Nf12'] : null;
        $this->Nf13 = (isset($data['Nf13']) && !empty($data['Nf13'])) ? $data['Nf13'] : null;
        $this->Nf14 = (isset($data['Nf14']) && !empty($data['Nf14'])) ? $data['Nf14'] : null;
        $this->Nf15 = (isset($data['Nf15']) && !empty($data['Nf15'])) ? $data['Nf15'] : null;
        $this->Nf16 = (isset($data['Nf16']) && !empty($data['Nf16'])) ? $data['Nf16'] : null;
        $this->Nf17 = (isset($data['Nf17']) && !empty($data['Nf17'])) ? $data['Nf17'] : null;
        $this->Nf18 = (isset($data['Nf18']) && !empty($data['Nf18'])) ? $data['Nf18'] : null;
        $this->Nf19 = (isset($data['Nf19']) && !empty($data['Nf19'])) ? $data['Nf19'] : null;
        $this->Nf20 = (isset($data['Nf20']) && !empty($data['Nf20'])) ? $data['Nf20'] : null;
        $this->Nf21 = (isset($data['Nf21']) && !empty($data['Nf21'])) ? $data['Nf21'] : null;
        $this->Nfs_ = (isset($data['Nfs_']) && !empty($data['Nfs_'])) ? $data['Nfs_'] : null;
        $this->Nfs0 = (isset($data['Nfs0']) && !empty($data['Nfs0'])) ? $data['Nfs0'] : null;
        $this->Nfs1 = (isset($data['Nfs1']) && !empty($data['Nfs1'])) ? $data['Nfs1'] : null;
        $this->Nfs2 = (isset($data['Nfs2']) && !empty($data['Nfs2'])) ? $data['Nfs2'] : null;
        $this->Nfs3 = (isset($data['Nfs3']) && !empty($data['Nfs3'])) ? $data['Nfs3'] : null;
        $this->Nfs4 = (isset($data['Nfs4']) && !empty($data['Nfs4'])) ? $data['Nfs4'] : null;
        $this->Nfs5 = (isset($data['Nfs5']) && !empty($data['Nfs5'])) ? $data['Nfs5'] : null;
        $this->Nfs6 = (isset($data['Nfs6']) && !empty($data['Nfs6'])) ? $data['Nfs6'] : null;
        $this->Nfs7 = (isset($data['Nfs7']) && !empty($data['Nfs7'])) ? $data['Nfs7'] : null;
        $this->Nfs8 = (isset($data['Nfs8']) && !empty($data['Nfs8'])) ? $data['Nfs8'] : null;
        $this->Nfs9 = (isset($data['Nfs9']) && !empty($data['Nfs9'])) ? $data['Nfs9'] : null;
        $this->Nom_ = (isset($data['Nom_']) && !empty($data['Nom_'])) ? $data['Nom_'] : null;
        $this->Paim = (isset($data['Paim']) && !empty($data['Paim'])) ? $data['Paim'] : null;
        $this->Pcr_ = (isset($data['Pcr_']) && !empty($data['Pcr_'])) ? $data['Pcr_'] : null;
        $this->Pcr_Dat_ = (isset($data['Pcr_Dat_']) && !empty($data['Pcr_Dat_'])) ? $data['Pcr_Dat_'] : null;
        $this->Pcr0 = (isset($data['Pcr0']) && !empty($data['Pcr0'])) ? $data['Pcr0'] : null;
        $this->Pcr1 = (isset($data['Pcr1']) && !empty($data['Pcr1'])) ? $data['Pcr1'] : null;
        $this->Pcr2 = (isset($data['Pcr2']) && !empty($data['Pcr2'])) ? $data['Pcr2'] : null;
        $this->Pcr3 = (isset($data['Pcr3']) && !empty($data['Pcr3'])) ? $data['Pcr3'] : null;
        $this->Pcr4 = (isset($data['Pcr4']) && !empty($data['Pcr4'])) ? $data['Pcr4'] : null;
        $this->Pcr5 = (isset($data['Pcr5']) && !empty($data['Pcr5'])) ? $data['Pcr5'] : null;
        $this->Pcr6 = (isset($data['Pcr6']) && !empty($data['Pcr6'])) ? $data['Pcr6'] : null;
        $this->Pnom = (isset($data['Pnom']) && !empty($data['Pnom'])) ? $data['Pnom'] : null;
        $this->Prec = (isset($data['Prec']) && !empty($data['Prec'])) ? $data['Prec'] : null;
        $this->Prsc = (isset($data['Prsc']) && !empty($data['Prsc'])) ? $data['Prsc'] : null;
        $this->Rdv_Heur = (isset($data['Rdv_Heur']) && !empty($data['Rdv_Heur'])) ? $data['Rdv_Heur'] : null;
        $this->Rdv_Horo = (isset($data['Rdv_Horo']) && !empty($data['Rdv_Horo'])) ? $data['Rdv_Horo'] : null;
        $this->Se10 = (isset($data['Se10']) && !empty($data['Se10'])) ? $data['Se10'] : null;
        $this->Se11 = (isset($data['Se11']) && !empty($data['Se11'])) ? $data['Se11'] : null;
        $this->Se12 = (isset($data['Se12']) && !empty($data['Se12'])) ? $data['Se12'] : null;
        $this->Se13 = (isset($data['Se13']) && !empty($data['Se13'])) ? $data['Se13'] : null;
        $this->Ser0 = (isset($data['Ser0']) && !empty($data['Ser0'])) ? $data['Ser0'] : null;
        $this->Ser1 = (isset($data['Ser1']) && !empty($data['Ser1'])) ? $data['Ser1'] : null;
        $this->Ser2 = (isset($data['Ser2']) && !empty($data['Ser2'])) ? $data['Ser2'] : null;
        $this->Ser3 = (isset($data['Ser3']) && !empty($data['Ser3'])) ? $data['Ser3'] : null;
        $this->Ser4 = (isset($data['Ser4']) && !empty($data['Ser4'])) ? $data['Ser4'] : null;
        $this->Ser5 = (isset($data['Ser5']) && !empty($data['Ser5'])) ? $data['Ser5'] : null;
        $this->Ser6 = (isset($data['Ser6']) && !empty($data['Ser6'])) ? $data['Ser6'] : null;
        $this->Ser7 = (isset($data['Ser7']) && !empty($data['Ser7'])) ? $data['Ser7'] : null;
        $this->Ser8 = (isset($data['Ser8']) && !empty($data['Ser8'])) ? $data['Ser8'] : null;
        $this->Ser9 = (isset($data['Ser9']) && !empty($data['Ser9'])) ? $data['Ser9'] : null;
        $this->Sero = (isset($data['Sero']) && !empty($data['Sero'])) ? $data['Sero'] : null;
        $this->Sexe = (isset($data['Sexe']) && !empty($data['Sexe'])) ? $data['Sexe'] : null;
        $this->Ume_Nume = (isset($data['Ume_Nume']) && !empty($data['Ume_Nume'])) ? $data['Ume_Nume'] : null;
        $this->Uri0 = (isset($data['Uri0']) && !empty($data['Uri0'])) ? $data['Uri0'] : null;
        $this->Uri1 = (isset($data['Uri1']) && !empty($data['Uri1'])) ? $data['Uri1'] : null;
        $this->Uri2 = (isset($data['Uri2']) && !empty($data['Uri2'])) ? $data['Uri2'] : null;
        $this->Uri3 = (isset($data['Uri3']) && !empty($data['Uri3'])) ? $data['Uri3'] : null;
        $this->Uri4 = (isset($data['Uri4']) && !empty($data['Uri4'])) ? $data['Uri4'] : null;
        $this->Uri5 = (isset($data['Uri5']) && !empty($data['Uri5'])) ? $data['Uri5'] : null;
        $this->Uri6 = (isset($data['Uri6']) && !empty($data['Uri6'])) ? $data['Uri6'] : null;
        $this->Urin = (isset($data['Urin']) && !empty($data['Urin'])) ? $data['Urin'] : null;
        $this->Vag0 = (isset($data['Vag0']) && !empty($data['Vag0'])) ? $data['Vag0'] : null;
        $this->Vag1 = (isset($data['Vag1']) && !empty($data['Vag1'])) ? $data['Vag1'] : null;
        $this->Vag2 = (isset($data['Vag2']) && !empty($data['Vag2'])) ? $data['Vag2'] : null;
        $this->Vag3 = (isset($data['Vag3']) && !empty($data['Vag3'])) ? $data['Vag3'] : null;
        $this->Vag4 = (isset($data['Vag4']) && !empty($data['Vag4'])) ? $data['Vag4'] : null;
        $this->Vagi = (isset($data['Vagi']) && !empty($data['Vagi'])) ? $data['Vagi'] : null;
        $this->count = (isset($data['count']) && !empty($data['count'])) ? $data['count'] : 0;
    }

    public function someValues(array $array) {
        foreach ($array as $key => $value) {
            if (empty($value)) {
                $this->$key = null;
            } else {
                $this->$key = $value;
            }
        }
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
