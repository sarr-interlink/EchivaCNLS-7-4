<?php

namespace Dispensation\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Dispensation\Model\Conf;
use Dispensation\Model\Item;
use Dispensation\Model\ObseModel;
use Dispensation\Model\MediconsModel;
use Dispensation\Form\DispensationForm;
use Dispensation\Form\ObsForm;

class DispensationController extends AbstractActionController {

    protected $entrTable;
    protected $itemTable;
    protected $listeTable;
    protected $dossTable;
    protected $dosaTable;
    protected $galeTable;
    protected $fabrTable;
    protected $confTable;
    protected $locaTable;
    protected $dciTable;
    protected $form;
    protected $prodTable;
    protected $mediconsTable;
    protected $tabmedi;
    protected $tabcons;
    protected $tabitem;

    public function indexAction() {
        
    }

    public function addAction() {
        $prefix = new \Zend\Session\Container('prefixe');
        $prefixe = $prefix->offsetGet('prefixe');
        $viewModel = new ViewModel();
        $Nume = $this->params()->fromRoute('Nume', 0);
        $this->form = new DispensationForm();
        $request = $this->getRequest();
        $conf = $this->getConfTable()->getConf(1);
        if ($request->isPost()) {
            $data = $request->getPost();
            $this->form->setData($data);
            $this->MajSubForm();
            
            $this->form->isValid();
            $posodefa = $conf->PosoDefa;
            //update conf 
            $conf->exchangeArray($data);
            $conf->PosoDefa = $posodefa;
            $conf->Nume = 1;
            $conf->AlerMess = "";
            $conf->Modi = date('Y-m-d H:m:s');
            $where = null;
            $order = "Nume DESC";
            $limit = 1;
            $col = "Nume";
            $result = $this->getItemTable()->select($where, $order, $limit, $col)->toArray();
            $Nume = "";
            if (isset($result)) {
                $Nume = $result[0]['Nume'];
            }
            $conf->StocItemNume = $Nume;
            if ($conf->Stoc) {
                $this->getConfTable()->saveConf($conf);
            }
            $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
            return $this->redirect()->toRoute('dispensation');
        } else {
            $col = array("Stoc");
            $result = $this->getConfTable()->select(null, null, null, $col)->toArray();
            $stock = "";
            if (isset($result) && !empty($result)) {
                $stock = $result[0]['Stoc'];
            }
            $tabstock = explode('xy9k', $stock);
            $resultitem = $this->getItemTable()->select("doss=$Nume AND(Dest=6)", "Nume")->toArray();
            $this->tabstock($resultitem, $tabstock);
            //init prescription
            $resultdci = $this->getDciTable()->select();
            $dcitab = $this->createtab($resultdci);

            $resultmedi = $this->getMediconsTable()->select("doss=$Nume and Dat_>0", "Dat_")->toArray();
            $tabcorresp = $this->correspARV();
            $i = 0;
            $ind = 0;
            $k = 0;
            $tabprsc = array();
            $tabobse = array();
            $tabmedicons = array();
            for ($i = 0; $i < count($resultmedi); $i++) {
                $dat = substr($resultmedi[$i]['Dat_'], 0, -9);
                $datprsc = explode('-', $dat);
                if (isset($datprsc[0])) {
                    $dat = $datprsc[2] . "/" . $datprsc[1] . "/" . $datprsc[0];
                }
                for ($j = 0; $j < 10; $j++) {
                    if ($resultmedi[$i]["Arv" . $j . "Prsc"]) {

                        $desiarv = explode(" + ", $resultmedi[$i]["Arv" . $j . "Prsc"]);
                        if (count($desiarv) > 1) {
                            for ($t = 0; $t < count($desiarv); $t++) {
                                if (array_key_exists($desiarv[$t], $tabcorresp))
                                    $desiarv[$t] = $tabcorresp[$desiarv[$t]];
                            }
                            $resultmedi[$i]["Arv" . $j . "Prsc"] = implode(" + ", $desiarv);
                        }
                        else {
                            $resultmedi[$i]["Arv" . $j . "Prsc"] = $desiarv[0];
                            if (array_key_exists($desiarv[0], $tabcorresp))
                                $resultmedi[$i]["Arv" . $j . "Prsc"] = $tabcorresp[$desiarv[0]];
                        }
                        $tabprsc[$ind]['Dat_'] = $dat;
                        $dat = "";
                        $tabprsc[$ind]['Prsc'] = $resultmedi[$i]["Arv" . $j . "Prsc"] . " " . $resultmedi[$i]["Arv" . $j . "Form"] . ": " . $resultmedi[$i]["Arv" . $j . "Nomb"] . " " . $resultmedi[$i]["Arv" . $j . "Unit"] . " " . $resultmedi[$i]["Arv" . $j . "Fois"] . " " . $resultmedi[$i]["Arv" . $j . "Nota"];
                        if ($resultmedi[$i]["Arv_Dure"] > 0)
                            $tabprsc[$ind]['Prsc'] .= " pd " . $resultmedi[$i]["Arv_Dure"] . " " . $resultmedi[$i]["Arv_DureTyp_"];
                        $tabprsc[$ind]['Nbr'] = "";
                        $tabprsc[$ind]['Form'] = "";
                        $tabprsc[$ind]['delivre'] = "";
                        $nbr = $resultmedi[$i]["Arv" . $j . "Nomb"];
                        $fois = explode(" ", $resultmedi[$i]["Arv" . $j . "Fois"]);
                        $dure = $resultmedi[$i]["Arv_Dure"];
                        $duretype = $resultmedi[$i]["Arv_DureTyp_"];
                        $tabprsc[$ind]['Nbr'] = (int) $nbr * (int) $fois[0] * (int) $dure;
                        if ($duretype == "semaine(s)") {
                            $tabprsc[$ind]['Nbr'] *= 7;
                        }
                        if ($duretype == "mois") {
                            $tabprsc[$ind]['Nbr'] *= 30;
                        }

                        $forme = explode(" ", $resultmedi[$i]["Arv" . $j . "Form"]);
                        $tabprsc[$ind]['Form'] = $forme[(count($forme) - 1)];
                        if ($resultmedi[$i]["Arv" . $j . "Serv"])
                            $tabprsc[$ind]['delivre'] = $resultmedi[$i]["Arv" . $j . "Serv"];
                        $tabprsc[$ind]['Nume'] = $resultmedi[$i]['Nume'] . "#Arv" . $j;
                        $tabprsc[$ind]['Numero'] = $resultmedi[$i]['Nume'];
                        $ind++;
                    }
                    if ($resultmedi[$i]["Med" . $j . "Dci_"] > 0) {
                        $tabprsc[$ind]['Dat_'] = $dat;
                        $dat = "";
                        $tabprsc[$ind]['Prsc'] = $dcitab[$resultmedi[$i]["Med" . $j . "Dci_"]] . " " . $resultmedi[$i]["Med" . $j . "Form"] . ": " . $resultmedi[$i]["Med" . $j . "Nomb"] . " " . $resultmedi[$i]["Med" . $j . "Unit"] . " " . $resultmedi[$i]["Med" . $j . "Fois"];
                        if ($resultmedi[$i]["Med" . $j . "Dure"] > 0)
                            $tabprsc[$ind]['Prsc'] .= " pd " . $resultmedi[$i]["Med" . $j . "Dure"] . " " . $resultmedi[$i]["Med" . $j . "DureTyp_"];
                        //calcule nbr
                        $nbr = $resultmedi[$i]["Med" . $j . "Nomb"];
                        $fois = explode(" ", $resultmedi[$i]["Med" . $j . "Fois"]);
                        $fois[0];
                        $dure = $resultmedi[$i]["Med" . $j . "Dure"];
                        $duretype = $resultmedi[$i]["Med" . $j . "DureTyp_"];
                        $tabprsc[$ind]['Nbr'] = 0;
                        $tabprsc[$ind]['Nbr'] = (int) $nbr * (int) $fois[0] * (int) $dure;
                        if ($duretype == "semaine(s)") {
                            $tabprsc[$ind]['Nbr'] *= 7;
                        }
                        if ($duretype == "mois") {
                            $tabprsc[$ind]['Nbr'] *= 30;
                        }
                        $forme = explode(" ", $resultmedi[$i]["Med" . $j . "Form"]);
                        $tabprsc[$ind]['Form'] = $forme[(count($forme) - 1)];
                        $tabprsc[$ind]['delivre'] = "";
                        if ($resultmedi[$i]["Med" . $j . "Serv"])
                            $tabprsc[$ind]['delivre'] = $resultmedi[$i]["Med" . $j . "Serv"];
                        $tabprsc[$ind]['Nume'] = $resultmedi[$i]['Nume'] . "#Med" . $j;
                        $tabprsc[$ind]['Numero'] = $resultmedi[$i]['Nume'];
                        $ind++;
                    }
                }
                //tabobse
                $tabobse[$k]['Nume'] = $resultmedi[$i]['Nume'];
                $tabobse[$k]['Obse'] = $resultmedi[$i]['Obse'];
                $tabobse[$k]['ObseCase'] = $resultmedi[$i]['ObseCase'];
                $tabobse[$k]['ObseManq'] = $resultmedi[$i]['ObseManq'];
                $tabobse[$k]['ObseMoti'] = $resultmedi[$i]['ObseMoti'];
                $tabobse[$k]['ObseNota'] = $resultmedi[$i]['ObseNota'];


                $tabmedicons[$k]['Nume'] = $resultmedi[$i]['Nume'];
                for ($p = 0; $p < 10; $p++) {
                    $tabmedicons[$k]["Arv" . $p . "Serv"] = $resultmedi[$i]["Arv" . $p . "Serv"];
                }
                for ($p = 0; $p < 10; $p++) {
                    $tabmedicons[$k]["Med" . $p . "Serv"] = $resultmedi[$i]["Med" . $p . "Serv"];
                }
                $k++;
            }
        }



        $viewModel->Nume = $Nume;
        $viewModel->prsc = $tabprsc;
        $viewModel->stock = $stock;
        $viewModel->medicament = $this->tabmedi;
        $viewModel->consommable = $this->tabcons;
        $viewModel->item = $this->tabitem;
        $viewModel->Obsecons = $tabobse;
        $viewModel->Medicons = $tabmedicons;
        
        $viewModel->prefixe = $prefixe;
        $viewModel->itemjs = $resultitem;
        $viewModel->form = $this->form;

        return $viewModel;
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
                $Nume = $request->getPost('Nume');
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

    public function dataAction() {
        $model = new JsonModel();
        $datatable = $this->getServiceLocator()->get('dispdatatable');
        $result = $datatable->getResult($this->params()->fromQuery());
        $model->setVariable('draw', $result->getDraw());
        $model->setVariable('recordsTotal', $result->getRecordsTotal());
        $model->setVariable('recordsFiltered', $result->getRecordsFiltered());
        $model->setVariable('data', $result->getData());
        return $model;
    }

    public function data1Action() {
        $daymax = $this->params()->fromQuery('daymax');
        $daymin = $this->params()->fromQuery('daymin');
        $Typ_ = $this->params()->fromQuery('Typ_');
        $array = $this->params()->fromQuery();
        $array['where'] = "";
        $array['Qte'] = "NombUnit";
        if ($daymax != '') {
            if ($daymin != '') {
                $array['where'] = "(Dat_ <= '$daymax 23:59:59' AND Dat_ >= '$daymin 00:00:00'";
            } else {
                $array['where'] = "(Dat_ <= '$daymax 23:59:59'";
            }
        }
        
        if ($daymin != '') {
            if ($daymax != '') {
                $array['where'] = "(Dat_ <= '$daymax 23:59:59' AND Dat_ >= '$daymin 00:00:00'";
            } else {
                $array['where'] = "(Dat_ >= '$daymin 00:00:00'";
            }
        }
		
        if ($Typ_ > 0 && $Typ_ <= 4) {
            $array['where'] .= "And Typ_='$Typ_' And Dest=6)";
        } else {
			if($Typ_ == 0)
				$array['where'] .= " And Dest=6)";
			else
				if($Typ_ == 5)    //entrée  && Dest=='2')
				{
					$array['Qte'] = "NombBoit";
					$array['where'] .= "And Sour=1 And Dest=2)";
				}
				else				
					if($Typ_ == 6)	//sortie  if($item->Sour=='2'){   //sortie
					{
						$array['Qte'] = "NombBoit";
						$array['where'] .= "And Sour=2)";		
					}
        }

        $model = new JsonModel();
        $datatable = $this->getServiceLocator()->get('histdatatable');
        $result = $datatable->getResult($array);
        //$result = $datatable->getResult($this->params()->fromQuery());
        $model->setVariable('draw', $result->getDraw());
        $model->setVariable('recordsTotal', $result->getRecordsTotal());
        $model->setVariable('recordsFiltered', $result->getRecordsFiltered());
        $model->setVariable('data', $result->getData());

        return $model;
    }

    public function addobsAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume = $this->params()->fromRoute('Nume', 0);
        $this->form = new ObsForm();
        $this->setObsForm();
        $viewModel->form = $this->form;
        $viewModel->Nume = $Nume;
        return $viewModel;
    }

