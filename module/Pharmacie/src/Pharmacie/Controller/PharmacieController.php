<?php

namespace Pharmacie\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Pharmacie\Model\Doss;
use Pharmacie\Model\Conf;
use Pharmacie\Model\Item;
use Pharmacie\Model\Prod;
use Pharmacie\Form\IndexForm;
use Pharmacie\Form\EntreForm;
use Pharmacie\Form\SortieForm;

class PharmacieController extends AbstractActionController {

    protected $itemTable;
    protected $itemdestTable;
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
    protected $provTable;
    protected $chrgTable;
    protected $tabmedi;
    protected $tabprod ;
    protected $tabcons;
    protected $tabarv;
    protected $tablab;

    public function indexAction() {
        $viewModel = new ViewModel();
        //$Nume = (int) $this->params()->fromRoute('Nume', 0);
        $this->form = new SortieForm();
        $this->setSortieForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $item = new Item();
            $data = $request->getPost();
            $this->form->setData($data);
            $this->form->isValid();
            $item->exchangeArray($this->form->getData());
            $col = array("Stoc");
            $result = $this->getConfTable()->select(null, null, null, $col)->toArray();
            $stock = "";
            if (isset($result)) {
                $stock = $result[0]['Stoc'];
            }
            $tabstock = explode('xy9k', $stock);
            $Nume =  $this->form->get('Numehidden')->getValue();
            $item->Prod = $tabstock[$Nume];
            $item->Expi = $this->formatdate($tabstock[$Nume + 3]);
            $item->Sour = 2;
            $item->Fabr = $tabstock[$Nume + 1];
            $item->Lot_ = $tabstock[$Nume + 2];
            $item->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
            $item->Modi = date("Y-m-d H:i:s");
			$item = $this->getItemTable()->saveItem($item);
			
			//mise a jour du stoc
			$conf = $this->getConfTable()->getConf(1);
            $where = null;
            $order = "Nume DESC";
            $limit = null;
            $col = "Nume";

            $conf->StocItemNume = $this->getItemTable()->getlastItem();
            $conf->Nume = 1;    //pr update
            //calcul restant
            $tabstock[$Nume + 4] = $tabstock[$Nume + 4] - (int) $item->NombBoit;
            $stock = implode("xy9k", $tabstock);
            $conf->Stoc = $stock;
            $conf = $this->getConfTable()->saveConf($conf);
            return $this->redirect()->toRoute('pharmacie');
        } 
        $col = array("Stoc");
        $result = $this->getConfTable()->select(null, null, null, $col)->toArray();
        $stock = "";
        if (isset($result) && !empty($result)) {
            $stock = $result[0]['Stoc'];
        }
        $tabstock = explode('xy9k', $stock);
        $this->tabstock($tabstock);
        $viewModel->form = $this->form;
        $viewModel->stock = $stock;
        $viewModel->medicament = $this->tabmedi;
        $viewModel->arv = $this->tabarv;
        $viewModel->consommable = $this->tabcons;
        $viewModel->laboratoire = $this->tablab;
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
 public function correspARV() {
         /*******************Tab correspondance *************************/
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
    public function createtabprod($resultdci) {
        $tab = array();
        foreach ($resultdci as $donne) {
            $tab[$donne->Nume] = array('Dci_' => $donne->Dci_, 'Dosa' => $donne->Dosa, 'Gale' => $donne->Gale, 'Typ_' => $donne->Typ_);
        }
        return $tab;
    }

    public function tabstock($stock) {
		$tabcorresp=$this->correspARV();
        $resultdci = $this->getDciTable()->select();
        $dcitab = $this->createtab($resultdci);
        $resultdosa = $this->getDosaTable()->select();
        $dosatab = $this->createtab($resultdosa);
        $resultgale = $this->getGaleTable()->select();
        $galetab = $this->createtab($resultgale);
        $resultprov = $this->getProvTable()->select();
        $provtab = $this->createtab($resultprov);
        $resultchrg = $this->getChrgTable()->select();
        $chrgtab = $this->createtab($resultchrg);
        $resultfabr = $this->getFabrTable()->select();
        $fabrtab = $this->createtab($resultfabr);
        $resultprod = $this->getProdTable()->select();
        $prodtab = $this->createtabprod($resultprod);

        $j = 0; //index medi
        $k = 0; //index arv
        $l = 0; //index cons
        $m = 0; //index lab
        /* nbr de prod dans stock */
        $i = 0;
        //parcours stoc
        while ($i < count($stock)) {
            if ($i % 8 == 0 && isset($prodtab[$stock[$i]])) {
                /*  calcule quantité */
                $nbr = $stock[$i + 4] + $stock[$i + 5];
                if ($nbr !== 0) {
					//si med
                    if ($prodtab[$stock[$i]]['Typ_'] == 1) {
                        $this->tabmedi[$j]['Desi'] = (isset($dcitab[$prodtab[$stock[$i]]['Dci_']]) ? $dcitab[$prodtab[$stock[$i]]['Dci_']] : "");
                        $this->tabmedi[$j]['Dosa'] = (isset($dosatab[$prodtab[$stock[$i]]['Dosa']]) ? $dosatab[$prodtab[$stock[$i]]['Dosa']] : "");
                        $this->tabmedi[$j]['Gale'] = (isset($galetab[$prodtab[$stock[$i]]['Gale']]) ? $galetab[$prodtab[$stock[$i]]['Gale']] : "");
                        $this->tabmedi[$j]['Fabr'] = (isset($fabrtab[$stock[$i + 1]]) ? $fabrtab[$stock[$i + 1]] : "");
                        $this->tabmedi[$j]['Lot'] = $stock[$i + 2];
                        $this->tabmedi[$j]['etat'] = 'bon';
                        //pour gestion des prod perimé
                        $date = date('Y-m-d', strtotime('last day of next month'));

                        $dateprod = strtr($stock[$i + 3], '/', '-');
                        $dateprod = date('Y-m-d', strtotime($dateprod));
                        if ($dateprod <= $date) {
                            $this->tabmedi[$j]['etat'] = 'perime';
                        }
                        $datepreemp = explode("/", $stock[$i + 3]);
                        $this->tabmedi[$j]['peremption'] = $datepreemp[1] . "/" . $datepreemp[2];
                        $this->tabmedi[$j]['Nbr'] = $nbr;
                        $this->tabmedi[$j]['Prov'] = (isset($provtab[$stock[$i + 6]]) ? $provtab[$stock[$i + 6]] : "");
                        $this->tabmedi[$j]['Chrg'] = (isset($chrgtab[$stock[$i + 7]]) ? $chrgtab[$stock[$i + 7]] : "");
                        /* indice de stock */
                        $this->tabmedi[$j]['Nume'] = $i;
                        $j++;
                    }
                    //si arv
                    if ($prodtab[$stock[$i]]['Typ_'] == 3) {
                        $dcidesi = (isset($dcitab[$prodtab[$stock[$i]]['Dci_']]) ? $dcitab[$prodtab[$stock[$i]]['Dci_']] : "");
						// $dcidesitab=explode(" + ",$dcidesi);
						// if(count($dcidesitab)>1){
							// for($t=0;$t<count($dcidesitab);$t++) {
								// if (array_key_exists($dcidesitab[$t], $tabcorresp))
									// $dcidesitab[$t]=$tabcorresp[$dcidesitab[$t]];    
							// }
							// $this->tabarv[$k]['Desi']=implode(" + ",$dcidesitab);
						// }
						// else
						// {    
							// $this->tabarv[$k]['Desi']=$dcidesitab[0]; 
							// if (array_key_exists($dcidesi, $tabcorresp))
								// $this->tabarv[$k]['Desi']=$tabcorresp[$dcidesi]; 
						// }
						$this->tabarv[$k]['Desi']=$dcidesi;
						$this->tabarv[$k]['Dosa'] = (isset($dosatab[$prodtab[$stock[$i]]['Dosa']]) ? $dosatab[$prodtab[$stock[$i]]['Dosa']] : "");
                        $this->tabarv[$k]['Gale'] = (isset($galetab[$prodtab[$stock[$i]]['Gale']]) ? $galetab[$prodtab[$stock[$i]]['Gale']] : "");
                        $this->tabarv[$k]['Fabr'] = (isset($fabrtab[$stock[$i + 1]]) ? $fabrtab[$stock[$i + 1]] : "");
                        $this->tabarv[$k]['Lot'] = $stock[$i + 2];
                        $this->tabarv[$k]['etat'] = 'bon';
                        //pour gestion des prod perimé
                        $date = date('Y-m-d', strtotime('last day of next month'));

                        $dateprod = strtr($stock[$i + 3], '/', '-');
                       $dateprod = date('Y-m-d', strtotime($dateprod));
                        if ($dateprod <= $date) {
                            $this->tabarv[$k]['etat'] = 'perime';
                        }
                        $datepreemp = explode("/", $stock[$i + 3]);
                        $this->tabarv[$k]['peremption'] = $datepreemp[1] . "/" . $datepreemp[2];
                        $this->tabarv[$k]['Nbr'] = $nbr;
                        $this->tabarv[$k]['Prov'] = (isset($provtab[$stock[$i + 6]]) ? $provtab[$stock[$i + 6]] : "");
                        $this->tabarv[$k]['Chrg'] = (isset($chrgtab[$stock[$i + 7]]) ? $chrgtab[$stock[$i + 7]] : "");
                        /* indice de stock */
                        $this->tabarv[$k]['Nume'] = $i;
                        $k++;
                    }
                    if ($prodtab[$stock[$i]]['Typ_'] == 2) {
                        $this->tabcons[$l]['Desi'] = (isset($dcitab[$prodtab[$stock[$i]]['Dci_']]) ? $dcitab[$prodtab[$stock[$i]]['Dci_']] : "");
                        $this->tabcons[$l]['Dosa'] = (isset($dosatab[$prodtab[$stock[$i]]['Dosa']]) ? $dosatab[$prodtab[$stock[$i]]['Dosa']] : "");
                        $this->tabcons[$l]['Gale'] = (isset($galetab[$prodtab[$stock[$i]]['Gale']]) ? $galetab[$prodtab[$stock[$i]]['Gale']] : "");
                        $this->tabcons[$l]['Fabr'] = (isset($fabrtab[$stock[$i + 1]]) ? $fabrtab[$stock[$i + 1]] : "");
                        $this->tabcons[$l]['Lot'] = $stock[$i + 2];
                        $this->tabcons[$l]['etat'] = 'bon';
                        //pour gestion des prod perimé
                        $date = date('Y-m-d', strtotime('last day of next month'));

                        $dateprod = strtr($stock[$i + 3], '/', '-');
                        $dateprod = date('Y-m-d', strtotime($dateprod));
                        if ($dateprod <= $date) {
                            $this->tabcons[$l]['etat'] = 'perime';
                        }
                        $datepreemp = explode("/", $stock[$i + 3]);
                        $this->tabcons[$l]['peremption'] = $datepreemp[1] . "/" . $datepreemp[2];
                        $this->tabcons[$l]['Nbr'] = $nbr;
                        $this->tabcons[$l]['Prov'] = (isset($provtab[$stock[$i + 6]]) ? $provtab[$stock[$i + 6]] : "");
                        $this->tabcons[$l]['Chrg'] = (isset($chrgtab[$stock[$i + 7]]) ? $chrgtab[$stock[$i + 7]] : "");
                        /* indice de stock */
                        $this->tabcons[$l]['Nume'] = $i;
                        $l++;
                    }
                    if ($prodtab[$stock[$i]]['Typ_'] == 4) {
                        $this->tablab[$m]['Desi'] = (isset($dcitab[$prodtab[$stock[$i]]['Dci_']]) ? $dcitab[$prodtab[$stock[$i]]['Dci_']] : "");
                        $this->tablab[$m]['Dosa'] = (isset($dosatab[$prodtab[$stock[$i]]['Dosa']]) ? $dosatab[$prodtab[$stock[$i]]['Dosa']] : "");
                        $this->tablab[$m]['Gale'] = (isset($galetab[$prodtab[$stock[$i]]['Gale']]) ? $galetab[$prodtab[$stock[$i]]['Gale']] : "");
                        $this->tablab[$m]['Fabr'] = (isset($fabrtab[$stock[$i + 1]]) ? $fabrtab[$stock[$i + 1]] : "");
                        $this->tablab[$m]['Lot'] = $stock[$i + 2];
                        $this->tablab[$m]['etat'] = 'bon';
                        //pour gestion des prod perimé
                        $date = date('Y-m-d', strtotime('last day of next month'));

                        $dateprod = strtr($stock[$i + 3], '/', '-');
                        $dateprod = date('Y-m-d', strtotime($dateprod));
                        if ($dateprod <= $date) {
                            $this->tablab[$m]['etat'] = 'perime';
                        }
                        $datepreemp = explode("/", $stock[$i + 3]);
                        $this->tablab[$m]['peremption'] = $datepreemp[1] . "/" . $datepreemp[2];
                        $this->tablab[$m]['Nbr'] = $nbr;
                        $this->tablab[$m]['Prov'] = (isset($provtab[$stock[$i + 6]]) ? $provtab[$stock[$i + 6]] : "");
                        $this->tablab[$m]['Chrg'] = (isset($chrgtab[$stock[$i + 7]]) ? $chrgtab[$stock[$i + 7]] : "");
                        /* indice de stock */
                        $this->tablab[$m]['Nume'] = $i;
                        $m++;
                    }
                }
            }
            $i++;
        }
    }

function restaure($itemtab,$stock){

//echo $stock;exit;
	foreach($itemtab as $item){
		if($item->Sour=='1' && $item->Dest=='2'){ //entrer
		
		$item->Expi=substr($item->Expi, 0, -9);
			$date=explode('-',$item->Expi);
			if(isset($date[0]))
				$dat=$date[2] . "/" . $date[1] . "/" . $date[0];
			$stock.= $item->Prod . "xy9k" . $item->Fabr . "xy9k" . $item->Lot_ . "xy9k" . $dat. "xy9k" . $item->NombBoit . "xy9k" . "0" . "xy9k" . $item->Prov . "xy9k" . $item->Chrg . "xy9k";
		}
		else
			if($item->Sour=='4' && $item->Dest=='6'){  //delivrance
				$tabstock = explode('xy9k', $stock);
				//echo $stock;
				$i = 0;
				while ($i < count($tabstock)) {
				if ($i % 8 == 0) { 
				
					if($tabstock[$i]== $item->Prod && $tabstock[$i+1]==$item->Fabr && $tabstock[$i+2]==$item->Lot_ ){
					{
					$tabstock[$i + 5]-=$item->NombUnit;
					break;}
					}
				}
				$i++;
				}
				$stock = implode("xy9k", $tabstock);
			
			}
			else
			if($item->Sour=='2'){   //sortie
			
				$tabstock = explode('xy9k', $stock);
				$i = 0;
				while ($i < count($tabstock)) {
				if ($i % 8 == 0) { 
					if($tabstock[$i]== $item->Prod && $tabstock[$i+1]==$item->Fabr && $tabstock[$i+2]==$item->Lot_ ){
					{
					$tabstock[$i + 4]-=$item->NombBoit;
					break;
					}
					}
				}
				$i++;
				} 
				$stock = implode("xy9k", $tabstock);
				
				}
}
echo $stock;
exit;
return($stock);
}


    public function addAction() {
        $viewModel = new ViewModel();
        //$viewModel->setTerminal(true);
        $this->form = new EntreForm();
        $Nume =  $this->params()->fromRoute('Nume', 0);
        $this->setPharmacieForm($Nume);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $item = new Item();
            $data = $request->getPost();
            $this->form->setData($data);
            $this->form->isValid();
            $item->exchangeArray($this->form->getData());
            $item->Modi = date("Y-m-d H:i:s");
            $item->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
            $date = $data->Expi . '';
            $date = date("Y-m-t", strtotime($date));
            $item->Lot_ = strtoupper($item->Lot_);
            $item->Expi = $date;
            $item->Sour = 1;
            $item->Dest = 2;
			$itemsave = $this->getItemTable()->saveItem($item);
			//mise a jour du stoc
			$conf = $this->getConfTable()->getConf(1);
            $where = null;
            $order = "Nume DESC";
            $limit = null;
            $col = "Nume";
            $Nume=$this->getItemTable()->getlastItem();
            $conf->StocItemNume = $Nume;
            $conf->Nume = 1;    //pr update
            $col = array("Stoc");
            $result = $this->getConfTable()->select(null, null, null, $col)->toArray();
            $stock = "";
            if (isset($result)) {
                $stock = $result[0]['Stoc'];
            }
            $date = explode('-', $date);
			$stock= $this->updatestoc($stock,$item);
			
            $conf->Stoc = $stock;
            $conf = $this->getConfTable()->saveConf($conf);
            $this->flashMessenger()->addSuccessMessage('Ajouté avec succès!');
                return $this->redirect()->toRoute('pharmacie');
        }
        $viewModel->form = $this->form;
        $viewModel->medicament = $this->tabprod;
        return $viewModel;
    }
	public function updatestoc($stock,$item){
		$tabstock = explode('xy9k', $stock);
		$date = explode('-', $item->Expi);
		$date = $date[2].'/'.$date[1].'/'.$date[0];
        $i = 0;
		$bool=0;
        $j = count($tabstock)-1;
		for($i=0;$i<$j;$i+=8){
			if ($tabstock[$i] == $item->Prod && $tabstock[$i + 1] == $item->Fabr && $tabstock[$i + 2] == $item->Lot_ && $tabstock[$i + 3] == $date) { 
				$bool=1;
				$tabstock[$i + 4] += $item->NombBoit;
				break;
            }	
		}
        $stock = implode("xy9k", $tabstock);
		if($bool==0){
			$stock.= $item->Prod . "xy9k" . $item->Fabr . "xy9k" . $item->Lot_ . "xy9k" . $date . "xy9k" . $item->NombBoit . "xy9k" . "0" . "xy9k" . $item->Prov . "xy9k" . $item->Chrg . "xy9k";
		}
		return $stock;
	}

