<?php

namespace Communaute\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Communaute\Model\Entr;
use Zend\View\Model\JsonModel;
use Communaute\Model\Comm;
use Communaute\Form\CommunauteForm;
use Communaute\Form\DossForm;
use Communaute\Form\OevForm;

class CommunauteController extends AbstractActionController {

    protected $entrTable;
    protected $dossTable;
    protected $oevTable;
    protected $commTable;
    protected $commdossTable;
    protected $userTable;
    protected $centreTable;
    protected $listTable;

    public function dataAction() {
        $daymax = $this->params()->fromQuery('daymax');
        $daymin = $this->params()->fromQuery('daymin');
        $array = $this->params()->fromQuery();

        if ($daymax != '') {
            $array['where'][] = new \Zend\Db\Sql\Predicate\Operator('Dat_', '<=', "$daymax 23:59:59");
        }
        if ($daymin != '') {
            $array['where'][] = new \Zend\Db\Sql\Predicate\Operator('Dat_', '>=', "$daymin 00:00:00");
        }

        $model = new JsonModel();
        $datatable = $this->getServiceLocator()->get('communautedatatable');
        $result = $datatable->getResult($array);
        $model->setVariable('draw', $result->getDraw());
        $model->setVariable('recordsTotal', $result->getRecordsTotal());
        $model->setVariable('recordsFiltered', $result->getRecordsFiltered());
        $model->setVariable('data', $result->getData());
        return $model;
    }

    public function indexAction() {
        return new ViewModel(array(
            'daymin' => date('Y-m-d'),
            'daymax' => date('Y-m-d'),
        ));
    }

