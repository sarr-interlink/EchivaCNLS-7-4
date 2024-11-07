<?php

namespace Dossiers\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Dossiers\Model\Doss;
use Zend\View\Model\JsonModel;
use Dossiers\Form\DossiersForm;
use Dossiers\Form\RefForm;
use Dossiers\Form\TransForm;
use Dossiers\Model\Socicons;
use Dossiers\Model\Psycons;
use Dossiers\Model\Socienfa;
use Dossiers\Model\Medicons;
use Dossiers\Model\Ptmegros;
use Dossiers\Model\Ptmeenfacons;
use Dossiers\Model\Obsecons;
use Dossiers\Model\Entr;
use Dossiers\Model\Conf;

class DossiersController extends AbstractActionController {

    protected $entrTable;
    protected $entrlabTable;
    protected $dossTable;
    protected $dosaTable;
    protected $galeTable;
    protected $listeTable;
    protected $locaTable;
    protected $chrgTable;
    protected $sociconsconcTable;
    protected $sociconsTable;
    protected $mediconscondTable;
    protected $psyconsconcTable;
    protected $csiTable;
    protected $dciTable;
    protected $lieuaccoTable;
    protected $form;
    protected $prodTable;
    protected $psyconsTable;
    protected $socienfaTable;
    protected $mediconsTable;
    protected $ptmegrosTable;
    protected $ptmeenfaconsTable;
    protected $obseconsTable;
    protected $confTable;
    protected $userTable;
    protected $centreTable;
    protected $transTable;
    public $codereg;
    public $codestruct;

    public function indexAction() {
        $prefix = new \Zend\Session\Container('prefixe');
        $prefixe = $prefix->offsetGet('prefixe');
        $prefixeagent = $prefix->offsetGet('prefixeagent');

        $viewModel = new ViewModel();
        $viewModel->prefixe = $prefixe;
        $viewModel->prefixeagent = $prefixeagent;
        return $viewModel;
    }

    public function formatdate($date) {
        $newdate = "";
        if ($date) {
            $date2 = explode(" ", $date);
            $newdate = $date2[0];
        }
        return $newdate;
    }

    public function addAction() {

        $prefix = new \Zend\Session\Container('prefixe');
        $prefixe = $prefix->offsetGet('prefixe');
        $prefixeagent = $prefix->offsetGet('prefixeagent');
        if ($prefixe == $prefixeagent) {
            $codereg = $prefix->offsetGet('codereg');
            $codestruct = $prefix->offsetGet('codestruct');
            $code = $codereg . $codestruct;

            $viewModel = new ViewModel();
            $this->form = new DossiersForm();
            $this->setDossiersForm();
            $Nume = $this->params()->fromRoute('Nume', 0);
            /* Initialise N° dossier */
            $where = null;
            $order = "Ref_ DESC";
            $limit = 1;
            //$col = "Ref_";
            $col = array('Ref_' => new \Zend\Db\Sql\Expression('CAST(SUBSTR(Ref_,6) AS UNSIGNED)'));
            $result = $this->getDossTable()->select($where, $order, $limit, $col)->toArray();
            $Ref_ = "";
            if (count($result) != 0) {
                $tabref_ = explode($codestruct, $result[0]['Ref_']);
                if (isset($tabref_[1]))
                    $Ref_ = $tabref_[1];
                else
                    $Ref_ = $result[0]['Ref_'];
                $Ref_++;
                $Ref_ = $code . $Ref_;
            } else {
                $Ref_ = $code . "1";
            }
            $this->form->get('subFormFiche')->get('Ref_')->setValue($Ref_);
            $request = $this->getRequest();
            if (!$request->isPost()) {
                $doss = new Doss();
                $doss->Nume = "06" . hexdec(uniqid());
                $doss->Ref_ = $Ref_;
                $doss->OuvrDat_ = date("Y-m-d H:i:s");
                $doss->Arv_Lign = 0;
                $doss->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $doss->Modi = date("Y-m-d H:i:s");
                /**/ $this->getDossTable()->saveDoss($doss);
                $where = "Ref_=$Ref_";
                $order = null;
                $limit = null;
                $col = "Nume"; //santia Nume,Ref_,Ref2,Info,MediTail,RensSexe,RensAge_,RensExonTota,RensExonArv_
                $Numedoss = $doss->Nume; //$this->getDossTable()->getLastvalue();
                $entr = new Entr();
                $entr = $entr->getArrayCopy();
                unset($entr['inputFilter']);
                $entr = array_keys($entr);
                $where = "(Doss='" . $Nume . "')and ((Moti='Consultation sociale')or(Moti='Consultation psy')or (Moti='Consultation méd.')or (Moti='ETP'))and (Rdv_horo>0)";
                // $tabentr = $this->getEntrTable()->select($where, $entr, null, "Rdv_horo ASC")->toArray();
                $tabentr = $this->getEntrTable()->select($where, "Rdv_horo ASC", null, $entr)->toArray();
                $date = date('Y-m-d H:i:s');
                foreach ($tabentr as $k => $tabent) {
                    if ($tabent['Arri'] == '1')
                        $tabentr[$k]['Arri'] = "Respecté";
                    else {
                        if ($date > $tabent['Rdv_Horo'])
                            $tabentr[$k]['Arri'] = "Manqué";
                        else
                            $tabentr[$k]['Arri'] = "RDV prochain";
                    }
                }
                $where = "(Doss='" . $Nume . "')";
                $tabtrans = $this->getTransTable()->select($where);
            }
            else {
                $data = $request->getPost();
                $this->form->setData($data);
                $this->MajSubForm();
                $doss = new Doss();
                $this->form->isValid();
                $tab = $this->form->getData();
                $donnee = $this->tabformat($tab);
                $doss->exchangeArray($donnee);
                $doss->Modi = date("Y-m-d H:i:s");
                $doss->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $doss->Nume = $Nume;
                $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                $doss = $this->getDossTable()->saveDoss($doss);
                return $this->redirect()->toRoute('dossiers');
            }
            $user = $this->getUserTable()->getUser($this->zfcUserAuthentication()->getIdentity()->getId());
            $viewModel->nomdoc = $user->display_name;    // pour ordonnance
            $viewModel->tabtrans = $tabtrans;
            $viewModel->date = date('Y-m-d');
            $viewModel->tabforme = $this->initforme("Typ_=3");
            $viewModel->form = $this->form;
            $viewModel->Nume = $Numedoss;
            $order = "Dat_ DESC";
            $viewModel->Socicons = $this->getSociconsTable()->select("(Doss='" . $Numedoss . "')", $order)->toArray();
            $viewModel->Psycons = $this->getPsyconsTable()->select("(Doss='" . $Numedoss . "')", $order)->toArray();
            $viewModel->Socienfa = $this->getSocienfaTable()->select("(Doss='" . $Numedoss . "')", "Pnom DESC")->toArray();
            $viewModel->Medicons = $this->getMediconsTable()->select("(Doss='" . $Numedoss . "')", $order)->toArray();
            $viewModel->Ptmegros = $this->getPtmegrosTable()->select("(Doss='" . $Numedoss . "')", "SaisDat_ DESC")->toArray();
            $viewModel->Ptmeenfacons = $this->getPtmeenfaconsTable()->select("(Doss='" . $Numedoss . "')", "Dat_ DESC")->toArray();
            $viewModel->Obsecons = $this->getObseconsTable()->select("(Doss='" . $Numedoss . "')", "Dat_ DESC")->toArray();
            $viewModel->Entr = $tabentr;
            $where = "(LaboDesi<>'')AND(Doss=" . $Numedoss . ")";
            $order = "LaboDat_ DESC";
            $col = array("Nume", "LaboDat_", "LaboDesi");
            $viewModel->Medibio = $this->getEntrlabTable()->select($where, null, null, $order)->toArray();
            $viewModel->tabformemedi = $this->initformemedicourant("Typ_=1");
            $viewModel->posologie = utf8_encode($this->getConfTable()->getConf(1)->PosoDefa);
            return $viewModel;
        } else {
            return $this->redirect()->toRoute('dossiers', array(
                        'action' => 'index'
            ));
        }
    }

