<?php

namespace Depistage\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Depistage\Model\Entr;
use Depistage\Model\Depi;
use Depistage\Model\Liste;
use Depistage\Form\DepistageForm;

class DepistageController extends AbstractActionController {

    protected $entrTable;
    protected $dossTable;
    protected $depiTable;
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
        $datatable = $this->getServiceLocator()->get('depistagedatatable');
        $result = $datatable->getResult($array);
        $model->setVariable('draw', $result->getDraw());
        $model->setVariable('recordsTotal', $result->getRecordsTotal());
        $model->setVariable('recordsFiltered', $result->getRecordsFiltered());
        $model->setVariable('data', $result->getData());
        return $model;
    }

    public function indexAction() {
        $prefix = new \Zend\Session\Container('prefixe');
        $prefixe = $prefix->offsetGet('prefixe');
        $prefixeagent = $prefix->offsetGet('prefixeagent');
        
        $viewModel = new ViewModel();      
        $viewModel->prefixe = $prefixe;
        $viewModel->prefixeagent = $prefixeagent;
        
        return new ViewModel(array(
            'daymin' => date('Y-m-d'),
            'daymax' => date('Y-m-d'),
            'prefixe' => $prefixe,
            'prefixeagent' => $prefixeagent
        ));
    }

    public function addAction() {

        $prefixe = new \Zend\Session\Container('prefixe');
        $codereg = $prefixe->offsetGet('codereg');
        $codestruct = $prefixe->offsetGet('codestruct');
        $code = $codereg . $codestruct;

        $viewModel = new ViewModel();
        $form = new DepistageForm();
        $Nume = $this->params()->fromRoute('Nume', 0);
        $form->get('Circ')->setOptions(array('value_options' => $this->getOptionsForSelect($this->getListTable()->select("Typ_ = 'Circonstance de depistage'"), 'Desi', 'Desi')));
        $form->get('Matr')->setOptions(array('value_options' => $this->getOptionsForSelect($this->getListTable()->select("Typ_ = 'Fiche | Situation matrimoniale'"), 'Desi', 'Desi')));
        $form->get('Prof')->setOptions(array('value_options' => $this->getOptionsForSelect($this->getListTable()->select("Typ_ = 'Profession'"), 'Desi', 'Desi')));
        $where = null;
        $order = "Ref_ DESC";
        $limit = 1;
        //$col = "Ref_";
        $col = array('Ref_' => new \Zend\Db\Sql\Expression('CAST(SUBSTR(Ref_,6) AS UNSIGNED)'));
        $result = $this->getDepiTable()->select($where, $order, $limit, $col)->toArray();
        $Ref_ = "";
        /*if (count($result) != 0) {
            $Ref_ = $result[0]['Ref_'];
            $Ref_++;
        } else
            $Ref_ = '1';*/
        
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
        
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $depi = new Depi();
                $depi->exchangeArray($form->getData());
                $depi->Nume = $Nume;
                $depi->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $depi->Modi = date("Y-m-d H:i:s");
                $depi = $this->getDepiTable()->saveDepi($depi);
                // Redirect to list of accueil
                return $this->redirect()->toRoute('depistage');
            }
        } else {
            $depi = new Depi();
            $depi->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
            $depi->Nume = "14".hexdec(uniqid());
            $depi->Modi = date("Y-m-d H:i:s");
            $depi->Dat_ = date("Y-m-d");
            $depi->Ref_ = $Ref_;
            $this->getDepiTable()->saveDepi($depi);
            $form->get('Ref_')->setValue($Ref_);
            $Numedepi = $depi->Nume;
        }
        $viewModel->form = $form;
        $viewModel->Nume = $Numedepi;
        return $viewModel;
    }

    public function editAction() {
        $viewModel = new ViewModel();
        //$viewModel->setTerminal(true);

        $Nume = $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('depistage', array(
                        'action' => 'add'
            ));
        }
        $depi = $this->getDepiTable()->getDepi($Nume);


        $form = new DepistageForm();
        $form->get('Circ')->setOptions(array('value_options' => $this->getOptionsForSelect($this->getListTable()->select("Typ_ = 'Circonstance de depistage'"), 'Desi', 'Desi')));
        $form->get('Matr')->setOptions(array('value_options' => $this->getOptionsForSelect($this->getListTable()->select("Typ_ = 'Fiche | Situation matrimoniale'"), 'Desi', 'Desi')));
        $form->get('Prof')->setOptions(array('value_options' => $this->getOptionsForSelect($this->getListTable()->select("Typ_ = 'Profession'"), 'Desi', 'Desi')));

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = (array) $request->getPost();
                $depi->someValues($data);
                $depi->Modi = date("Y-m-d H:i:s");
                $depi->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $this->getDepiTable()->saveDepi($depi);
                $this->flashMessenger()->addSuccessMessage('La modification a été faite avec succés.');
                return $this->redirect()->toRoute('depistage');
            }
        } else {
            $form->bind($depi);
            $form->get('Dat_')->setValue($this->formatdate($depi->Dat_));
            $form->get('TestDat_')->setValue($this->formatdate($depi->TestDat_));
            $form->get('TestRetr')->setValue($this->formatdate($depi->TestRetr));
            $form->get('ConfDat_')->setValue($this->formatdate($depi->ConfDat_));
            $form->get('ConfRetr')->setValue($this->formatdate($depi->ConfRetr));
        }
        $viewModel->form = $form;
        $viewModel->Nume = $Nume;
        return $viewModel;
    }

    public function viewconfirmationAction() {
        return $this->redirect()->toRoute('depistage');
    }

    public function formatdate($date) {
        $newdate = "";
        if ($date) {
            $date2 = explode(" ", $date);
            $newdate = $date2[0];
        }
        return $newdate;
    }

    public function deleteAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume = $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('depistage');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                 $Nume =  $request->getPost('Nume');
                $this->getDepiTable()->deleteDepi($Nume);
            }
            $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succés.');
            // Redirect to list of depistage
            return $this->redirect()->toRoute('depistage');
        }

        $viewModel->Nume = $Nume;
        $viewModel->entr = $this->getDepiTable()->getDepi($Nume);
        return $viewModel;
    }

    public function getListTable() {
        if (!$this->listTable) {
            $sm = $this->getServiceLocator();
            $this->listTable = $sm->get('Depistage\Model\ListeTable');
        }
        return $this->listTable;
    }

    public function getEntrTable() {
        if (!$this->entrTable) {
            $sm = $this->getServiceLocator();
            $this->entrTable = $sm->get('Depistage\Model\EntrTable');
        }
        return $this->entrTable;
    }

    public function getDossTable() {
        if (!$this->dossTable) {
            $sm = $this->getServiceLocator();
            $this->dossTable = $sm->get('Depistage\Model\DossTable');
        }
        return $this->dossTable;
    }

    public function getDepiTable() {
        if (!$this->depiTable) {
            $sm = $this->getServiceLocator();
            $this->depiTable = $sm->get('Depistage\Model\DepiTable');
        }
        return $this->depiTable;
    }

    public function getOptionsForSelect($array, $key, $value) {
        $select = array();
        foreach ($array as $res) {
            $select[$res->$key] = $res->$value;
        }
        return $select;
    }

}
