<?php

namespace Analyse\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\Http\Cookies;
use Zend\View\Model\ViewModel;
use Analyse\Form\RequeteDossForm;
use Analyse\Form\RappForm;
use Analyse\Model\Doss;

class AnalyseController extends AbstractActionController {

    protected $confTable;
    protected $mediconsTable;
    protected $ptmegrosTable;
    protected $entrTable;
    protected $itemTable;
    protected $commTable;
    protected $commdossTable;
    protected $socienfaTable;
    protected $listeTable;
    protected $obseconsTable;
    protected $prodTable;
    protected $psyconsTable;
    protected $ptmeenfaconsTable;
    protected $sociconsTable;
    protected $droiTable;
    protected $depiTable;
    protected $dossTable;
    protected $locaTable;
    protected $csiTable;
    protected $dciTable;
    protected $chrgTable;
    protected $form;
    protected $tabtitre = array();
    protected $tabdonnee = array();
    protected $dossNnom = 0;
    protected $dossNouvrdat = 0;
    protected $cons = 0;
    protected $fileactive = array();
    protected $dcd = array();
    protected $dcdm = array();
    protected $depistage = array();
    protected $dossdetail = array();
    protected $transdetail = array();
    protected $inclusionarv = array();
    protected $pdvpm = array();
    protected $bio = array();
    protected $infectop = array();
    protected $ptmedetails = array();
    protected $nnedetails = array();
    protected $nnearvdetails = array();
    public $prefixe;
    protected $transTable;
    protected $userTable;
    protected $centreTable;

    public function indexAction() {
        //$t=$this->setdoss();exit;
        $request = $this->getRequest();
        if ($request->isPost()) {
            $daymax = date("Y-m-d", strtotime($this->getRequest()->getPost('daymax', date("Y-m-d"))));
            $daymin = date("Y-m-d", strtotime($this->getRequest()->getPost('daymin', date("Y-m-d"))));
        } else {
            $daymax = date("Y-m-d");
            $daymin = date("Y-m-d", strtotime("-30 days", strtotime($daymax)));
        }
        $tomorrow = date("Y-m-d", strtotime("1 day", strtotime($daymax)));
        $where = "(Dat_>='$daymin 00:00:00')";
        $order = "Dat_ ASC";
        return new ViewModel(array(
            'comms' => '', //$this->getCommTable()->select($where, $order),
            'daymax' => $daymax,
            'daymin' => $daymin,
        ));
    }

    public function setdoss() {
        $chrg = $this->getChrgTable()->select();
        $tabchr = array();
        $tabchr['-1'] = '';
        $tabchr[''] = '';
        foreach ($chrg as $chr) {
            $tabchr[$chr->Nume] = $chr->Desi;
        }
        $col = array('Nume', 'Ref_', 'RensNom_', 'RensPnom', 'RensAge_', 'RensSexe', 'RensDeceDat_', 'RensChrg', 'OuvrDat_', 'MediSeroTyp_', 'Arv_Desi', 'RensTel_', 'Imc_info', 'Conc_info');
        $colaffich = array('Nume', 'Ref_', 'RensNom_', 'RensPnom', 'RensAge_', 'RensDeceDat_', 'OuvrDat_', 'MediSeroTyp_', 'Arv_Desi', 'RensTel_', 'Imc_info', 'Conc_info');
        $dosss = $this->getDossTable()->Rapport(null, $col, null/* $group */);
        $tab = array();
        $sexe[1] = "Masculin";
        $sexe[2] = "Feminin";
        $sexe[''] = "";
        foreach ($dosss as $doss) {
            $tab[$doss->Nume]['RensSexe'] = $sexe[$doss->RensSexe];
            $tab[$doss->Nume]['RensChrg'] = $tabchr[$doss->RensChrg];
            $tab[$doss->Nume]['derncons'] = '';
            $tab[$doss->Nume]['dernrdv'] = '';
            $tab[$doss->Nume]['dernvisite'] = '';

            $tab[$doss->Nume]['commfirstpart'] = '';
            $tab[$doss->Nume]['commlastpart'] = '';
            $tab[$doss->Nume]['arvfirstdeliv'] = '';
            $tab[$doss->Nume]['arvlastdeliv'] = '';
            $tab[$doss->Nume]['firstdeliv'] = '';
            $tab[$doss->Nume]['lastdeliv'] = '';
            $tab[$doss->Nume]['derngrosaccouch'] = '';
            $tab[$doss->Nume]['derngrosaccouchprev'] = '';
            $tab[$doss->Nume]['derngrossaisi'] = '';
            $tab[$doss->Nume]['Dat_initCd40'] = '';
            $tab[$doss->Nume]['initCd40'] = '';
            $tab[$doss->Nume]['Dat_dernCd40'] = '';
            $tab[$doss->Nume]['dernCd40'] = '';
            $tab[$doss->Nume]['Dat_initPcr0'] = '';
            $tab[$doss->Nume]['initPcr0'] = '';
            $tab[$doss->Nume]['Dat_dernPcr0'] = '';
            $tab[$doss->Nume]['dernPcr0'] = '';
            foreach ($colaffich as $colone) {

                $tab[$doss->Nume][$colone] = $doss->$colone;
            }
            $tab[$doss->Nume] = array_merge($tab[$doss->Nume], $this->imcconcmanager($doss->Imc_info, 'Imc_info'));
            $tab[$doss->Nume] = array_merge($tab[$doss->Nume], $this->imcconcmanager($doss->Conc_info, 'Conc_info'));
        }
        return $tab;
    }

    public function imcconcmanager($info, $str) { //dernier imc et cd4
        $donnee = array(
            'Dat_init' . $str => "",
            'init' . $str => "",
            'Dat_dern' . $str => "",
            'dern' . $str => "",
        );
        if ($info) {
            $tab = explode("|", $info);
            $donnee = array(
                'Dat_init' . $str => $tab[0],
                'init' . $str => $tab[1],
                'Dat_dern' . $str => $tab[2],
                'dern' . $str => $tab[3],
            );
        }
        return($donnee);
    }

    public function initialisation($lig, $col, $value) {
        $tab = array();
        for ($i = 1; $i <= $lig; $i++) {
            for ($j = 1; $j <= $col; $j++) {
                $tab[$i][$j] = $value;
            }
        }
        return $tab;
    }

    public function totcol($tabdepis) {
        //total col
        foreach ($tabdepis as $k => $subArray) {
            $tabdepis[$k][] = array_sum($tabdepis[$k]);
            ksort($tabdepis[$k]);
        }
        ksort($tabdepis);
        return($tabdepis);
    }

    public function totrow($tabdepis) {
        //total row
        $col = 0;
        foreach ($tabdepis as $k => $subArray) {
            $col = count($subArray);
            break;
        }
        //Return first key of associative array in PHP
        $debrow = current(array_keys($tabdepis));
        $debcol = current(array_keys($tabdepis[$debrow]));
        $col += $debcol;
        $newrow = $debrow + count($tabdepis);
        // echo "$newrow $col";
        for ($i = $debcol; $i < $col; $i++) {
            $tabdepis[$newrow][$i] = 0;
            for ($j = $debrow; $j < count($tabdepis); $j++) {
                $tabdepis[$newrow][$i] += $tabdepis[$j][$i];
            }
        }
        return($tabdepis);
    }

    public function pourcentrow($tabdepis, $tot) {
        foreach ($tabdepis as $k => $subArray) {
            if ($tot == 0)
                $tabdepis[$k][] = "0%";
            else {
                $pourcent = round($subArray[count($subArray)] * 100 / $tot);
                if ($pourcent <= 100)
                    $tabdepis[$k][] = $pourcent . "%";
                else
                    $tabdepis[$k][] = "";
            }
        }

        return($tabdepis);
    }

    public function pourcentcol($tabdepis, $tot) {
        //pourcentage col
        $col = 0;
        foreach ($tabdepis as $subArray) {
            $col = count($subArray);
            break;
        }
        //pourcent

        $debrow = current(array_keys($tabdepis));
        $debcol = current(array_keys($tabdepis[$debrow]));
        $col += $debcol;
        $taillerow = count($tabdepis);
        $newrow = $debrow + $taillerow;
        for ($i = $debcol; $i < $col; $i++) {
            $tabdepis[$newrow][$i] = 0;
            for ($j = $debrow; $j < count($tabdepis); $j++) {
                if ($tot == 0)
                    $tabdepis[$newrow][$i] = "0%";
                else {
                    $pourcent = round($tabdepis[$taillerow][$i] * 100 / $tot);
                    //if ($pourcent <= 100)
                    $tabdepis[$newrow][$i] = $pourcent . "%";
                    //else
                    //    $tabdepis[$newrow][$i] = "";
                }
            }
        }
        $col--;
        $tabdepis[$newrow][$col] = "";
        return($tabdepis);
    }

    public function addcol($tabdepis, $titre, $str) {

        foreach ($tabdepis as $k => $tabdepi) {
            $tabdepis[$k][$str] = $titre[$k];
        }
        return($tabdepis);
    }

    public function Np($datedeb, $datefin) {
        $loca = $this->getLocaTable()->select();
        foreach ($loca as $locali) {
            $tabloca[$locali->Nume] = $locali->Desi;
        }
        $csi = $this->getCsiTable()->select();
        foreach ($csi as $cs) {
            $tabcsi[$cs->Nume] = $cs->Desi;
        }
        $chrg = $this->getChrgTable()->select();
        $tabchr = array();
        foreach ($chrg as $chr) {
            $tabchr[$chr->Nume] = $chr->Desi;
        }
        $col = array('Nume', 'RensSexe', 'RensAge_', 'Ref_', 'OuvrDat_', 'RensMatr', 'RensProv', 'MediCsi_', 'RensChrg');
        $where = " ( OuvrDat_ >='" . $datedeb . "' AND OuvrDat_ <='" . $datefin . "')";
        $dosss = $this->getDossTable()->Rapport($where, $col, null/* $group */);
        $tabdepis = $this->initialisation(2, 3, 0);
        $Nouveaupat = array();
        foreach ($dosss as $doss) {
            $Nouveaupat[$doss->Nume]['Ref'] = $doss->Ref_;
            $Nouveaupat[$doss->Nume]['RensSexe'] = $doss->RensSexe;
            $Nouveaupat[$doss->Nume]['RensAge_'] = $doss->RensAge_;
            $Nouveaupat[$doss->Nume]['RensMatr'] = $doss->RensMatr;
            $Nouveaupat[$doss->Nume]['OuvrDat_'] = $doss->OuvrDat_;
            if (array_key_exists($doss->RensProv, $tabloca))
                $Nouveaupat[$doss->Nume]['RensProv'] = $tabloca[$doss->RensProv];
            else
                $Nouveaupat[$doss->Nume]['RensProv'] = "";
            if (array_key_exists($doss->MediCsi_, $tabcsi))
                $Nouveaupat[$doss->Nume]['MediCsi_'] = $tabcsi[$doss->MediCsi_];
            else
                $Nouveaupat[$doss->Nume]['MediCsi_'] = "";
            if (array_key_exists($doss->RensChrg, $tabchr))
                $Nouveaupat[$doss->Nume]['RensChrg'] = $tabchr[$doss->RensChrg];
            else
                $Nouveaupat[$doss->Nume]['RensChrg'] = "";
            if ($doss->RensSexe != NULL) {
                if ($doss->RensAge_ <= 15) {
                    $tabdepis[$doss->RensSexe][1] ++;
                } else if ($doss->RensAge_ <= 49) {
                    $tabdepis[$doss->RensSexe][2] ++;
                } else {
                    $tabdepis[$doss->RensSexe][3] ++;
                }
            }
        }

        $tab['nb'] = $tabdepis;
        $tab['detail'] = $Nouveaupat;
        return $tab;
    }