    public function editAction() {

        $viewModel = new ViewModel();
        $Nume = $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('dossiers', array(
                        'action' => 'add'
            ));
        }
        $doss = $this->getDossTable()->getDoss($Nume);
        $this->form = new DossiersForm();
        $form1 = new TransForm();
        $user = $this->getUserTable()->getUser($this->zfcUserAuthentication()->getIdentity()->getId());
        $form1->get('Structure_destination')->setOptions(array('value_options' => $this->getOptionsForSelect($this->getCentreTable()->select("Id <>" . $user->centre, 'Structure'), 'Code_struct', 'Structure')));
        $order = "Dat_ Asc";
        /**/$Medicons = $this->getMediconsTable()->select("(Doss='" . $Nume . "')", $order)->toArray();
        foreach ($Medicons as $medicons) {
            $dte = explode('-', substr($medicons['Dat_'], 0, -9));
            if (isset($dte[2]))
                $this->form->get('subFormMedicalSui')->medicons[$medicons['Nume']] = $dte[2] . '/' . $dte[1] . '/' . $dte[0];
        }
        $this->setDossiersForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $doss = new Doss();
            $data = $request->getPost();
            $this->form->setData($data);
            $this->MajSubForm();
            $this->form->isValid();
            $tab = $this->form->getData();
            $donnee = $this->tabformat($tab);
            $doss->exchangeArray($donnee);
            $doss->Modi = date("Y-m-d H:i:s");
            $doss->Nume = $Nume;
            $doss->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
            $savedoss = $this->getDossTable()->saveDoss($doss);
            $this->flashMessenger()->addSuccessMessage('La modification a été faite avec succés.');
            return $this->redirect()->toRoute('dossiers');
            /**/
            $entr = new Entr();
            $entr = $entr->getArrayCopy();
            unset($entr['inputFilter']);
            $entr = array_keys($entr);
            $where = "(Doss='" . $Nume . "')and ((Moti='Consultation sociale')or(Moti='Consultation psy')or (Moti='Consultation méd.')or (Moti='ETP'))and (Rdv_horo>0)";
            //$tabentr = $this->getEntrTable()->select($where, $entr, null, "Rdv_horo ASC")->toArray();
            $tabentr = $this->getEntrTable()->select($where, "Rdv_horo ASC", null, $entr)->toArray();
            $date = date('Y-m-d H:i:s');
            foreach ($tabentr as $k => $tabent) {
                if ($tabent['Arri'] == '1')
                    $tabentr[$k]['Arri'] = "Respecté";
                else {
                    if ($date > $tabent['Rdv_Horo'])
                        $tabentr[$k]['Arri'] = "Manqué";
                    else
                        $tabentr[$k]['Arri'] = "RDV prochain";
                }
            }
            /**/
        }
        else {
            $doss->subFormFiche['RensNaisDat_'] = $this->formatdate($doss->subFormFiche['RensNaisDat_']);
            $doss->subFormFiche['OuvrDat_'] = $this->formatdate($doss->subFormFiche['OuvrDat_']);
            $doss->subFormFiche['RensNon_SuivDat_'] = $this->formatdate($doss->subFormFiche['RensNon_SuivDat_']);
            $doss->subFormFiche['RensDeceDat_'] = $this->formatdate($doss->subFormFiche['RensDeceDat_']);
            $doss->subFormFiche['RensIarvDat_'] = $this->formatdate($doss->subFormFiche['RensIarvDat_']);
            $doss->subFormSocial['subFormSocialSer']['MediDepiDat_'] = $this->formatdate($doss->subFormSocial['subFormSocialSer']['MediDepiDat_']);
            $doss->subFormSocial['subFormSocialAut']['SociAutrAgr_Dat_'] = $this->formatdate($doss->subFormSocial['subFormSocialAut']['SociAutrAgr_Dat_']);
            $doss->subFormMedicalOuv['MediDepiDat_'] = $doss->subFormSocial['subFormSocialSer']['MediDepiDat_'];
            $doss->subFormMedicalOuv['AffOuvrDat_'] = $this->formatdate($doss->subFormFiche['OuvrDat_']);
            $this->form->bind($doss);
            $entr = new Entr();
            $entr = $entr->getArrayCopy();
            unset($entr['inputFilter']);
            $entr = array_keys($entr);
            $where = "(Doss='" . $Nume . "')and ((Moti='Consultation sociale')or(Moti='Consultation psy')or (Moti='Consultation méd.')or (Moti='ETP'))and (Rdv_horo>0)";
            //$tabentr = $this->getEntrTable()->select($where, $entr, null, "Rdv_horo ASC")->toArray();
            $tabentr = $this->getEntrTable()->select($where, "Rdv_horo ASC", null, $entr)->toArray();
            $where = "(Doss='" . $Nume . "')";
            $tabtrans = $this->getTransTable()->select($where);
            $date = date('Y-m-d H:i:s');
            foreach ($tabentr as $k => $tabent) {
                if ($tabent['Arri'] == '1')
                    $tabentr[$k]['Arri'] = "Respecté";
                else {
                    if ($date > $tabent['Rdv_Horo'])
                        $tabentr[$k]['Arri'] = "Manqué";
                    else
                        $tabentr[$k]['Arri'] = "RDV prochain";
                }
            }
        }

        $viewModel->nomdoc = $user->display_name;    // pour ordonnance
        $viewModel->tabtrans = $tabtrans;    // pour ordonnance
        $viewModel->date = date('Y-m-d');
        $viewModel->tabforme = $this->utf8_converter($this->initforme("Typ_=3"));
        $viewModel->form = $this->form;
        $viewModel->form1 = $form1;
        $viewModel->Nume = $Nume;
        $order = "Dat_ DESC";
        $viewModel->Socicons = $this->utf8_converter($this->getSociconsTable()->select("(Doss='" . $Nume . "')", $order)->toArray());
        $viewModel->Psycons = $this->utf8_converter($this->getPsyconsTable()->select("(Doss='" . $Nume . "')", $order)->toArray());
        $viewModel->Socienfa = $this->utf8_converter($this->getSocienfaTable()->select("(Doss='" . $Nume . "')", "Pnom DESC")->toArray());
        $viewModel->Medicons = $Medicons;
        $viewModel->Ptmegros = $this->utf8_converter($this->getPtmegrosTable()->select("(Doss='" . $Nume . "')", "SaisDat_ DESC")->toArray());
        $viewModel->Ptmeenfacons = $this->utf8_converter($this->getPtmeenfaconsTable()->select("(Doss='" . $Nume . "')", "Dat_ DESC")->toArray());
        $viewModel->Obsecons = $this->utf8_converter($this->getObseconsTable()->select("(Doss='" . $Nume . "')", "Dat_ DESC")->toArray());
        $viewModel->Entr = $tabentr;
        $where = "(LaboDesi<>'')AND(Doss=" . $Nume . ")";
        $order = "LaboDat_ DESC";
        $col = array("Nume", "LaboDat_", "LaboDesi");
        $viewModel->Medibio = $this->utf8_converter($this->getEntrlabTable()->select($where, null, null, $order)->toArray());
        $viewModel->tabformemedi = $this->utf8_converter($this->initformemedicourant("Typ_=1"));
        $viewModel->posologie = utf8_encode($this->getConfTable()->getConf(1)->PosoDefa);
        return $viewModel;
    }

    public function AjaxAction() {
        $Type = $_POST['Type'];


        if ($Type == '3') {//delete
            $Nume = $_POST['Nume'];
            $this->getTransTable()->deleteTrans($Nume);

            return new \Zend\View\Model\JsonModel();
        } else {
            $Doss = $_POST['Doss'];
            $Dat_ = $_POST['Dat_'];
            $Motif = $_POST['Motif'];
            $Structdest = $_POST['Structdest'];

            $user = $this->getUserTable()->getUser($this->zfcUserAuthentication()->getIdentity()->getId());
            $centre = $this->getCentreTable()->getCentre($user->centre);
            $trans = new \Dossiers\Model\Trans();
            $trans->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
            $dossier = $this->getDossTable()->getDoss($Doss);
            $trans->Doss = $Doss;
            $trans->Ref_ = $dossier->Ref_;
            $trans->Dat_ = $Dat_;
            $trans->Motif = $Motif;
            $trans->Structure_source = $centre->Code_struct;
            $trans->Structure_destination = $Structdest;
            if ($Type == '1') {//add
                $trans->Nume = "06" . hexdec(uniqid());
            }
            if ($Type == '2') {//add
                $trans->Nume = $_POST['Nume'];
            }
            $trans = $this->getTransTable()->saveTrans($trans);
            $res = $trans->getArrayCopy();
        }





        return new \Zend\View\Model\JsonModel($res);
    }

    public function RefNumedossAction() {
        $this->form1 = new RefForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $this->form1->setData($data);
            if ($this->form1->isValid()) {
                $Ref_ = $this->form1->get('Ref_doss')->getValue();
                if ($Ref_) {
                    $DossByRef_ = $this->getDossTable()->getDossByRef_($Ref_);
                    //print_r($DossByRef_->Nume);
                    return $this->redirect()->toRoute('dossiers', array(
                                'controller' => 'dossiers',
                                'action' => 'edit',
                                'Nume' => $DossByRef_->Nume,
                    ));
                    //exit;
                }
            }
        }
        exit;
    }

    /* public function AjaxAction() {
      $Ref_ = $_POST['Ref_'];
      $doss = new Doss();
      $DossByRef_ = $this->getDossTable()->getDossByRef_($Ref_);
      $doss->Nume = $DossByRef_->Nume;
      $res = $doss->getArrayCopy();
      return new \Zend\View\Model\JsonModel($res);
      }
     */

    public function dataAction() {
        $model = new JsonModel();
        $datatable = $this->getServiceLocator()->get('dossiersdatatable');
        $result = $datatable->getResult($this->params()->fromQuery());
        $model->setVariable('draw', $result->getDraw());
        $model->setVariable('recordsTotal', $result->getRecordsTotal());
        $model->setVariable('recordsFiltered', $result->getRecordsFiltered());
        $model->setVariable('data', $result->getData());
        return $model;
    }

    public function conversion($string, $dbtable) {
        $coltab = array_keys((array) $dbtable);
        $ligne = explode("$", $string);
        $tab = null;
        for ($i = 0; $i < (count($ligne) - 1); $i++) {
            $col = explode('#', $ligne[$i]);
            for ($j = 0; $j < (count($coltab) - 1); $j++) {
                $tab[$i][$coltab[$j]] = $col[$j];
            }
            $tab[$i]['Action'] = $col[$j];
        }
        return $tab;
    }

    public function savesubform($mediconstab, $funct1, $funct2, $funct3) {
        foreach ($mediconstab as $medicons) {
            $medicons['Util'] = $this->zfcUserAuthentication()->getIdentity()->getId();
            $medicons['Modi'] = date("Y-m-d H:i:s"); //a voire # date de modif pour chque enreg...             
            if ($medicons['Action'] !== "Action") {
                if ($medicons['Action'] === "del") {
                    $this->$funct1()->$funct2($medicons['Nume']);
                } else {
                    if ((int) $medicons['Nume'] === 0)
                        $medicons['Nume'] = "06" . hexdec(uniqid());
                    unset($medicons['Action']);
                    /*    $medicons = array_filter($medicons, function($v) {
                      return $v != '';
                      }, ARRAY_FILTER_USE_BOTH); */
                    $this->$funct1()->$funct3($medicons);
                }
            }
        }
    }

    public function MajSubForm() {
        $Socicons = new Socicons();
        $socitab = $this->conversion($this->form->get('subFormSocial')->get('subFormSocialSocial')->get('subFormSocialSocialhidden')->getValue(), $Socicons);
        $Psycons = new Psycons();
        $psytab = $this->conversion($this->form->get('subFormSocial')->get('subFormSocialPsy')->get('subFormSocialPsyhidden')->getValue(), $Psycons);
        $Socienfa = new Socienfa();
        $socienfatab = $this->conversion($this->form->get('subFormSocial')->get('subFormSocialEnf')->get('subFormSocialEnfhidden')->getValue(), $Socienfa);
        $Medicons = new Medicons();
        $mediconstab = $this->conversion($this->form->get('subFormMedicalSui')->get('subFormMedicalSuihidden')->getValue(), $Medicons);
        $Ptmegros = new Ptmegros();
        $ptmegrostab = $this->conversion($this->form->get('subFormPtme')->get('subFormPtmehidden')->getValue(), $Ptmegros);
        $Ptmeenfacons = new Ptmeenfacons();
        $ptmeenfaconstab = $this->conversion($this->form->get('subFormPtme')->get('subFormPtmeEnf')->get('subFormPtmeEnfhidden')->getValue(), $Ptmeenfacons);
        $Obsecons = new Obsecons();
        $obseconstab = $this->conversion($this->form->get('subFormEducationtherap')->get('subFormEducationtheraphidden')->getValue(), $Obsecons);
        $Entr = new Entr();
        $entrtab = $this->conversion($this->form->get('subFormSocial')->get('subFormSocialSocial')->get('subFormRdvhidden')->getValue(), $Entr);


        if ($mediconstab) {
            $this->savesubform($mediconstab, "getMediconsTable", "deleteMedicons", "saveMedicons");
        }
        if ($socitab) {
            $this->savesubform($socitab, "getSociconsTable", "deleteSocicons", "saveSocicons");
        }
        if ($psytab) {
            $this->savesubform($psytab, "getPsyconsTable", "deletePsycons", "savePsycons");
        }
        if ($socienfatab) {
            $this->savesubform($socienfatab, "getSocienfaTable", "deleteSocienfa", "saveSocienfa");
        }
        if ($ptmegrostab) {
            $this->savesubform($ptmegrostab, "getPtmegrosTable", "deletePtmegros", "savePtmegros");
        }
        if ($ptmeenfaconstab) {
            $this->savesubform($ptmeenfaconstab, "getPtmeenfaconsTable", "deletePtmeenfacons", "savePtmeenfacons");
        }
        if ($obseconstab) {
            $this->savesubform($obseconstab, "getObseconsTable", "deleteObsecons", "saveObsecons");
        }



        /*         * *****************Gestion RDV*********************** */
        $ServRdv_ = "";
        if (isset($conf) && !empty($conf)) {
            $ServRdv_ = $conf[0]['ServRdv_'];
        }
        if ($entrtab) {
            $col = array('ServRdv_');
            $conf = $this->getConfTable()->select(null, $col, null)->toArray();
            $ServRdv_ = "";
            $updateservrdv = false;
            if (isset($conf) && !empty($conf)) {
                $ServRdv_ = $conf[0]['ServRdv_'];
            }
            foreach ($entrtab as $entr) {
                $entr['Util'] = $this->zfcUserAuthentication()->getIdentity()->getId();
                $entr['Modi'] = date("Y-m-d H:i:s");
                if ($entr['Action'] !== "Action") {
                    $updateservrdv = true;
                    if ($entr['Action'] === "del") {
                        $this->getEntrTable()->deleteEntr($entr['Nume']);
                    } else {
                        unset($entr['Action']);
                        if ((int)$entr['Nume'] === 0)
                            $entr['Nume'] = "06" . hexdec(uniqid());


                        $this->getEntrTable()->saveEntrArray($entr);
                    }
                }
            }


            if ($updateservrdv) {
                $this->setrdv();
            }
        }
    }

    public function setrdv() {
        $datedeb = date('Y-m');
        $datedeb .= "-01";
        $datedeb = date('Y-m-d 00:00:00', strtotime($datedeb));
        $datefin = date('Y-m-d 00:00:00', strtotime('+1 years'));
        //$tabentr = $this->getEntrTable()->select("(Rdv_Horo>='" . $datedeb . "') AND (Rdv_Horo<='" . $datefin . "')", null, null, null)->toArray();
        $tabentr = $this->getEntrTable()->select("(Rdv_Horo>='" . $datedeb . "') AND (Rdv_Horo<='" . $datefin . "')")->toArray();
        $chaine = "";
        foreach ($tabentr as $tabent) {
            $rdvdateheur = explode(" ", $tabent['Rdv_Horo']);
            $rdvdate = explode("-", $rdvdateheur[0]);
            $rdvdate = $rdvdate[2] . "/" . $rdvdate[1] . "/" . $rdvdate[0];
            $tabent['Rdv_Horo'] = $rdvdate . " " . $rdvdateheur[1] . ":00";
            $chaine .= $tabent['Cta_Ume_'] . '*' . $tabent['Cta_Nume'] . '*' . $tabent['Ume_Nume'] . '*' . $tabent['Rdv_Horo'] . "|\r\n";
        }
        $conftab['Nume'] = 1;
        $conftab['ServRdv_'] = $chaine;
      //  $this->getConfTable()->saveConftab($conftab);
    }

    public function converpsy($string) {
        $ligne = explode("$", $string);
        $tab = null;
        for ($i = 0; $i < (count($ligne) - 1); $i++) {
            $col = explode('#', $ligne[$i]);
            $tab[$i] = array(
                'Nume' => $col[0],
                'Util' => $col[1],
                'Modi' => $col[2],
                'Conc' => $col[3],
                'Dat_' => $col[4],
                'Doss' => $col[5],
                'Moti' => $col[6],
                'Nota' => $col[7],
                'Action' => $col[8],
            );
        }
        return $tab;
    }

    public function tabformat($tab) {

        foreach ($tab as $key => $valeur) {
            if (!is_array($valeur)) {
                $donnee[$key] = $valeur;
            } else {
                foreach ($valeur as $key => $valeur) {
                    if (!is_array($valeur)) {
                        $donnee[$key] = $valeur;
                        //    echo "$key 2 $valeur<br>";
                    } else {
                        foreach ($valeur as $key => $valeur) {
                            if (!is_array($valeur)) {
                                $donnee[$key] = $valeur;
                            }
                        }
                    }
                }
            }
        }
        return $donnee;
    }

    public function createtab($resultdci) {
        $tab = array();
        foreach ($resultdci as $donne) {
            $tab[$donne->Nume] = $donne->Desi;
        }
        return $tab;
    }

    public function createtabprod($resultdci) {
        $tab = array();
        foreach ($resultdci as $donne) {
            $tab[$donne->Nume] = array('Dci_' => $donne->Dci_, 'Dosa' => $donne->Dosa, 'Gale' => $donne->Gale);
        }
        return $tab;
    }

    public function initformemedicourant($str) {
        $resultdci = $this->getDciTable()->select($str, "Nume ASC");
        $dcitab = $this->createtab($resultdci);
        $resultdosa = $this->getDosaTable()->select();
        $dosatab = $this->createtab($resultdosa);
        $resultgale = $this->getGaleTable()->select();
        $galetab = $this->createtab($resultgale);
        $resultprod = $this->getProdTable()->select(null, "Dci_ ASC");
        $prodtab = $this->createtabprod($resultprod);
        $tabform = array();
        $i = 0;
        foreach ($prodtab as $prodtabs) {
            if (array_key_exists($prodtabs['Dci_'], $dcitab)) {
                $tabform[$i]['Dci'] = $prodtabs['Dci_'];
                $dosa = (isset($dosatab[$prodtabs['Dosa']]) ? $dosatab[$prodtabs['Dosa']] : "");
                $gale = (isset($galetab[$prodtabs['Gale']]) ? $galetab[$prodtabs['Gale']] : "");
                $tabform[$i]['Desi'] = $dosa . " " . $gale;
                $i++;
            }
        }
        return($tabform);
    }

    public function correspARV() {
        /*         * *****************Tab correspondance ************************ */
        $tabcorresp['abacavir'] = 'ABC';
        $tabcorresp['atazanavir'] = 'ATV';
        $tabcorresp['darunavir'] = 'DRV';
        $tabcorresp['didanosine'] = 'DDI';
        $tabcorresp['efavirenz'] = 'EFV';
        $tabcorresp['emtricitabine'] = 'FTC';
        $tabcorresp['etravirine'] = 'ETR';
        $tabcorresp['indinavir'] = 'IDV';
        $tabcorresp['lamivudine'] = '3TC';
        $tabcorresp['nelfinavir'] = 'NFV';
        $tabcorresp['névirapine'] = 'NVP';
        $tabcorresp['raltegravir'] = 'RAL';
        $tabcorresp['ritonavir'] = 'RTV';
        $tabcorresp['saquinavir'] = 'SQV';
        $tabcorresp['stavudine'] = 'D4T';
        $tabcorresp['zidovudine'] = 'AZT';
        $tabcorresp['lopinavir'] = 'LPV';
        $tabcorresp['ténofovir'] = 'TDF';
        return $tabcorresp;
    }

    public function initforme($str) {

        $tabcorresp = $this->correspARV();
        $resultdci = $this->getDciTable()->select($str, "Nume ASC");
        $dcitab = $this->createtab($resultdci);
        $resultdosa = $this->getDosaTable()->select();
        $dosatab = $this->createtab($resultdosa);
        $resultgale = $this->getGaleTable()->select();
        $galetab = $this->createtab($resultgale);
        $resultprod = $this->getProdTable()->select(null, "Dci_ ASC");
        $prodtab = $this->createtabprod($resultprod);
        //$tabform = "";
        $i = 0;
        $tabform = array();
        foreach ($prodtab as $prodtabs) {
            if (array_key_exists($prodtabs['Dci_'], $dcitab)) {


                $tabform[$i]['Dci'] = $dcitab[$prodtabs['Dci_']];


                $dosa = (isset($dosatab[$prodtabs['Dosa']]) ? $dosatab[$prodtabs['Dosa']] : "");
                $gale = (isset($galetab[$prodtabs['Gale']]) ? $galetab[$prodtabs['Gale']] : "");
                $tabform[$i]['Desi'] = $dosa . " " . $gale;
                $i++;
            }
        }

        foreach ($tabform as $k => $tabforme) {

            $dci = $tabforme['Dci'];
            $dcidesitab = explode(" + ", $dci);

            if (count($dcidesitab) > 1) {
                for ($t = 0; $t < count($dcidesitab); $t++) {
                    if (array_key_exists($dcidesitab[$t], $tabcorresp))
                        $dcidesitab[$t] = $tabcorresp[$dcidesitab[$t]];
                }
                $dcidesi = implode(" + ", $dcidesitab);
                $tabform[$k]['Dci'] = $dcidesi;
            }
            else {
                $dcidesi = $dcidesitab[0];
                if (array_key_exists($dcidesi, $tabcorresp))
                    $tabform[$k]['Dci'] = $tabcorresp[$dcidesi];
            }
        }

        return($tabform);
    }

    public function deleteAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume = $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('dossiers');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');
            if ($del == 'Oui') {
                 $Nume =  $request->getPost('Nume');
                $doss = $this->getDossTable()->getDoss($Nume);
                $this->getDossTable()->deleteDoss($Nume);
            }
            // Redirect to list of dossiers
            $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            return $this->redirect()->toRoute('dossiers');
        }

        $viewModel->Nume = $Nume;
        $viewModel->entr = $this->getDossTable()->getDoss($Nume);
        return $viewModel;
    }

    public function setDossiersForm() {
        $loca = $this->getLocaTable()->getLocatab();
        $nbrloca = count($loca);
        $this->form->get('subFormFiche')->RensLoca['-1'] = '';
        for ($i = 0; $i < $nbrloca; $i++) {
            $this->form->get('subFormFiche')->RensLoca[$loca[$i]['Nume']] = $loca[$i]['Desi'];
        }
        $liste = $this->getListeTable()->getListetab();
        $nbrliste = count($liste);
        for ($i = 0; $i < $nbrliste; $i++) {
            if ($liste[$i]['Typ_']) {
                if ($liste[$i]['Typ_'] === "Fiche | Ouverture par") {
                    $this->form->get('subFormFiche')->RensOuvrUnit[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Fiche | Quartier") {
                    $this->form->get('subFormFiche')->RensQuar[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Fiche | Nationalité") {
                    $this->form->get('subFormFiche')->RensNati[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Fiche | Situation matrimoniale") {
                    $this->form->get('subFormFiche')->RensMatr[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Fiche | Cause de décès") {
                    $this->form->get('subFormFiche')->RensDeceCaus[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Social | Lien de parenté") {
                    $this->form->get('subFormSocial')->SociOev_Lien[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Profession") {
                    $this->form->get('subFormFiche')->RensProf[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->get('subFormSocial')->RensProf[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Fiche | Niveau détudes") {
                    $this->form->get('subFormFiche')->RensEtud[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Fiche | Type dOEV") {

                    $this->form->get('subFormFiche')->RensOev_Type[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Social | Situation sanitaire") {
                    $this->form->get('subFormFiche')->RensOev_Sani[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->get('subFormSocial')->RensOev_Sani[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->get('subFormSocial')->get('subFormSocialEnf')->Sani[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Social | Motif de consultation") {
                    $this->form->get('subFormSocial')->get('subFormSocialSocial')->Motifsocial[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Psy | Motif") {
                    $this->form->get('subFormSocial')->get('subFormSocialPsy')->Motif[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Circonstance de dépistage") {
                    $this->form->get('subFormSocial')->get('subFormSocialSer')->MediDepiCirc[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->get('subFormMedicalOuv')->MediDepiCirc[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Social | Cause de non information") {
                    $this->form->get('subFormSocial')->get('subFormSocialSer')->SociConjInfoCaus[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Autre | Activité communautaire") {
                    $this->form->get('subFormSocial')->get('subFormSocialAut')->SociAutrCommActi[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Autre | Fréquence de nutrition") {
                    $this->form->get('subFormSocial')->get('subFormSocialAut')->SociAutrNutrFreq[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Autre | Composition de nutrition") {
                    $this->form->get('subFormSocial')->get('subFormSocialAut')->SociAutrNutrComp[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Autre | Profil social") {
                    $this->form->get('subFormSocial')->get('subFormSocialAut')->SociAutrEconProf[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->SociAutrEconProf[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Autre | Niveau socio-éco") {
                    $this->form->get('subFormSocial')->get('subFormSocialAut')->SociAutrEconNive[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->SociAutrEconNive[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Autre | Statut de résidence") {
                    $this->form->get('subFormSocial')->get('subFormSocialAut')->SociAutrResiStat[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->SociAutrResiStat[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Autre | Qualité de lhabitat") {
                    $this->form->get('subFormSocial')->get('subFormSocialAut')->SociAutrHabiQual[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Suivi | Contexte") {
                    $this->form->get('subFormMedicalSui')->Contsuiv[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Suivi | Acte dHDJ") {
                    $this->form->get('subFormMedicalSui')->Hdj_Acte[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->Hdj_Acte[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Social | Attitude de la famille") {
                    $this->form->get('subFormSocial')->get('subFormSocialSer')->SociFamiAtti[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Suivi | Modification de traitement") {
                    $this->form->Arv_Modi[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->get('subFormMedicalSui')->Arv_Modi[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Grossesse | Résultat échographique") {
                    $this->form->get('subFormPtme')->get('subFormPtmeGros')->EchoResu[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->EchoResu[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Grossesse | Evolution de la grossesse") {
                    $this->form->get('subFormPtme')->get('subFormPtmeGros')->EvolGros[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->EvolGros[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Enfant | Cause de décès") {
                    $this->form->get('subFormPtme')->get('subFormPtmeEnf')->EnfDeceCaus[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->get('subFormPtme')->get('subFormPtmeJum')->EnfDeceCaus[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->EnfDeceCaus[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Enfant | Etat clinique") {
                    $this->form->get('subFormPtme')->get('subFormPtmeEnf')->Cli[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->get('subFormPtme')->get('subFormPtmeJum')->Cli[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->Cli[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Observance | Evaluation") {
                    $this->form->get('subFormEducationtherap')->Eval[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->Eval[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Observance | Type de RDV") {
                    $this->form->get('subFormFiche')->Typ_[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->get('subFormEducationtherap')->Typ_[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Observance | Contexte") {
                    $this->form->get('subFormEducationtherap')->Contobs[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->Contobs[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Observance | Support utilisé") {
                    $this->form->Supp[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->get('subFormEducationtherap')->Supp[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Observance | Appréciation") {
                    $this->form->get('subFormEducationtherap')->Apci[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                    $this->form->Apci[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Suivi | Motif de non observance") {
                    $this->form->get('subFormMedicalSui')->get('subFormMedicalSuiObs')->ObseMoti[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Suivi | Observance") {
                    $this->form->get('subFormMedicalSui')->get('subFormMedicalSuiObs')->Obse[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
            }
        }
        $chrg = $this->getChrgTable()->select()->toArray();
        $nbrchrg = count($chrg);

        for ($i = 0; $i < $nbrchrg; $i++) {
            $this->form->get('subFormFiche')->RensChrg[$chrg[$i]['Nume']] = $chrg[$i]['Desi'];
            $this->form->get('subFormSocial')->RensChrg[$chrg[$i]['Nume']] = $chrg[$i]['Desi'];
        }
        $sociconsconc = $this->getSociconsconcTable()->getSociconsconctab();
        $nbrsociconsconc = count($sociconsconc);

        for ($i = 0; $i < $nbrsociconsconc; $i++) {
            $this->form->get('subFormSocial')->get('subFormSocialSocial')->Concsocial[$sociconsconc[$i]['Nume']] = $sociconsconc[$i]['Desi'];
            //$this->form->Concsocial[$sociconsconc[$i]['Nume']] = $sociconsconc[$i]['Desi'];
        }
        $mediconscond = $this->getMediconscondTable()->getMediconscondtab();
        $nbrmediconscond = count($mediconscond);

        for ($i = 0; $i < $nbrmediconscond; $i++) {
            $this->form->Cond[$mediconscond[$i]['Nume']] = $mediconscond[$i]['Desi'];
            $this->form->get('subFormMedicalSui')->Cond[$mediconscond[$i]['Nume']] = $mediconscond[$i]['Desi'];
        }

        $dci = $this->getDciTable()->getDcitab();
        $nbrdci = count($dci);
        $tabcorresp = $this->correspARV();
        for ($i = 0; $i < $nbrdci; $i++) {
            if ($dci[$i]['Typ_'] == 3) {
                $dcidesi = $dci[$i]['Desi'];
                $dcidesitab = explode(" + ", $dcidesi);
                if (count($dcidesitab) > 1) {
                    for ($t = 0; $t < count($dcidesitab); $t++) {
                        if (array_key_exists($dcidesitab[$t], $tabcorresp))
                            $dcidesitab[$t] = $tabcorresp[$dcidesitab[$t]];
                    }
                    $dcidesi = implode(" + ", $dcidesitab);
                }
                else {
                    $dcidesi = $dcidesitab[0];
                    if (array_key_exists($dcidesi, $tabcorresp))
                        $dcidesi = $tabcorresp[$dcidesi];
                }
                $this->form->get('subFormMedicalSui')->Arv0Prsc[$dcidesi] = $dcidesi;
            }
            if ($dci[$i]['Typ_'] == 1) {
                $this->form->Med0Dci_[$dci[$i]['Nume']] = $dci[$i]['Desi'];
                $this->form->get('subFormMedicalSui')->Med0Dci_[$dci[$i]['Nume']] = $dci[$i]['Desi'];
            }
        }
        $psyconsconc = $this->getPsyconsconcTable()->getPsyconsconctab();
        $nbrpsyconsconc = count($psyconsconc);

        for ($i = 0; $i < $nbrpsyconsconc; $i++) {
            $this->form->get('subFormSocial')->get('subFormSocialPsy')->Conc[$psyconsconc[$i]['Nume']] = $psyconsconc[$i]['Desi'];
            $this->form->Concpsy[$psyconsconc[$i]['Nume']] = $psyconsconc[$i]['Desi'];
        }

        $csi = $this->getCsiTable()->getCsitab();
        $nbrcsi = count($csi);
        for ($i = 0; $i < $nbrcsi; $i++) {
            $this->form->get('subFormSocial')->get('subFormSocialSer')->MediCsi_[$csi[$i]['Nume']] = $csi[$i]['Desi'];
            $this->form->get('subFormMedicalOuv')->MediCsi_[$csi[$i]['Nume']] = $csi[$i]['Desi'];
            //$this->form->MediCsi_[$csi[$i]['Nume']] = $csi[$i]['Desi'];
        }

        $lieuacco = $this->getLieuaccoTable()->getLieuaccotab();
        $nbrlieuacco = count($lieuacco);
        for ($i = 0; $i < $nbrlieuacco; $i++) {
            $this->form->get('subFormPtme')->get('subFormPtmeAcc')->AccoLieu[$lieuacco[$i]['Nume']] = $lieuacco[$i]['Desi'];
            $this->form->AccoLieu[$lieuacco[$i]['Nume']] = $lieuacco[$i]['Desi'];
        }
        $this->form->get('subFormFiche')->initialise();
        $this->form->get('subFormSocial')->initialise();
        $this->form->get('subFormSocial')->get('subFormSocialSocial')->initialise();
        $this->form->get('subFormSocial')->get('subFormSocialPsy')->initialise();
        $this->form->get('subFormSocial')->get('subFormSocialSer')->initialise();
        $this->form->get('subFormSocial')->get('subFormSocialEnf')->initialise();
        $this->form->get('subFormSocial')->get('subFormSocialAut')->initialise();
        $this->form->get('subFormMedicalOuv')->initialise();
        $this->form->get('subFormMedicalOuv')->get('subFormMedicalOuvFact')->initialise();
        $this->form->get('subFormMedicalOuv')->get('subFormMedicalOuvMedi')->initialise();
        $this->form->get('subFormMedicalSui')->initialise();
        $this->form->get('subFormMedicalSui')->get('subFormMedicalSuiInto')->initialise();
        $this->form->get('subFormMedicalSui')->get('subFormMedicalSuiMedi')->initialise();
        $this->form->get('subFormMedicalSui')->get('subFormMedicalSuiMoti')->initialise();
        $this->form->get('subFormMedicalSui')->get('subFormMedicalSuiMotihdj')->initialise();
        $this->form->get('subFormMedicalSui')->get('subFormMedicalSuiObs')->initialise();
        $this->form->get('subFormMedicalSui')->get('subFormMedicalSuiRdv')->initialise();
        $this->form->get('subFormMedicalBio')->initialise();
        $this->form->get('subFormPtme')->initialise();
        $this->form->get('subFormPtme')->get('subFormPtmeGros')->initialise();
        $this->form->get('subFormPtme')->get('subFormPtmeAcc')->initialise();
        $this->form->get('subFormPtme')->get('subFormPtmeEnf')->initialise();
        $this->form->get('subFormPtme')->get('subFormPtmeJum')->initialise();
        $this->form->get('subFormEducationtherap')->initialise();
    }

    public function getEntrTable() {
        if (!$this->entrTable) {
            $sm = $this->getServiceLocator();
            $this->entrTable = $sm->get('Dossiers\Model\EntrTable');
        }
        return $this->entrTable;
    }

    public function getEntrlabTable() {
        if (!$this->entrlabTable) {
            $sm = $this->getServiceLocator();
            $this->entrlabTable = $sm->get('Dossiers\Model\EntrlabTable');
        }
        return $this->entrlabTable;
    }

    public function getDossTable() {
        if (!$this->dossTable) {
            $sm = $this->getServiceLocator();
            $this->dossTable = $sm->get('Dossiers\Model\DossTable');
        }
        return $this->dossTable;
    }

    public function getListeTable() {
        if (!$this->listeTable) {
            $sm = $this->getServiceLocator();
            $this->listeTable = $sm->get('Dossiers\Model\ListeTable');
        }
        return $this->listeTable;
    }

    public function getLocaTable() {
        if (!$this->locaTable) {
            $sm = $this->getServiceLocator();
            $this->locaTable = $sm->get('Dossiers\Model\LocaTable');
        }
        return $this->locaTable;
    }

    public function getChrgTable() {
        if (!$this->chrgTable) {
            $sm = $this->getServiceLocator();
            $this->chrgTable = $sm->get('Dossiers\Model\ChrgTable');
        }
        return $this->chrgTable;
    }

    public function getSociconsconcTable() {
        if (!$this->sociconsconcTable) {
            $sm = $this->getServiceLocator();
            $this->sociconsconcTable = $sm->get('Dossiers\Model\SociconsconcTable');
        }
        return $this->sociconsconcTable;
    }

    public function getPsyconsconcTable() {
        if (!$this->psyconsconcTable) {
            $sm = $this->getServiceLocator();
            $this->psyconsconcTable = $sm->get('Dossiers\Model\PsyconsconcTable');
        }
        return $this->psyconsconcTable;
    }

    public function getCsiTable() {
        if (!$this->csiTable) {
            $sm = $this->getServiceLocator();
            $this->csiTable = $sm->get('Dossiers\Model\CsiTable');
        }
        return $this->csiTable;
    }

    public function getMediconscondTable() {
        if (!$this->mediconscondTable) {
            $sm = $this->getServiceLocator();
            $this->mediconscondTable = $sm->get('Dossiers\Model\MediconscondTable');
        }
        return $this->mediconscondTable;
    }

    public function getDciTable() {
        if (!$this->dciTable) {
            $sm = $this->getServiceLocator();
            $this->dciTable = $sm->get('Dossiers\Model\DciTable');
        }
        return $this->dciTable;
    }

    public function getLieuaccoTable() {
        if (!$this->lieuaccoTable) {
            $sm = $this->getServiceLocator();
            $this->lieuaccoTable = $sm->get('Dossiers\Model\LieuaccoTable');
        }
        return $this->lieuaccoTable;
    }

    public function getProdTable() {
        if (!$this->prodTable) {
            $sm = $this->getServiceLocator();
            $this->prodTable = $sm->get('Dossiers\Model\ProdTable');
        }
        return $this->prodTable;
    }

    function utf8_converter($array) {
        array_walk_recursive($array, function(&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });

        return $array;
    }

    public function getSociconsTable() {
        if (!$this->sociconsTable) {
            $sm = $this->getServiceLocator();
            $this->sociconsTable = $sm->get('Dossiers\Model\sociconsTable');
        }
        return $this->sociconsTable;
    }

    public function getPsyconsTable() {
        if (!$this->psyconsTable) {
            $sm = $this->getServiceLocator();
            $this->psyconsTable = $sm->get('Dossiers\Model\PsyconsTable');
        }
        return $this->psyconsTable;
    }

    public function getDosaTable() {
        if (!$this->dosaTable) {
            $sm = $this->getServiceLocator();
            $this->dosaTable = $sm->get('Dossiers\Model\DosaTable');
        }
        return $this->dosaTable;
    }

    public function getGaleTable() {
        if (!$this->galeTable) {
            $sm = $this->getServiceLocator();
            $this->galeTable = $sm->get('Dossiers\Model\GaleTable');
        }
        return $this->galeTable;
    }

    public function getSocienfaTable() {
        if (!$this->socienfaTable) {
            $sm = $this->getServiceLocator();
            $this->socienfaTable = $sm->get('Dossiers\Model\SocienfaTable');
        }
        return $this->socienfaTable;
    }

    public function getMediconsTable() {
        if (!$this->mediconsTable) {
            $sm = $this->getServiceLocator();
            $this->mediconsTable = $sm->get('Dossiers\Model\MediconsTable');
        }
        return $this->mediconsTable;
    }

    public function getPtmegrosTable() {
        if (!$this->ptmegrosTable) {
            $sm = $this->getServiceLocator();
            $this->ptmegrosTable = $sm->get('Dossiers\Model\PtmegrosTable');
        }
        return $this->ptmegrosTable;
    }

    public function getPtmeenfaconsTable() {
        if (!$this->ptmeenfaconsTable) {
            $sm = $this->getServiceLocator();
            $this->ptmeenfaconsTable = $sm->get('Dossiers\Model\PtmeenfaconsTable');
        }
        return $this->ptmeenfaconsTable;
    }

    public function getObseconsTable() {
        if (!$this->obseconsTable) {
            $sm = $this->getServiceLocator();
            $this->obseconsTable = $sm->get('Dossiers\Model\ObseconsTable');
        }
        return $this->obseconsTable;
    }

    public function getConfTable() {
        if (!$this->confTable) {
            $sm = $this->getServiceLocator();
            $this->confTable = $sm->get('Dossiers\Model\ConfTable');
        }
        return $this->confTable;
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

    public function getTransTable() {
        if (!$this->transTable) {
            $sm = $this->getServiceLocator();
            $this->transTable = $sm->get('Dossiers\Model\TransTable');
        }
        return $this->transTable;
    }

    public function getOptionsForSelect($array, $key, $value) {
        $select = array();
        foreach ($array as $res) {

            $select[$res->$key] = $res->$value;
        }
        return $select;
    }

}