    public function addAction() {
        $viewModel = new ViewModel();
        //  $viewModel->setTerminal(true);
        $form = new CommunauteForm();
        $form->get('Acti')->setOptions(array('value_options' => $this->getOptionsForSelect($this->getListTable()->select("Typ_ = 'Communauté | Activité'", 'Desi'), 'Desi', 'Desi')));
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $comm = new Comm();
                $comm->exchangeArray($form->getData());
                $comm->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $comm->Modi = date("Y-m-d H:i:s");
                $comm = $this->getCommTable()->saveComm($comm);
                // Redirect to list of accueil
                return $this->redirect()->toRoute('communaute');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function editAction() {
        $viewModel = new ViewModel();
        $Nume = $this->params()->fromRoute('Nume', 0);

        if (!$Nume) {
            return $this->redirect()->toRoute('communaute', array(
                        'action' => 'add'
            ));
        }
        $comm = $this->getCommTable()->getComm($Nume);
        if ($comm->Dat_)
            $comm->Dat_ = substr($comm->Dat_, 0, -9);
        $form = new CommunauteForm();
        $form->get('Acti')->setOptions(array('value_options' => $this->getOptionsForSelect($this->getListTable()->select("Typ_ = 'Communauté | Activité'", 'Desi'), 'Desi', 'Desi')));
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $comm->someValues($form->getData());
                $comm->Modi = date("Y-m-d H:i:s");
                $comm->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $this->getCommTable()->saveComm($comm);
                return $this->redirect()->toRoute('communaute');
            }
        } else {
            $form->bind($comm);
        }
        $viewModel->form = $form;
        $viewModel->Nume = $Nume;
        return $viewModel;
    }

    public function deleteAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume = $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('communaute');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $Nume = $request->getPost('Nume');
                $this->getCommTable()->deleteComm($Nume);
            }

            // Redirect to list of communaute
            return $this->redirect()->toRoute('communaute');
        }

        $viewModel->Nume = $Nume;
        $viewModel->entr = $this->getCommTable()->getComm($Nume);
        return $viewModel;
    }

    public function moreAction() {
        $viewModel = new ViewModel();
        //$viewModel->setTerminal(true);
        $Nume = $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('communaute');
        }
        //$Commdoss = new \Communaute\Model\Commdoss();
        $Commdoss = $this->getCommTable()->getComm($Nume);
        $date = date('Y-m-d', strtotime($Commdoss->Dat_ . ' -1 month'));
        $Commdoss1 = $this->getCommTable()->select('Acti = "' . $Commdoss->Acti . '" And Dat_>="' . $date . '" And Nume<>' . $Nume)->toArray();
        $Commdoss = $Commdoss->getArrayCopy();
        $order = "Ref_ ASC";
        $viewModel->comm = $Commdoss;
        $viewModel->commprec = $Commdoss1;
        $viewModel->OevForm = new OevForm();
        $viewModel->DossForm = new DossForm();
        $viewModel->Doss = $this->utf8_converter($this->getCommdossTable()->select("(Comm=$Nume)AND(Doss>0)", $order)->toArray());
        $viewModel->Oev_ = $this->getCommdossTable()->select("(Comm=$Nume)AND(Oev_>0)", $order);
        return $viewModel;
    }

    function utf8_converter($array) {
        array_walk_recursive($array, function(&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });

        return $array;
    }

    public function AjaxAction() {
        $Nume = $_POST['Nume'];
        $Nume = strtoupper($Nume);
        $prefix = new \Zend\Session\Container('prefixe');
        $prefixe = $prefix->offsetGet('prefixe');
        $codereg = $prefix->offsetGet('codereg');
        $codestruct = $prefix->offsetGet('codestruct');
        $code = $codereg . $codestruct;


        if (strpos($Nume, $codestruct) === false) {
            $Nume = $code . $Nume;
        }
        $Comm = $_POST['Comm'];
        $Motif = $_POST['Motif'];
        $Commdoss = new \Communaute\Model\Commdoss();
        $DossByRef_ = $this->getDossTable()->getDossByRef_up($Nume, $prefixe);
        //gestion doublure et un patient ne peut pas participé a une meme activité dans le meme moi

        $where = "Ref_='" . $DossByRef_->Ref_ . "'" . "AND Oev_=0 AND (Comm='" . $Comm . "' ";
        if (isset($_POST['Commp'])) {
            $Commp = $_POST['Commp'];
            foreach ($Commp as $Commprec) {
                $where .= " or Comm='" . $Commprec . "' ";
            }
        }
        $where .= ")";
        $order = "Modi DESC";
        $result = $this->getCommdossTable()->select($where, $order);
        $foi = $result->count();
        if ($foi == '0' || ($foi != '0' && $Motif)) {
            $Commdoss->Nume = "14".hexdec(uniqid());
            $Commdoss->Comm = $Comm;
            $Commdoss->Motif = $Motif;
            $Commdoss->Ref_ = $DossByRef_->Ref_;
            $Commdoss->Nom_ = $DossByRef_->RensNom_;
            $Commdoss->Pnom = $DossByRef_->RensPnom;
            $Commdoss->Sexe = $DossByRef_->RensSexe;
            $Commdoss->Age_ = $DossByRef_->RensAge_;
            $Commdoss->Oev_ = 0;
            $Commdoss->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
            $Commdoss->Modi = date("Y-m-d H:i:s");
            $Commdoss->Doss = $DossByRef_->Nume;
            $Commdoss->prefixe = $prefixe;
            $Commdoss = $this->getCommdossTable()->saveCommdoss($Commdoss);

            $res = $Commdoss->getArrayCopy();
        } else {
            if ($foi != '0') {
                $Commdoss->Nume = -1; //existe deja
                foreach ($result as $Commprec) {
                    $Commdoss->Modi = $Commprec->Modi;
                    break;
                }
                $res = $Commdoss->getArrayCopy();
            }
        }
        return new \Zend\View\Model\JsonModel($res);
    }

    public function Ajax2Action() {
        if (isset($_POST['Nume'])) {
            $Nume = strtoupper($_POST['Nume']);
            $prefix = new \Zend\Session\Container('prefixe');
            $prefixe = $prefix->offsetGet('prefixe');
            $codereg = $prefix->offsetGet('codereg');
            $codestruct = $prefix->offsetGet('codestruct');
            $code = $codereg . $codestruct;
            if (strpos($Nume, $codestruct) === false) {
                $Nume = $code . $Nume;
            }
            $Motif = $_POST['Motif'];
            $Comm = $_POST['Comm'];
            $Commdoss = new \Communaute\Model\Commdoss();
            $oev = $this->getOevTable()->getOevByRef_up($Nume, $prefixe);
            //gestion doublure et un patient ne peut pas participé a une meme activité dans le meme moi
            $where = "Ref_='" . $oev->Ref_ . "'" . "AND Oev_=1 AND (Comm='" . $Comm . "' ";
            if (isset($_POST['Commp'])) {
                $Commp = $_POST['Commp'];
                foreach ($Commp as $Commprec) {
                    $where .= " or Comm='" . $Commprec . "' ";
                }
            }
            $where .= ")";
            $order = "Modi DESC";
            $result = $this->getCommdossTable()->select($where, $order);
            $foi = $result->count();
            if ($foi == '0' || ($foi != '0' && $Motif)) {
                $Commdoss->Nume = "14".hexdec(uniqid());
                $Commdoss->Comm = $Comm;
                $Commdoss->Ref_ = $oev->Ref_;
                $Commdoss->Motif = $Motif;
                $Commdoss->Nom_ = $oev->Nom_;
                $Commdoss->Sexe = $oev->Sexe;
                $Commdoss->Age_ = $oev->Age_;
                $Commdoss->Oev_ = 1;
                $Commdoss->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $Commdoss->Modi = date("Y-m-d H:i:s");
                $Commdoss->Doss = $oev->Nume;
                $Commdoss->prefixe = $prefixe;
                $Commdoss = $this->getCommdossTable()->saveCommdoss($Commdoss);
                $res = $Commdoss->getArrayCopy();
            } else {
                if ($foi != '0') {
                    $Commdoss->Nume = -1; //existe deja
                    foreach ($result as $Commprec) {
                        $Commdoss->Modi = $Commprec->Modi;
                        break;
                    }
                    $res = $Commdoss->getArrayCopy();
                }
            }
            //set sexe age enfant
            $res['Sexe'] = $oev->Sexe;
            $res['Age_'] = $oev->Age_;
        } else {
            $Nume = $_POST['id'];
            $tuteur = $_POST['Tuteur'];
            $montant = $_POST['Montant'];
            $Commdoss = $this->getCommdossTable()->getCommdoss($Nume);
            $Commdoss->Montant = $montant;
            $Commdoss->Tuteur = $tuteur;
            $Commdoss = $this->getCommdossTable()->saveCommdoss($Commdoss);
            $res = $Commdoss->getArrayCopy();
        }
        return new \Zend\View\Model\JsonModel($res);
    }

    public function adddossAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $form = new CommunauteForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $comm = new Comm();
                $comm->exchangeArray($form->getData());
                $comm->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $comm->Modi = date("Y-m-d H:i:s");
                $comm = $this->getCommTable()->saveComm($comm);
                // Redirect to list of accueil
                return $this->redirect()->toRoute('communaute');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function addoevAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $form = new CommunauteForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $comm = new Comm();
                $comm->exchangeArray($form->getData());
                $comm->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $comm->Modi = date("Y-m-d H:i:s");
                $comm = $this->getCommTable()->saveComm($comm);
                // Redirect to list of accueil
                return $this->redirect()->toRoute('communaute');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function delcommdossAction() {
        $Nume = $_POST['Nume'];
        $this->getCommdossTable()->deleteCommdoss($Nume);
        return new \Zend\View\Model\JsonModel();
    }

    public function getDossTable() {
        if (!$this->dossTable) {
            $sm = $this->getServiceLocator();
            $this->dossTable = $sm->get('Communaute\Model\DossTable');
        }
        return $this->dossTable;
    }

    public function getOevTable() {
        if (!$this->oevTable) {
            $sm = $this->getServiceLocator();
            $this->oevTable = $sm->get('Communaute\Model\OevTable');
        }
        return $this->oevTable;
    }

    public function getCommTable() {
        if (!$this->commTable) {
            $sm = $this->getServiceLocator();
            $this->commTable = $sm->get('Communaute\Model\CommTable');
        }
        return $this->commTable;
    }

    public function getCommdossTable() {
        if (!$this->commdossTable) {
            $sm = $this->getServiceLocator();
            $this->commdossTable = $sm->get('Communaute\Model\CommdossTable');
        }
        return $this->commdossTable;
    }

    public function getOptionsForSelect($array, $key, $value) {

        $select = array();
        foreach ($array as $res) {
            $select[$res->$key] = $res->$value;
        }
        return $select;
    }

    public function getListTable() {
        if (!$this->listTable) {
            $sm = $this->getServiceLocator();
            $this->listTable = $sm->get('Communaute\Model\ListeTable');
        }
        return $this->listTable;
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
