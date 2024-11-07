<?php

namespace Accueil\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Accueil\Model\Entr;
use Accueil\Form\AccueilForm;

class AccueilController extends AbstractActionController {

    protected $entrTable;
    protected $dossTable;
    protected $listTable;
    protected $userTable;
    protected $centreTable;

    public function inday($Ref_, $date) {
        $where = " Cta_Nume = '$Ref_' and ArriHoro <= '$date 23:59:59' and ArriHoro >= '$date 00:00:00'";    
        $res = $this->getEntrTable()->select($where, "Nume desc", null);
        if (count($res) > 0) {
            $ling = $res->current();
            return $ling->Nume;
        }
        return 0;
    }

    public function indexAction() {
        $prefix = new \Zend\Session\Container('prefixe');
        $prefixe = $prefix->offsetGet('prefixe');
        $prefixeagent = $prefix->offsetGet('prefixeagent');
        return new ViewModel(array(
            'daymin' => date('Y-m-d'),
            'daymax' => date('Y-m-d'),
            'prefixe' => $prefixe,
            'prefixeagent'=> $prefixeagent,
        ));
    }

    public function addAction() {
        $viewModel = new ViewModel();
        $form = new AccueilForm();
        $form->get('Moti')->setOptions(array('value_options' => $this->getOptionsForSelect($this->getListTable()->select("Typ_ = 'Accueil | Moti'", 'Desi'), 'Desi', 'Desi')));
        $form->get('Prec')->setOptions(array('value_options' => $this->getActiveOptionsForSelect($this->getListTable()->select("Typ_ = 'Accueil | Prec'", 'Desi'), 'Desi', 'Desi')));
        $request = $this->getRequest();
        if ($request->isPost()) {
            $entr = new Entr();
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $Cta_Nume = $form->get('Cta_Nume')->getValue();
                if ($Cta_Nume != null) {
					$Cta_Nume = strtoupper($Cta_Nume);
                    $prefixe = new \Zend\Session\Container('prefixe');
                    $codereg = $prefixe->offsetGet('codereg');
                    $codestruct = $prefixe->offsetGet('codestruct');
                    $code = $codereg . $codestruct;
                    if(strpos($Cta_Nume, $codestruct) === false)
                    {
                        $Cta_Nume = $code.$Cta_Nume;
                    }
                    $doss = $this->getDossTable()->getDossByRef_($Cta_Nume);
                    $datehoro = date('Y-m-d', strtotime($form->get('ArriHoro')->getValue()));                   
                    if (count($doss) > 0) {
                        $numredi = $this->inday($Cta_Nume, $datehoro);
                        if ($numredi != 0) {
                            $this->flashMessenger()->addWarningMessage('Modifier arrivée enregistrer');
                            return $this->redirect()->toRoute('accueil', array(
                                        'action' => 'edit', 'Nume' => $numredi
                            ));
                        }
                        $entr->Nume =  "14".hexdec(uniqid());
                        $entr->Doss = $doss->Nume;
                        $entr->Cta_Nume = $doss->Ref_;
                        $entr->Nom_ = $doss->RensNom_;
                        $entr->Pnom = $doss->RensPnom;
                        $entr->Age_ = $doss->RensAge_;
                        if ($doss->RensSexe = 1) {
                            $entr->Sexe = 'M.';
                        } else {
                            $entr->Sexe = 'Mme';
                        }
                    } else {
                        $form->get('Cta_Nume')->setAttribute("class", "btn-danger");
                        $viewModel->form = $form;
                        return $viewModel;
                    }
                } else {
                    $entr->exchangeArray($form->getData());
                }
                $Prec = "";
                $Moti = "";
                if ($form->get('Prec')->getValue() != '') {
                    $Prec = implode(" - ", $form->get('Prec')->getValue());
                    $form->remove('Prec');
                }
                if ($form->get('Moti')->getValue() != '') {
                    $Moti = implode(" - ", $form->get('Moti')->getValue());
                    $form->remove('Moti');
                }

                $entr->Prec = $Prec;
                $entr->Moti = $Moti;
                $entr->Arri = 1;

                $entr->ArriHoro = $form->get('ArriHoro')->getValue();
                $entr->ArriHeur = date('H', strtotime($entr->ArriHoro)) . "h" . date('i', strtotime($entr->ArriHoro));
                $entr->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $entr = $this->getEntrTable()->saveEntr($entr);

                // Redirect to list of accueil
                $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                return $this->redirect()->toRoute('accueil');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function editAction() {
        $viewModel = new ViewModel();
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('accueil', array(
                        'action' => 'add'
            ));
        }
        $entr = $this->getEntrTable()->getEntr($Nume);
        $form = new AccueilForm();
        $form->get('Moti')->setOptions(array('value_options' => $this->getOptionsForSelect($this->getListTable()->select("Typ_ = 'Accueil | Moti'"), 'Desi', 'Desi')));
        $form->get('Prec')->setOptions(array('value_options' => $this->getOptionsForSelect($this->getListTable()->select("Typ_ = 'Accueil | Prec'"), 'Desi', 'Desi')));
        $active = $this->getActiveOptionsForSelect($this->getListTable()->select("Typ_ = 'Accueil | Prec'"), 'Desi', 'Desi');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $form->get('Nume')->setValue($Nume);
            if ($form->isValid()) {
                $Prec = "";
                $Moti = "";
                if ($form->get('Prec')->getValue() != '') {
                    $Prec = implode(" - ", $form->get('Prec')->getValue());
                    $form->remove('Prec');
                }
                if ($form->get('Moti')->getValue() != '') {
                    $Moti = implode(" - ", $form->get('Moti')->getValue());
                    $form->remove('Moti');
                }
                //$entr->someValues($form->getData()); ARV
                $entr->exchangeArray($form->getData());
                //ajouter 1726
                $entr->Arri = 1;
                
                $entr->Prec = $Prec;
                $entr->Moti = $Moti;
                $entr->ArriHoro = $form->get('ArriHoro')->getValue();
                $entr->ArriHeur = date('H', strtotime($entr->ArriHoro)) . "h" . date('i', strtotime($entr->ArriHoro));

                $entr->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $this->getEntrTable()->saveEntr($entr);
                $this->flashMessenger()->addSuccessMessage('La modification a été faite avec succés.');
                return $this->redirect()->toRoute('accueil');
            }
        } else {
            $form->bind($entr);
            if ($entr->Prec && !is_object($entr->Prec)) {
                $Prec = explode(" - ", $entr->Prec);
                $form->get('Prec')->setValue($Prec);
            }
            if ($entr->Moti && !is_object($entr->Moti)) {
                $Moti = explode(" - ", $entr->Moti);
                $form->get('Moti')->setValue($Moti);
            }
            if (!is_null($entr->ArriHoro))
                $form->get('ArriHoro')->setValue(date('Y-m-d\TH:i', strtotime($entr->ArriHoro)));

            /* $options = $form->get('Prec')->getValueOptions();

              foreach ($options  as $value)
              {
              $disabled=true;
              if(array_key_exists($options [$value],$active))
              $disabled=false;

              $options [$value] = [
              'label' => $options [$value],
              'disabled' => $disabled,
              'value' => $value
              ];
              }
              $form->get('Prec')->setValueOptions($options); */
        }
        $viewModel->form = $form;
        $viewModel->Nume = $Nume;
        return $viewModel;
    }