    public function NpMatr($datedeb, $datefin) {
        $list = $this->getOptionsForSelect($this->getListeTable()->select("Typ_ = 'Fiche | Situation matrimoniale'", 'Desi'), 'Desi', 'Desi');
        foreach ($list as $l) {
            $tab[$l]['valeur'] = 0;
            $tab[$l]['pourcentage'] = '0%';
        }
        $tab['Total']['valeur'] = 0;
        $tab['Total']['pourcentage'] = '0%';
        $where = " ( OuvrDat_ >='" . $datedeb . "' AND OuvrDat_ <='" . $datefin . "'and rensmatr!='')";
        $col = array('RensMatr', 'count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
        $group = array('RensMatr');
        $dosss = $this->getDossTable()->Rapport($where, $col, $group)->toArray();
        $tot = 0;
        foreach ($dosss as $doss) {
            $tot += $doss['count'];
        }
        foreach ($dosss as $doss) {
            $tab[$doss['RensMatr']]['valeur'] = $doss['count'];
            $tab[$doss['RensMatr']]['pourcentage'] = round($doss['count'] * 100 / $tot) . '%';
        }
        if ($tot) {
            $tab['Total']['valeur'] = $tot;
            $tab['Total']['pourcentage'] = '100%';
        }

        return $tab;
    }

    public function setinformeddoss($where, $col, $order, $Newcol, $Medcol) {
        // SELECT Nume,Doss,Dat_,Imc_,Conc FROM `medicons` where Doss >0 and Dat_>0 and (imc_>0 or Conc!='') order BY Doss,Dat_;
        $dosss = $this->getMediconsTable()->Rapport($where, $col, null, $order);
        $tabmin = array();
        foreach ($dosss as $doss) {
            $date = substr($doss->Dat_, 0, -9);
            if (!isset($tabmin[$doss->Doss]['Nume'])) {
                $tabmin[$doss->Doss]['Nume'] = $doss->Doss;
                $tabmin[$doss->Doss][$Newcol] = $date . '|' . $doss->$Medcol;
            }
            $tab[$doss->Doss]['Nume'] = $tabmin[$doss->Doss]['Nume'];
            $tab[$doss->Doss][$Newcol] = $tabmin[$doss->Doss][$Newcol] . '|' . $date . '|' . $doss->$Medcol;
        }
        foreach ($tab as $tabb) {
            echo $tabb['Nume'] . "<br>";
            $this->getDossTable()->saveDossArray($tabb);
        }
    }

    public function setinfocd4doss() {
        $col = array('Nume', 'Ref_', 'RensAdre');
        $dos = $this->getDossTable()->Rapport(null, $col, null/* $group */);
        //print_r($dos);
        foreach ($dos as $dossiers) {
            //$tabr[$dossiers->Nume]['Ref_']=$dossiers->Ref_;
            //$tabr[$dossiers->Nume]['MinPcr5']='$dossiers->RensAdre';
            echo $dossiers->Ref_ . "$" . utf8_encode($dossiers->RensAdre) . "<br>";
        }exit;
        //SELECT Nume,`Entr`.`Doss`,LaboDat_,Cd40 FROM `entr` where (cd40>0) order BY Doss,labodat_
        $where = "Doss >0 and LaboDat_>0 and Pcr5>0" /* or Pcr0>0 or Pcr1>0/* ."and LaboDat_>'2017-10-02'" */;
        $col = array('Doss', 'LaboDat_', 'Pcr5'/* , 'Pcr0', 'Pcr1' */);
        $order = array('Doss', 'LaboDat_');
        $dosss = $this->getEntrTable()->Rapport($where, $col, null, $order);
        //	print_r($tabr);
        echo count($tabr);
        foreach ($dosss as $doss) {
            if (isset($tabr[$doss->Doss])) {
                if (empty($tabr[$doss->Doss]['MinPcr5'])) {
                    $tabr[$doss->Doss]['MinPcr5'] = $doss->LaboDat_;
                    $tabr[$doss->Doss]['VMinPcr5'] = $doss->Pcr5;
                }
                $tabr[$doss->Doss]['MaxPcr5'] = $doss->LaboDat_;
                $tabr[$doss->Doss]['VMaxPcr5'] = $doss->Pcr5;
            }
        }
        echo "<br><br>";
        foreach ($tabr as $tabre) {
            echo $tabre['Ref_'] . "$" . $tabre['MinPcr5'] . "$" . $tabre['VMinPcr5'] . "$" . $tabre['MaxPcr5'] . "$" . $tabre['VMaxPcr5'] . "<br>";
        }
        echo count($tabr);
        exit;

        /*  $tab[$doss->Doss]['Nume'] = $doss->Doss;
          $date = date('d/m/Y', strtotime(substr($doss->LaboDat_, 0, -9)));
          if (isset($tab[$doss->Doss]['Info']))
          $tab[$doss->Doss]['Info'].="Entr|" . $doss->Nume . "|" . $date . "|" . $doss->Cd40 . "|" . $doss->Pcr0 . "|" . $doss->Pcr1 . "\n";
          else
          $tab[$doss->Doss]['Info'] = "Entr|" . $doss->Nume . "|" . $date . "|" . $doss->Cd40 . "|" . $doss->Pcr0 . "|" . $doss->Pcr1 . "\n";
          }
          foreach ($tab as $tabb) {
          $this->getDossTable()->saveDossArray1($tabb);
          } */
    }

    public function Nbdc($datedeb, $datefin, $dossiers) {
        /*       $where = "Doss >0 and Dat_>0 and Imc_>0";
          $col = array('Nume','Doss','Dat_','Imc_');
          $order = array('Doss','Dat_');
          $this->setinformeddoss($where,$col,$order,'Imc_info','Imc_');exit;


          $where = "Doss >0 and Dat_>0 and Conc like 'Stad%'";
          $col = array('Nume','Doss','Dat_','Conc' => new \Zend\Db\Sql\Expression('SUBSTR(Conc,11,1)'));
          $order = array('Doss','Dat_');
          $this->setinformeddoss($where,$col,$order,'Conc_info','Conc');
         */
        // $this->setinfocd4doss();
        $where = " ( Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and Doss >0)";
        $col = array('count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
        $dosss = $this->getMediconsTable()->Rapport($where, $col);




        foreach ($dosss as $doss) {
            $tabdepis = $doss->count;
        }
        return $tabdepis;
    }

    public function Nbpacpf($datedeb, $datefin, $dossiers) {
        $where = "( Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and Doss >0)";
        $col = array('Doss', 'Dat_' => new \Zend\Db\Sql\Expression('Max(Dat_)'), 'count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
        $dosss = $this->getMediconsTable()->Rapport($where, $col, 'Doss', null);
        $cons = array();
        $tabdepis = 0;

        $colffich = array('Ref_', 'RensSexe', 'RensAge_', 'OuvrDat_', 'MediSeroTyp_', 'Arv_Desi', 'RensTel_', 'Dat_initConc', 'initConc', 'Dat_dernConc', 'dernConc', 'Dat_initImc_', 'initImc_', 'Dat_dernImc_', 'dernImc_');
        foreach ($dosss as $dos) {
            if ($dos->count > 1) {
                $tabdepis++;
            }
            if (array_key_exists($dos->Doss, $dossiers))
                foreach ($dossiers[$dos->Doss] as $colonne => $value) {
                    $cons[$dos->Doss][$colonne] = $dossiers[$dos->Doss][$colonne];
                    //$cons[$dos->Doss]['Nbrcons'] = 1;
                    $cons[$dos->Doss]['derncons'] = $dos->Dat_;
                    $cons[$dos->Doss]['Nbrcons'] = $dos->count;
                }
        }

        $t = null;
        $tab['nbcons'] = $tabdepis;
        $tab['detail'] = $cons;
        $cons = null;
        $dosss = null;
        $doss = null;
        // $dossiers = null;
        return $tab;
    }

    public function Nptme($datedeb, $datefin) {

        $dossiers = $this->setdoss();

        $tab['Femmes enceintes suivis pour la PTME']['valeur'] = 0;
        $tab['Nouveau-nés mis sous prophylaxie NVP']['valeur'] = 0;

        //select distinct(nkt_doss.Nume),SaisDat_ from nkt_doss,nkt_ptmegros where(nkt_doss.nume=nkt_ptmegros.doss and nkt_ptmegros.SaisDat_ BETWEEN '2018-01-01' AND '2018-05-31')
        $where = " ( ptmegros.SaisDat_ > 0 AND ptmegros.SaisDat_ >= '" . $datedeb . "' AND ptmegros.SaisDat_ <='" . $datefin . "')";
        //$col = array('count' => new \Zend\Db\Sql\Expression('COUNT(DISTINCT ' . $this->prefixe . 'doss.Nume)'));
        $col = array('Nume' => new \Zend\Db\Sql\Expression('DISTINCT ' . $this->prefixe . 'doss.Nume'), 'SaisDat_' => 'SaisDat_', 'AccoPrev' => 'AccoPrev');
        $join = array('ptmegros' => $this->prefixe . 'ptmegros');
        $condjoin = $this->prefixe . 'doss.Nume=ptmegros.Doss';
        $dosss = $this->getDossTable()->Rapportjoint($where, $col, $join, $condjoin, null);
        //   print_r($dosss);exit;
        $dosss->setArrayObjectPrototype(new \Analyse\Model\Ptmegros());
        $ptmedetails = array();
        $i = 0;
        foreach ($dosss as $doss) {
            foreach ($dossiers[$doss->Nume] as $colonne => $value) {
                $ptmedetails[$doss->Nume][$colonne] = $dossiers[$doss->Nume][$colonne];
            }
            $ptmedetails[$doss->Nume]['grossaisi'] = (substr($doss->SaisDat_, 0, -9)) ? substr($doss->SaisDat_, 0, -9) : '';
            $ptmedetails[$doss->Nume]['grosaccouchprev'] = (substr($doss->AccoPrev, 0, -9)) ? substr($doss->AccoPrev, 0, -9) : '';
            $i++;
        }
        $tab['Femmes enceintes suivis pour la PTME']['valeur'] = count($ptmedetails);
        $where = " (Enf0Nais >0 AND Enf0Nais BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and Enf0Nvp_Debu<>'')";
        $dosss1 = $this->getPtmegrosTable()->Rapport($where);
        $tab['Nouveau-nés mis sous prophylaxie NVP']['valeur'] =0;
        $tab['Nouveau-nés mis sous prophylaxie NVP']['valeur'] = count($dosss1);
        $i=0;$nnedetails = array();
        foreach ($dosss1 as $doss1) { 
            foreach ($dossiers[$doss1->Doss] as $colonne => $value) {
                
                $nnedetails[$i][$colonne] = $dossiers[$doss1->Doss][$colonne];
            }
            $nnedetails[$i]['grossaisi'] = (substr($doss1->SaisDat_, 0, -9)) ? substr($doss1->SaisDat_, 0, -9) : '';
            $nnedetails[$i]['grosaccouchprev'] = (substr($doss1->AccoPrev, 0, -9)) ? substr($doss1->AccoPrev, 0, -9) : '';
            $nnedetails[$i]['naissance'] = (substr($doss1->Enf0Nais, 0, -9)) ? substr($doss1->Enf0Nais, 0, -9) : '';
            $nnedetails[$i]['debutnvp'] = $doss1->Enf0Nvp_Debu;
            $i++;
        }    
        $where = " ( Enf1Nais >0 AND Enf1Nais BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and Enf1Nvp_Debu<>'')";
        $dosss2 = $this->getPtmegrosTable()->Rapport($where);
        $tab['Nouveau-nés mis sous prophylaxie NVP']['valeur'] += count($dosss2);
        foreach ($dosss2 as $doss2) {
            foreach ($dossiers[$doss2->Doss] as $colonne => $value) {
                $nnedetails[$i][$colonne] = $dossiers[$doss2->Doss][$colonne];
            }
            $nnedetails[$i]['grossaisi'] = (substr($doss2->SaisDat_, 0, -9)) ? substr($doss2->SaisDat_, 0, -9) : '';
            $nnedetails[$i]['grosaccouchprev'] = (substr($doss2->AccoPrev, 0, -9)) ? substr($doss2->AccoPrev, 0, -9) : '';
            $nnedetails[$i]['naissance'] = (substr($doss2->Enf1Nais, 0, -9)) ? substr($doss2->Enf1Nais, 0, -9) : '';
            $nnedetails[$i]['debutnvp'] = $doss2->Enf1Nvp_Debu;
            $i++;
        }
        
        
        $where = " (Enf0Nais >0 AND Enf0Nais BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and Enf0Azt_Debu<>'')";
        $dosss3 = $this->getPtmegrosTable()->Rapport($where);
        $tab['Nouveau-nés mis sous prophylaxie ARV']['valeur'] =0;
        $tab['Nouveau-nés mis sous prophylaxie ARV']['valeur'] = count($dosss3);
        $i=0;$nnearvdetails = array();
        foreach ($dosss3 as $doss3) {  
            foreach ($dossiers[$doss3->Doss] as $colonne => $value) {
                
                $nnearvdetails[$i][$colonne] = $dossiers[$doss3->Doss][$colonne];
            }
            $nnearvdetails[$i]['grossaisi'] = (substr($doss3->SaisDat_, 0, -9)) ? substr($doss3->SaisDat_, 0, -9) : '';
            $nnearvdetails[$i]['grosaccouchprev'] = (substr($doss3->AccoPrev, 0, -9)) ? substr($doss3->AccoPrev, 0, -9) : '';
            $nnearvdetails[$i]['naissance'] = (substr($doss3->Enf0Nais, 0, -9)) ? substr($doss3->Enf0Nais, 0, -9) : '';
            $nnearvdetails[$i]['debutarv'] = $doss3->Enf0Azt_Debu;
            $i++;
          
        }    
        
        $where = " ( Enf1Nais >0 AND Enf1Nais BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and Enf1Azt_Debu<>'')";
        $dosss4 = $this->getPtmegrosTable()->Rapport($where);
        $tab['Nouveau-nés mis sous prophylaxie ARV']['valeur'] += count($dosss4);
        foreach ($dosss4 as $doss4) {
            foreach ($dossiers[$doss4->Doss] as $colonne => $value) {
                $nnearvdetails[$i][$colonne] = $dossiers[$doss4->Doss][$colonne];
            }
            $nnearvdetails[$i]['grossaisi'] = (substr($doss4->SaisDat_, 0, -9)) ? substr($doss4->SaisDat_, 0, -9) : '';
            $nnearvdetails[$i]['grosaccouchprev'] = (substr($doss4->AccoPrev, 0, -9)) ? substr($doss4->AccoPrev, 0, -9) : '';
            $nnearvdetails[$i]['naissance'] = (substr($doss4->Enf1Nais, 0, -9)) ? substr($doss4->Enf1Nais, 0, -9) : '';
            $nnearvdetails[$i]['debutarv'] = $doss4->Enf1Azt_Debu;
            $i++;
        }
        
        $this->ptmedetails = $ptmedetails;
        $this->nnedetails = $nnedetails;
        $this->nnearvdetails = $nnearvdetails;

        return $tab;
    }

    public function Nhosp($datedeb, $datefin) {
        $tab["Nombre d'hospitalisations"]['valeur'] = 0;
        $tab['Nombre de patients différents']['valeur'] = 0;
        $where = "Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and hdj_=1";
        $col = array('count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
        $dosss = $this->getMediconsTable()->select($where, null, null, $col);
        foreach ($dosss as $doss) {
            $tab["Nombre d'hospitalisations"]['valeur'] = $doss->count;
        }
        $where = "Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and hdj_=1";
        $col = array('count' => new \Zend\Db\Sql\Expression('COUNT(Distinct doss)'));
        $dosss = $this->getMediconsTable()->select($where, null, null, $col);
        foreach ($dosss as $doss) {
            $tab['Nombre de patients différents']['valeur'] = $doss->count;
        }

        return $tab;
    }

    public function NsuivBio($datedeb, $datefin, $corresp) {
        $tot = 0;
        $bio = array();

        $dossiers = $this->setdoss();
        foreach ($corresp as $k => $correspond) {
            $where = $correspond . ">0 and labodat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and Cta_Nume is not null";
            if ($k == 'Groupe sanguin / Rhésus') {
                $where = $correspond . "!='' and labodat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and Cta_Nume is not null";
            }
            // $col = array('count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
            $dosss = $this->getEntrTable()->Rapport($where, null); // $col);
            $tabdepis[$k]['valeur'] = 0;


            foreach ($dosss as $doss) {

                foreach ($corresp as $cor) {
                    if (!isset($bio[$doss->Doss][$cor]))
                        $bio[$doss->Doss][$cor] = "";
                }
                $tot++; //=$doss->count;
                $tabdepis[$k]['valeur'] ++; // = $doss->count;
                if (array_key_exists($doss->Doss, $dossiers))
                    foreach ($dossiers[$doss->Doss] as $colonne => $value) {
                        $bio[$doss->Doss][$colonne] = $dossiers[$doss->Doss][$colonne];
                        $bio[$doss->Doss][$correspond] = $doss->LaboDat_;
                    }
            }
        }
        $tot += $tabdepis['Autres']['valeur'] = $this->NsuivBioautr($datedeb, $datefin);
        $tabdepis = $this->pourcentage($tabdepis, $tot);
        $this->bio = $bio;
        return $tabdepis;
    }

    public function NsuivBioautr($datedeb, $datefin) {

        //Autre 0 12
        for ($i = 0; $i <= 12; $i++) {
            if ($i != 1) {
                if ($i < 10 && $i != 12)
                    $tab[] = 'Au0' . $i;
                else
                    $tab[] = 'Au' . $i;
            }
        }
        //Bi 6 13
        for ($i = 0; $i <= 13; $i++) {
            if ($i >= 6 && $i != 11) {
                if ($i < 10)
                    $tab[] = 'Bi0' . $i;
                else
                    $tab[] = 'Bi' . $i;
            }
        }
        //Se 6 13
        for ($i = 0; $i <= 13; $i++) {
            if ($i >= 3 && $i != 11 && $i != 12 && $i != 6 && $i != 8) {
                if ($i < 10)
                    $tab[] = 'Ser' . $i;
                else
                    $tab[] = 'Se' . $i;
            }
        }
        $tab[] = 'Vagi';
        $tab[] = 'Pcr_';
        $tab[] = 'Urin';
        $tab[] = 'Ceph';
        $tab[] = 'Gout';
        $cpt = 0;
        foreach ($tab as $tabb) {
            $where = $tabb . ">0  and labodat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and Cta_Nume is not null";
            $col = array('count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
            $dosss = $this->getEntrTable()->Rapport($where, $col)->toArray();
            //   echo $where." " ;
            $cpt += (int) $dosss[0]['count'];
//echo $dosss[0]['count']." ";
            unset($dosss);
        }
        return $cpt;
    }

    public function Nbincarv($datefin) { //patient sous arv qui sont dans la file active        
        $dossiers = $this->setdoss();
        $dfin = date("Y-m-t", strtotime($datefin));
        $ddeb = date("Y-m-01", strtotime($datefin));

        $query = "Select t.doss,Dat_ from " . $this->prefixe . "medicons t inner join (SELECT doss,MIN(Dat_) as min_date FROM   " . $this->prefixe . "medicons WHERE (doss>0 And Arv0Prsc<>'' or Arv1Prsc<>'' or Arv2Prsc<>'' or Arv3Prsc<>'' or Arv4Prsc<>'' or Arv5Prsc<>'' or Arv6Prsc<>'' or Arv7Prsc<>'' or Arv8Prsc<>'' or Arv9Prsc<>'') GROUP BY doss)a on a.doss = t.doss and a.min_date = Dat_ where(Dat_>='$ddeb' AND Dat_<='$dfin') GROUP BY doss";
        $meddebprsc = $this->getEntrTable()->executeSqlString($query);
        $tab["Nombre de patients mis sous ARV ce mois"]['valeur'] = count($meddebprsc);
        $tab['Dont enfants (<= 15 ans)']['valeur'] = 0;
        foreach ($meddebprsc as $debprsc) {
            if (array_key_exists($debprsc['doss'], $dossiers)) {
                if ($dossiers[$debprsc['doss']]['RensAge_'] <= 15)
                    $tab['Dont enfants (<= 15 ans)']['valeur'] ++;
            }
        }
        $query1 = "Select t.doss,Dat_ from " . $this->prefixe . "medicons t inner join (SELECT doss,MIN(Dat_) as min_date FROM   " . $this->prefixe . "medicons WHERE (doss>0 And Arv0Prsc<>'' or Arv1Prsc<>'' or Arv2Prsc<>'' or Arv3Prsc<>'' or Arv4Prsc<>'' or Arv5Prsc<>'' or Arv6Prsc<>'' or Arv7Prsc<>'' or Arv8Prsc<>'' or Arv9Prsc<>'') GROUP BY doss)a on a.doss = t.doss and a.min_date = Dat_ where(Dat_<='$dfin') GROUP BY doss";
        $meddebprsc1 = $this->getEntrTable()->executeSqlString($query1);

        $tab["Nombre de patients sous ARV à la fin du mois"]['valeur'] = 0;
        $tab[' Dont enfants (<= 15 ans)']['valeur'] = 0;

        $datedebfilact = date('Y-m-d', strtotime($dfin . ' -6 month')); //file active de la fin du moi
        $this->fileact($datedebfilact, $dfin);
        $cons = array();
        foreach ($meddebprsc1 as $debprsc1) {
            if (array_key_exists($debprsc1['doss'], $this->fileactive)) {
                if (array_key_exists($debprsc1['doss'], $dossiers)) {
                    $tab["Nombre de patients sous ARV à la fin du mois"]['valeur'] ++;
                    if ($dossiers[$debprsc1['doss']]['RensAge_'] <= 15)
                        $tab[' Dont enfants (<= 15 ans)']['valeur'] ++;

                    $Nume = $debprsc1['doss'];
                    $cons[$Nume]['Ref_'] = $dossiers[$Nume]['Ref_'];
                    $cons[$Nume]['RensAge_'] = $dossiers[$Nume]['RensAge_'];
                    $cons[$Nume]['RensSexe'] = $dossiers[$Nume]['RensSexe'];
                    $cons[$Nume]['OuvrDat_'] = $dossiers[$Nume]['OuvrDat_'];
                    $cons[$Nume]['Arv_Desi'] = $dossiers[$Nume]['Arv_Desi'];
                    $cons[$Nume]['MediSeroTyp_'] = $dossiers[$Nume]['MediSeroTyp_'];
                    $cons[$Nume]['RensTel_'] = $dossiers[$Nume]['RensTel_'];
                    $cons[$Nume]['debprescr'] = $debprsc1['Dat_'];
                }
            }
        }

        $this->inclusionarv = $cons;
        $cons = null;
        return $tab;
    }

    public function pourcentage($tabdepis, $tot) {
        foreach ($tabdepis as $k => $tabdepi) {
            if ($tot > 0)
                $tabdepis[$k]['pourcentage'] = round($tabdepis[$k]['valeur'] * 100 / $tot) . "%";
            else
                $tabdepis[$k]['pourcentage'] = '0%';
        }
        $tabdepis['Total']['valeur'] = $tot;
        if ($tot > 0)
            $tabdepis['Total']['pourcentage'] = '100%';
        else
            $tabdepis['Total']['pourcentage'] = '0%';
        return $tabdepis;
    }

    public function Ninfectop($datedeb, $datefin, $corresp) {

        $tot = 0;
        $infectop = array();

        $dossiers = $this->setdoss();
        foreach ($corresp as $k => $value) {

            $where = " (SUBSTR(ConcCase," . $value . ",1)=1 AND Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and doss >0)";
            if ($k == 'Zona 5 derniers mois') {
                $date = date('Y-m-d', strtotime($datedeb . ' -5 month'));
                $where = " (SUBSTR(ConcCase," . $value . ",1)=1 AND Dat_ BETWEEN '" . $date . "' AND '" . $datefin . "')";
            }
            $dosss = $this->getMediconsTable()->Rapport($where);
            $tabdepis[$k]['valeur'] = 0;
            foreach ($dosss as $doss) {
                foreach ($corresp as $keys => $cor) {
                    if (!isset($infectop[$doss->Nume][$keys]))
                        $infectop[$doss->Nume][$keys] = "";
                }$i = 0;
                $tot++; //=$doss->count;
                $tabdepis[$k]['valeur'] ++; // = $doss->count;
                if (array_key_exists($doss->Doss, $dossiers))
                    foreach ($dossiers[$doss->Doss] as $colonne => $v) {




                        $infectop[$doss->Nume][$colonne] = $dossiers[$doss->Doss][$colonne];
                        $infectop[$doss->Nume][$k] = $doss->Dat_;

                        $i++;
                    }
            }
        }

        $tabdepis = $this->pourcentage($tabdepis, $tot);
        $this->infectop = $infectop;
        return $tabdepis;
    }

    public function Nactcomm($datedeb, $datefin) {
        $list = $this->getOptionsForSelect($this->getListeTable()->select("Typ_ = 'Communauté | Activité'", 'Desi'), 'Desi', 'Desi');
        $where = "(Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and Acti is not null)";
        $col = array('Acti' => new \Zend\Db\Sql\Expression('Distinct(Acti)'), 'count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
        $group = array(new \Zend\Db\Sql\Expression("Acti"));
        $dosss = $this->getCommTable()->Rapport($where, $col, $group)->toArray();
        $tab = array();
        foreach ($dosss as $doss) {
            $tab[$doss['Acti']]['nbsess'] = $doss['count'];
            $tab[$doss['Acti']]['totpar'] = 0;
            $tab[$doss['Acti']]['hom'] = 0;
            $tab[$doss['Acti']]['fem'] = 0;
            $tab[$doss['Acti']]['total'] = 0;
            $tab[$doss['Acti']]['obs'] = '';
        }
        $where = "(Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and Acti is not null)";
        $col = array('Acti' => 'Acti', 'count' => new \Zend\Db\Sql\Expression('COUNT(DISTINCT commdoss.Doss)'), 'Doss' => 'Doss', 'Renssexe' => 'Renssexe');
        $join[0] = array('commdoss' => 'commdoss');
        $condjoin[0] = 'comm.Nume=commdoss.Comm';
        $join[1] = array('doss' => 'doss');
        $condjoin[1] = 'commdoss.Doss=doss.Nume';
        $group = array(new \Zend\Db\Sql\Expression("doss"));
        $dosss = $this->getCommTable()->RapportjointareV($where, $col, $join, $condjoin, $group)->toArray();
        foreach ($dosss as $doss) {
            if (isset($tab[$doss['Acti']]['totpar']))
                $tab[$doss['Acti']]['totpar'] = $tab[$doss['Acti']]['totpar'] + $doss['count'];
            if (isset($tab[$doss['Acti']]['hom']))
                if ($doss['Renssexe'] == '1')
                    $tab[$doss['Acti']]['hom'] = $tab[$doss['Acti']]['hom'] + $doss['count'];
            if (isset($tab[$doss['Acti']]['fem']))
                if ($doss['Renssexe'] == '2')
                    $tab[$doss['Acti']]['fem'] = $tab[$doss['Acti']]['fem'] + $doss['count'];
            $tab[$doss['Acti']]['total'] = $tab[$doss['Acti']]['totpar'];
            $tab[$doss['Acti']]['obs'] = '';
        }
        return $tab;
    }

    public function NkitAlim($datedeb, $datefin) {
        $corresp = array('Kits alimentaires In' => 'Kits individuels', 'Kits alimentaires Fa' => 'Kits familiaux');
        $tab['Kits individuels']['enf'] = 0;
        $tab['Kits individuels']['adlt'] = 0;
        $tab['Kits familiaux']['enf'] = 0;
        $tab['Kits familiaux']['adlt'] = 0;
        $where = "(Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and (Acti='Kits alimentaires Fa' or Acti='Kits alimentaires In') and RensAge_<=15)";
        $col = array('Acti' => 'Acti', 'count' => new \Zend\Db\Sql\Expression('COUNT(DISTINCT commdoss.Doss)'));
        $join[0] = array('commdoss' => $this->prefixe . 'commdoss');
        $condjoin[0] = $this->prefixe . 'comm.Nume=commdoss.Comm';
        $join[1] = array('doss' => $this->prefixe . 'doss');
        $condjoin[1] = 'commdoss.Doss=doss.Nume';
        $group = array(new \Zend\Db\Sql\Expression("Acti"));
        $dosss = $this->getCommTable()->RapportjointareV($where, $col, $join, $condjoin, $group)->toArray();
        $tab = array();
        $tot1 = 0;
        foreach ($dosss as $doss) {
            $tot1 += $doss['count'];
            $key = $corresp[$doss['Acti']];
            $tab[$key]['enf'] = $doss['count'];
            if (!isset($tab[$key]['adlt']))
                $tab[$key]['adlt'] = 0;
        }
        $where = "(Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and (Acti='Kits alimentaires Fa' or Acti='Kits alimentaires In') and RensAge_>15)";
        $dosss = $this->getCommTable()->RapportjointareV($where, $col, $join, $condjoin, $group)->toArray();
        $tot = 0;
        foreach ($dosss as $doss) {
            $tot += $doss['count'];
            $key = $corresp[$doss['Acti']];
            if (!isset($tab[$key]['enf']))
                $tab[$key]['enf'] = 0;
            $tab[$key]['adlt'] = $doss['count'];
        }

        $tab['Total']['enf'] = $tot1;
        $tab['Total']['adlt'] = $tot;
        $tot = $tab['Total']['enf'] + $tab['Total']['adlt'];
        foreach ($tab as $k => $tabb) {
            $tab[$k]['Total'] = $tab[$k]['enf'] + $tab[$k]['adlt'];
            $tab[$k]['Pourcentage'] = '0%';
            if ($tot > 0) {
                $tab[$k]['Pourcentage'] = round($tab[$k]['Total'] * 100 / $tot) . '%';
                $tab['Pourcentage']['enf'] = round($tab['Total']['enf'] * 100 / $tot) . '%';
                $tab['Pourcentage']['adlt'] = round($tab['Total']['adlt'] * 100 / $tot) . '%';
                $tab['Pourcentage']['Total'] = '100%';
                $tab['Pourcentage']['Pourcentage'] = '';
            }
        }
        return $tab;
    }

    public function Nactind($datedeb, $datefin) {
        //SELECT COUNT(*) AS `count`, `Renssexe` AS `Renssexe` FROM `socicons` INNER JOIN `Doss` AS `Doss` ON `Socicons`.`Doss`=`Doss`.`Nume` WHERE (Dat_ BETWEEN '2017-08-01' AND '2017-08-31' ) GROUP BY renssexe
        $where = "(Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "')";
        $col = array('count' => new \Zend\Db\Sql\Expression('COUNT(*)'), 'Renssexe' => 'Renssexe');
        $join = array('doss' => 'doss');
        $condjoin = 'doss.Nume=socicons.Doss';
        $group = array(new \Zend\Db\Sql\Expression("Renssexe"));
        $dosss = $this->getSociconsTable()->Rapportjoint($where, $col, $join, $condjoin, $group)->toArray();
        $tab['Soutien social']['totalseanc'] = 0;
        $tab['Soutien social'][1] = 0;
        $tab['Soutien social'][2] = 0;
        foreach ($dosss as $doss) {
            $tab['Soutien social']['totalseanc'] += (int) $doss['count'];
            if ($doss['Renssexe'] == '1')
                $tab['Soutien social'][1] = $doss['count'];
            if ($doss['Renssexe'] == '2')
                $tab['Soutien social'][2] = $doss['count'];
        }
        $tab['Soutien social']['total'] = $tab['Soutien social'][1] + $tab['Soutien social'][2];
        $tab['Soutien social']['obs'] = '';

        $where = "(Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "')";
        $col = array('count' => new \Zend\Db\Sql\Expression('COUNT(*)'), 'Renssexe' => 'Renssexe');
        $join = array('doss' => 'doss');
        $condjoin = 'doss.Nume=psy_cons.Doss';
        $group = array(new \Zend\Db\Sql\Expression("Renssexe"));
        $dosss = $this->getPsyconsTable()->Rapportjoint($where, $col, $join, $condjoin, $group)->toArray();
        $tab['Soutien psychologique']['totalseanc'] = 0;
        $tab['Soutien psychologique'][1] = 0;
        $tab['Soutien psychologique'][2] = 0;
        foreach ($dosss as $doss) {
            $tab['Soutien psychologique']['totalseanc'] += (int) $doss['count'];
            if ($doss['Renssexe'] == '1')
                $tab['Soutien psychologique'][1] = $doss['count'];
            if ($doss['Renssexe'] == '2')
                $tab['Soutien psychologique'][2] = $doss['count'];
        }
        $tab['Soutien psychologique']['total'] = $tab['Soutien psychologique'][1] + $tab['Soutien psychologique'][2];
        $tab['Soutien psychologique']['obs'] = '';

        return $tab;
    }

    /**/

    public function Nconsind() {
        for ($i = 1; $i <= 2; $i++) {
            $tabconsindivi[$i][1] = 0;
            $tabconsindivi1[$i][1] = 0;
        }
        $titre = array(
            'Enfants' => 1,
            'Adultes' => 2,
        );
        $titre1 = array(
            'Enfants dénutris' => 1,
            'Adultes dénutris' => 2,
        );
        $tabconsindivi[1][1] = 5;
        $tabconsindivi[2][1] = 6;
        $tabconsindivi1[1][1] = 3;
        $tabconsindivi1[2][1] = 2;

        $tabconsindivi = $this->totrow($tabconsindivi);
        end($tabconsindivi);         // move the internal pointer to the end of the array
        $key = key($tabconsindivi);
        end($tabconsindivi[$key]);         // move the internal pointer to the end of the array
        $key2 = key($tabconsindivi[$key]);
        $tabconsindivi = $this->pourcentrow($tabconsindivi, $tabconsindivi[$key][$key2]);
        foreach ($titre as $k => $value) {
            $titre[$value] = $k;
            unset($titre[$k]);
        }

        $titre[] = 'Total';
        $tabconsindivi = $this->addcol($tabconsindivi, $titre, 'titre');
        $tabconsindivi1 = $this->totrow($tabconsindivi1);
        end($tabconsindivi1);         // move the internal pointer to the end of the array
        $key = key($tabconsindivi1);
        end($tabconsindivi1[$key]);         // move the internal pointer to the end of the array
        $key2 = key($tabconsindivi1[$key]);
        $tabconsindivi1 = $this->pourcentrow($tabconsindivi1, $tabconsindivi1[$key][$key2]);
        foreach ($titre1 as $k => $value) {
            $titre1[$value] = $k;
            unset($titre1[$k]);
        }
        $titre1[] = 'Total';
        $tabconsindivi1 = $this->addcol($tabconsindivi1, $titre1, 'titre');
        //fusion 
        $tab = array();
        foreach ($tabconsindivi as $k => $tabconsindiv) {
            if (!isset($cle))
                $cle = 1;
            $tab[$cle] = $tabconsindiv;
            $cle++;
            $tab[$cle] = $tabconsindivi1[$k];
            $cle++;
        }
        return $tab;
    }

    /**/

    public function Nchrgcta() {
        for ($i = 1; $i <= 3; $i++) {
            $tabchrgcta[$i][1] = 0;
            $tabchrgcta[$i][2] = 0;
            $tabchrgcta[$i][3] = 0;
            $tabchrgcta[$i][1] = 0;
            $tabchrgcta1[$i][2] = 0;
            $tabchrgcta1[$i][3] = 0;
            $tabchrgcta1[$i][4] = 0;
        }
        $titre = array(
            '0 à 5 ans' => 1,
            '6 à 16 ans' => 2,
            '> 16 ans' => 3,
        );
        for ($i = 1; $i <= 3; $i++) {
            $tabchrgcta[$i][1] = rand(0, 5);
            $tabchrgcta[$i][2] = rand(0, 5);
            $tabchrgcta[$i][3] = rand(0, 5);
            $tabchrgcta1[$i][1] = rand(0, 5);
            $tabchrgcta1[$i][2] = rand(0, 5);
            $tabchrgcta1[$i][3] = rand(0, 5);
            $tabchrgcta1[$i][4] = rand(0, 5);
        }
        if (isset($tabchrgcta)) {
            $tabchrgcta = $this->totcol($tabchrgcta);
            foreach ($titre as $k => $value) {
                $titre[$value] = $k;
                unset($titre[$k]);
            }
            $tabchrgcta = $this->addcol($tabchrgcta, $titre, 'titre');
            $tabchrgcta1 = $this->totcol($tabchrgcta1);
            //fusion 
            foreach ($tabchrgcta as $k => $tabchrgct) {
                if (!isset($cles))
                    $cles = 1;
                $tabchrg[$cles] = array_merge($tabchrgcta[$k], $tabchrgcta1[$k]);
                /*                 * commencer par 1 parce que array_merge fait commencer par 0 */
                array_unshift($tabchrg[$cles], "test");
                unset($tabchrg[$cles][0]);
                /*                 * *** */
                $cles++;
            }
            $chrgmoiprec[1] = 10;
            $chrgmoiprec[2] = 7;
            $chrgmoiprec[3] = 5;
            $tabchrg = $this->addcol($tabchrg, $chrgmoiprec, 'chrgmoiprec');
            $i = 1;
            foreach ($tabchrg as $tabchrge) {
                $chrgfinmoi[$i] = (int) $tabchrge['chrgmoiprec'] + (int) $tabchrge[4] - (int) $tabchrge[9];
                $i++;
            }
            $tabchrg = $this->addcol($tabchrg, $chrgfinmoi, 'chrgfinmoi');
            $this->tabchrgcta = $tabchrg;
        }
        return $tabchrg;
    }

    /**/

    public function Nintrant() {
        $titre = array(
            'Plumpy nut' => 1,
            'Lait F-75' => 2,
        );
        for ($i = 1; $i <= 2; $i++) {
            $tabintrant[$i][1] = rand(0, 5);
            $tabintrant[$i][2] = rand(0, 5);
            $tabintrant[$i][3] = rand(0, 5);
        }
        if (isset($tabintrant)) {
            foreach ($titre as $k => $value) {
                $titre[$value] = $k;
                unset($titre[$k]);
            }
            $tabintrant = $this->addcol($tabintrant, $titre, 'titre');
            $i = 1;

            foreach ($tabintrant as $tabintran) {
                $stockfinmoi[$i] = (int) $tabintran[1] + $tabintran[2] - $tabintran[3];
                $i++;
            }
            $tabintrant = $this->addcol($tabintrant, $stockfinmoi, 'stockfinmoi');
        }
        return $tabintrant;
    }

    public function Nbimcclas($datedeb, $datefin, $titre) {
        echo "<br><br>";
        foreach ($titre as $value) {
            $tab[$value]['valeur'] = 0;
        }
        $where = "(Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and doss.rensage_ > 15 and Imc_ is not null)";
        $col = array(new \Zend\Db\Sql\Expression('case when Imc_ < 18.5 then "Dénutris" when Imc_ between 18.5 and 24.9 then "Normal" when Imc_ between 25.0 and 29.9 then "Surpoids" when Imc_ >= 30 then "Obésité" end as Imc_'), 'count' => new \Zend\Db\Sql\Expression('COUNT(Distinct imc_)'));
        $join = array('doss' => $this->prefixe . 'doss');
        $condjoin = $this->prefixe . 'medicons.Doss=doss.Nume';

        $group = array(new \Zend\Db\Sql\Expression('case when Imc_ < 18.5 then "Dénutris" when Imc_ between 18.5 and 24.9 then "Normal" when Imc_ between 25.0 and 29.9 then "Surpoids" when Imc_ >= 30 then "Obésité" end'));
        $dosss = $this->getMediconsTable()->Rapportjoint($where, $col, $join, $condjoin, $group);

        foreach ($dosss as $doss) {
            $tab[$doss->Imc_]['valeur'] = $doss->count;
        }

        return $tab;
    }

    public function Nbimc($datedeb, $datefin, $titre) {
        foreach ($titre as $value) {
            $tab[$value]['valeur'] = 0;
        }
        $where = "(Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' and doss.rensage_ > 15 and Imc_ is not null)";
        $col = array(new \Zend\Db\Sql\Expression('case when Imc_ < 16 then "< 16.0" when Imc_ between 16.0 and 16.9 then "16.0 - 16.9" when Imc_ between 17.0 and 18.4 then "17.0 - 18.4" when Imc_ between 18.5 and 24.9 then "18.5 - 24.9" when Imc_ between 25.0 and 29.9 then "25.0 - 29.9" when Imc_ between 30.0 and 34.9 then "30.0 - 34.9" when Imc_ >= 35.0 then ">= 35.0" end as Imc_'), 'count' => new \Zend\Db\Sql\Expression('COUNT(Distinct imc_)'));
        $join = array('doss' => $this->prefixe . 'doss');
        $condjoin = $this->prefixe . 'medicons.Doss=doss.Nume';



        $group = array(new \Zend\Db\Sql\Expression('case when Imc_ < 16 then "< 16.0" when Imc_ between 16.0 and 16.9 then "16.0 - 16.9" when Imc_ between 17.0 and 18.4 then "17.0 - 18.4" when Imc_ between 18.5 and 24.9 then "18.5 - 24.9" when Imc_ between 25.0 and 29.9 then "25.0 - 29.9" when Imc_ between 30.0 and 34.9 then "30.0 - 34.9" when Imc_ >= 35.0 then ">= 35.0" end'));
        $dosss = $this->getMediconsTable()->Rapportjoint($where, $col, $join, $condjoin, $group);
        print_r($dosss);exit;
        $tot = 0;
        foreach ($dosss as $doss) {
            $tot += $doss->count;
            $tab[$doss->Imc_]['valeur'] = $doss->count;
        }
        $tab = $this->pourcentage($tab, $tot);
print_r($tab);exit;
        return $tab;
    }

    public function Nbcotx($datedeb, $datefin) {
        $where = 'desi ="cotrimoxazole"';
        $col = array('Nume');
        $dosss = $this->getDciTable()->Rapport($where, $col);
        foreach ($dosss as $dci) {
            $nume = $dci->Nume;
        }
        if ($nume) {
            $where = "medicons.Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "' And  ";
            $case = "case";
            for ($i = 0; $i <= 5; $i++) {
                $where .= " Med" . $i . "Dci_ = " . $nume;
                if ($i != 5)
                    $where .= " Or";
                $case .= "  when Med" . $i . "Dci_= " . $nume . " then Med" . $i . "Nomb";
            }
            $case .= " end";
            $col = array('Ref_' => 'Ref_', 'count' => new \Zend\Db\Sql\Expression($case));
            $join = array('medicons' => $this->prefixe . 'medicons');
            $condjoin = $this->prefixe . 'doss.Nume=medicons.Doss';


            $dosss = $this->getDossTable()->Rapportjoint($where, $col, $join, $condjoin);
            $tab = array();
            $i = 1;
            foreach ($dosss as $doss) {
                $tab[$i]['codep'] = $doss->Ref_;
                $tab[$i]['comp'] = $doss->count;
                $i++;
            }
        }
        return $tab;
    }

    public function Nbcotxresult($tabcotx, $titre) {
        $totpat = array();
        foreach ($titre as $k => $tit) {
            $tabcotx1[$k]['valeur'] = 0;
        }
        foreach ($tabcotx as $tabcot) {
            if ($tabcot['codep'] !== "") {
                $tabcotx1['Total prescriptions']['valeur'] ++;
                $totpat[$tabcot['codep']] = $tabcot['codep'];
            }
            if ($tabcot['comp'] !== "") {
                $tabcotx1['Nbre comprimés']['valeur'] += $tabcot['comp'];
            }
        }
        $tabcotx1['Total patient']['valeur'] = count($totpat);
        return $tabcotx1;
    }

    public function Nbdpis($datedeb, $datefin) {
        $where = " ((ConfDat_>='" . $datedeb . "')AND(ConfDat_<='" . $datefin . "'))"; /* AND (ConfSero>0) */
        $col = array('Nume', 'Ref_', 'Age_', 'ConfDat_', 'ConfSero', 'ConfSeroTyp_', 'Sexe');
        $depi = $this->getDepiTable()->Rapport($where, $col);
        $tabdepis = $this->initialisation(3, 3, 0);
        $i = 0;
        $tab1 = array();
        $tab2 = array();
        $tab3 = array();
        $depistage = array();
        $sexe = array('1' => 'Masculin', '2' => 'Feminin', '' => '');
        $confsero = array('1' => 'Positif', '2' => 'Negatif', '3' => 'Indeterminé', '' => '');
        foreach ($depi as $depis) {
            $tab1[$i] = $depis->ConfSero;
            $tab2[$i] = $depis->ConfSeroTyp_;
            $tab3[$i] = $depis->Sexe;
            $depistage[$depis->Nume]['Ref'] = $depis->Ref_;
            $depistage[$depis->Nume]['Sexe'] = $sexe[$depis->Sexe];
            $depistage[$depis->Nume]['Age_'] = $depis->Age_;
            $depistage[$depis->Nume]['ConfSero'] = $confsero[$depis->ConfSero];
            $depistage[$depis->Nume]['ConfSeroTyp_'] = $depis->ConfSeroTyp_;
            $depistage[$depis->Nume]['ConfDat_'] = $depis->ConfDat_;
            $i++;
        }
        $sexecor = array('1' => 1, '2' => 2);
        for ($i = 0; $i < count($tab1); $i++) {
            if (array_key_exists($tab3[$i], $sexecor)) {
                if ($tab1[$i] > 0) {
                    if (!isset($tabdepis[$tab1[$i]][$sexecor[$tab3[$i]]])) {
                        $tabdepis[$tab1[$i]][$sexecor[$tab3[$i]]] = 1;
                    } else
                        $tabdepis[$tab1[$i]][$sexecor[$tab3[$i]]] ++;
                    $tabdepis[$tab1[$i]][3] = $tabdepis[$tab1[$i]][1] + $tabdepis[$tab1[$i]][2];
                }
            }
        }

        $tabtyp = $this->Nbdpistyp($sexecor, $tab1, $tab2, $tab3);
        $tab['depistage'] = $tabdepis;
        $tab['type'] = $tabtyp;
        $this->depistage = $depistage;
        return $tab;
    }

    public function Nbdpistyp($sexecor, $tab1, $tab2, $tab3) {
        $tabdepis = $this->initialisation(3, 3, 0);
        $titre = array('VIH1' => 1, 'VIH2' => 2, 'VIH 1+2' => 3);
        for ($i = 0; $i < count($tab2); $i++) {
            if (array_key_exists($tab3[$i], $sexecor)) {
                if ($tab2[$i]/* > 0 && $tab2[$i] < 4 */) {
                    if (array_key_exists($tab2[$i], $titre)) {
                        if (!isset($tabdepis[$titre[$tab2[$i]]][$sexecor[$tab3[$i]]])) {
                            $tabdepis[$titre[$tab2[$i]]][$sexecor[$tab3[$i]]] = 1;
                        } else
                            $tabdepis[$titre[$tab2[$i]]][$sexecor[$tab3[$i]]] ++;
                        $tabdepis[$titre[$tab2[$i]]][3] = $tabdepis[$titre[$tab2[$i]]][1] + $tabdepis[$titre[$tab2[$i]]][2];
                    }
                }
            }
        }
        return $tabdepis;
    }

    public function Nbprofilpat($date) {
        $datefin = date('Y-m-t', strtotime($date));
        $datedeb = date('Y-m-01', strtotime($date));
        for ($i = 0; $i < 6; $i++) {
            $tabprofil[$i]['valeur'] = 0;
        }
        /* AND(RensAge_!='') (ouvrdat_ is null) erreur de saisi */
        $dossdetail = array();
        $col = array('Nume', 'Ref_', 'RensAge_', 'RensSexe', 'OuvrDat_');
        $doss = $this->getDossTable()->Rapport(null, $col, null);
        $sexe = array("1" => "Masculin", "2" => "Feminin", '' => "");

        foreach ($doss as $dossierd) {
            $dossdetail[$dossierd->Nume]['Ref'] = $dossierd->Ref_;
            $dossdetail[$dossierd->Nume]['RensSexe'] = $sexe[$dossierd->RensSexe];
            $dossdetail[$dossierd->Nume]['RensAge_'] = $dossierd->RensAge_;
            $dossdetail[$dossierd->Nume]['OuvrDat_'] = $dossierd->OuvrDat_;
        }
        $where = " ((OuvrDat_<'" . $datedeb . "') or (Ouvrdat_ is null))"; /* AND(RensAge_!='') (ouvrdat_ is null) erreur de saisi */
        $col = array('count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
        $doss = $this->getDossTable()->Rapport($where, $col, null)->toArray();
        foreach ($doss as $dossier) {
            if (isset($dossier['count'])) {
                $tabprofil[0]['valeur'] = $dossier['count'];
            }
        }

        $where = " ((OuvrDat_>='" . $datedeb . "')AND(OuvrDat_<='" . $datefin . "23:59:59'))"; /* AND(RensAge_!='') */
        $col = array(new \Zend\Db\Sql\Expression("(case when RensAge_ <= 15 then 'Enfant' when RensAge_ > 15 then 'Adulte'  end) AS RensAge_"), 'count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
        $group = array(new \Zend\Db\Sql\Expression("(case when RensAge_ <= 15 then 'Enfant' when RensAge_ > 15 then 'Adulte' end)"));
        $doss = $this->getDossTable()->Rapport($where, $col, $group)->toArray();
        $tabprofil[1]['valeur'] = 0;
        foreach ($doss as $dossier) {
            if (isset($dossier['count'])) {
                $tabprofil[1]['valeur'] += $dossier['count'];
                if ($dossier['RensAge_'] == "Enfant")
                    $tabprofil[2]['valeur'] = $dossier['count'];
            }
        }


        $datedebfilact = date('Y-m-d', strtotime($date . ' -6 month'));
        $fileact = $this->fileact($datedebfilact, $date);
        $enffileact = 0;
        foreach ($fileact as $fileactenf) {
            if ($fileactenf['RensAge_'] <= 15) {
                $enffileact++;
            }
        }
        $fileactall = count($fileact);
        $tabprofil[4]['valeur'] = $fileactall;
        $tabprofil[5]['valeur'] = $enffileact;
        $this->dossdetail = $dossdetail;
        return $tabprofil;
    }

    public function Nbtransfpat($datedeb, $datefin) {
        $user = $this->getUserTable()->getUser($this->zfcUserAuthentication()->getIdentity()->getId());
        $centre = $this->getCentreTable()->getCentre($user->centre);


        $transdetail = array();
        $doss = $this->getTransTable()->select("Dat_>='$datedeb' and Dat_<='$datefin' and (Structure_source = '$centre->Code_struct' or Structure_destination = '$centre->Code_struct' )", 'Dat_'); //arder by dat_
        $tabprofil = array();
        $tabprofil['Nombre de patients transférés vers une autre structure']['valeur'] = 0;
        $tabprofil["Nombre de patients venant d'autres structures PEC"]['valeur'] = 0;

        /* a peu pret vrai */$i = 0;
        foreach ($doss as $dossierd) {
            if ($dossierd->Structure_source == $centre->Code_struct) {
                $tabprofil['Nombre de patients transférés vers une autre structure']['valeur'] ++;
            }
            if ($dossierd->Structure_destination == $centre->Code_struct) {
                $tabprofil["Nombre de patients venant d'autres structures PEC"]['valeur'] ++;
            }
            $transdetail[$i]['Ref'] = $dossierd->Ref_;
            $transdetail[$i]['TransDat_'] = $dossierd->Dat_;
            $transdetail[$i]['Source'] = $dossierd->Structure_source;
            $transdetail[$i]['Destination'] = $dossierd->Structure_destination;
            $i++;
        }


        $tabprofil["Nombre Total Patients transferés"]['valeur'] = $tabprofil['Nombre de patients transférés vers une autre structure']['valeur'] + $tabprofil["Nombre de patients venant d'autres structures PEC"]['valeur'];
        $this->transdetail = $transdetail;
        return $tabprofil;
    }

    public function Ndcd($datefin) {
        $dfin = date("Y-m-t", strtotime($datefin));
        $ddeb = date("Y-m-01", strtotime($datefin));
        $col = array('Nume', 'RensSexe', 'RensAge_', 'Ref_', 'RensDeceDat_', 'Arv_Desi');
        $where1 = " (  RensDeceDat_ >= '$ddeb' and RensDeceDat_ <='$dfin')";
        $dosss1 = $this->getDossTable()->Rapport($where1, $col, null);
        //dcd par moi
        $tab['Nombre de décès ce mois']['valeur'] = count($dosss1);
        $tab['Nombre enfants décédés ce mois (≤ 15 ans)']['valeur'] = 0;
        $dcdm = array();
        $sexe[1] = "Masculin";
        $sexe[2] = "Feminin";
        $sexe[''] = "";
        foreach ($dosss1 as $doss1) {
            if ($doss1->RensAge_ <= 15) {
                $tab['Nombre enfants décédés ce mois (≤ 15 ans)']['valeur'] ++;
            }
            $dcdm[$doss1->Nume]['Ref'] = $doss1->Ref_;
            $dcdm[$doss1->Nume]['RensSexe'] = $sexe[$doss1->RensSexe];
            $dcdm[$doss1->Nume]['RensAge_'] = $doss1->RensAge_;
            $dcdm[$doss1->Nume]['RensDeceDat_'] = $doss1->RensDeceDat_;
            $dcdm[$doss1->Nume]['Arv_Desi'] = $doss1->Arv_Desi;
        }

        $where = " ( RensDeceDat_ is not null and RensDeceDat_ >0);";
        $dosss = $this->getDossTable()->Rapport($where, $col, null);

        //dcd total
        $tab['Nombre total de décès']['valeur'] = count($dosss);
        // $tab['Nombre total enfants décédés (≤ 15 ans)']['valeur'] = 0;
        $dcd = array();

        foreach ($dosss as $doss) {
            $dcd[$doss->Nume]['Ref'] = $doss->Ref_;
            $dcd[$doss->Nume]['RensSexe'] = $sexe[$doss->RensSexe];
            $dcd[$doss->Nume]['RensAge_'] = $doss->RensAge_;
            $dcd[$doss->Nume]['RensDeceDat_'] = $doss->RensDeceDat_;
            $dcd[$doss->Nume]['Arv_Desi'] = $doss->Arv_Desi;
            // if ($doss->RensAge_ <= 15)
            //     $tab['Nombre total enfants décédés (≤ 15 ans)']['valeur'] ++;
        }

        $this->dcd = $dcd;
        $this->dcdm = $dcdm;
        return $tab;
    }

    public function pdvpmoi($perdudv) {
        print_r($perdudv);
        foreach ($perdudv as $k => $pdv) { {
                foreach ($pdv as $value) {
                    $tab[$value] = $k;
                }
            }
        }
        echo "<br><br><br><br><br>";
        print_r($tab);
        //  exit;
    }

    public function Npdv($datefin) {

        $datedebfilact = date('Y-m-d', strtotime($datefin . ' -6 month'));
        $perdudv = $this->perdudv($datedebfilact, $datefin);

        $t[0] = count($perdudv);
        $t[1] = 0;
        foreach ($perdudv as $perdu) {
            if ($perdu['RensAge_'] <= 15)
                $t[1] ++;
        }
        $t[2] = count($this->pdvpm);
        $t[3] = 0;
        foreach ($this->pdvpm as $perdum) {
            if ($perdum['RensAge_'] <= 15)
                $t[3] ++;
        }

        $tab['nb'] = $t;
        $tab['detailspdv'] = $perdudv;
        return $tab;
    }

    public function perdudv($datedebfilact, $datefin) {

        /*         * ****************************************perdu de vu global************************************** */
        $fileact = $this->fileact($datedebfilact, $datefin);
        $col = array('Nume', 'RensSexe', 'RensAge_', 'Ref_', 'Arv_Desi');
        $where = "rensdecedat_=0 or rensdecedat_ is null";
        $doss = $this->getDossTable()->Rapport($where, $col);
        $pdv = array();
        $sexe[1] = "Masculin";
        $sexe[2] = "Feminin";
        $sexe[''] = "";
        $dossier = array();
        foreach ($doss as $dosss) {
            $dossier[$dosss->Nume]['Nume'] = $dosss->Nume;
            $dossier[$dosss->Nume]['Ref_'] = $dosss->Ref_;
            $dossier[$dosss->Nume]['RensSexe'] = $dosss->RensSexe;
            $dossier[$dosss->Nume]['RensAge_'] = $dosss->RensAge_;
            $dossier[$dosss->Nume]['Arv_Desi'] = $dosss->Arv_Desi;
        }

        foreach ($dossier as $dosss) {
            if (!array_key_exists($dosss['Nume'], $fileact)) {
                //$pdv[$dosss->Doss]['Visit']= $dosss->ArriHoro; 
                $pdv[$dosss['Nume']]['Ref'] = $dosss['Ref_'];
                $pdv[$dosss['Nume']]['RensSexe'] = $sexe[$dosss['RensSexe']];
                $pdv[$dosss['Nume']]['RensAge_'] = $dosss['RensAge_'];
                $pdv[$dosss['Nume']]['Arv_Desi'] = $dosss['Arv_Desi'];
            }
        }




        /*         * ***************************************perdu de vu par mois************************************* */


        $datevisitedeb = date('Y-m-d', strtotime($datefin . ' -7 month'));
        $datevisitefin = date('Y-m-d', strtotime($datefin . ' -6 month'));
        $visit = $this->setlastvisiteee($datevisitedeb, $datevisitefin);
        $pdvpm = array();
        foreach ($visit as $k => $visite) {
            if (!array_key_exists($k, $fileact)) {
                if (array_key_exists($k, $dossier)) {
                    $pdvpm[$k]['Ref'] = $dossier[$k]['Ref_'];
                    $pdvpm[$k]['RensSexe'] = $sexe[$dossier[$k]['RensSexe']];
                    $pdvpm[$k]['RensAge_'] = $dossier[$k]['RensAge_'];
                    $pdvpm[$k]['Arv_Desi'] = $dossier[$k]['Arv_Desi'];
                    $pdvpm[$k]['Dernvisit'] = $visite['Dernvisit'];
                }
            }
        }
        $this->pdvpm = $pdvpm;
        return($pdv);
    }

    public function setlastvisiteee($datevisitedeb, $datevisitefin) {

        // print_r($this->fileactive);
        $where = "(Doss >0 and Dat_>='" . $datevisitedeb . "' and Dat_<='" . $datevisitefin . "')";
        $col = array('Doss', 'Dat_' => new \Zend\Db\Sql\Expression('Max(Dat_)'));
        $group = array('Doss');
        $medi = $this->getMediconsTable()->Rapport($where, $col, $group);
        $soci = $this->getSociconsTable()->Rapport($where, $col, $group);
        $soci = $this->getPsyconsTable()->Rapport($where, $col, $group);
        $obse = $this->getObseconsTable()->Rapport($where, $col, $group);
        $where = "(Doss >0 AND Dest=6 and Dat_>='" . $datevisitedeb . "' and Dat_<='" . $datevisitefin . "')";
        $item = $this->getItemTable()->Rapport($where, $col, $group);
        $where = "(Doss >0 and ArriHoro>='" . $datevisitedeb . "' and ArriHoro<='" . $datevisitefin . "')";
        $col = array('Doss', 'ArriHoro' => new \Zend\Db\Sql\Expression('Max(ArriHoro)'));
        $entr = $this->getEntrTable()->Rapport($where, $col, $group);
        $visit = array();
        foreach ($medi as $medic) {
            $visit[$medic->Doss]['Dernvisit'] = $medic->Dat_;
        }
        foreach ($soci as $socic) {
            if (array_key_exists($socic->Doss, $visit)) {
                if (strtotime($socic->Dat_) > strtotime($visit[$socic->Doss]['Dernvisit'])) {
                    $visit[$socic->Doss]['Dernvisit'] = $socic->Dat_;
                }
            } else {
                $visit[$socic->Doss]['Dernvisit'] = $socic->Dat_;
            }
        }
        foreach ($obse as $obsec) {
            if (array_key_exists($obsec->Doss, $visit)) {
                if (strtotime($obsec->Dat_) > strtotime($visit[$obsec->Doss]['Dernvisit'])) {
                    $visit[$obsec->Doss]['Dernvisit'] = $obsec->Dat_;
                }
            } else {
                $visit[$obsec->Doss]['Dernvisit'] = $obsec->Dat_;
            }
        }
        foreach ($entr as $entrc) {
            if (array_key_exists($entrc->Doss, $visit)) {
                if (strtotime($entrc->ArriHoro) > strtotime($visit[$entrc->Doss]['Dernvisit'])) {
                    $visit[$entrc->Doss]['Dernvisit'] = $entrc->ArriHoro;
                }
            } else {
                $visit[$entrc->Doss]['Dernvisit'] = $entrc->ArriHoro;
            }
        }
        foreach ($item as $itemc) {
            if (array_key_exists($itemc->Doss, $visit)) {
                if (strtotime($itemc->Dat_) > strtotime($visit[$itemc->Doss]['Dernvisit'])) {
                    $visit[$itemc->Doss]['Dernvisit'] = $itemc->Dat_;
                }
            } else {
                $visit[$itemc->Doss]['Dernvisit'] = $itemc->Dat_;
            }
        }
        return($visit);
    }

    public function setlastvisit() {

        $where = "(Doss >0 and Dat_>0)";
        $col = array('Doss', 'Dat_' => new \Zend\Db\Sql\Expression('Max(Dat_)'));
        $group = array('Doss');
        $medi = $this->getMediconsTable()->Rapport($where, $col, $group);
        $soci = $this->getSociconsTable()->Rapport($where, $col, $group);
        $soci = $this->getPsyconsTable()->Rapport($where, $col, $group);
        $obse = $this->getObseconsTable()->Rapport($where, $col, $group);
        $where = "(Doss >0 AND Dest=6 and Dat_>0)";
        $item = $this->getItemTable()->Rapport($where, $col, $group);
        $where = "(Doss >0 and ArriHoro>0)";
        $col = array('Doss', 'ArriHoro' => new \Zend\Db\Sql\Expression('Max(ArriHoro)'));
        $entr = $this->getEntrTable()->Rapport($where, $col, $group);
        /* $col = array('Doss', 'SaisDat_' => new \Zend\Db\Sql\Expression('Max(SaisDat_)'));
          $gross = $this->getPtmegrosTable()->Rapport(null, $col, $group); */

        foreach ($medi as $medic) {
            $visit[$medic->Doss]['Dernvisit'] = $medic->Dat_;
        }
        foreach ($soci as $socic) {
            if (array_key_exists($socic->Doss, $visit)) {
                if (strtotime($socic->Dat_) > strtotime($visit[$socic->Doss]['Dernvisit'])) {
                    $visit[$socic->Doss]['Dernvisit'] = $socic->Dat_;
                }
            } else {
                $visit[$socic->Doss]['Dernvisit'] = $socic->Dat_;
            }
        }
        foreach ($obse as $obsec) {
            if (array_key_exists($obsec->Doss, $visit)) {
                if (strtotime($obsec->Dat_) > strtotime($visit[$obsec->Doss]['Dernvisit'])) {
                    $visit[$obsec->Doss]['Dernvisit'] = $obsec->Dat_;
                }
            } else {
                $visit[$obsec->Doss]['Dernvisit'] = $obsec->Dat_;
            }
        }
        foreach ($entr as $entrc) {
            if (array_key_exists($entrc->Doss, $visit)) {
                if (strtotime($entrc->ArriHoro) > strtotime($visit[$entrc->Doss]['Dernvisit'])) {
                    $visit[$entrc->Doss]['Dernvisit'] = $entrc->ArriHoro;
                }
            } else {
                $visit[$entrc->Doss]['Dernvisit'] = $entrc->ArriHoro;
            }
        }
        foreach ($item as $itemc) {
            if (array_key_exists($itemc->Doss, $visit)) {
                if (strtotime($itemc->Dat_) > strtotime($visit[$itemc->Doss]['Dernvisit'])) {
                    $visit[$itemc->Doss]['Dernvisit'] = $itemc->Dat_;
                }
            } else {
                $visit[$itemc->Doss]['Dernvisit'] = $itemc->Dat_;
            }
        }
        /* foreach ($gross as $gros) {
          if (array_key_exists($gros->Doss, $visit)) {
          if (strtotime($gros->SaisDat_) > strtotime($visit[$gros->Doss]['Visit'])) {
          $visit[$gros->Doss]['Dernvisit'] = $gros->SaisDat_;
          }
          } else {
          $visit[$gros->Doss]['Dernvisit'] = $gros->SaisDat_;
          }
          } */
        return($visit);
    }

    public function fileact($datedebfilact, $datefin) {

        $customcol = array('Arv_Desi' => 'Arv_Desi', 'RensVar0' => new \Zend\Db\Sql\Expression('Max(Dat_)'));
        $col = array('Nume' => 'doss.Nume', 'Ref_', 'RensAge_', 'RensSexe', 'OuvrDat_');
        $col = array_merge($customcol, $col);
        $join = array('doss' => $this->prefixe . 'doss');
        $condjoin = $this->prefixe . 'medicons.Doss=doss.Nume';
        $group = array('Doss');
        $doss = new Doss();
        $where = "OuvrDat_>='" . $datedebfilact . "' and OuvrDat_<='" . $datefin . "' and (rensdecedat_=0 or rensdecedat_ is null)";
        $dossier = $this->getDossTable()->select($where);
        $where = "dat_>='" . $datedebfilact . "' and dat_<='" . $datefin . "' and (rensdecedat_=0 or rensdecedat_ is null)";
        $medi = $this->getMediconsTable()->Rapportjoint($where, $col, $join, $condjoin, $group, 'Doss ASC, Dat_ Desc');
        $medi->setArrayObjectPrototype($doss);
        $condjoin = $this->prefixe . 'socicons.Doss=doss.Nume';
        $soci = $this->getSociconsTable()->Rapportjoint($where, $col, $join, $condjoin, $group);
        $soci->setArrayObjectPrototype($doss);
        $condjoin = $this->prefixe . 'obsecons.Doss=doss.Nume';
        $obse = $this->getObseconsTable()->Rapportjoint($where, $col, $join, $condjoin, $group);
        $obse->setArrayObjectPrototype($doss);
        $condjoin = $this->prefixe . 'psy_cons.Doss=doss.Nume';
        $psy = $this->getPsyConsTable()->Rapportjoint($where, $col, $join, $condjoin, $group);
        $psy->setArrayObjectPrototype($doss);
        $condjoin = $this->prefixe . 'ptmeenfacons.Doss=doss.Nume';
        $enf = $this->getPtmeenfaconsTable()->Rapportjoint($where, $col, $join, $condjoin, $group);
        $enf->setArrayObjectPrototype($doss);
        $condjoin = $this->prefixe . 'item.Doss=doss.Nume';
        $where = "dat_>='" . $datedebfilact . "' and dat_<='" . $datefin . "' and dest=6 and (rensdecedat_=0 or rensdecedat_ is null)";
        $item = $this->getItemTable()->Rapportjoint($where, $col, $join, $condjoin, $group);
        $item->setArrayObjectPrototype($doss);
        $col = array('Nume' => 'doss.Nume', 'Ref_', 'RensAge_', 'RensSexe', 'Arv_Desi' => 'Arv_Desi', 'RensVar0' => new \Zend\Db\Sql\Expression('Max(ArriHoro)'));
        $condjoin = $this->prefixe . 'entr.Doss=doss.Nume';
        $where = "arrihoro>='" . $datedebfilact . "' and arrihoro<='" . $datefin . "' and (rensdecedat_=0 or rensdecedat_ is null)";
        $entr = $this->getEntrTable()->Rapportjoint($where, $col, $join, $condjoin, $group);
        $entr->setArrayObjectPrototype($doss);
        $col = array('Nume' => 'doss.Nume', 'Ref_', 'RensAge_', 'RensSexe', 'Arv_Desi' => 'Arv_Desi', 'RensVar0' => new \Zend\Db\Sql\Expression('Max(SaisDat_)'));
        $where = "SaisDat_>='" . $datedebfilact . "' and SaisDat_<='" . $datefin . "' and (rensdecedat_=0 or rensdecedat_ is null)";
        $condjoin = $this->prefixe . 'ptmegros.Doss=doss.Nume';
        $gross = $this->getPtmegrosTable()->Rapportjoint($where, $col, $join, $condjoin, $group);
        $gross->setArrayObjectPrototype($doss);
        $sexe[1] = "Masculin";
        $sexe[2] = "Feminin";
        $sexe[''] = "";
        //traitement
        foreach ($dossier as $dossierp) {
            $this->fileactive[$dossierp->Nume]['Visit'] = $dossierp->OuvrDat_;
            $this->fileactive[$dossierp->Nume]['RensAge_'] = $dossierp->RensAge_;
            $this->fileactive[$dossierp->Nume]['RensSexe'] = $sexe[$dossierp->RensSexe];
            $this->fileactive[$dossierp->Nume]['Ref'] = $dossierp->Ref_;
            $this->fileactive[$dossierp->Nume]['Nume'] = $dossierp->Nume;
            $this->fileactive[$dossierp->Nume]['Arv_Desi'] = $dossierp->Arv_Desi;
        }
        foreach ($medi as $medic) {
            $this->fileactive[$medic->Nume]['Visit'] = $medic->RensVar0;
            $this->fileactive[$medic->Nume]['RensAge_'] = $medic->RensAge_;
            $this->fileactive[$medic->Nume]['RensSexe'] = $sexe[$medic->RensSexe];
            $this->fileactive[$medic->Nume]['Ref'] = $medic->Ref_;
            $this->fileactive[$medic->Nume]['Nume'] = $medic->Nume;
            $this->fileactive[$medic->Nume]['Arv_Desi'] = $medic->Arv_Desi;
        }
        foreach ($soci as $socic) {
            if (array_key_exists($socic->Nume, $this->fileactive)) {
                if (strtotime($socic->RensVar0) > strtotime($this->fileactive[$socic->Nume]['Visit'])) {
                    $this->fileactive[$socic->Nume]['Visit'] = $socic->RensVar0;
                }
            } else {
                $this->fileactive[$socic->Nume]['Visit'] = $socic->RensVar0;
                $this->fileactive[$socic->Nume]['RensAge_'] = $socic->RensAge_;
                $this->fileactive[$socic->Nume]['RensSexe'] = $sexe[$socic->RensSexe];
                $this->fileactive[$socic->Nume]['Ref'] = $socic->Ref_;
                $this->fileactive[$socic->Nume]['Nume'] = $socic->Nume;
                $this->fileactive[$socic->Nume]['Arv_Desi'] = $socic->Arv_Desi;
            }
        }
        foreach ($obse as $obsec) {
            if (array_key_exists($obsec->Nume, $this->fileactive)) {
                if (strtotime($obsec->RensVar0) > strtotime($this->fileactive[$obsec->Nume]['Visit'])) {
                    $this->fileactive[$obsec->Nume]['Visit'] = $obsec->RensVar0;
                }
            } else {
                $this->fileactive[$obsec->Nume]['Visit'] = $obsec->RensVar0;
                $this->fileactive[$obsec->Nume]['RensAge_'] = $obsec->RensAge_;
                $this->fileactive[$obsec->Nume]['RensSexe'] = $sexe[$obsec->RensSexe];
                $this->fileactive[$obsec->Nume]['Ref'] = $obsec->Ref_;
                $this->fileactive[$obsec->Nume]['Nume'] = $obsec->Nume;
                $this->fileactive[$obsec->Nume]['Arv_Desi'] = $obsec->Arv_Desi;
            }
        }
        foreach ($psy as $psyc) {
            if (array_key_exists($psyc->Nume, $this->fileactive)) {
                if (strtotime($psyc->RensVar0) > strtotime($this->fileactive[$psyc->Nume]['Visit'])) {
                    $this->fileactive[$psyc->Nume]['Visit'] = $psyc->RensVar0;
                }
            } else {
                $this->fileactive[$psyc->Nume]['Visit'] = $psyc->RensVar0;
                $this->fileactive[$psyc->Nume]['RensAge_'] = $psyc->RensAge_;
                $this->fileactive[$psyc->Nume]['RensSexe'] = $sexe[$psyc->RensSexe];
                $this->fileactive[$psyc->Nume]['Ref'] = $psyc->Ref_;
                $this->fileactive[$psyc->Nume]['Nume'] = $psyc->Nume;
                $this->fileactive[$psyc->Nume]['Arv_Desi'] = $psyc->Arv_Desi;
            }
        }
        foreach ($enf as $enfc) {
            if (array_key_exists($enfc->Nume, $this->fileactive)) {
                if (strtotime($enfc->RensVar0) > strtotime($this->fileactive[$enfc->Nume]['Visit'])) {
                    $this->fileactive[$enfc->Nume]['Visit'] = $enfc->RensVar0;
                }
            } else {
                $this->fileactive[$enfc->Nume]['Visit'] = $enfc->RensVar0;
                $this->fileactive[$enfc->Nume]['RensAge_'] = $enfc->RensAge_;
                $this->fileactive[$enfc->Nume]['RensSexe'] = $sexe[$enfc->RensSexe];
                $this->fileactive[$enfc->Nume]['Ref'] = $enfc->Ref_;
                $this->fileactive[$enfc->Nume]['Nume'] = $enfc->Nume;
                $this->fileactive[$enfc->Nume]['Arv_Desi'] = $enfc->Arv_Desi;
            }
        }

        foreach ($entr as $entrc) {
            if (array_key_exists($entrc->Nume, $this->fileactive)) {
                if (strtotime($entrc->RensVar0) > strtotime($this->fileactive[$entrc->Nume]['Visit'])) {
                    $this->fileactive[$entrc->Nume]['Visit'] = $entrc->RensVar0;
                }
            } else {
                $this->fileactive[$entrc->Nume]['Visit'] = $entrc->RensVar0;
                $this->fileactive[$entrc->Nume]['RensAge_'] = $entrc->RensAge_;
                $this->fileactive[$entrc->Nume]['RensSexe'] = $sexe[$entrc->RensSexe];
                $this->fileactive[$entrc->Nume]['Ref'] = $entrc->Ref_;
                $this->fileactive[$entrc->Nume]['Nume'] = $entrc->Nume;
                $this->fileactive[$entrc->Nume]['Arv_Desi'] = $entrc->Arv_Desi;
            }
        }
        foreach ($item as $itemc) {
            if (array_key_exists($itemc->Nume, $this->fileactive)) {
                if (strtotime($itemc->RensVar0) > strtotime($this->fileactive[$itemc->Nume]['Visit'])) {
                    $this->fileactive[$itemc->Nume]['Visit'] = $itemc->RensVar0;
                }
            } else {
                $this->fileactive[$itemc->Nume]['Visit'] = $itemc->RensVar0;
                $this->fileactive[$itemc->Nume]['RensAge_'] = $itemc->RensAge_;
                $this->fileactive[$itemc->Nume]['RensSexe'] = $sexe[$itemc->RensSexe];
                $this->fileactive[$itemc->Nume]['Ref'] = $itemc->Ref_;
                $this->fileactive[$itemc->Nume]['Nume'] = $itemc->Nume;
                $this->fileactive[$itemc->Nume]['Arv_Desi'] = $itemc->Arv_Desi;
            }
        }
        foreach ($gross as $gros) {
            if (array_key_exists($gros->Nume, $this->fileactive)) {
                if (strtotime($gros->RensVar0) > strtotime($this->fileactive[$gros->Nume]['Visit'])) {
                    $this->fileactive[$gros->Nume]['Visit'] = $gros->RensVar0;
                }
            } else {
                $this->fileactive[$gros->Nume]['Visit'] = $gros->RensVar0;
                $this->fileactive[$gros->Nume]['RensAge_'] = $gros->RensAge_;
                $this->fileactive[$gros->Nume]['RensSexe'] = $sexe[$gros->RensSexe];
                $this->fileactive[$gros->Nume]['Ref'] = $gros->Ref_;
                $this->fileactive[$gros->Nume]['Nume'] = $gros->Nume;
                $this->fileactive[$gros->Nume]['Arv_Desi'] = $gros->Arv_Desi;
            }
        }

        return($this->fileactive);
    }

    public function NpSrcori($datedeb, $datefin) {
        //table loca
        $csi = $this->getCsiTable()->select();
        foreach ($csi as $cs) {
            $tab[$cs->Nume] = $cs->Desi;
            $tabb[$cs->Desi]['valeur'] = 0;
            $tabb[$cs->Desi]['pourcentage'] = 0;
        }
        $tabb['Total']['valeur'] = 0;
        $tabb['Total']['pourcentage'] = 0;

        $where = " ( OuvrDat_ >='" . $datedeb . "' AND OuvrDat_ <='" . $datefin . "')and (MediCsi_<>'-1')";
        $col = array('MediCsi_', 'count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
        $group = array('MediCsi_');
        $dosss = $this->getDossTable()->Rapport($where, $col, $group)->toArray();
        $tot = 0;
        foreach ($dosss as $doss) {
            $tot += $doss['count'];
        }
        foreach ($dosss as $doss) {
            if ($doss['MediCsi_'] > 0) {
                if (array_key_exists($doss['MediCsi_'], $tab)) {
                    $key = $tab[$doss['MediCsi_']];
                    $tabb[$key]['valeur'] = $doss['count'];
                    $tabb[$key]['pourcentage'] = round($doss['count'] * 100 / $tot) . '%';
                }
            }
        }
        if ($tot) {
            $tabb['Total']['valeur'] = $tot;
            $tabb['Total']['pourcentage'] = '100%';
        }
        return $tabb;
    }

    public function NpLoca($datedeb, $datefin) {

        //table loca
        $loca = $this->getLocaTable()->select();
        foreach ($loca as $locali) {
            $tab[$locali->Nume] = $locali->Desi;
        }
        $where = " ( OuvrDat_  Between '" . $datedeb . "' AND '" . $datefin . "')and (RensProv<>'-1')";
        $col = array('RensProv', 'count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
        $group = array('RensProv');
        $dosss = $this->getDossTable()->Rapport($where, $col, $group);
        $tabloca = array();
        $tot = count($dosss);

        if ($tot > 0) {
            foreach ($dosss as $doss) {
                if ($doss->RensProv) {
                    if (array_key_exists($doss->RensProv, $tab)) {
                        $key = $tab[$doss->RensProv];
                        $tabloca[$key]['Nombre'] = $doss->count;

                        $tabloca[$key]['Pourcentage'] = round($tabloca[$key]['Nombre'] * 100 / $tot) . '%';
                    }
                }
            }
            $tabloca['Total']['Nombre'] = $tot;
            $tabloca['Total']['Pourcentage'] = '100%';
        }
        return $tabloca;
    }

    public function motifhdj($datedeb, $datefin, $corresp) {
        $tot = 0;
        foreach ($corresp as $k => $value) {

            $where = " (SUBSTR(MotiHdjCase," . $value . ",1)=1 AND Dat_ BETWEEN '" . $datedeb . "' AND '" . $datefin . "')";
            $col = array('count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
            $dosss = $this->getMediconsTable()->Rapport($where, $col, null)->toArray();
            $tabmotihosp[$k]['valeur'] = 0;
            foreach ($dosss as $doss) {
                $tot += $doss['count'];
                $tabmotihosp[$k]['valeur'] = $doss['count'];
            }
        }
        $tabmotihosp = $this->pourcentage($tabmotihosp, $tot);
        return $tabmotihosp;
    }

    public function refchn() {
        $where = "RefCHN=1";
        $col = array('count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
        $group = array('Doss');
        $dosss = $this->getMediconsTable()->Rapport($where, $col, $group)->toArray();
        $refchn = count($dosss);

        return $refchn;
    }

    public function Nmodtrait($datedeb, $datefin) {
        $where = "Dat_>0 and (Arv0Prsc<>'' or Arv1Prsc<>'' or Arv2Prsc<>'' or Arv3Prsc<>'')";
        $col = array('Doss', 'Dat_', 'Arv0Prsc', 'Arv1Prsc', 'Arv2Prsc', 'Arv3Prsc');
        $order = "Dat_ ASC";
        $medi = $this->getMediconsTable()->Rapport($where, $col, null, $order, null);
        $i = 0;
        foreach ($medi as $medicons) {
            $tab[$i] = $medicons->Doss;
            $tab1[$i] = $medicons->Dat_;
            $tab2[$i] = $medicons->Arv0Prsc;
            if ($medicons->Arv1Prsc)
                $tab2[$i] .= '+' . $medicons->Arv1Prsc;
            if ($medicons->Arv2Prsc)
                $tab2[$i] .= '+' . $medicons->Arv2Prsc;
            if ($medicons->Arv3Prsc)
                $tab2[$i] .= '+' . $medicons->Arv3Prsc;
            $i++;
        }

        $compare = array();
        for ($i = 0; $i < count($tab1); $i++) {
            if (strtotime($tab1[$i]) >= strtotime($datedeb . ' 00:00:00') && strtotime($tab1[$i]) <= strtotime($datefin . ' 00:00:00')) {
                $arvc = $tab2[$i];
                $arvp = '';
                if ($arvc) {
                    foreach ($tab as $k => $val) {
                        if ($i != $k) {
                            if ($val == $tab[$i] && $tab2[$k]) {
                                $arvp = $tab2[$k];
                            }
                        } else {
                            break;
                        }
                    }
                    if ($arvc && $arvp) {
                        $arvc = str_replace(' + ', '+', $arvc);
                        $arvp = str_replace(' + ', '+', $arvp);
                        if (substr_count($arvc, '+') >= 4) {
                            $arv = explode('+', $arvc);
                            $arvc = $arv[0] . '+' . $arv[1] . '+' . $arv[2] . '+' . $arv[3];
                        }
                        if (substr_count($arvp, '+') >= 4) {
                            $arv1 = explode('+', $arvp);
                            $arvp = $arv1[0] . '+' . $arv1[1] . '+' . $arv1[2] . '+' . $arv1[3];
                        }

                        $compare[$arvc] = $arvp;
                    }
                }
            }
        }
        unset($arvc);
        unset($arvp);
        $tabmodtrai = array();
        foreach ($compare as $arvc => $arvp) {
            $arvc1 = $this->modtraitlign($arvc);
            $arvp1 = $this->modtraitlign($arvp);
            if ($arvc1 != $arvp1) {    //si changement
                $tabmodtrai[$arvc1] = $arvp1;
            }
        }
        return $tabmodtrai;
    }

    public function modtraitlign($arv) {
        $ligne = array(
            'AZT+3TC+NVP' => '1ère ligne',
            'TDF+FTC+EFV' => '1ère ligne',
            'AZT+3TC+EFV' => '1ère ligne',
            'ABC+3TC+NVP' => '1ère ligne',
            'ABC+3TC+EFV' => '1ère ligne',
            'AZT+3TC+LPV+RTV' => '2ème ligne',
            'TDF+FTC+LPV+RTV' => '2ème ligne',
            'ABC+3TC+LPV+RTV' => '2ème ligne',
            'AZT+3TC+DRV+RTV' => '3ème ligne',
            'TDF+FTC+DRV+RTV' => '3ème ligne'
        );
        if (!array_key_exists($arv, $ligne)) {
            $tabarv = explode('+', $arv);
            foreach ($ligne as $key => $lign) {
                $pos = false;
                if ($key) {
                    if (substr_count($arv, '+') == substr_count($key, '+')) {
                        for ($i = 0; $i < count($tabarv); $i++) {
                            if ($tabarv[$i]) {
                                $pos = strpos($key, $tabarv[$i]);
                                if ($pos === false) {
                                    break;
                                }
                            }
                        }
                        if ($pos !== false) {
                            $arv = $key;
                            break;
                        }
                    }
                }
            }
        }
        return($arv);
    }

    public function rgmeadult($titre, $datedeb, $datefin) {
        $datedebfilact = date('Y-m-d', strtotime($datefin . ' -6 month'));
        $this->fileact($datedebfilact, $datefin);
        //     $dossiers = $this->setdoss();

        $dfin = date("Y-m-t", strtotime($datefin));
        $ddeb = date("Y-m-01", strtotime($datefin));
        $query = "Select d.Ref_,d.RensAge_,d.Nume,d.Arv_Desi,Dat_ from  " . $this->prefixe . "doss d inner join (Select t.doss,Dat_ from  " . $this->prefixe . "medicons t inner join (SELECT doss,MIN(Dat_) as min_date FROM    " . $this->prefixe . "medicons WHERE (doss>0 And Arv0Prsc<>'' or Arv1Prsc<>'' or Arv2Prsc<>'' or Arv3Prsc<>'' or Arv4Prsc<>'' or Arv5Prsc<>'' or Arv6Prsc<>'' or Arv7Prsc<>'' or Arv8Prsc<>'' or Arv9Prsc<>'') GROUP BY doss)a on a.doss = t.doss and a.min_date = Dat_ where(Dat_>='$ddeb' AND Dat_<='$dfin') GROUP BY doss)b on d.Nume = b.doss";
        $meddebprsc = $this->getEntrTable()->executeSqlString($query);
        $tab1 = $this->regimeArvtt($meddebprsc);







        $query1 = "Select d.Ref_,d.RensAge_,d.Nume,d.Arv_Desi,Dat_ from  " . $this->prefixe . "doss d inner join (Select t.doss,Dat_ from  " . $this->prefixe . "medicons t inner join (SELECT doss,MIN(Dat_) as min_date FROM    " . $this->prefixe . "medicons WHERE (doss>0 And Arv0Prsc<>'' or Arv1Prsc<>'' or Arv2Prsc<>'' or Arv3Prsc<>'' or Arv4Prsc<>'' or Arv5Prsc<>'' or Arv6Prsc<>'' or Arv7Prsc<>'' or Arv8Prsc<>'' or Arv9Prsc<>'') GROUP BY doss)a on a.doss = t.doss and a.min_date = Dat_ where(Dat_<='$dfin') GROUP BY doss)b on d.Nume = b.doss";
        $meddebprsc1 = $this->getEntrTable()->executeSqlString($query1);
        $tab = $this->regimeArvtt2($meddebprsc1, $this->fileactive, null);



        $tabregim = array();
        $tot2 = 0;
        $tot1 = 0;
        $tt = $this->settabregim($tab['adulte'], $tab1['adulte']);
        $tabregimadlt['Total'][1] = $tt['Total1'];
        $tabregimadlt['Total'][2] = $tt['Total2'];
        $tabpharma['adulte'] = $tt['adulte'];
        $tabpharma['adulte'] = array_merge($tabpharma['adulte'], $tabregimadlt);

        $tt = $this->settabregim($tab['enfant'], $tab1['enfant']);
        $tabregimenf['Total / Enfants'][1] = $tt['Total1'];
        $tabregimenf['Total / Enfants'][2] = $tt['Total2'];
        $tabpharma['enfant'] = $tt['adulte'];
        if (isset($tabregimenf)) {
            $tabregimenf['Total / Patients'][1] = $tabregimenf['Total / Enfants'][1] + $tabregimadlt['Total'][1];
            $tabregimenf['Total / Patients'][2] = $tabregimenf['Total / Enfants'][2] + $tabregimadlt['Total'][2];
        }
        $tabpharma['enfant'] = array_merge($tabpharma['enfant'], $tabregimenf);
        $tot = $tabpharma['adulte']['Total'][2];
        $tabpharma['ligne'] = $this->lignearv($tabregimadlt, $tot);
        return $tabpharma;



        /* foreach ($this->fileactive as $k => $file) {
          if ($file['RensAge_'] <= 15) {
          unset($this->fileactive[$k]);
          $fileenf[$k] = $file;
          }
          }

          $col = array('Doss' => new \Zend\Db\Sql\Expression('DISTINCT Doss'));
          $where = "(Dat_<='" . $datefin . "')";
          $dosss = $this->getMediconsTable()->Rapport($where, $col);
          $tab = $this->regimeArv($dosss, $this->fileactive, $titre);
          $col = array('Doss' => new \Zend\Db\Sql\Expression('DISTINCT Doss'));
          $where = "(Dat_>='" . $datedeb . "') AND (Dat_<='" . $datefin . "')";
          $dosss1 = $this->getMediconsTable()->Rapport($where, $col);
          $tab1 = $this->regimeArv($dosss1, $this->fileactive, $titre);
          $tabregim = array();
          $tot2 = 0;
          $tot1 = 0;
          $tt = $this->settabregim($tab, $tab1);
          $tabregimadlt['Total'][1] = $tt['Total1'];
          $tabregimadlt['Total'][2] = $tt['Total2'];
          $tabpharma['adulte'] = $tt['adulte'];
          $tabpharma['adulte'] = array_merge($tabpharma['adulte'], $tabregimadlt);
          $tab = $this->regimeArv($dosss, $fileenf, $titre);
          $tab1 = $this->regimeArv($dosss1, $fileenf, $titre);
          $tt = $this->settabregim($tab, $tab1);
          $tabregimenf['Total / Enfants'][1] = $tt['Total1'];
          $tabregimenf['Total / Enfants'][2] = $tt['Total2'];
          $tabpharma['enfant'] = $tt['adulte'];
          if (isset($tabregimenf)) {
          $tabregimenf['Total / Patients'][1] = $tabregimenf['Total / Enfants'][1] + $tabregimadlt['Total'][1];
          $tabregimenf['Total / Patients'][2] = $tabregimenf['Total / Enfants'][2] + $tabregimadlt['Total'][2];
          }
          $tabpharma['enfant'] = array_merge($tabpharma['enfant'], $tabregimenf);
          $tot = $tabpharma['adulte']['Total'][2];
          $tabpharma['ligne'] = $this->lignearv($tabregimadlt, $tot);
          return $tabpharma; */
    }

    public function settabregim($tab, $tab1) {
        $tot2 = 0;
        $tot1 = 0;
        $tabregimadlt = array();
        foreach ($tab as $k => $val) {
            $tabregimadlt[$k][1] = 0;
            $tabregimadlt[$k][2] = $val;
            $tot2 += $val;
            if (array_key_exists($k, $tab1)) {
                $tot1 += $tab1[$k];
                $tabregimadlt[$k][1] = $tab1[$k];
            }
        }
        $tabregim['Total1'] = $tot1;
        $tabregim['Total2'] = $tot2;
        $tabregim['adulte'] = $tabregimadlt;

        return $tabregim;
    }

    public function rgmeenf($titre, $datedeb, $datefin, $tabregimadlt) {
        $where = "(Dat_>='" . $datedeb . "') AND (Dat_<='" . $datefin . "') and arv_desi<>'' and RensAge_<=15";
        $col = array('Arv_Desi', 'Nume' => 'doss.Nume');
        $group = array('medicons.Doss');
        $join = array('medicons' => 'medicons');
        $condjoin = 'doss.Nume=medicons.Doss';
        $dosss = $this->getDossTable()->Rapportjoint($where, $col, $join, $condjoin, $group)->toArray();
        $tab1 = $this->regimeArv($dosss, $this->fileactive, $titre);
        //total a la fin du moi
        $where = "(Dat_<='" . $datefin . "') and arv_desi<>'' and RensAge_<=15";
        $dosss = $this->getDossTable()->Rapportjoint($where, $col, $join, $condjoin, $group)->toArray();
        $tab = $this->regimeArv($dosss, $this->fileactive, $titre);
        $tabregimenf = array();
        $tot2 = 0;
        $tot1 = 0;
        foreach ($tab as $k => $val) {
            $tabregimenf[$k][1] = 0;
            $tabregimenf[$k][2] = $val;
            $tot2 += $val;
            if (array_key_exists($k, $tab1)) {
                $tot1 += $tab1[$k];
                $tabregimenf[$k][1] = $tab1[$k];
            }
        }
        $tabregimenf['Total / Enfants'][1] = $tot1;
        $tabregimenf['Total / Enfants'][2] = $tot2;
        if (isset($tabregimenf)) {
            $tabregimenf['Total / Patients'][1] = $tabregimenf['Total / Enfants'][1] + $tabregimadlt['Total'][1];
            $tabregimenf['Total / Patients'][2] = $tabregimenf['Total / Enfants'][2] + $tabregimadlt['Total'][2];
        }
        $tabregimenf['Total / Enfants'][1] = 0;
        $tabregimenf['Total / Enfants'][2] = 0;
        return($tabregimenf);
    }

    public function regimeArv($Medicons, $fileact, $Age) {
        $tab1 = array();
        foreach ($Medicons as $k => $medi) {
            if (array_key_exists($medi->Doss, $fileact)) {
                if ($fileact[$medi->Doss]['Arv_Desi']) {
                    $t = explode(' ligne ', $fileact[$medi->Doss]['Arv_Desi']);
                    if (isset($t[1])) {
                        $t[1] = str_replace(' + ', '+', $t[1]);
                        $tab1[] = $t[1];
                    } else {
                        $tab1[] = $fileact[$medi->Doss]['Arv_Desi'];
                    }
                }
            }
        }
        $tab1 = array_count_values($tab1);
        $tab1 = $this->arvtraitement($tab1);
        return($tab1);
    }

    public function regimeArvtt($Medicons) {
        $tab1 = array();
        $tab2 = array();
        foreach ($Medicons as $k => $medi) {
            $t = explode(' ligne ', $medi['Arv_Desi']);
            if ($medi['RensAge_'] > 15) {
                if (isset($t[1])) {
                    $t[1] = str_replace(' + ', '+', $t[1]);
                    $tab1[] = $t[1];
                } else {
                    $tab1[] = $medi['Arv_Desi'];
                }
            } else {
                if (isset($t[1])) {
                    $t[1] = str_replace(' + ', '+', $t[1]);
                    $tab2[] = $t[1];
                } else {
                    $tab2[] = $medi['Arv_Desi'];
                }
            }
        }
        $tab1 = array_count_values($tab1);
        $tab1 = $this->arvtraitement($tab1);
        $tab2 = array_count_values($tab2);
        $tab2 = $this->arvtraitement($tab2);
        $tab['adulte'] = $tab1;
        $tab['enfant'] = $tab2;
        return($tab);
    }

    public function regimeArvtt2($Medicons, $fileact, $Age) {  //ARE
        $tab1 = array();
        $tab2 = array();

        foreach ($Medicons as $k => $medi) {
            if ($medi['RensAge_'] > 15) {
                if (array_key_exists($medi['Nume'], $fileact)) {
                    if ($fileact[$medi['Nume']]['Arv_Desi']) {
                        $t = explode(' ligne ', $fileact[$medi['Nume']]['Arv_Desi']);
                        if (isset($t[1])) {
                            $t[1] = str_replace(' + ', '+', $t[1]);
                            $tab1[] = $t[1];
                        } else {
                            $tab1[] = $fileact[$medi['Nume']]['Arv_Desi'];
                        }
                    }
                }
            } else {
                if (array_key_exists($medi['Nume'], $fileact)) {
                    if ($fileact[$medi['Nume']]['Arv_Desi']) {
                        $t = explode(' ligne ', $fileact[$medi['Nume']]['Arv_Desi']);
                        if (isset($t[1])) {
                            $t[1] = str_replace(' + ', '+', $t[1]);
                            $tab2[] = $t[1];
                        } else {
                            $tab2[] = $fileact[$medi['Nume']]['Arv_Desi'];
                        }
                    }
                }
            }
        }

        $tab1 = array_count_values($tab1);
        $tab1 = $this->arvtraitement($tab1);
        $tab2 = array_count_values($tab2);
        $tab2 = $this->arvtraitement($tab2);
        $tab['adulte'] = $tab1;
        $tab['enfant'] = $tab2;
        return($tab);
    }

    public function arvtraitement($tab) {
        $tabfin = array();
        foreach ($tab as $key => $tabb) {
            $arv = explode('+', $key);
            for ($i = 4; $i < count($arv); $i++) {
                unset($arv[$i]);
            }
            $trouve = 0;
            foreach ($tabfin as $k => $tabff) {
                for ($i = 0; $i < count($arv); $i++) {
                    $trouve = 1;
                    if ($arv[$i]) {
                        $pos = strpos($k, $arv[$i]);
                        if ($pos === false) {
                            $trouve = 0;
                            break;
                        }
                    }
                    if (($i == count($arv) - 1)) {
                        break 2;
                    }
                }
            }
            if ($trouve == 0)
                $tabfin[$key] = $tabb;
            else {
                $tabfin[$k] += $tabb;
            }
        }
        return($tabfin);
    }

    public function arvtraitementold($tab, $titre) {
        foreach ($tab as $k => $tabb) {
            if (array_key_exists($k, $titre)) {
                $titre[$k] += $tab[$k];
            } else {
                $arv = explode('+', $k);
                foreach ($titre as $key => $titr) {
                    if (substr_count($k, '+') == substr_count($key, '+')) {
                        for ($i = 0; $i < count($arv); $i++) {
                            $pos = strpos($key, $arv[$i]);
                            if ($pos === false) {
                                break;
                            }
                        }
                        if ($pos !== false) {
                            $titre[$key] += $tab[$k];
                        }
                    }
                }
            }
        }
        return($titre);
    }

    public function regimeArvold($dosss, $fileact, $titre) {
        $tab1 = array();
        foreach ($dosss as $k => $doss) {
            if (array_key_exists($doss['Nume'], $fileact)) {
                $t = explode(' ligne ', $doss['Arv_Desi']);
                if (isset($t[1])) {
                    $t[1] = str_replace(' + ', '+', $t[1]);
                    if (substr_count($t[1], '+') >= 4) {
                        $arv = explode('+', $t[1]);
                        $t[1] = $arv[0] . '+' . $arv[1] . '+' . $arv[2] . '+' . $arv[3];
                    }
                    if (!isset($tab1[$k]))
                        $tab1[$k] = $t[1];
                    else
                        $tab1[$k] += $t[1];
                } else
                    $tab1[$k] = $doss['Arv_Desi'];
            }
        }
        $tab1 = array_count_values($tab1);
        $tab1 = $this->arvtraitement($tab1, $titre);
        return($tab1);
    }

    public function lignearv($tabregimadlt, $tot) {
        $ligne = array(
            'AZT+3TC+NVP' => '1ère ligne',
            'TDF+FTC+EFV' => '1ère ligne',
            'AZT+3TC+EFV' => '1ère ligne',
            'ABC+3TC+NVP' => '1ère ligne',
            'ABC+3TC+EFV' => '1ère ligne',
            'AZT+3TC+LPV+RTV' => '2ème ligne',
            'TDF+FTC+LPV+RTV' => '2ème ligne',
            'ABC+3TC+LPV+RTV' => '2ème ligne',
            'AZT+3TC+DRV+RTV' => '3ème ligne',
            'TDF+FTC+DRV+RTV' => '3ème ligne'
        );
        $tabligne = array();
        if ($tot > 0) {
            foreach ($tabregimadlt as $k => $tabregimadlte) {
                if (array_key_exists($k, $ligne)) {
                    $key = $ligne[$k];
                    if (!isset($tabligne[$key])) {
                        $tabligne[$key]['Nombre'] = $tabregimadlte[2];
                    } else {
                        $tabligne[$key]['Nombre'] += $tabregimadlte[2];
                    }
                }
            }
            foreach ($tabligne as $k => $tablign) {
                $tabligne[$k]['Pourcentage'] = round($tabligne[$k]['Nombre'] * 100 / $tot) . '%';
            }
        }
        return($tabligne);
    }

    public function depistageAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');

        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $datedeb = date('Y-m-01');
        $datefin = date('Y-m-t');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('datefin')->getValue();
                $tab = $this->Nbdpis($datedeb, $datefin);
                $tabdepis = $tab['depistage'];
                $tabdepis1 = $tab['type'];
                if (isset($tabdepis)) {
                    $tabdepis = $this->totrow($tabdepis);
                    end($tabdepis);         // move the internal pointer to the end of the array
                    $key = key($tabdepis);
                    end($tabdepis[$key]);         // move the internal pointer to the end of the array
                    $key2 = key($tabdepis[$key]);
                    $tabdepis = $this->pourcentrow($tabdepis, $tabdepis[$key][$key2]);
                    $tabdepis = $this->pourcentcol($tabdepis, $tabdepis[$key][$key2]);
                    $titre = array(1 => "Positifs", 2 => 'Négatifs', 3 => "Indéterminés", 4 => "Total", 5 => "Pourcentage");
                    $tabdepis = $this->addcol($tabdepis, $titre, 'titre');
                    $this->tabdepis = $tabdepis;
                }
                $titre = array('VIH 1' => 1, 'VIH 2' => 2, 'VIH 1+2' => 3);
                if (isset($tabdepis1)) {
                    $tabdepis1 = $this->totrow($tabdepis1);
                    end($tabdepis1);         // move the internal pointer to the end of the array
                    $key = key($tabdepis1);
                    end($tabdepis1[$key]);         // move the internal pointer to the end of the array
                    $key2 = key($tabdepis1[$key]);
                    $tabdepis1 = $this->pourcentrow($tabdepis1, $tabdepis1[$key][$key2]);
                    $tabdepis1 = $this->pourcentcol($tabdepis1, $tabdepis1[$key][$key2]);
                    $titre = array(1 => 'VIH 1', 2 => 'VIH 2', 3 => 'VIH 1+2', 4 => 'Total', 5 => 'Pourcentage');
                    $tabdepis1 = $this->addcol($tabdepis1, $titre, 'titre');
                }

                $this->tabdepisprofil = $tabdepis1;
            }
        } else {
            $tab = $this->Nbdpis($datedeb, $datefin);
            $tabdepis = $tab['depistage'];
            $tabdepis1 = $tab['type'];
            if (isset($tabdepis)) {
                $tabdepis = $this->totrow($tabdepis);
                end($tabdepis);         // move the internal pointer to the end of the array
                $key = key($tabdepis);
                end($tabdepis[$key]);         // move the internal pointer to the end of the array
                $key2 = key($tabdepis[$key]);
                $tabdepis = $this->pourcentrow($tabdepis, $tabdepis[$key][$key2]);
                $tabdepis = $this->pourcentcol($tabdepis, $tabdepis[$key][$key2]);
                $titre = array(1 => "Positifs", 2 => 'Négatifs', 3 => "Indéterminés", 4 => "Total", 5 => "Pourcentage");
                $tabdepis = $this->addcol($tabdepis, $titre, 'titre');
                $this->tabdepis = $tabdepis;
            }
            $titre = array('VIH 1' => 1, 'VIH 2' => 2, 'VIH 1+2' => 3);
            if (isset($tabdepis1)) {
                $tabdepis1 = $this->totrow($tabdepis1);
                end($tabdepis1);         // move the internal pointer to the end of the array
                $key = key($tabdepis1);
                end($tabdepis1[$key]);         // move the internal pointer to the end of the array
                $key2 = key($tabdepis1[$key]);
                $tabdepis1 = $this->pourcentrow($tabdepis1, $tabdepis1[$key][$key2]);
                $tabdepis1 = $this->pourcentcol($tabdepis1, $tabdepis1[$key][$key2]);
                $titre = array(1 => 'VIH 1', 2 => 'VIH 2', 3 => 'VIH 1+2', 4 => 'Total', 5 => 'Pourcentage');
                $tabdepis1 = $this->addcol($tabdepis1, $titre, 'titre');
            }
            $this->tabdepisprofil = $tabdepis1;
        }

        $viewModel->form = $this->form;
        $viewModel->tabdepis = $this->tabdepis;
        $viewModel->tabdepisprofil = $this->tabdepisprofil;
        $viewModel->detailsdepistage = json_encode(array_values($this->depistage));
        return $viewModel;
    }

    public function profilpatientAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $date = date('Y-m-d');
        $request = $this->getRequest();
        $titre[0] = "Nombre total de patients inscrits au CTA à la fin du mois précédent";
        $titre[1] = 'Nombre de nouveaux inscrits ce mois-ci';
        $titre[2] = 'Dont enfants (<= 15 ans)';
        $titre[3] = 'Nombre total de patients inscrits au CTA à la fin du mois';
        $titre[4] = 'File active';
        $titre[5] = 'Dont enfants (<= 15 ans)';
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $date = $this->form->get('daterappmoi')->getValue();
            }
        }
        $tabprofil = $this->Nbprofilpat($date);
        $tabprofil[3]['valeur'] = $tabprofil[0]['valeur'] + $tabprofil[1]['valeur'];
        $tabprofil = $this->addcol($tabprofil, $titre, 'titre');



        $viewModel->form = $this->form;
        $viewModel->tabprofil = $tabprofil;
        $viewModel->details = json_encode(array_values($this->fileactive));
        $viewModel->dossdetails = json_encode(array_values($this->dossdetail));

        return $viewModel;
    }

    public function transpatientAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $datedeb = date('Y-m-01');
        $datefin = date('Y-m-t');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('datefin')->getValue();
            }
        }

        $viewModel->form = $this->form;
        $viewModel->transfpat = $this->Nbtransfpat($datedeb, $datefin . '23:59:59');
        $viewModel->transdetail = json_encode(array_values($this->transdetail));

        return $viewModel;
    }

    public function viewdetailAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $fileactive = 0;
        $perdudv = 0;
        $dcd = 0;
        $Nouveaupat = 0;
        $medicons = 0;
        $inclusionarv = 0;
        $Nume = (int) $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('analyse');
        }
        $Rapportcontainer = new Container('Rapport');
        if ($Nume == 1 && $Rapportcontainer->offsetExists('fileactive')) {
            $fileactive = json_encode(array_values($Rapportcontainer->offsetGet('fileactive'))); //$Rapportcontainer->offsetGet('fileactive');
        } else
        if ($Nume == 2 && $Rapportcontainer->offsetExists('perdudv')) {
            $perdudv = json_encode(array_values($Rapportcontainer->offsetGet('perdudv')));
        } else
        if ($Nume == 3 && $Rapportcontainer->offsetExists('dcd')) {
            $dcd = json_encode(array_values($Rapportcontainer->offsetGet('dcd')));
        } else
        if ($Nume == 4 && $Rapportcontainer->offsetExists('Nouveaupat')) {
            $Nouveaupat = json_encode(array_values($Rapportcontainer->offsetGet('Nouveaupat')));
        } else
        if ($Nume == 5 && $Rapportcontainer->offsetExists('medicons')) {
            $medicons = json_encode(array_values($Rapportcontainer->offsetGet('medicons')));
        } else
        if ($Nume == 6 && $Rapportcontainer->offsetExists('inclusionarv')) {
            $inclusionarv = json_encode(array_values($Rapportcontainer->offsetGet('inclusionarv')));
        }
        $viewModel->Nume = $Nume;
        $viewModel->fileactive = $fileactive;
        $viewModel->perdudv = $perdudv;
        $viewModel->dcd = $dcd;
        $viewModel->Nouveaupat = $Nouveaupat;
        $viewModel->medicons = $medicons;
        $viewModel->inclusionarv = $inclusionarv;
        return $viewModel;
    }

    public function suivipatientAction() {

        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $request = $this->getRequest();
        //$datedeb = date('Y-m-01');
        $date = date('Y-m-d');
        $titre = array(
            "Nombre total de décès",
            'Dont enfants (≤ 15 ans)',
            'Nombre total de PDV',
            ' Dont enfants (≤ 15 ans)',
            'Nombre de PDV par moi',
                /*  'Nombre de décès ce mois',
                  'Dont enfants (≤ 15 ans)', */
                /*  'Nombre de PDV récupérés (En attente)',
                  'Dont enfants (≤ 15 ans) (En attente)' */
        );
        /* $titre = array(
          'Nombre de décès ce mois',
          'Nombre enfants décédés ce mois (≤ 15 ans)',
          'Nombre total de décès',
          'Dont enfants (≤ 15 ans)',
          'Nombre de PDV ce mois',
          'Nombre enfants PDV ce mois (≤ 15 ans)',
          'Nombre de PDV récupérés',
          'Nombre enfants PDV récupérés (≤ 15 ans)',
          'Nombre total de PDV',
          'Dont enfants (≤ 15 ans)',
          ); */
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $date = $this->form->get('daterappmoi')->getValue();
            }
        }
        $tabsuivi = $this->Ndcd($date);
        $tab = $this->Npdv($date);
        $t = $tab['nb'];

