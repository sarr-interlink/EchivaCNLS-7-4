<?php

namespace Laboratoire\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Laboratoire\Form\ExamForm;
use Laboratoire\Model\Entr;
use Laboratoire\Form\SerologieForm;

class LaboratoireController extends AbstractActionController {

    protected $entrTable;
    protected $dossTable;
    protected $listTable;

    public function inday($Ref_, $date) {
        $where = " Cta_Nume = '$Ref_' and ArriHoro <= '$date 23:59:59' and ArriHoro >= '$date 00:00:00'";
        $res = $this->getEntrTable()->select($where, "Nume desc", null);
        if (count($res) > 0) {
            $ling = $res->current();
            return $ling->Nume;
        }
        return 0;
    }

    public function dataAction() {
        $daymax = $this->params()->fromQuery('daymax');
        $daymin = $this->params()->fromQuery('daymin');
        $LaboDesi = $this->params()->fromQuery('LaboDesi');
        $array = $this->params()->fromQuery();

        if ($daymax != '') {
            $array['where'][] = new \Zend\Db\Sql\Predicate\Operator('ArriHoro', '<=', "$daymax 23:59:59");
        }
        if ($daymin != '') {
            $array['where'][] = new \Zend\Db\Sql\Predicate\Operator('ArriHoro', '>=', "$daymin 00:00:00");
        }
        if ($LaboDesi != '0') {
            $array['where'][] = new \Zend\Db\Sql\Predicate\Operator('LaboDesi', '<>', "");
        }

        $array['where'][] = new \Zend\Db\Sql\Predicate\Operator('Arri', '=', "1");

        $model = new JsonModel();
        $datatable = $this->getServiceLocator()->get('laboratoiredatatable');
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
        //$viewModel->setTerminal(true);
        $form = new SerologieForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $Cta_Nume = $form->get('Cta_Nume')->getValue();
                $entr = new Entr();
                $entr->exchangeArray($request->getPost());
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
                    $numredi = $this->inday($Cta_Nume, date("Y-m-d", strtotime($form->get('ArriHoro')->getValue())));                    
                    if ($numredi != 0) {
                        $this->flashMessenger()->addWarningMessage('Modifier Examen enregistrer');
                        return $this->redirect()->toRoute('laboratoire', array(
                                    'action' => 'edit', 'Nume' => $numredi
                        ));
                    }

                    //ajouter le case numero de dossier inalide
                   
                    $doss = $this->getDossTable()->getDossByRef_($Cta_Nume);
                    $entr->Doss = $doss->Nume;
                    $entr->Cta_Nume = $doss->Ref_;
                    $entr->Ume_Nume = $doss->Ref2;
                    $entr->Nom_ = $doss->RensNom_;
                    $entr->Pnom = $doss->RensPnom;
                    $entr->Age_ = $doss->RensAge_;
                    $entr->Sexe = $doss->RensSexe;
                    $entr->Arri = 1;
                    $entr->ArriHoro = date("Y-m-d H:i:s", strtotime($form->get('ArriHoro')->getValue()));
                    $entr->ArriHeur = date("H") . "h" . date("i");
                    $entr->Moti = 'Saisie rétroactive';
                    $entr->Cta_Ume_ = -1;
                    $entr->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                    $entr->Modi = date("Y-m-d H:i:s");
                    $LaboDesi = "";
                    $plus = "";
                    if ($entr->Sero == 1) {
                        $LaboDesi .= "Sero";
                        $msg = "";
                        switch ($entr->Ser0) {
                            case 1:
                                $msg = "=VIH-";
                                $plus = " +";
                                break;
                            case 2: //positif
                                switch ($entr->Ser1) {
                                    case 1:
                                        $msg = "=VIH1";
                                        $plus = " +";
                                        break;
                                    case 2:
                                        $msg = "=VIH2";
                                        $plus = " +";
                                        break;
                                    case 3:
                                        $msg = "=VIH1+2";
                                        $plus = " +";
                                        break;
                                    case 4:
                                        $msg = "=VIH+";
                                        $plus = " +";
                                        break;
                                }
                                break;
                            case 3:
                                $msg = "=ind. ";
                                $plus = " +";
                                break;
                        }
                        $LaboDesi .= $msg;
                    }
                    if ($entr->Bioc == 1) {
                        $LaboDesi .= $plus . " Bioch.";
                        $plus = " +";
                    }
                    if ($entr->Nfs_ == 1) {
                        $LaboDesi .= $plus . " Nfs";
                        $plus = " +";
                    }
                    if ($entr->Cd4_ == 1) {
                        $LaboDesi .= $plus . " Cd4";
                        if ($entr->Cd40)
                            $LaboDesi .= "=" . $entr->Cd40;
                        $plus = " +";
                    }
                    if ($entr->Pcr_ == 1) {
                        $LaboDesi .= $plus . " Pcr";
                        $plus = " +";
                    }
                    if ($entr->Urin == 1) {
                        $LaboDesi .= $plus . " PU";
                        $plus = " +";
                    }
                    if ($entr->Gout == 1) {
                        $LaboDesi .= $plus . " GE";
                        $plus = " +";
                    }
                    if ($entr->Vagi == 1) {
                        $LaboDesi .= $plus . " PV";
                        $plus = " +";
                    }
                    if ($entr->Ceph == 1) {
                        $LaboDesi .= $plus . " LCP";
                        $plus = " +";
                    }
                    if ($entr->Autr == 1) {
                        $LaboDesi .= $plus . " Autre";
                        $plus = " +";
                    }

                    $entr->LaboDesi = $LaboDesi;

                    $entr = $this->getEntrTable()->saveEntr($entr);
                    // Redirect to list of laboratoire
                    $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                    return $this->redirect()->toRoute('laboratoire');
                }
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function editAction() {
        $viewModel = new ViewModel();
        //$viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('laboratoire', array(
                        'action' => 'add'
            ));
        }
        $entr = $this->getEntrTable()->getEntr($Nume);
        $form = new SerologieForm();

        $ValueOptions = $form->get('BiocAutr')->getValueOptions();
        $VaOs = array();
        foreach ($ValueOptions as $key => $val) {
            if (!empty($entr->$key)) {
                $form->add(array(
                    'name' => "$key",
                    'attributes' => array(
                        'type' => 'text',
                        'class' => 'form-control',
                    ),
                    'options' => array(
                        'label' => "$val",
                    ),
                ));
                $VaOs[$key] = $val;
            } else {
                $options[$key] = $val;
            }
        }
        $form->get('BiocAutr')->setValueOptions($options);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $form->get('Nume')->setValue($Nume);
            if ($form->isValid()) {
                $data = (array) $request->getPost();
                $entr->someValues($data);
                $entr->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $LaboDesi = "";
                $plus = "";
                if ($entr->Sero == 1) {
                    $LaboDesi .= "Sero";
                    $msg = "";

                    switch ($entr->Ser0) {
                        case 1:
                            $msg = "=VIH-";
                            $plus = " +";
                            break;
                        case 2: //positif

                            switch ($entr->Ser1) {
                                case 1:
                                    $msg = "=VIH1";
                                    $plus = " +";
                                    break;
                                case 2:
                                    $msg = "=VIH2";
                                    $plus = " +";
                                    break;
                                case 3:
                                    $msg = "=VIH1+2";
                                    $plus = " +";
                                    break;
                                case 4:
                                    $msg = "=VIH+";
                                    $plus = " +";
                                    break;
                            }
                            break;
                        case 3:
                            $msg = "=ind. ";
                            $plus = " +";
                            break;
                    }

                    $LaboDesi .= $msg;
                }
                if ($entr->Bioc == 1) {
                    $LaboDesi .= $plus . " Bioch.";
                    $plus = " +";
                }
                if ($entr->Nfs_ == 1) {
                    $LaboDesi .= $plus . " Nfs";
                    $plus = " +";
                }
                if ($entr->Cd4_ == 1) {
                    $LaboDesi .= $plus . " Cd4";
                    if ($entr->Cd40)
                        $LaboDesi .= "=" . $entr->Cd40;
                    $plus = " +";
                }
                if ($entr->Pcr_ == 1) {
                    $LaboDesi .= $plus . " Pcr";
                    $plus = " +";
                }
                if ($entr->Urin == 1) {
                    $LaboDesi .= $plus . " PU";
                    $plus = " +";
                }
                if ($entr->Gout == 1) {
                    $LaboDesi .= $plus . " GE";
                    $plus = " +";
                }
                if ($entr->Vagi == 1) {
                    $LaboDesi .= $plus . " PV";
                    $plus = " +";
                }
                if ($entr->Ceph == 1) {
                    $LaboDesi .= $plus . " LCP";
                    $plus = " +";
                }
                if ($entr->Autr == 1) {
                    $LaboDesi .= $plus . " Autre";
                    $plus = " +";
                }


                $entr->LaboDesi = $LaboDesi;

                $this->getEntrTable()->saveEntr($entr);
                $this->flashMessenger()->addSuccessMessage('La modification a été faite avec succés.');
                return $this->redirect()->toRoute('laboratoire');
            }
        } else {

            $form->bind($entr);
            if (!is_null($entr->Pcr_Dat_)) {
                $form->get('Pcr_Dat_')->setValue($this->formatdate($entr->Pcr_Dat_));
            }
            if (!is_null($entr->Cd4_Dat_)) {
                $form->get('Cd4_Dat_')->setValue($this->formatdate($entr->Cd4_Dat_));
            }
            if (!is_null($entr->ArriHoro)) {
                $form->get('ArriHoro')->setValue(date('Y-m-d', strtotime($entr->ArriHoro)));
            }
            if (!is_null($entr->LaboDat_)) {
                $form->get('LaboDat_')->setValue(date('Y-m-d', strtotime($entr->LaboDat_)));
            }
        }
        /**/$viewModel->Medibio = $this->getEntrTable()->select('nume=' . $Nume)->toArray();
        $viewModel->form = $form;
        $viewModel->Nume = $Nume;
        $viewModel->VaOs = $VaOs;
        return $viewModel;
    }

    public function setexamenAction() {
        $viewModel = new ViewModel();
        $selectoption = $this->getOptionsForSelect($this->getListTable()->select("Typ_ = 'Accueil | Prec'", 'Desi'), 'Nume', 'Desi', 'state');
        $form = new ExamForm();
        $i = 1;
        $pog['1'] = 'Activé';
        $pog['0'] = 'Desactivé';
        foreach ($selectoption as $k => $value) {
            $element['title'] = $selectoption[$k]['title'];

            $element['value'] = $k;
            $form->add(array(
                'type' => 'Zend\Form\Element\Select',
                'name' => $k,
                'attributes' => array(
                    'id' => $k,
                    'class' => 'selectpicker',
                    'data-live-search' => 'true',
                    'value' =>  $selectoption[$k]['state'],
                ),
                'options' => array(
                    'label' => ' ',
                    'value_options' => $pog
                )
            ));
            $all[] = $element;
            $i++;
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $data = (array) $request->getPost();
            unset($data['Nume']);
            unset($data['submit']);
            foreach ($data as $Nume => $permiress) {
                $this->getListTable()->updt($permiress, $Nume);
            }
            return $this->redirect()->toRoute('laboratoire');
        }
        return new ViewModel(array(
            'all' => $all,
            /*     'Nume' => $Nume, */
            'form' => $form,
        ));
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
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('laboratoire');
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

            // Redirect to list of laboratoire
            $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            return $this->redirect()->toRoute('laboratoire');
        }

        $viewModel->Nume = $Nume;
        $viewModel->entr = $this->getEntrTable()->getEntr($Nume);
        return $viewModel;
    }

    public function getEntrTable() {
        if (!$this->entrTable) {
            $sm = $this->getServiceLocator();
            $this->entrTable = $sm->get('Laboratoire\Model\EntrTable');
        }
        return $this->entrTable;
    }

    public function getDossTable() {
        if (!$this->dossTable) {
            $sm = $this->getServiceLocator();
            $this->dossTable = $sm->get('Laboratoire\Model\DossTable');
        }
        return $this->dossTable;
    }

    public function getListTable() {
        if (!$this->listTable) {
            $sm = $this->getServiceLocator();
            $this->listTable = $sm->get('Laboratoire\Model\ListeTable');
        }
        return $this->listTable;
    }

    public function getOptionsForSelect($array, $key, $value, $state) {
        $select = array();
        foreach ($array as $res) {
            $select[$res->$key] = array('title' => $res->$value, 'state' => $res->$state);
        }
        return $select;
    }

}