    public function deleteAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('accueil');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $Nume =  $request->getPost('Nume');
                $entr = $this->getEntrTable()->getEntr($Nume);
                if ($entr->Rdv_Heur == null) {
                    $this->getEntrTable()->deleteEntr($Nume);
                } else {
                    $entr->Arri = 0;
                    $entr->ArriHoro = null;
                    $entr->ArriHeur = null;
                    $this->getEntrTable()->saveEntr($entr);
                }
            }

            // Redirect to list of accueil
            $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            return $this->redirect()->toRoute('accueil');
        }

        $viewModel->Nume = $Nume;
        $viewModel->entr = $this->getEntrTable()->getEntr($Nume);
        return $viewModel;
    }

    public function rdvAction() {
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('accueil');
        }

        $entr = $this->getEntrTable()->getEntr($Nume);
        if ($entr->Arri == 0) {
            $entr->Arri = 1;
            $entr->ArriHoro = date("Y-m-d H:i:s");
            $entr->ArriHeur = date("H") . "h" . date("i");
            $entr->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
        }
        $this->getEntrTable()->saveEntr($entr);
        return $this->redirect()->toRoute('accueil');
    }

    public function rdvlistAction() {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $daymax = date("Y-m-d", strtotime($this->getRequest()->getPost('daymax', date("Y-m-d"))));
            $daymin = date("Y-m-d", strtotime($this->getRequest()->getPost('daymin', date("Y-m-d"))));
        } else {
            $daymax = date("Y-m-d");
            $daymin = date("Y-m-d");
        }
        $where = "Rdv_Horo >= '$daymin 00:00:00' and  Rdv_Horo <= '$daymax 23:59:59'";
        return new ViewModel(array(
            'daymax' => $daymax,
            'daymin' => $daymin,
            'Rdvs' => $this->getEntrTable()->select($where, "Rdv_Horo ASC")
        ));
    }

    public function majrdvAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('accueil', array(
                        'action' => 'rdvlist'
            ));
        }
        $comm = $this->getEntrTable()->getEntr($Nume);
        $form = new \Accueil\Form\RdvForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $comm->someValues($form->getData());
                $this->getEntrTable()->saveEntr($comm);
                return $this->redirect()->toRoute('accueil', array(
                            'action' => 'rdvlist'));
            }
        } else {
            $form->bind($comm);
        }
        $viewModel->form = $form;
        $viewModel->Nume = $Nume;
        return $viewModel;
    }

    public function planningAction() {
        $daymin = date("Y-m-d", strtotime("-1 year", strtotime(date("Y-m-d"))));
        $where = "Arri = 0 AND Rdv_Horo > '$daymin 00:00:00'";
        return new ViewModel(array(
            'entrs' => $this->getEntrTable()->select($where, "Rdv_Horo  DESC"),
        ));
    }

    public function dataAction() {
        $daymax = $this->params()->fromQuery('daymax');
        $daymin = $this->params()->fromQuery('daymin');
        $array = $this->params()->fromQuery();

        $array['where'] = "";
        if ($daymax != '') {
            if ($daymin != '') {
                $array['where'] = "(ArriHoro <= '$daymax 23:59:59' AND ArriHoro >= '$daymin 00:00:00')";
                $array['where'] .= " OR (Rdv_Horo <= '$daymax 23:59:59' AND Rdv_Horo >= '$daymin 00:00:00')";
            } else {
                $array['where'] = "(ArriHoro <= '$daymax 23:59:59')";
                $array['where'] .= " OR (Rdv_Horo <= '$daymax 23:59:59')";
            }
        }
        if ($daymin != '') {
            if ($daymax != '') {
                $array['where'] = "(ArriHoro <= '$daymax 23:59:59' AND ArriHoro >= '$daymin 00:00:00')";
                $array['where'] .= " OR (Rdv_Horo <= '$daymax 23:59:59' AND Rdv_Horo >= '$daymin 00:00:00')";
            } else {
                $array['where'] = "(ArriHoro >= '$daymin 00:00:00')";
                $array['where'] .= " OR (Rdv_Horo >= '$daymin 00:00:00')";
            }
        }
        $model = new JsonModel();
        $datatable = $this->getServiceLocator()->get('accueildatatable');
        $result = $datatable->getResult($array);
        $model->setVariable('draw', $result->getDraw());
        $model->setVariable('recordsTotal', $result->getRecordsTotal());
        $model->setVariable('recordsFiltered', $result->getRecordsFiltered());
        $model->setVariable('data', $result->getData());
        return $model;
    }

    public function getEntrTable() {
        if (!$this->entrTable) {
            $sm = $this->getServiceLocator();
            $this->entrTable = $sm->get('Accueil\Model\EntrTable');
        }
        return $this->entrTable;
    }

    public function getDossTable() {
        if (!$this->dossTable) {
            $sm = $this->getServiceLocator();
            $this->dossTable = $sm->get('Accueil\Model\DossTable');
        }
        return $this->dossTable;
    }

    public function getListTable() {
        if (!$this->listTable) {
            $sm = $this->getServiceLocator();
            $this->listTable = $sm->get('Accueil\Model\ListeTable');
        }
        return $this->listTable;
    }

    public function getOptionsForSelect($array, $key, $value) {
        $select = array();
        foreach ($array as $res) {

            $select[$res->$key] = $res->$value;
        }
        return $select;
    }

    public function getActiveOptionsForSelect($array, $key, $value) {
        $select = array();
        foreach ($array as $res) {
            if ($res->state == 1)
                $select[$res->$key] = $res->$value;
        }
        return $select;
    }
     public function getUserTable() {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Parametres\Model\UserTable');
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