    public function historiqueAction() {
        $viewModel = new ViewModel();
        $form = new DispensationForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $form->setData($data);
            $form->isValid();
            if ($request->getPost('Nume') && $request->getPost('Stoc')) {
                $Nume = $request->getPost('Nume');
                $Stoc = $form->get('Stoc')->getValue();
                $Serv = $form->get('Mediconshidden')->getValue();
                //   exit;

                if ($Serv) {
                    $med = explode("#", $Serv);
                    if ($med[0]) {
                        echo $med[0];
                        $item=$this->getItemTable()->getItem($Nume);
                        $medicons = $this->getMediconsTable()->getMediconsup($med[0],$item->prefixe);
                        $serv = $med[1] . "Serv";
                        $medarvserv = (int) $medicons->$serv;
                        if ($medarvserv >= $med[2]) {
                            $medicons->$serv = $medarvserv - $med[2];
                        }
                        	$medicons = $this->getMediconsTable()->saveobjMedicons($medicons);
                    }
                    
                }
                //suppression item
                $this->getItemTable()->deleteItem($Nume);
                //update conf
                $conf = $this->getConfTable()->getConf('1');
                $conf->Stoc = $Stoc;
                $save = $this->getConfTable()->saveConf($conf);
                return $this->redirect()->toRoute('dispensation', array('action' => 'historique'));
            }
        }
        $col = array("Stoc");
        $result = $this->getConfTable()->select(null, null, null, $col)->toArray();
        $stock = "";
        if (isset($result) && !empty($result)) {
            $stock = $result[0]['Stoc'];
        }
        