        $tabsuivi['Nombre de PDV ce mois']['valeur'] = $t[2];
        $tabsuivi['Nombre enfants PDV ce mois (≤ 15 ans)']['valeur'] = $t[3];
        /* $tabsuivi['Nombre de PDV récupérés F']['valeur'] = 0;
          $tabsuivi['Nombre enfants PDV récupérés (≤ 15 ans) F']['valeur'] = 0; */
        $tabsuivi['Nombre total de PDV']['valeur'] = $t[0];
        // $tabsuivi['Nombre total enfant PDV']['valeur'] = $t[1];
        $viewModel->form = $this->form;
        $viewModel->tabsuivi = $tabsuivi;
        $viewModel->detailspdv = json_encode(array_values($tab['detailspdv']));
        $viewModel->detailsdcd = json_encode(array_values($this->dcd));
        $viewModel->detailsdcdm = json_encode(array_values($this->dcdm));
        $viewModel->detailspdvpm = json_encode(array_values($this->pdvpm));

        return $viewModel;
    }

    public function nouveaupatientAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $request = $this->getRequest();
        $datedeb = date('Y-m-01');
        $datefin = date('Y-m-t');
        $titre[0] = "Nombre de décès ce mois";
        $titre[1] = 'Dont enfants (<= 15 ans)';
        $titre[2] = 'Nombre de PDV';
        $titre[3] = ' Dont enfants (<= 15 ans)';
        $titre[4] = 'Nombre de PDV récupérés';
        $titre[5] = 'Dont enfants (<= 15 ans)';
        $tabnouvpat = $this->initialisation(2, 3, 0);
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('datefin')->getValue();
            }
        }
        $tab = $this->Np($datedeb, $datefin);
        $tabnouvpat = $tab['nb'];
        $details = $tab['detail'];
        if (isset($tabnouvpat)) {
            $tabnouvpat = $this->totcol($tabnouvpat);
            $tabnouvpat = $this->totrow($tabnouvpat);
            end($tabnouvpat);         // move the internal pointer to the end of the array
            $key = key($tabnouvpat);
            end($tabnouvpat[$key]);         // move the internal pointer to the end of the array
            $key2 = key($tabnouvpat[$key]);
            $tabnouvpat = $this->pourcentrow($tabnouvpat, $tabnouvpat[$key][$key2]);
            $tabnouvpat = $this->pourcentcol($tabnouvpat, $tabnouvpat[$key][$key2]);
            $titre = array(1 => 'Masculin', 2 => "Féminin", 3 => "Total", 4 => "Pourcentage");
            $tabnouvpat = $this->addcol($tabnouvpat, $titre, 'titre');
            $tabnouvpatmatri = $this->NpMatr($datedeb, $datefin);
        }
        $viewModel->form = $this->form;
        $viewModel->tabnouvpat = $tabnouvpat;
        $viewModel->details = json_encode(array_values($details));
        $viewModel->tabnouvpatmatri = $tabnouvpatmatri;
        $viewModel->taborient = $this->NpSrcori($datedeb, $datefin);
        $viewModel->tabloca = $this->NpLoca($datedeb, $datefin);
        return $viewModel;
    }

    public function mediconsAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $dossiers = $this->setdoss();
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $datedeb = date('Y-m-01');
        $datefin = date('Y-m-t');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('datefin')->getValue();
                $tabmedicons = $this->initialisation(2, 1, 0);
                $tabmedicons[1][1] = $this->Nbdc($datedeb, $datefin, $dossier);
                $cons = $this->Nbpacpf($datedeb, $datefin, $dossiers);
                $tabmedicons[2][1] = $cons['nbcons'];
                $titre[1] = "Nombre de consultations";
                $titre[2] = 'Nombre de patients ayant consulté plusieurs fois';
                $tabmedicons = $this->addcol($tabmedicons, $titre, 'titre');
            }
        } else {
            $tabmedicons = $this->initialisation(2, 1, 0);
            $tabmedicons[1][1] = $this->Nbdc($datedeb, $datefin, $dossiers);
            $cons = $this->Nbpacpf($datedeb, $datefin, $dossiers);
            $tabmedicons[2][1] = $cons['nbcons'];
            $titre[1] = "Nombre de consultations";
            $titre[2] = 'Nombre de patients ayant consulté plusieurs fois';
            $tabmedicons = $this->addcol($tabmedicons, $titre, 'titre');
        }
        $viewModel->form = $this->form;
        $viewModel->tabmedicons = $tabmedicons;
        $viewModel->details = json_encode(array_values($cons['detail']));
        return $viewModel;
    }

    public function incarvAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        //$datedeb = date('Y-m-01');
        $datefin = date('Y-m-d');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                //  $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('daterappmoi')->getValue();
            }
        }
        $viewModel->form = $this->form;
        $viewModel->tabincavr = $this->Nbincarv(/* $datedeb, */ $datefin);
        $viewModel->details = json_encode(array_values($this->inclusionarv));
        return $viewModel;
    }

    public function modtraitAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $request = $this->getRequest();
        $datedeb = date('Y-m-01');
        $datefin = date('Y-m-t');

        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('datefin')->getValue();
                $tabmodtraitmt = $this->Nmodtrait($datedeb, $datefin);
            }
        } else {
            $tabmodtraitmt = $this->Nmodtrait($datedeb, $datefin);
        }
        $viewModel->form = $this->form;
        $viewModel->tabmodtraitmt = $tabmodtraitmt;
        return $viewModel;
    }

    public function pharmaAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $request = $this->getRequest();
        $datedeb = date('Y-m-01');
        $datefin = date('Y-m-t');
        $titre = array(
            'AZT+3TC+NVP' => 0,
            'TDF+FTC+EFV' => 0,
            'AZT+3TC+EFV' => 0,
            'ABC+3TC+EFV' => 0,
            'AZT+3TC+LPV+RTV' => 0,
            'TDF+FTC+LPV+RTV' => 0,
            'ABC+3TC+LPV+RTV' => 0,
            'AZT+3TC+DRV+RTV' => 0,
            'TDF+FTC+DRV+RTV' => 0
        );
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('datefin')->getValue();
                $tab = $this->rgmeadult($titre, $datedeb, $datefin);
                $tabregimadlt = $tab['adulte'];
                $tabregimenf = $tab['enfant'];
                $tabligne = $tab['ligne'];
            }
        } else {
            $tab = $this->rgmeadult($titre, $datedeb, $datefin);
            $tabregimadlt = $tab['adulte'];
            $tabregimenf = $tab['enfant'];
            $tabligne = $tab['ligne'];
        }
        $viewModel->form = $this->form;
        $viewModel->tabregimadlt = $tabregimadlt;
        $viewModel->tabregimenf = $tabregimenf;
        $viewModel->tabligne = $tabligne;
        return $viewModel;
    }

    public function ptmeAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $request = $this->getRequest();
        $datedeb = date('Y-m-01');
        $datefin = date('Y-m-t');

        $tabnouvpat = $this->initialisation(2, 3, 0);

        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('datefin')->getValue();
                $tabptme = $this->Nptme($datedeb, $datefin);
                $this->tabptme = $tabptme;
            }
        } else {
            $tabptme = $this->Nptme($datedeb, $datefin);
            $this->tabptme = $tabptme;
        }
        $viewModel->form = $this->form;
        $viewModel->tabptme = $tabptme;
        $viewModel->ptmedetails = json_encode(array_values($this->ptmedetails));
        $viewModel->nnedetails = json_encode(array_values($this->nnedetails));
        $viewModel->nnearvdetails = json_encode(array_values($this->nnearvdetails));
        return $viewModel;
    }

    public function infectoppAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $request = $this->getRequest();
        $datedeb = date('Y-m-01');
        $datefin = date('Y-m-t');
        $titre['Candidose buccale'] = 11;
        $titre['Zona 5 derniers mois'] = 5;
        $titre['Candidose extra pulmonaire'] = 25;
        $titre['Tuberculose extra pulmonaire'] = 27;
        $titre['Tuberculose pulmonaire'] = 14;
        $titre['Diarrhée'] = 9;
        $titre['Maladie de Kaposi'] = 32;
        $titre['Paludisme'] = 35;
        $titre['Neuropathie périphérique'] = 36;
        $titre['Rhumatismes inflammatoires'] = 37;
        $titre['Manifestations cutanées majeures'] = 38;
        $titre['Lymphadéno | Lymphadé'] = 2;
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('datefin')->getValue();
                $tabinfect = $this->Ninfectop($datedeb, $datefin, $titre);
                $viewModel->infectopdetails = json_encode(array_values($this->infectop));
                unset($titre);
                $titre['Patient asymptomatique'] = 1;
                $tabasymp = $this->Ninfectop($datedeb, $datefin, $titre);
                $viewModel->asympdetails = json_encode(array_values($this->infectop));
            }
        } else {
            $tabinfect = $this->Ninfectop($datedeb, $datefin, $titre);
            $viewModel->infectopdetails = json_encode(array_values($this->infectop));
            unset($titre);
            $titre['Patient asymptomatique'] = 1;
            $tabasymp = $this->Ninfectop($datedeb, $datefin, $titre);
            $viewModel->asympdetails = json_encode(array_values($this->infectop));
        }
        $viewModel->form = $this->form;
        $viewModel->tabasymp = $tabasymp;
        $viewModel->tabinfect = $tabinfect;
        //$viewModel->infectopdetails = json_encode(array_values($this->infectop));
        return $viewModel;
    }

    public function suivibioAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $datedeb = date('Y-m-01');
        $datefin = date('Y-m-t');
        $request = $this->getRequest();
        $titre = array(
            'Numération de formule sanguine' => 'Nfs_',
            'Glycémie' => 'Bi00',
            'Créatinine' => 'Bi01',
            'Dépistage' => 'Ser0',
            'Hépatite B' => 'Ser2',
            'ALAT' => 'Bi02',
            'ASAT' => 'Bi03',
            'CD4' => 'CD4_',
            'Cholesterol' => 'Bi04',
            'Triglycéride' => 'Bi05',
            'Urée' => 'Bi11',
            'Groupe sanguin / Rhésus' => 'Au01',
        );
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('datefin')->getValue();

                $tabbiol = $this->NsuivBio($datedeb, $datefin, $titre);

                /*                 * ***********En attente reponse************************************** */
                for ($i = 1; $i <= 4; $i++) {
                    $tabanalcompl[$i][1] = "";
                    $tabanalcompl[$i][2] = "";
                }
                $titre[1] = "Centre Hospitalier National";
                $titre[2] = "Maurilab";
                $titre[3] = "CNC";
                $titre[4] = "CNSpecialites";
                $tabanalcompl = $this->addcol($tabanalcompl, $titre, 'titre');
                $titre[1] = "";
                $titre[2] = "";
                $titre[3] = "INRSP";
                $titre[4] = "";
                $tabanalcompl = $this->addcol($tabanalcompl, $titre, 'Chrgv');
            }
        } else {
            $tabbiol = $this->NsuivBio($datedeb, $datefin, $titre);
            /*             * ***********En attente reponse************************************** */
            for ($i = 1; $i <= 4; $i++) {
                $tabanalcompl[$i][1] = "";
                $tabanalcompl[$i][2] = "";
            }
            $titre[1] = "Centre Hospitalier National";
            $titre[2] = "Maurilab";
            $titre[3] = "CNC";
            $titre[4] = "CNSpecialites";
            $tabanalcompl = $this->addcol($tabanalcompl, $titre, 'titre');
            $titre[1] = "";
            $titre[2] = "";
            $titre[3] = "INRSP";
            $titre[4] = "";
            $tabanalcompl = $this->addcol($tabanalcompl, $titre, 'Chrgv');
        }
        $viewModel->form = $this->form;
        $viewModel->tabbiol = $tabbiol;
        $viewModel->tabanalcompl = $tabanalcompl;
        $viewModel->biodetails = json_encode(array_values($this->bio));
        return $viewModel;
    }

    public function suivinutriAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $request = $this->getRequest();
        $datedeb = date('Y-m-01');
        $datefin = date('Y-m-t');
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('datefin')->getValue();
                $tabsuivnutri = $this->NkitAlim($datedeb, $datefin);
                $titre = array(
                    '< 16.0',
                    '16.0 - 16.9',
                    '17.0 - 18.4',
                    '18.5 - 24.9',
                    '25.0 - 29.9',
                    '30.0 - 34.9',
                    '>= 35.0'
                );
                $tabimc = $this->Nbimc($datedeb, $datefin, $titre);
                $titre = array(
                    'Dénutris',
                    'Normal',
                    'Surpoids',
                    'Obésité',
                );
                $tabnutristat = $this->Nbimcclas($datedeb, $datefin, $titre);
                $tabconsindivi = $this->Nconsind();
            }
        } else {
            $tabsuivnutri = $this->NkitAlim($datedeb, $datefin);
            $titre = array(
                '< 16.0',
                '16.0 - 16.9',
                '17.0 - 18.4',
                '18.5 - 24.9',
                '25.0 - 29.9',
                '30.0 - 34.9',
                '>= 35.0'
            );
            $tabimc = $this->Nbimc($datedeb, $datefin, $titre);
            $titre = array(
                'Dénutris',
                'Normal',
                'Surpoids',
                'Obésité',
            );
            $tabnutristat = $this->Nbimcclas($datedeb, $datefin, $titre);
            $tabconsindivi = $this->Nconsind();
        }
        $viewModel->form = $this->form;
        $viewModel->tabsuivnutri = $tabsuivnutri;
        $viewModel->tabimc = $tabimc;
        $viewModel->tabnutristat = $tabnutristat;
        $viewModel->tabconsindivi = $tabconsindivi;
        return $viewModel;
    }

    public function rappcotxAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $request = $this->getRequest();
        $datedeb = date('Y-m-01');
        $datefin = date('Y-m-t');
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $date = date('Y-m-d', strtotime($datefin . ' -5 month'));
                $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('datefin')->getValue();
                if (strtotime($datedeb) < strtotime($date))
                    return $this->redirect()->toRoute('analyse');

                $tabcotx = $this->Nbcotx($datedeb, $datefin);
                $titre = array(
                    'Total prescriptions' => 'totprsc',
                    'Total patient' => 'totpat',
                    'Nbre comprimés' => 'nbrcompr',
                );
                $tabcotx1 = $this->Nbcotxresult($tabcotx, $titre);
            }
        }
        else {
            $tabcotx = $this->Nbcotx($datedeb, $datefin);
            $titre = array(
                'Total prescriptions' => 'totprsc',
                'Total patient' => 'totpat',
                'Nbre comprimés' => 'nbrcompr',
            );
            $tabcotx1 = $this->Nbcotxresult($tabcotx, $titre);
        }
        $viewModel->form = $this->form;
        $viewModel->tabcotx = $tabcotx;
        $viewModel->tabcotx1 = $tabcotx1;
        return $viewModel;
    }

    public function hospdjAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $this->form = new RappForm();
        $request = $this->getRequest();
        $titre['Diarrhées et vomissements'] = 1;
        $titre['Altération de l’état général'] = 2;
        $titre['Candidose buccale'] = 3;
        $titre['Anémie'] = 4;
        $titre['Paludisme'] = 5;
        $titre['Fièvre intermittente'] = 6;
        $titre['Pneumopathies'] = 7;
        $titre['Autres'] = 8;
        $datedeb = date('Y-m-01');
        $datefin = date('Y-m-t');
        if ($request->isPost()) {
            $this->form->setData($request->getPost());
            if ($this->form->isValid()) {
                $datedeb = $this->form->get('datedeb')->getValue();
                $datefin = $this->form->get('datefin')->getValue();
                $tabnbhosp = $this->Nhosp($datedeb, $datefin);
                $tabmotihosp = $this->motifhdj($datedeb, $datefin, $titre);
                $tabrefhospnat[0]['valeur'] = $this->refchn($datedeb, $datefin);
                $titre[0] = "Patients référés à l'hopital national";
                $tabrefhospnat = $this->addcol($tabrefhospnat, $titre, 'titre');
                $titrep[0] = "Référencement à l'hopital national";
                $tabrefhospnat = $this->addcol($tabrefhospnat, $titrep, 'titrep');
                $this->tabrefhospnat = $tabrefhospnat;
            }
        } else {
            $tabnbhosp = $this->Nhosp($datedeb, $datefin);
            $tabmotihosp = $this->motifhdj($datedeb, $datefin, $titre);
            $tabrefhospnat[0]['valeur'] = $this->refchn($datedeb, $datefin);
            $titre[0] = "Patients référés à l'hopital national";
            $tabrefhospnat = $this->addcol($tabrefhospnat, $titre, 'titre');
            $titrep[0] = "Référencement à l'hopital national";
            $tabrefhospnat = $this->addcol($tabrefhospnat, $titrep, 'titrep');
        }
        $viewModel->form = $this->form;
        $viewModel->tabnbhosp = $tabnbhosp;
        $viewModel->tabmotihosp = $tabmotihosp;
        $viewModel->tabrefhospnat = $tabrefhospnat;
        return $viewModel;
    }

    public function extractAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $dossiers = $this->setdoss();
        //Nbcons Derniere consultation requete lente
        $where = "(Doss >0)";
        $col = array('Doss', 'Max' => new \Zend\Db\Sql\Expression('Max(Dat_)'), 'count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
        //select doss,max(Dat_),count(*) from medicons where (doss>0) group by doss
        $medicons = $this->getMediconsTable()->Rapport($where, $col, 'Doss', null);
        $medicons->setArrayObjectPrototype(new \Analyse\Model\MinMedicons());
        //print_r($medicons);
        //exit;
        foreach ($medicons as $medi) {
            if (array_key_exists($medi->Doss, $dossiers))
                $dossiers[$medi->Doss]['derncons'] = (substr($medi->Max, 0, -9)) ? substr($medi->Max, 0, -9) : '';
        }
        $medicons = null;
        //arv delivrance max min
        //select item.doss,max(item.dat_),min(item.dat_) from item,prod where (item.prod=prod.nume and typ_=3 and dest=6) group by doss		
        $where = "(Doss >0 and Typ_=3 and Dest=6)";
        $col = array('Doss', 'Min' => new \Zend\Db\Sql\Expression('Min(Dat_)'), 'Max' => new \Zend\Db\Sql\Expression('Max(Dat_)'));
        $join = array('prod' => $this->prefixe . 'prod');
        $condjoin = $this->prefixe . 'item.Prod=prod.Nume';
        $item = $this->getItemTable()->Rapportjoint($where, $col, $join, $condjoin, 'Doss');
        $item->setArrayObjectPrototype(new \Analyse\Model\MinMedicons());
        foreach ($item as $itemm) {
            if (array_key_exists($itemm->Doss, $dossiers)) {
                $dossiers[$itemm->Doss]['arvfirstdeliv'] = (substr($itemm->Min, 0, -9)) ? substr($itemm->Min, 0, -9) : '';
                $dossiers[$itemm->Doss]['arvlastdeliv'] = (substr($itemm->Max, 0, -9)) ? substr($itemm->Max, 0, -9) : '';
            }
        }
        $item = null;
        //delivrance max min
        //select item.doss,max(item.dat_),min(item.dat_) from item,prod where (item.prod=prod.nume and typ_=3 and dest=6) group by doss		
        $where = "(Doss >0 and Dest=6)";
        $col = array('Doss', 'Min' => new \Zend\Db\Sql\Expression('Min(Dat_)'), 'Max' => new \Zend\Db\Sql\Expression('Max(Dat_)'));
        $join = array('prod' => $this->prefixe . 'prod');
        $condjoin = $this->prefixe . 'item.Prod=prod.Nume';
        $itemmed = $this->getItemTable()->Rapportjoint($where, $col, $join, $condjoin, 'Doss');
        $itemmed->setArrayObjectPrototype(new \Analyse\Model\MinMedicons());
        foreach ($itemmed as $itemmedi) {
            if (array_key_exists($itemmedi->Doss, $dossiers)) {
                $dossiers[$itemmedi->Doss]['firstdeliv'] = (substr($itemmedi->Min, 0, -9)) ? substr($itemmedi->Min, 0, -9) : '';
                $dossiers[$itemmedi->Doss]['lastdeliv'] = (substr($itemmedi->Max, 0, -9)) ? substr($itemmedi->Max, 0, -9) : '';
            }
        }
        $item = null;
        //derniere participation communaute
        // select doss,max(Dat_) from comm,commdoss where (commdoss.Comm=comm.Nume and Doss>0) group by doss
        $where = "(Doss >0)";
        $col = array('Doss', 'Min' => new \Zend\Db\Sql\Expression('Min(Dat_)'), 'Max' => new \Zend\Db\Sql\Expression('Max(Dat_)'));
        $join = array('commdoss' => $this->prefixe . 'commdoss');
        $condjoin = $this->prefixe . 'comm.Nume=commdoss.Comm';
        $comm = $this->getCommTable()->Rapportjoint($where, $col, $join, $condjoin, 'Doss');
        $comm->setArrayObjectPrototype(new \Analyse\Model\MinMedicons());
        foreach ($comm as $co) {
            if (array_key_exists($co->Doss, $dossiers)) {
                $dossiers[$co->Doss]['commfirstpart'] = substr($co->Min, 0, -9) ? substr($co->Min, 0, -9) : '';
                $dossiers[$co->Doss]['commlastpart'] = substr($co->Max, 0, -9) ? substr($co->Max, 0, -9) : '';
            }
        }

        $item = null;
        // PTME: Date accouch. (dern. gros.) -> AccoDat_; PTME: Date accouch. prév. (dern. gros.) -> AccoPrev;  PTME: Date saisie dern. grossesse -> SaisDat_;
        //SELECT `ptmegros`.`Doss` AS `Doss`, Max(AccoDat_) AS `AccoDat_`, Max(AccoPrev) AS `AccoPrev`, Max(SaisDat_) AS `SaisDat_` FROM `ptmegros` WHERE (Doss >0) GROUP BY `Doss`
        $where = "Doss >0";
        $col = array('Doss', 'AccoDat_' => new \Zend\Db\Sql\Expression('Max(AccoDat_)'), 'AccoPrev' => new \Zend\Db\Sql\Expression('Max(AccoPrev)'), 'SaisDat_' => new \Zend\Db\Sql\Expression('Max(SaisDat_)'));
        $ptmegros = $this->getPtmegrosTable()->Rapport($where, $col, 'Doss', null);
        $ptmegros->setArrayObjectPrototype(new \Analyse\Model\MinPtmegros());

        foreach ($ptmegros as $ptme) {
            if (array_key_exists($ptme->Doss, $dossiers)) {
                $dossiers[$ptme->Doss]['derngrosaccouch'] = (substr($ptme->AccoDat_, 0, -9)) ? substr($ptme->AccoDat_, 0, -9) : '';
                $dossiers[$ptme->Doss]['derngrosaccouchprev'] = (substr($ptme->AccoPrev, 0, -9)) ? substr($ptme->AccoPrev, 0, -9) : '';
                $dossiers[$ptme->Doss]['derngrossaisi'] = (substr($ptme->SaisDat_, 0, -9)) ? substr($ptme->SaisDat_, 0, -9) : '';
            }
        }
        //CD40 min, max
        $where = "Doss>0 and CD40 >0";
        $col = array('Doss', 'LaboDat_' => new \Zend\Db\Sql\Expression('Min(LaboDat_)'), 'Cd40');
        $cd4min = $this->getEntrTable()->Rapport($where, $col, 'Doss', null);
        $cd4min->setArrayObjectPrototype(new \Analyse\Model\MinEntr());
        $query = " Select t.doss,LaboDat_,Cd40 from " . $this->prefixe . "entr t inner join (SELECT doss,MAX(labodat_) as max_date FROM " . $this->prefixe . "entr WHERE (Doss>0 and CD40 >0) GROUP BY doss)a on a.doss = t.doss and a.max_date = labodat_ GROUP BY doss";
        $cd4max = $this->getEntrTable()->executeSqlString($query);

        foreach ($cd4min as $cd4mine) {
            if (array_key_exists($cd4mine->Doss, $dossiers)) {
                $dossiers[$cd4mine->Doss]['Dat_initCd40'] = (substr($cd4mine->LaboDat_, 0, -9)) ? substr($cd4mine->LaboDat_, 0, -9) : '';
                $dossiers[$cd4mine->Doss]['initCd40'] = $cd4mine->Cd40;
            }
        }
        foreach ($cd4max as $cd4maxe) {
            if (array_key_exists($cd4maxe['doss'], $dossiers)) {
                $dossiers[$cd4maxe['doss']]['Dat_dernCd40'] = (substr($cd4maxe['LaboDat_'], 0, -9)) ? substr($cd4maxe['LaboDat_'], 0, -9) : '';
                $dossiers[$cd4maxe['doss']]['dernCd40'] = $cd4maxe['Cd40'];
            }
        }
        //charge viral PCR0 UI/ml min max select doss,min(labodat_),Pcr0 from entr where Pcr0 >0 group by doss;
        $where = "Doss>0 and Pcr_=1";
        $col = array('Doss', 'LaboDat_' => new \Zend\Db\Sql\Expression('Min(LaboDat_)'), 'Pcr0','Pcr4','Pcr6');
        $pcrmin = $this->getEntrTable()->Rapport($where, $col, 'Doss', null);
        $pcrmin->setArrayObjectPrototype(new \Analyse\Model\MinEntr());
        $query = " Select t.doss,LaboDat_,Pcr0,Pcr4,Pcr6 from " . $this->prefixe . "entr t inner join (SELECT doss,MAX(labodat_) as max_date FROM " . $this->prefixe . "entr WHERE (Doss>0 and Pcr_=1) GROUP BY doss)a on a.doss = t.doss and a.max_date = labodat_ GROUP BY doss";
        $pcrmax = $this->getEntrTable()->executeSqlString($query);
        foreach ($pcrmin as $pcrmine) {
            if (array_key_exists($pcrmine->Doss, $dossiers)) {
                $dossiers[$pcrmine->Doss]['Dat_initPcr0'] = substr($pcrmine->LaboDat_, 0, -9);
		if($pcrmine->Pcr4==1)
                	$dossiers[$pcrmine->Doss]['initPcr0'] ='Indetectable';
	     else
		if($pcrmine->Pcr6==1)
                	$dossiers[$pcrmine->Doss]['initPcr0'] = '<20';

	    else
                $dossiers[$pcrmine->Doss]['initPcr0'] = $pcrmine->Pcr0;
            }
        }
        foreach ($pcrmax as $pcrmaxe) {
            /* baisse preformance */ if (array_key_exists($pcrmaxe['doss'], $dossiers)) {
                $dossiers[$pcrmaxe['doss']]['Dat_dernPcr0'] = substr($pcrmaxe['LaboDat_'], 0, -9);
		if($pcrmaxe['Pcr4']==1)
			$dossiers[$pcrmaxe['doss']]['dernPcr0']='Indetectable';
		else
		if($pcrmaxe['Pcr6']==1)
			$dossiers[$pcrmaxe['doss']]['dernPcr0']='<20';
		else
                	$dossiers[$pcrmaxe['doss']]['dernPcr0'] = $pcrmaxe['Pcr0'];
            }
        }

        // derniere rendez vous
        //select doss,max(Rdv_horo) from entr where Rdv_horo is not null group by doss 
        $where = "Doss >0 and Rdv_horo >0";
        $col = array('Doss', 'Rdv_horo' => new \Zend\Db\Sql\Expression('Max(Rdv_horo)'));
        $entr = $this->getEntrTable()->Rapport($where, $col, 'Doss', null);
        $entr->setArrayObjectPrototype(new \Analyse\Model\MinEntr());
        foreach ($entr as $entre) {
            /* baisse preformance */ if (array_key_exists($entre->Doss, $dossiers))
                $dossiers[$entre->Doss]['dernrdv'] = (substr($entre->Rdv_horo, 0, -9)) ? substr($entre->Rdv_horo, 0, -9) : '';
        }
        // date de derniere 
        //select doss,max(Rdv_horo) from entr where Rdv_horo is not null group by doss 
        $dernvisit = $this->setlastvisit();
        foreach ($dernvisit as $k => $dernvisite) {
            /* baisse preformance */ if (array_key_exists($k, $dossiers))
                $dossiers[$k]['dernvisite'] = $dernvisite['Dernvisit'];
        }
        // print_r($dossiers);


        $viewModel->details = json_encode(array_values($dossiers));
        return $viewModel;
    }

    public function rketetab($analrequ, $str) {
        $tab = "";
        $tabcorresp = $this->form->correspDB;
        $tabcond = $this->form->corresp;
        $tabtitre = $this->form->Listerqtedoss;
        foreach ($analrequ as $requete) {
            $rkete = explode("#", $requete);
            if ($rkete[0] === $str) {
                $tab = $rkete;
                break;
            }
        }
        $i = 1;
        $sql = "";
        $tabrekete['Doss'] = array('col' => array('Nume'), 'where' => '(Nume<>0)', 'order' => 'Ref_');
        $requeteMedi = false;
        $requeteEntr = false;
        $Item = false;
        $requeteComm = false;
        $tabhead = array();
        for ($i = 1; $i < count($tab); $i += 4) {
            $valchamps = $tab[$i];
            if (isset($valchamps) && !empty($valchamps)) {

                $valview = $tab[$i + 1];
                $valcond = $tab[$i + 2];
                $valcond2 = $tab[$i + 3];

                $tableDB = explode('$', $tabcorresp[$valchamps]);
                $tabwhere = explode('$', $tabcond[$valchamps]);
                //initialise tabview

                if ($valview == '1') //si view 
                    $tabhead[] = array('id' => $valchamps, 'titre' => $tabtitre[$valchamps], 'colonne' => $tableDB[0], 'table' => $tableDB[1]);
                if ($tableDB[1] == 'Medicons' && !$requeteMedi) {
                    $requeteMedi = true;
                    $tabrekete['Doss1'] = array('col' => array('Nume', 'OuvrDat_'));
                    $tabrekete['Medicons'] = array('col' => array('Doss', 'Dat_', 'Arv_Modi', 'Moti', 'Arv_Into', 'Arv0Prsc', 'Arv1Prsc', 'Arv2Prsc', 'Arv3Prsc', 'Imc_', 'ConcCase'), 'order' => 'Dat_');
                }
                if ($tableDB[1] == 'Entr' && !$requeteEntr) {
                    $requeteEntr = true;
                    $tabrekete['Doss1'] = array('col' => array('Nume', 'OuvrDat_'));
                    $tabrekete['Medicons'] = array('col' => array('Doss', 'Dat_', 'Arv_Modi', 'Moti', 'Arv_Into', 'Arv0Prsc', 'Arv1Prsc', 'Arv2Prsc', 'Arv3Prsc', 'Imc_', 'ConcCase'), 'order' => 'Dat_');
                    $tabrekete['Entr'] = array('col' => array('Doss', 'LaboDat_', 'Cd40', 'Bi01', 'Nfs2', 'Nfs9', 'Nf10', 'Bi03', 'Cd41', 'Pcr0', 'Pcr4'), 'order' => 'Dat_');
                }
                if ($tableDB[1] == 'Item' && !$Item) {
                    $Item = true;
                    $tabrekete['Item'] = array('col' => array('Doss', 'Dat_', 'Prod'), 'where' => "Dest=6", 'order' => 'Dat_');
                }
                if ($tableDB[1] == 'Comm' && !$requeteComm) {
                    $tabrekete['Comm'] = array('col' => array('Nume', 'Dat_'));
                    $tabrekete['CommDoss'] = array('col' => array('Doss', 'Comm'));
                    $requeteComm = true;
                }
                if ($tableDB[1] == 'PtmeGros') {
                    $tabrekete['PtmeGros'] = array('col' => array('Doss', 'SaisDat_', 'AccoPrev', 'AccoDat_'));
                }
                if ($tableDB[1] == 'Doss') {
                    //GESTION colonne DB
                    $col = $tabrekete['Doss']['col'];
                    $tabtitre[$valchamps];
                    $col[$tabtitre[$valchamps]] = $tableDB[0];
                    //$this->tabview['titre']= $col;
                    $tabrekete['Doss']['col'] = $col;
                    //retirer les doublon de colonne
                    $tabrekete['Doss']['col'] = array_unique($tabrekete['Doss']['col']);
                    //Gestion condition
                    //$where = $tabrekete['Doss']['where'];
                    if ($valcond != 0) {
                        $ind = $valcond - 1;
                        $cond = $tabwhere[$ind];
                        if ($cond === '>' || $cond === '<') {
                            $cond .= $valcond2;
                        }
                        $where = $tabrekete['Doss']['where'];
                        $tabrekete['Doss']['where'] = $where . $this->condcorresp($cond, $tableDB[0]);
                    }
                }
            }
        }
        $this->tabtitre = $tabhead;
        return $tabrekete;
    }

    public function condcorresp($cond, $colDB) {
        $str = "";
        switch ($cond) {
            case "renseigné":
                $str .= "AND($colDB<>'')";
                break;
            case "vide":
                $str .= "AND($colDB='')";
                break;
            case "aujourd'hui":
                echo "qwery";
                $str .= "AND($colDB>" . date("Y-m-d") . ")";
                break;
            case "ce moi-ci":
                $date1 = date('Y-m-d', strtotime('last day of last month'));
                $date2 = date('Y-m-d', strtotime('first day of next month'));
                $str .= "AND($colDB>$date1)AND($colDB<$date2)";
                break;
            case "cette année":
                $date1 = date('Y-m-d', strtotime('last day of last year'));
                $date2 = date('Y-m-d', strtotime('first day of next year'));
                $str .= "AND($colDB>$date1)AND($colDB<$date2)";
                break;
            case "oui":
                $str .= "AND($colDB=1)";
                break;
            case "non":
                $str .= "AND($colDB<>1)";
                break;
            case "homme":
                $str .= "AND($colDB=1)";
                break;
            case "femme":
                $str .= "AND($colDB=2)";
                break;
            case "":
                break;
            /* case ">":
              break;
              case "<":
              break; */
            default: //<5
                $str .= "AND($colDB" . $cond . ")";
        }

        return $str;
    }

    public function getConfTable() {
        if (!$this->confTable) {
            $sm = $this->getServiceLocator();
            $this->confTable = $sm->get('Analyse\Model\ConfTable');
        }
        return $this->confTable;
    }

    public function getDossTable() {
        if (!$this->dossTable) {
            $sm = $this->getServiceLocator();
            $this->dossTable = $sm->get('Analyse\Model\DossTable');
        }
        return $this->dossTable;
    }

    public function getMediconsTable() {
        if (!$this->mediconsTable) {
            $sm = $this->getServiceLocator();
            $this->mediconsTable = $sm->get('Analyse\Model\MediconsTable');
        }
        return $this->mediconsTable;
    }

    public function getPtmegrosTable() {
        if (!$this->ptmegrosTable) {
            $sm = $this->getServiceLocator();
            $this->ptmegrosTable = $sm->get('Analyse\Model\PtmegrosTable');
        }
        return $this->ptmegrosTable;
    }

    public function getEntrTable() {
        if (!$this->entrTable) {
            $sm = $this->getServiceLocator();
            $this->entrTable = $sm->get('Analyse\Model\EntrTable');
        }
        return $this->entrTable;
    }

    public function getItemTable() {
        if (!$this->itemTable) {
            $sm = $this->getServiceLocator();
            $this->itemTable = $sm->get('Analyse\Model\ItemTable');
        }
        return $this->itemTable;
    }

    public function getCommTable() {
        if (!$this->commTable) {
            $sm = $this->getServiceLocator();
            $this->commTable = $sm->get('Analyse\Model\CommTable');
        }
        return $this->commTable;
    }

    public function getCommdossTable() {
        if (!$this->commdossTable) {
            $sm = $this->getServiceLocator();
            $this->commdossTable = $sm->get('Analyse\Model\CommdossTable');
        }
        return $this->commdossTable;
    }

    public function getSocienfaTable() {
        if (!$this->socienfaTable) {
            $sm = $this->getServiceLocator();
            $this->socienfaTable = $sm->get('Analyse\Model\SocienfaTable');
        }
        return $this->socienfaTable;
    }

    public function getListeTable() {
        if (!$this->listeTable) {
            $sm = $this->getServiceLocator();
            $this->listeTable = $sm->get('Analyse\Model\ListeTable');
        }
        return $this->listeTable;
    }

    public function getObseconsTable() {
        if (!$this->obseconsTable) {
            $sm = $this->getServiceLocator();
            $this->obseconsTable = $sm->get('Analyse\Model\ObseconsTable');
        }
        return $this->obseconsTable;
    }

    public function getProdTable() {
        if (!$this->prodTable) {
            $sm = $this->getServiceLocator();
            $this->prodTable = $sm->get('Analyse\Model\ProdTable');
        }
        return $this->prodTable;
    }

    public function getPsyconsTable() {
        if (!$this->psyconsTable) {
            $sm = $this->getServiceLocator();
            $this->psyconsTable = $sm->get('Analyse\Model\PsyconsTable');
        }
        return $this->psyconsTable;
    }

    public function getPtmeenfaconsTable() {
        if (!$this->ptmeenfaconsTable) {
            $sm = $this->getServiceLocator();
            $this->ptmeenfaconsTable = $sm->get('Analyse\Model\PtmeenfaconsTable');
        }
        return $this->ptmeenfaconsTable;
    }

    public function getSociconsTable() {
        if (!$this->sociconsTable) {
            $sm = $this->getServiceLocator();
            $this->sociconsTable = $sm->get('Analyse\Model\SociconsTable');
        }
        return $this->sociconsTable;
    }

    public function getDroiTable() {
        if (!$this->droiTable) {
            $sm = $this->getServiceLocator();
            $this->droiTable = $sm->get('Analyse\Model\DroiTable');
        }
        return $this->droiTable;
    }

    public function getDepiTable() {
        if (!$this->depiTable) {
            $sm = $this->getServiceLocator();
            $this->depiTable = $sm->get('Analyse\Model\DepiTable');
        }
        return $this->depiTable;
    }

    public function getLocaTable() {
        if (!$this->locaTable) {
            $sm = $this->getServiceLocator();
            $this->locaTable = $sm->get('Analyse\Model\LocaTable');
        }
        return $this->locaTable;
    }

    public function getCsiTable() {
        if (!$this->csiTable) {
            $sm = $this->getServiceLocator();
            $this->csiTable = $sm->get('Analyse\Model\CsiTable');
        }
        return $this->csiTable;
    }

    public function getDciTable() {
        if (!$this->dciTable) {
            $sm = $this->getServiceLocator();
            $this->dciTable = $sm->get('Analyse\Model\DciTable');
        }
        return $this->dciTable;
    }

    public function getChrgTable() {
        if (!$this->chrgTable) {
            $sm = $this->getServiceLocator();
            $this->chrgTable = $sm->get('Analyse\Model\ChrgTable');
        }
        return $this->chrgTable;
    }

    public function getOptionsForSelect($array, $key, $value) {
        $select = array();
        foreach ($array as $res) {
            $select[$res->$key] = $res->$value;
        }
        return $select;
    }

    public function getTransTable() {
        if (!$this->transTable) {
            $sm = $this->getServiceLocator();
            $this->transTable = $sm->get('Dossiers\Model\TransTable');
        }
        return $this->transTable;
    }

    public function getUserTable() {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Dossiers\Model\UserTable');
        }
        return $this->userTable;
    }

    public function getCentreTable() {
        if (!$this->centreTable) {
            $sm = $this->getServiceLocator();
            $this->centreTable = $sm->get('Parametres\Model\CentreTable');
        }
        return $this->centreTable;
    }

}