    public function setPharmacieForm($Type) {

        $prov = $this->getProvTable()->select();   //a revoir trop de connexion
        foreach ($prov as $provs) {
            $this->form->Prov[$provs->Nume] = $provs->Desi;
        }
        $fabr = $this->getFabrTable()->select();   //a revoir trop de connexion
        foreach ($fabr as $fabrs) {
            $this->form->Fabr[$fabrs->Nume] = $fabrs->Desi;
        }
        $chrg = $this->getChrgTable()->select();
        foreach ($chrg as $chrgs) {
            $this->form->Chrg[$chrgs->Nume] = $chrgs->Desi;
        }
        $itemdest = $this->getItemdestTable()->select();
        foreach ($itemdest as $itemdests) {
            $this->form->Dest[$itemdests->Nume] = $itemdests->Desi;
        }
        $resultdci = $this->getDciTable()->select("Typ_=$Type");
        $dcitab = $this->createtab($resultdci);
        $resultdosa = $this->getDosaTable()->select(null, 'Desi');
        $dosatab = $this->createtab($resultdosa);
        $resultgale = $this->getGaleTable()->select(null, 'Desi');
        $galetab = $this->createtab($resultgale);
        $resultprod = $this->getProdTable()->select("Typ_=$Type");

        //pour verifier si le produit est en stock
        $col = array("Stoc");
        $result = $this->getConfTable()->select(null, null, null, $col)->toArray();
        $stock = "";
        if (isset($result[0]['Stoc'])) {
            $stock = $result[0]['Stoc'];
        }
        $stock = explode('xy9k', $stock);
        $i = 0;
        //recup tous les prod en stoc
        $prodstock = array();
        while ($i < count($stock)) {
            if ($i % 8 == 0) {
                $prodstock[] = $stock[$i];
            }
            $i++;
        }
        $i = 0;
        foreach ($resultprod as $resulte) {
            $this->form->Prod[$resulte->Nume] = (isset($dcitab[$resulte->Dci_]) ? $dcitab[$resulte->Dci_] : "") . " " . (isset($dosatab[$resulte->Dosa]) ? $dosatab[$resulte->Dosa] : "") . " " . (isset($galetab[$resulte->Gale]) ? $galetab[$resulte->Gale] : "") . (!empty($resulte->Cont) ? " (" . $resulte->Cont . " " . $resulte->Unit . ")" : "");
            $this->tabprod[$i]['Produit'] = (isset($dcitab[$resulte->Dci_]) ? $dcitab[$resulte->Dci_] : "") . " " . (isset($dosatab[$resulte->Dosa]) ? $dosatab[$resulte->Dosa] : "") . " " . (isset($galetab[$resulte->Gale]) ? $galetab[$resulte->Gale] : "") . (!empty($resulte->Cont) ? " (" . $resulte->Cont . " " . $resulte->Unit . ")" : "");

            $this->tabprod[$i]['data'] = $resulte->Dci_ . "$" . $resulte->Dosa . "$" . $resulte->Gale . "$" . $resulte->Cont . "$" . $resulte->Unit;


            if (array_search($resulte->Nume, $prodstock))
                $this->tabprod[$i]['enstock'] = 'OK';
            else
                $this->tabprod[$i]['enstock'] = 'NOK';

            $this->tabprod[$i]['Nume'] = $resulte->Nume;
            $i++;
        }
        $this->form->get('ProdForm')->Dosa = $dosatab;
        $this->form->get('ProdForm')->Gale = $galetab;
        $this->form->get('ProdForm')->Dci_ = $dcitab;
        $this->form->get('ProdForm')->Type = $Type;
        $this->form->get('ProdForm')->initialise();
        $this->form->initialise();
    }

