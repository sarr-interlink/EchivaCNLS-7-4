<?php

namespace Oev\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Oev\Model\Oev;
use Oev\Form\OevForm;

class OevController extends AbstractActionController {

    protected $oevTable;
    protected $listeTable;
    protected $centreTable;
    protected $userTable;
    protected $form;

    public function indexAction() {
        $prefix = new \Zend\Session\Container('prefixe');
        $prefixe = $prefix->offsetGet('prefixe');
        $prefixeagent = $prefix->offsetGet('prefixeagent');
        $request = $this->getRequest();
        return new ViewModel(array(
            'oevs' => $this->getOevTable()->select(),
            'prefixe' => $prefixe,
            'prefixeagent' => $prefixeagent
        ));
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
            //$viewModel->setTerminal(true);
            $this->form = new OevForm();
            $this->setOevForm();
            $Nume = $this->params()->fromRoute('Nume', 0);
            /* Initialise N° dossier */
            $where = null;
            $order = "Ref_ DESC";
            $limit = 1;
//        $col = "Ref_";
            $col = array('Ref_' => new \Zend\Db\Sql\Expression('CAST(SUBSTR(Ref_,6) AS UNSIGNED)'));
            $result = $this->getOevTable()->select($where, $order, $limit, $col)->toArray();

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
            $this->form->get('Ref_')->setValue($Ref_);
            $request = $this->getRequest();
            if (!$request->isPost()) {
                $oev = new Oev();
                $oev->Nume = "14".hexdec(uniqid());
                $Numeoev = $oev->Nume;
                $oev->Ref_ = $Ref_;
                // $doss->OuvrDat_ = date("Y-m-d H:i:s");
                // $doss->Arv_Lign = 0;
                $oev->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $oev->Modi = date("Y-m-d H:i:s");
                /**/ $this->getOevTable()->saveOev($oev);
            } else {
                $oev = new Oev();
                $data = $request->getPost();
                $this->form->setData($data);
                $this->form->isValid();
                $oev->exchangeArray($this->form->getData());
                $oev->Modi = date("Y-m-d H:i:s");
                $oev->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $oev->Nume = $Nume;
                $oev = $this->getOevTable()->saveOev($oev);
                $this->flashMessenger()->addSuccessMessage('ajouté avec succès!');
                return $this->redirect()->toRoute('oev');
            }
            $viewModel->form = $this->form;
            $viewModel->Nume = $Numeoev;
            return $viewModel;
        } 
        else {
            return $this->redirect()->toRoute('oev', array(
                        'action' => 'index'
            ));
        }
    }

    public function editAction() {
        $viewModel = new ViewModel();
        //$viewModel->setTerminal(true);
        $Nume = $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('oev', array(
                        'action' => 'add'
            ));
        }
        $oev = $this->getOevTable()->getOev($Nume);
        $this->form = new OevForm();
        $this->setOevForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $oev = new Oev();
            $data = $request->getPost();
            $this->form->setData($data);
            $this->form->isValid();
            $oev->exchangeArray($this->form->getData());
            $oev->Modi = date("Y-m-d H:i:s");
            $oev->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
            $oev = $this->getOevTable()->saveOev($oev);
            $this->flashMessenger()->addSuccessMessage('modifié avec succès!');
            return $this->redirect()->toRoute('oev');
        } else {
            $oev = $this->getOevTable()->getOev($Nume);
            $oev->Nais = $this->extractdate($oev->Nais);
            $this->form->bind($oev);
        }
        $viewModel->form = $this->form;
        $viewModel->Nume = $Nume;
        return $viewModel;
    }

    public function deleteAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume = $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('oev');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');
            if ($del == 'Oui') {
                $Nume = $request->getPost('Nume');

                $oev = $this->getOevTable()->getOev($Nume);
                $this->getOevTable()->deleteOev($Nume);
            }
            // Redirect to list of dossiers
            $this->flashMessenger()->addSuccessMessage('supprimé avec succès!');
            return $this->redirect()->toRoute('oev');
        }

        $viewModel->Nume = $Nume;
        return $viewModel;
    }

    public function setOevForm() {
        $liste = $this->getListeTable()->getListetab();
        $nbrliste = count($liste);
        for ($i = 0; $i < $nbrliste; $i++) {
            if ($liste[$i]['Typ_']) {
                if ($liste[$i]['Typ_'] === "Social | Situation sanitaire") {
                    $this->form->Sani[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "OEV | Scolarité/formation") {
                    $this->form->Scol[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
                if ($liste[$i]['Typ_'] === "OEV | Difficulté") {
                    $this->form->Diff[$liste[$i]['Desi']] = $liste[$i]['Desi'];
                }
            }
        }
        $this->form->initialise();
    }

    public function extractdate($date) {
        $newdate = "";
        if ($date) {
            $date2 = explode(" ", $date);
            $newdate = $date2[0];
        }
        return $newdate;
    }

    public function getOevTable() {
        if (!$this->oevTable) {
            $sm = $this->getServiceLocator();
            $this->oevTable = $sm->get('Oev\Model\OevTable');
        }
        return $this->oevTable;
    }

    public function getListeTable() {
        if (!$this->listeTable) {
            $sm = $this->getServiceLocator();
            $this->listeTable = $sm->get('Oev\Model\ListeTable');
        }
        return $this->listeTable;
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