        $viewModel->stock = $stock;
        $viewModel->form = $form;
        $viewModel->daymax = date('Y-m-d');
        $viewModel->daymin = date('Y-m-d');
        return $viewModel;
    }

    public function formatdate($date) {
        $newdate = "";
        if ($date) {
            $date1 = explode("/", $date);
            $cpt = count($date1);
            if ($cpt > 1) {
                $newdate = $date1[2] . "-" . $date1[1] . "-" . $date1[0];
            } else {
                $date2 = explode(" ", $date);
                $date2 = explode("-", $date2[0]);
                $newdate = $date2[2] . "/" . $date2[1] . "/" . $date2[0];
            }
        }
        return $newdate;
    }

    public function createtab($resultdci) {
        $tab = array();
        foreach ($resultdci as $donne) {
            $tab[$donne->Nume] = $donne->Desi;
        }
        return $tab;
    }

    public function createtabprod($resultprod, $tabnume) {
        $tab = array();
        foreach ($resultprod as $donne) {
            if (array_key_exists($donne->Nume, $tabnume)) {
                $tab[$donne->Nume] = array('Dci_' => $donne->Dci_, 'Dosa' => $donne->Dosa, 'Gale' => $donne->Gale, 'Typ_' => $donne->Typ_, 'Dat' => $tabnume[$donne->Nume]['date']);
            }
            //pour item
            else
                $tab[$donne->Nume] = array('Dci_' => $donne->Dci_, 'Dosa' => $donne->Dosa, 'Gale' => $donne->Gale, 'Typ_' => $donne->Typ_);
        }
        return $tab;
    }

    public function correspARV() {
        /*         * *****************Tab correspondance ************************ */
        $tabcorresp['ABC'] = 'abacavir';
        $tabcorresp['ATV'] = 'atazanavir';
        $tabcorresp['DRV'] = 'darunavir';
        $tabcorresp['DDI'] = 'didanosine';
        $tabcorresp['EFV'] = 'efavirenz';
        $tabcorresp['FTC'] = 'emtricitabine';
        $tabcorresp['ETR'] = 'etravirine';
        $tabcorresp['IDV'] = 'indinavir';
        $tabcorresp['3TC'] = 'lamivudine';
        $tabcorresp['NFV'] = 'nelfinavir';
        $tabcorresp['NVP'] = 'névirapine';
        $tabcorresp['RAL'] = 'raltegravir';
        $tabcorresp['RTV'] = 'ritonavir';
        $tabcorresp['SQV'] = 'saquinavir';
        $tabcorresp['D4T'] = 'stavudine';
        $tabcorresp['AZT'] = 'zidovudine';
        $tabcorresp['LPV'] = 'lopinavir';
        $tabcorresp['TDF'] = 'ténofovir';
        return $tabcorresp;
    }

    public function tabstock($resultitem, $stock) {

        $resultdci = $this->getDciTable()->select();
        $dcitab = $this->createtab($resultdci);
        $resultdosa = $this->getDosaTable()->select();
        $dosatab = $this->createtab($resultdosa);
        $resultgale = $this->getGaleTable()->select();
        $galetab = $this->createtab($resultgale);
        $resultfabr = $this->getFabrTable()->select();
        $fabrtab = $this->createtab($resultfabr);

        //gestion produit 
        //creer tab de nume prod venant de stock
        $tabnumeprod = array();
        $l = 0;
        while ($l < count($stock) - 1) {
            //si med 
            if ($l % 8 == 0) {
                $date = strtr($stock[$l + 3], '/', '-');
                $date = date('Y-m-d', strtotime($date));
                if (isset($tabnumeprod[$stock[$l]]['date'])) {
                    $dateprod = strtr($tabnumeprod[$stock[$l]]['date'], '/', '-');
                    $dateprod = date('Y-m-d', strtotime($dateprod));
                    if ($date < $dateprod) {
                        $tabnumeprod[$stock[$l]]['date'] = $date;
                    }
                } else {
                    $tabnumeprod[$stock[$l]]['date'] = $date;
                }
            }
            $l++;
        }
        $resultprod = $this->getProdTable()->select();
        $prodtab = $this->createtabprod($resultprod, $tabnumeprod);
        $j = 0; //index medi
        $k = 0; //index cons
        $i = 0; //index cons
        while ($i < count($stock)) {
            if ($i % 8 == 0 && isset($prodtab[$stock[$i]])) {
                /*  calcule quantité */
                $nbr = $stock[$i + 4] + $stock[$i + 5];
                if ($nbr !== 0) {
                    if ($prodtab[$stock[$i]]['Typ_'] == 1 || $prodtab[$stock[$i]]['Typ_'] == 3) {
                        $desi = (isset($dcitab[$prodtab[$stock[$i]]['Dci_']]) ? $dcitab[$prodtab[$stock[$i]]['Dci_']] : "");
                        $dosa = (isset($dosatab[$prodtab[$stock[$i]]['Dosa']]) ? $dosatab[$prodtab[$stock[$i]]['Dosa']] : "");
                        $gale = (isset($galetab[$prodtab[$stock[$i]]['Gale']]) ? $galetab[$prodtab[$stock[$i]]['Gale']] : "");
                        $this->tabmedi[$j]['Desi'] = $desi . " " . $dosa . " " . $gale;
                        $this->tabmedi[$j]['Nbr'] = $nbr;
                        $this->tabmedi[$j]['Fabr'] = (isset($fabrtab[$stock[$i + 1]]) ? $fabrtab[$stock[$i + 1]] : "");
                        $this->tabmedi[$j]['Lot'] = $stock[$i + 2];
                        $datepreemp = explode("/", $stock[$i + 3]);
                        $this->tabmedi[$j]['Date'] = "";
                        if (isset($datepreemp[1]))
                            $this->tabmedi[$j]['Date'] = $datepreemp[1] . "/" . $datepreemp[2];
                        $this->tabmedi[$j]['proche'] = "";
                        $dateprod = date('Y-m-d', strtotime($prodtab[$stock[$i]]['Dat']));
                        $date = strtr($stock[$i + 3], '/', '-');
                        $date = date('Y-m-d', strtotime($date));
                        if ($date == $dateprod) {
                            $this->tabmedi[$j]['proche'] = "";
                        }
                        $this->tabmedi[$j]['Nume'] = $i;
                        $this->tabmedi[$j]['gale'] = $gale;

                        $j++;
                    }
                    if ($prodtab[$stock[$i]]['Typ_'] == 2) {
                        $desi = (isset($dcitab[$prodtab[$stock[$i]]['Dci_']]) ? $dcitab[$prodtab[$stock[$i]]['Dci_']] : "");
                        $dosa = (isset($dosatab[$prodtab[$stock[$i]]['Dosa']]) ? $dosatab[$prodtab[$stock[$i]]['Dosa']] : "");
                        $gale = (isset($galetab[$prodtab[$stock[$i]]['Gale']]) ? $galetab[$prodtab[$stock[$i]]['Gale']] : "");
                        $this->tabcons[$k]['Desi'] = $desi . " " . $dosa . " " . $gale;
                        $this->tabcons[$k]['Nbr'] = $nbr;
                        $this->tabcons[$k]['Fabr'] = (isset($fabrtab[$stock[$i + 1]]) ? $fabrtab[$stock[$i + 1]] : "");
                        $this->tabcons[$k]['Lot'] = $stock[$i + 2];
                        $datepreemp = explode("/", $stock[$i + 3]);
                        $this->tabcons[$k]['Date'] = $datepreemp[1] . "/" . $datepreemp[2];
                        $this->tabcons[$k]['proche'] = "";
                        $dateprod = date('Y-m-d', strtotime($prodtab[$stock[$i]]['Dat']));
                        $date = strtr($stock[$i + 3], '/', '-');
                        $date = date('Y-m-d', strtotime($date));
                        if ($date == $dateprod) {
                            $this->tabcons[$k]['proche'] = "";
                        }
                        $datepreemp = explode("/", $stock[$i + 3]);
                        $this->tabcons[$k]['Date'] = $datepreemp[1] . "/" . $datepreemp[2];
                        /* indice de stock */
                        $this->tabcons[$k]['Nume'] = $i;
                        $this->tabcons[$k]['gale'] = $gale;
                        $k++;
                    }
                }
            }
            $i++;
        }

        $p = 0; //index 
        foreach ($resultitem as $resultit) {
            $this->tabitem[$p]['Nume'] = $resultit['Nume'];
            $this->tabitem[$p]['Date'] = $resultit['Dat_'];
            $date = explode(' ', $resultit['Expi'])[0];
            $date = explode('-', $date);
            $date = $date[1] . "/" . $date[0];
            if (array_key_exists($resultit['Prod'], $prodtab)) {
                $desi = (isset($dcitab[$prodtab[$resultit['Prod']]['Dci_']]) ? $dcitab[$prodtab[$resultit['Prod']]['Dci_']] : "");
                $dosa = (isset($dosatab[$prodtab[$resultit['Prod']]['Dosa']]) ? $dosatab[$prodtab[$resultit['Prod']]['Dosa']] : "");
                $gale = (isset($galetab[$prodtab[$resultit['Prod']]['Gale']]) ? $galetab[$prodtab[$resultit['Prod']]['Gale']] : "");
            }
            $this->tabitem[$p]['Desi'] = $desi . " " . $dosa . " " . $gale . " exp. " . $date . " lot " . $resultit['Lot_'];
            $this->tabitem[$p]['Qte'] = $resultit['NombUnit'] . " " . $gale;
            $this->tabitem[$p]['Util'] = $resultit['MediCons'] . "#" . $resultit['MediConsPrsc'];
            $this->tabitem[$p]['Utilstock'] = $resultit['MediCons'] . "#" . $resultit['MediConsPrsc'];

            $p++;
        }

        // exit;
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

    public function MajSubForm() {
        $ObseModel = new ObseModel();
        $obsemodeltab = $this->conversion($this->form->get('Obsehidden')->getValue(), $ObseModel);
        if ($obsemodeltab)
            foreach ($obsemodeltab as $obsemodel) {
                $obsemodel['Util'] = $this->zfcUserAuthentication()->getIdentity()->getId();
                $obsemodel['Modi'] = date("Y-m-d H:i:s"); //a voire # date de modif pour chque enreg...             
                if ($obsemodel['Action'] !== "Action") {
                    unset($obsemodel['Action']);
                    $this->getMediconsTable()->saveMedicons($obsemodel);
                }
            }
        $MediconsModel = new MediconsModel();
        $mediconsmodeltab = $this->conversion($this->form->get('Mediconshidden')->getValue(), $MediconsModel);
        if ($mediconsmodeltab)
            foreach ($mediconsmodeltab as $mediconsmodel) {
                $mediconsmodel['Util'] = $this->zfcUserAuthentication()->getIdentity()->getId();
                $mediconsmodel['Modi'] = date("Y-m-d H:i:s"); //a voire # date de modif pour chque enreg...             
                if ($mediconsmodel['Action'] !== "Action") {
                    unset($mediconsmodel['Action']);
                    $this->getMediconsTable()->saveMedicons($mediconsmodel);
                }
            }

        $ItemTable = new Item();
        $itemtabletab = $this->conversion($this->form->get('Itemhidden')->getValue(), $ItemTable);
        if ($itemtabletab)
            foreach ($itemtabletab as $itemtable) {
                $itemtable['Util'] = $this->zfcUserAuthentication()->getIdentity()->getId();
                $itemtable['Modi'] = date("Y-m-d H:i:s"); //a voire # date de modif pour chque enreg...             
                if ($itemtable['Action'] !== "Action") {
                    if ($itemtable['Action'] === "del") {
                        $this->getItemTable()->deleteItem($itemtable['Nume']);
                    } else {
                        unset($itemtable['Action']);
                        unset($itemtable['count']);
                        if (strstr($itemtable['Nume'], "add")) {
                            $itemtable['Nume'] = "14".hexdec(uniqid());
                            $this->getItemTable()->saveItemtab($itemtable);
                        }
                    }
                }
            }
    }

    public function setObsForm() {
        $liste = $this->getListeTable()->getListetab();
        $nbrliste = count($liste);
        for ($i = 0; $i < $nbrliste; $i++) {
            if ($liste[$i]['Typ_']) {
                if ($liste[$i]['Typ_'] === "Suivi | Motif de non observance") {
                    $this->form->ObseMoti[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "Suivi | Observance") {
                    $this->form->Obse[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
            }
        }
        $this->form->initialise();
    }

    public function getDossTable() {
        if (!$this->dossTable) {
            $sm = $this->getServiceLocator();
            $this->dossTable = $sm->get('Dispensation\Model\DossTable');
        }
        return $this->dossTable;
    }

    public function getConfTable() {
        if (!$this->confTable) {
            $sm = $this->getServiceLocator();
            $this->confTable = $sm->get('Dispensation\Model\ConfTable');
        }
        return $this->confTable;
    }

    public function getLocaTable() {
        if (!$this->locaTable) {
            $sm = $this->getServiceLocator();
            $this->locaTable = $sm->get('Dispensation\Model\LocaTable');
        }
        return $this->locaTable;
    }

    public function getDciTable() {
        if (!$this->dciTable) {
            $sm = $this->getServiceLocator();
            $this->dciTable = $sm->get('Dispensation\Model\DciTable');
        }
        return $this->dciTable;
    }

    public function getProdTable() {
        if (!$this->prodTable) {
            $sm = $this->getServiceLocator();
            $this->prodTable = $sm->get('Dispensation\Model\ProdTable');
        }
        return $this->prodTable;
    }

    public function getMediconsTable() {
        if (!$this->mediconsTable) {
            $sm = $this->getServiceLocator();
            $this->mediconsTable = $sm->get('Dispensation\Model\MediconsTable');
        }
        return $this->mediconsTable;
    }

    public function getDosaTable() {
        if (!$this->dosaTable) {
            $sm = $this->getServiceLocator();
            $this->dosaTable = $sm->get('Dispensation\Model\DosaTable');
        }
        return $this->dosaTable;
    }

    public function getGaleTable() {
        if (!$this->galeTable) {
            $sm = $this->getServiceLocator();
            $this->galeTable = $sm->get('Dispensation\Model\GaleTable');
        }
        return $this->galeTable;
    }

    public function getFabrTable() {
        if (!$this->fabrTable) {
            $sm = $this->getServiceLocator();
            $this->fabrTable = $sm->get('Dispensation\Model\FabrTable');
        }
        return $this->fabrTable;
    }

    public function getItemTable() {
        if (!$this->itemTable) {
            $sm = $this->getServiceLocator();
            $this->itemTable = $sm->get('Dispensation\Model\ItemTable');
        }
        return $this->itemTable;
    }

    public function getListeTable() {
        if (!$this->listeTable) {
            $sm = $this->getServiceLocator();
            $this->listeTable = $sm->get('Dispensation\Model\ListeTable');
        }
        return $this->listeTable;
    }
    
}