    public function setSortieForm() {
        $itemdest = $this->getItemdestTable()->select();
        foreach ($itemdest as $itemdests) {
            $this->form->Dest[$itemdests->Nume] = $itemdests->Desi;
        }
        $this->form->initialise();
    }

    public function tabformat($tab) {
        foreach ($tab as $key => $valeur) {
            if (!is_array($valeur)) {
                $donnee[$key] = $valeur;
            } else {
                // print_r($valeur);
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

    public function AjaxAction() {
        $prod = new Prod();
        $ajouter = true;
        //gestion double si ajout
        //  if (!$_POST['Nume']) {
        $where = "(Typ_='" . $_POST['Typ_'] . "')AND(Dci_='" . $_POST['Dci_'] . "')AND(Dosa='" . $_POST['Dosa'] . "')AND(Gale='" . $_POST['Gale'] . "')AND(Unit='" . $_POST['Unit'] . "')";
        $resultprod = $this->getProdTable()->select($where)->toArray();
        $ajouter = false;
        if (!empty($resultprod)) { //si sa existe
            for ($i = 0; $i < count($resultprod); $i++) {//verifi la contenance
                if ($resultprod[$i]['Cont'] == $_POST['Cont']) {
                    $res = $prod->getArrayCopy();
                    $ajouter = false;
                    break;
                } else {
                    $ajouter = true;
                }
            }
        } else { //si ca n'existe pas 
            $ajouter = true;
        }
        //}

        if ($ajouter) {
            $prod->Nume = $_POST['Nume'];
            $prod->Cont = $_POST['Cont'];
            $prod->Dci_ = $_POST['Dci_'];
            $prod->Dci_Desi = $_POST['Dci_Desi'];
            $prod->Dosa = $_POST['Dosa'];
            $prod->DosaDesi = $_POST['DosaDesi'];
            $prod->Gale = $_POST['Gale'];
            $prod->GaleDesi = $_POST['GaleDesi'];
            $prod->Typ_ = $_POST['Typ_'];
            $prod->Unit = $_POST['Unit'];
            $prod->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
            $prod->Modi = date("Y-m-d H:i:s");
            if(!$prod->Nume) 
                $prod->Nume="14".hexdec(uniqid());
            $prod = $this->getProdTable()->saveProd($prod);
            $res = $prod->getArrayCopy();
        }
        return new \Zend\View\Model\JsonModel($res);
    }

    public function delprodAction() {
        $Nume = $_POST['Nume'];
        $this->getProdTable()->deleteProd($Nume);
        return new \Zend\View\Model\JsonModel();
    }

   /* public function editAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume = (int) $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('dispensation', array(
                        'action' => 'add'
            ));
        }
        $col = array("Stoc");
        $result = $this->getConfTable()->select(null, null, null, $col)->toArray();
        $stock = "";
        if (isset($result)) {
            $stock = $result[0]['Stoc'];
        }
        $tabstock = explode('xy9k', $stock);
        $this->form = new EntreForm();
        $this->setPharmacieForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $doss = new Doss();
            $data = $request->getPost();
            $this->form->setData($data);
            $this->form->isValid();
            $tab = $this->form->getData();
            $donnee = $this->tabformat($tab);
            $doss->exchangeArray($donnee);


            /*             * *** format date *** 
            $doss->OuvrDat_ = $this->formatdate($doss->OuvrDat_);
            $doss->MediDepiDat_ = $this->formatdate($doss->MediDepiDat_);
            $doss->RensDeceDat_ = $this->formatdate($doss->RensDeceDat_);
            $doss->RensIarvDat_ = $this->formatdate($doss->RensIarvDat_);
            $doss->RensNaisDat_ = $this->formatdate($doss->RensNaisDat_);
            $doss->RensNon_SuivDat_ = $this->formatdate($doss->RensNon_SuivDat_);
            $doss->SociAutrAgr_Dat_ = $this->formatdate($doss->SociAutrAgr_Dat_);
            $doss->TranDat_ = $this->formatdate($doss->TranDat_);
            /*             * * *
            $doss->Modi = date("Y-m-d H:i:s");
            $doss->Util = $this->zfcUserAuthentication()->getIdentity()->getId();


            $doss = $this->getDossTable()->saveDoss($doss);
                $this->flashMessenger()->addSuccessMessage('modifié avec succès!');
                return $this->redirect()->toRoute('dispensation');
        } else {

            // $this->form->get('')->setValue($donnee);
            $this->form->get('Lot_')->setValue($tabstock[$Nume + 2]);
            $this->form->get('NombBoit')->setValue($tabstock[$Nume + 4]);
            //traitement
            $this->form->get('Expi_moi')->setValue('09');
            $this->form->get('Expi_annee')->setValue('2016');
            $this->form->get('Prov')->setValue($tabstock[$Nume + 6]);
            $this->form->get('Fabr')->setValue($tabstock[$Nume + 1]);
            $this->form->get('Chrg')->setValue($tabstock[$Nume + 7]);
            $this->form->get('Dat_')->setValue($tabstock[$Nume + 3]);
        }
        $viewModel->form = $this->form;
        $viewModel->medicament = $this->tabmedi;
        $viewModel->arv = $this->tabarv;
        $viewModel->consommable = $this->tabcons;
        $viewModel->laboratoire = $this->tablab;
        $viewModel->Nume = $Nume;
        $viewModel->Prod = $tabstock[$Nume];
        $viewModel->Nume = $Nume;
        return $viewModel;
    }
*/
  /*  public function deleteAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume = (int) $this->params()->fromRoute('Nume', 0);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');
            if ($del == 'Oui') {
                $Nume = (int) $request->getPost('Nume');
                $col = array("Stoc");
                $result = $this->getConfTable()->select(null, null, null, $col)->toArray();
                $stock = "";
                if (isset($result)) {
                    $stock = $result[0]['Stoc'];
                }
                $tabstock = explode('xy9k', $stock);
                $cpt = 0;
                while ($cpt < 8) {
                    unset($tabstock[$Nume + $cpt]);
                    $cpt++;
                }
                $tabstock = array_values($tabstock);
                $stock = implode("xy9k", $tabstock);
                $conf = new Conf();
                $where = null;
                $order = "Nume DESC";
                $limit = null;
                $col = "Nume";
                $result = $this->getItemTable()->select($where, $order, $limit, $col)->toArray();
                $Nume = "";
                if (isset($result)) {
                    $Nume = $result[0]['Nume'];
                }
                $conf->StocItemNume = $Nume;
                $conf->Nume = 1;    //pr update
                $conf->AlerMess = "";
                $conf->Dat_Vers = "2008-11-21 00:00:00";
                $conf->Dat_VersMini = "2012-05-19 00:00:00";
                $conf->ExecVers = "1.7";
                $conf->SauvHeur = 20;
                $conf->Stoc = $stock;
                $conf = $this->getConfTable()->saveConf($conf);
            }
            // Redirect to list of dispensation
            $this->flashMessenger()->addSuccessMessage('supprimé avec succès!');
                return $this->redirect()->toRoute('pharmacie');
        }

        $viewModel->Nume = $Nume;
        return $viewModel;
    } */

    public function getDossTable() {
        if (!$this->dossTable) {
            $sm = $this->getServiceLocator();
            $this->dossTable = $sm->get('Pharmacie\Model\DossTable');
        }
        return $this->dossTable;
    }

    public function getConfTable() {
        if (!$this->confTable) {
            $sm = $this->getServiceLocator();
            $this->confTable = $sm->get('Pharmacie\Model\ConfTable');
        }
        return $this->confTable;
    }

    public function getLocaTable() {
        if (!$this->locaTable) {
            $sm = $this->getServiceLocator();
            $this->locaTable = $sm->get('Pharmacie\Model\LocaTable');
        }
        return $this->locaTable;
    }

    public function getDciTable() {
        if (!$this->dciTable) {
            $sm = $this->getServiceLocator();
            $this->dciTable = $sm->get('Pharmacie\Model\DciTable');
        }
        return $this->dciTable;
    }

    public function getProdTable() {
        if (!$this->prodTable) {
            $sm = $this->getServiceLocator();
            $this->prodTable = $sm->get('Pharmacie\Model\ProdTable');
        }
        return $this->prodTable;
    }

    public function getMediconsTable() {
        if (!$this->mediconsTable) {
            $sm = $this->getServiceLocator();
            $this->mediconsTable = $sm->get('Pharmacie\Model\MediconsTable');
        }
        return $this->mediconsTable;
    }

    public function getDosaTable() {
        if (!$this->dosaTable) {
            $sm = $this->getServiceLocator();
            $this->dosaTable = $sm->get('Pharmacie\Model\DosaTable');
        }
        return $this->dosaTable;
    }

    public function getGaleTable() {
        if (!$this->galeTable) {
            $sm = $this->getServiceLocator();
            $this->galeTable = $sm->get('Pharmacie\Model\GaleTable');
        }
        return $this->galeTable;
    }

    public function getFabrTable() {
        if (!$this->fabrTable) {
            $sm = $this->getServiceLocator();
            $this->fabrTable = $sm->get('Pharmacie\Model\FabrTable');
        }
        return $this->fabrTable;
    }

    public function getItemTable() {
        if (!$this->itemTable) {
            $sm = $this->getServiceLocator();
            $this->itemTable = $sm->get('Pharmacie\Model\ItemTable');
        }
        return $this->itemTable;
    }

    public function getProvTable() {
        if (!$this->provTable) {
            $sm = $this->getServiceLocator();
            $this->provTable = $sm->get('Pharmacie\Model\ProvTable');
        }
        return $this->provTable;
    }

    public function getChrgTable() {
        if (!$this->chrgTable) {
            $sm = $this->getServiceLocator();
            $this->chrgTable = $sm->get('Pharmacie\Model\ChrgTable');
        }
        return $this->chrgTable;
    }

    public function getItemdestTable() {
        if (!$this->itemdestTable) {
            $sm = $this->getServiceLocator();
            $this->itemdest = $sm->get('Pharmacie\Model\ItemdestTable');
        }
        return $this->itemdest;
    }

}
