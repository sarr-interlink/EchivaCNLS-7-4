<?php

namespace Parametres\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Crypt\Password\Bcrypt;
use Parametres\Form\ProfilForm;
use Parametres\Form\CentreForm;
use Parametres\Form\Base;
use Parametres\Form\DroitsForm;
use Parametres\Form\UserForm;
use Parametres\Form\ListeForm;
use Parametres\Form\DciForm;
use Parametres\Form\DosaForm;
use Parametres\Model\Role;
use Parametres\Model\Liste;
use Dossiers\Model\Dci;
use Dossiers\Model\Dosa;
use Dossiers\Model\Gale;
use Dossiers\Model\Prov;
use Dossiers\Model\Fabr;
use Dossiers\Model\Chrg;
use Dossiers\Model\Prod;
use Dossiers\Model\Itemdest;
use Parametres\Model\Conf;
use Parametres\Form\PosologieForm;
use Parametres\Model\UserRole;

class ParametresController extends AbstractActionController {

    protected $userRoleTable;
    protected $confTable;
    protected $roleTable;
    protected $userTable;
    protected $resourceTable;
    protected $permissionTable;
    protected $rolePermissionTable;
    protected $listTable;
    protected $serviceLocator;
    protected $role;
    protected $entrTable;
    protected $depiTable;
    protected $dciTable;
    protected $DosaTable;
    protected $GaleTable;
    protected $ProvTable;
    protected $FabrTable;
    protected $ChrgTable;
    protected $ProdTable;
    protected $ItemdestTable;
    protected $centreTable;

    public function indexAction() {
        $this->form = new PosologieForm();
        $this->setPosologieForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = $request->getPost();
            $this->form->setData($data);
            $posodefa = $this->form->get('PosoDefa')->getValue();
            if ($posodefa) {
                $posodefa = str_replace('#', "\n", $posodefa);
            }
            /*             * */
            if (mb_detect_encoding($posodefa, 'utf-8', true)) {
                $posodefa = utf8_decode($posodefa);
            }
            /*             * */
            $conf = $this->getConfTable()->getConf(1);
            $conf->PosoDefa = $posodefa;
            $conf->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
            $conf->Modi = date("Y-m-d H:i:s");
            $conf = $this->getConfTable()->saveConf($conf);
            return $this->redirect()->toRoute('parametres');
        } else {
            $posodefa = $this->getConfTable()->getConf(1)->PosoDefa;
            $tabposodefa = explode("\n", $posodefa);
        }

        return new ViewModel(array(
            'roles' => $this->getRoleTable()->fetchAll(),
            'users' => $this->getUserTable()->fetchAll(),
            'lists' => $this->getListTable()->fetchAll(),
            'dcis' => $this->getDciTable()->fetchAll(),
            'Dosage' => $this->getDosaTable()->fetchAll(),
            'Forme' => $this->getGaleTable()->fetchAll(),
            'Provenance' => $this->getProvTable()->fetchAll(),
            'Fabricant' => $this->getFabrTable()->fetchAll(),
            'Priseencharge' => $this->getChrgTable()->fetchAll(),
            'Destination' => $this->getItemdestTable()->fetchAll(),
            'Centre' => $this->getCentreTable()->select(null, 'Structure'),
            'posologie' => $this->utf8_converter($tabposodefa),
            'tabformemedi' => $this->utf8_converter($this->initformemedicourant("Typ_=1")),
            'tabforme' => $this->utf8_converter($this->initforme("Typ_=3")),
            'form' => $this->form
        ));
    }

    public function deleteposoAction() {
        $request = $this->getRequest();
        if ($request->isPost()) {
            $posodefa = $request->getPost('PosoDefa');
            if ($posodefa) {
                $posodefa = str_replace('#', "\n", $posodefa);
                /*                 * */
                if (mb_detect_encoding($posodefa, 'utf-8', true))
                    $posodefa = utf8_decode($posodefa);
                /*                 * */
                $conf = $this->getConfTable()->getConf(1);
                $conf->PosoDefa = $posodefa;
                $conf->Util = $this->zfcUserAuthentication()->getIdentity()->getId();
                $conf->Modi = date("Y-m-d H:i:s");
                $conf = $this->getConfTable()->saveConf($conf);
            }
        }
        return $this->redirect()->toRoute('parametres');
    }

    public function setPosologieForm() {
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
                $this->form->ArvPrsc[$dcidesi] = $dcidesi;
            }
            if ($dci[$i]['Typ_'] == 1) {
                $this->form->MedDci_[$dci[$i]['Nume']] = $dci[$i]['Desi'];
            }
        }
        $this->form->initialise();
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
        $tabform = array();
        $i = 0;
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

    public function createtabprod($resultdci) {
        $tab = array();
        foreach ($resultdci as $donne) {
            $tab[$donne->Nume] = array('Dci_' => $donne->Dci_, 'Dosa' => $donne->Dosa, 'Gale' => $donne->Gale);
        }
        return $tab;
    }

    public function createtab($resultdci) {
        $tab = array();
        foreach ($resultdci as $donne) {
            $tab[$donne->Nume] = $donne->Desi;
        }
        return $tab;
    }

    function utf8_converter($array) {
        array_walk_recursive($array, function(&$item, $key) {
            if (!mb_detect_encoding($item, 'utf-8', true)) {
                $item = utf8_encode($item);
            }
        });
        return $array;
    }

    public function roleAction() {
        $form = new UserForm();
        $Nume =  $this->params()->fromRoute('Nume', 0);

        if (!$Nume) {
            return $this->redirect()->toRoute('parametres');
        }

        $form->get('user_id')->setValue($Nume);

        $roleusers = $this->getOptionsForSelect($this->getRoleTable()->fetchAll(), 'rid', 'role_name');
        $form->get('profil')->setOptions(array(
            'value_options' => $roleusers,
        ));
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $form->setData($request->getPost());
                $data = (array) $request->getPost('profil', null);
                $this->getUserRoleTable()->deleteUserRoleByUser($Nume);
                foreach ($data as $key => $dat) {
                    $new = new UserRole();
                    $new->id =  "14".hexdec(uniqid());
                    $new->role_id = $dat;
                    $new->user_id = $Nume;
                    $this->getUserRoleTable()->saveUserRole($new);
                }
                $this->flashMessenger()->addSuccessMessage('La modification a été faite avec succés.');
                return $this->redirect()->toRoute('parametres');
            }
        } else {
            $rlsusr = $this->getOptionsForSelect($this->getUserRoleTable()->select("user_id = '$Nume'"), 'role_id', 'role_id');
            $form->get('profil')->setValue($rlsusr);
        }
        return new ViewModel(array(
            'Nume' => $Nume,
            'form' => $form,
        ));
    }

    public function resetpasswordAction() {
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];
        $bcrypt = new Bcrypt();
        $user = $this->getUserTable()->getUser($user_id);
        $user->password = $bcrypt->create($password);
        $user = $this->getUserTable()->saveUser($user);
        $res = $user->getArrayCopy();
        return new \Zend\View\Model\JsonModel($res);
    }

    public function getOptionsForSelect($array, $key, $value) {
        $select = array();
        foreach ($array as $res) {
            $select[$res->$key] = $res->$value;
        }
        return $select;
    }

    public function droitsAction() {
        $form = new DroitsForm();
        $Nume =  $this->params()->fromRoute('Nume', 0);

        if (!$Nume) {
            return $this->redirect()->toRoute('parametres');
        }
        $form->get('Nume')->setValue($Nume);
        $resources = $this->getResourceTable()->like("%Module%");
        $rolepermissions = $this->getRolePermissionTable()->select("role_id = $Nume");
        $permissionsrole = array();
        foreach ($rolepermissions as $rolepermission) {
            $permissionsrole[$rolepermission->permission_id] = $rolepermission->permission_id;
        }
        foreach ($resources as $value) {
            $pog = null;
            $pog2 = null;
            $permissions = $this->getPermissionTable()->select("resource_id = $value->id");
            foreach ($permissions as $permi) {
                $pog[$permi->id] = $permi->name;
                if (in_array($permi->id, $permissionsrole)) {
                    $pog2[$permi->id] = $permi->id;
                }
            }
            $element['title'] = $value->title;
            $element['id'] = $value->id;
            $form->add(array(
                'type' => 'Zend\Form\Element\Select',
                'name' => $value->id,
                'attributes' => array(
                    'multiple' => 'multiple',
                    'class' => 'selectpicker',
                    'data-live-search' => 'true',
                    'value' => $pog2
                ),
                'options' => array(
                    'label' => ' ',
                    'value_options' => $pog
                )
            ));
            $all[] = $element;
        }


        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $data = (array) $request->getPost();
            unset($data['Nume']);
            unset($data['submit']);
            $this->getRolePermissionTable()->deleteRole($Nume);
            foreach ($data as $permiress) {
                $this->getRolePermissionTable()->updt($permiress, $Nume);
            }
            return $this->redirect()->toRoute('parametres');
        }
        return new ViewModel(array(
            'all' => $all,
            'Nume' => $Nume,
            'form' => $form,
        ));
    }

    public function addAction() {
        $viewModel = new ViewModel();
        //$viewModel->setTerminal(true);
        $form = new ProfilForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $entr = new Role();
                $entr->exchangeArray($request->getPost());
                $this->getRoleTable()->saveRole($entr);
                // Redirect to list of parametres
                $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                return $this->redirect()->toRoute('parametres');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function addcentreAction() {
        $viewModel = new ViewModel();
        //$viewModel->setTerminal(true);
        $form = new CentreForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $entr = new \Parametres\Model\Centre();
                $entr->exchangeArray($request->getPost());
                $this->getCentreTable()->saveCentre($entr);
                // Redirect to list of parametres
                $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                return $this->redirect()->toRoute('parametres');
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
            return $this->redirect()->toRoute('parametres', array(
                        'action' => 'add'
            ));
        }
        $entr = $this->getRoleTable()->getRole($Nume);
        $form = new ProfilForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = (array) $request->getPost();
                $entr->someValues($data);
                $this->getRoleTable()->saveRole($entr);
                $this->flashMessenger()->addSuccessMessage('La modification a été faite avec succés.');
                return $this->redirect()->toRoute('parametres');
            }
        } else {
            $form->bind($entr);
        }
        $viewModel->rid = $Nume;
        $viewModel->form = $form;
        return $viewModel;
    }

    public function editcentreAction() {
        $viewModel = new ViewModel();
        //$viewModel->setTerminal(true);

        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres', array(
                        'action' => 'addcentre'
            ));
        }
        $entr = $this->getCentreTable()->getCentre($Nume);
        $form = new CentreForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = (array) $request->getPost();
                $entr->someValues($data);
                $this->getCentreTable()->saveCentre($entr);
                $this->flashMessenger()->addSuccessMessage('La modification a été faite avec succés.');
                return $this->redirect()->toRoute('parametres');
            }
        } else {
            $form->bind($entr);
        }
        $viewModel->id = $Nume;
        $viewModel->form = $form;
        return $viewModel;
    }

    public function edituserAction() {
        $viewModel = new ViewModel();
        //$viewModel->setTerminal(true);

        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres', array(
                        'action' => 'index'
            ));
        }
        $entr = $this->getUserTable()->getUser($Nume);
        $form = new Base();
        $centretable = $this->getOptionsForSelect($this->getCentreTable()->select(null, 'Structure'), 'Id', 'Structure');
        $form->get('centre')->setOptions(array('value_options' => $centretable));

        $request = $this->getRequest();
        if ($request->isPost()) {
                
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = (array) $request->getPost();
                $entr->someValues($data);
                $this->getUserTable()->saveUser($entr);
                $this->flashMessenger()->addSuccessMessage('La modification a été faite avec succés.');
                return $this->redirect()->toRoute('parametres');
            }
        } else {
            $form->bind($entr);
        }
        $viewModel->id = $Nume;
        $viewModel->form = $form;
        return $viewModel;
    }

    public function deleteAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                 $Nume =  $request->getPost('Nume');
                $entr = $this->getRoleTable()->getRole($Nume);
                $this->getRoleTable()->deleteRole($Nume);
            }
            // Redirect to list of parametres
            $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            return $this->redirect()->toRoute('parametres');
        }

        $viewModel->rid = $Nume;
        $viewModel->role = $this->getRoleTable()->getRole($Nume);
        return $viewModel;
    }

    public function deletecentreAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                 $Nume =  $request->getPost('Nume');
                $entr = $this->getCentreTable()->getCentre($Nume);
                $this->getCentreTable()->deleteCentre($Nume);
            }
            // Redirect to list of parametres
            $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            return $this->redirect()->toRoute('parametres');
        }

        $viewModel->id = $Nume;
        $viewModel->centre = $this->getCentreTable()->getCentre($Nume);
        return $viewModel;
    }

    public function statueAction() {
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres', array(
                        'action' => 'index'
            ));
        }
        $entr = $this->getUserTable()->getUser($Nume);

        if ($entr->state == 1) {
            $entr->state = 2;
        } else {
            $entr->state = 1;
        }
        $this->getUserTable()->saveUser($entr);
        $this->flashMessenger()->addSuccessMessage('La modification a été faite avec succés.');
        return $this->redirect()->toRoute('parametres');
    }

    public function addlisteAction() {
        $viewModel = new ViewModel();
        $form = new ListeForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $entr = new Liste();
                $entr->exchangeArray($request->getPost());
                $entr->Modi = date("Y-m-d H:i:s");
                $entr->Util = -40;
                $this->getListTable()->saveListe($entr);
                // Redirect to list of parametres
                $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                return $this->redirect()->toRoute('parametres');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function editlisteAction() {
        $viewModel = new ViewModel();
        //$viewModel->setTerminal(true);

        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres', array(
                        'action' => 'addliste'
            ));
        }
        $entr = $this->getListTable()->getListe($Nume);
        $form = new ListeForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = (array) $request->getPost();
                $entr->someValues($data);
                $this->getListTable()->saveListe($entr);
                $this->flashMessenger()->addSuccessMessage('La modification a été faite avec succés.');
                return $this->redirect()->toRoute('parametres');
            }
        } else {
            $form->bind($entr);
        }
        $viewModel->Nume = $Nume;
        $viewModel->form = $form;
        return $viewModel;
    }

    public function deletelisteAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                 $Nume =  $request->getPost('Nume');
                $this->getListTable()->deleteListe($Nume);
                $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            }

            // Redirect to list of laboratoire
            return $this->redirect()->toRoute('parametres');
        }

        $viewModel->Nume = $Nume;
        $viewModel->list = $this->getListTable()->getListe($Nume);
        return $viewModel;
    }

    public function adddciAction() {
        $viewModel = new ViewModel();
        $form = new DciForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $entr = new Dci();
                $entr->exchangeArray($request->getPost());
                $entr->Modi = date("Y-m-d H:i:s");
                $entr->Util = -40;
                $this->getDciTable()->saveDci($entr);
                // Redirect to list of parametres
                $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                return $this->redirect()->toRoute('parametres');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function adddosaAction() {
        $viewModel = new ViewModel();
        $form = new DosaForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $entr = new Dosa();
                $entr->exchangeArray($request->getPost());
                $entr->Modi = date("Y-m-d H:i:s");
                $entr->Util = -40;
                $this->getDosaTable()->saveDosa($entr);
                // Redirect to list of parametres
                $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                return $this->redirect()->toRoute('parametres');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function addgaleAction() {
        $viewModel = new ViewModel();
        $form = new DosaForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $entr = new Gale();
                $entr->exchangeArray($request->getPost());
                $entr->Modi = date("Y-m-d H:i:s");
                $entr->Util = -40;
                $this->getGaleTable()->saveGale($entr);
                // Redirect to list of parametres
                $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                return $this->redirect()->toRoute('parametres');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function addprovAction() {
        $viewModel = new ViewModel();
        $form = new DosaForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $entr = new Prov();
                $entr->exchangeArray($request->getPost());
                $entr->Modi = date("Y-m-d H:i:s");
                $entr->Util = -40;
                $this->getProvTable()->saveProv($entr);
                // Redirect to list of parametres
                $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                return $this->redirect()->toRoute('parametres');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function addfabrAction() {
        $viewModel = new ViewModel();
        $form = new DosaForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $entr = new Fabr();
                $entr->exchangeArray($request->getPost());
                $entr->Modi = date("Y-m-d H:i:s");
                $entr->Util = -40;
                $this->getFabrTable()->saveFabr($entr);
                // Redirect to list of parametres
                $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                return $this->redirect()->toRoute('parametres');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function addchrgAction() {
        $viewModel = new ViewModel();
        $form = new DosaForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $entr = new Chrg();
                $entr->exchangeArray($request->getPost());
                $entr->Modi = date("Y-m-d H:i:s");
                $entr->Util = -40;
                $this->getChrgTable()->saveChrg($entr);
                // Redirect to list of parametres
                $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                return $this->redirect()->toRoute('parametres');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function additemdestAction() {
        $viewModel = new ViewModel();
        $form = new DosaForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $entr = new Itemdest();
                $entr->exchangeArray($request->getPost());
                $entr->Modi = date("Y-m-d H:i:s");
                $entr->Util = -40;
                $this->getItemdestTable()->saveItemdest($entr);
                // Redirect to list of parametres
                $this->flashMessenger()->addSuccessMessage('L\'ajout a été fait avec succées.');
                return $this->redirect()->toRoute('parametres');
            }
        }
        $viewModel->form = $form;
        return $viewModel;
    }

    public function editdciAction() {
        $viewModel = new ViewModel();
        //$viewModel->setTerminal(true);

        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres', array(
                        'action' => 'adddci'
            ));
        }
        $entr = $this->getDciTable()->getDci($Nume);
        $form = new DciForm();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = (array) $request->getPost();
                $entr->someValues($data);
                $this->getDciTable()->saveDci($entr);
                $this->flashMessenger()->addSuccessMessage('La modification a été faite avec succés.');
                return $this->redirect()->toRoute('parametres');
            }
        } else {
            $form->bind($entr);
        }
        $viewModel->Nume = $Nume;
        $viewModel->form = $form;
        return $viewModel;
    }

    public function deletedciAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                 $Nume =  $request->getPost('Nume');
                $this->getDciTable()->deleteDci($Nume);
                $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            }

            // Redirect to list of laboratoire
            return $this->redirect()->toRoute('parametres');
        }

        $viewModel->Nume = $Nume;
        $viewModel->list = $this->getDciTable()->getDci($Nume);
        return $viewModel;
    }

    public function deletedosaAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                 $Nume =  $request->getPost('Nume');
                $this->getDosaTable()->deleteDosa($Nume);
                $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            }

            // Redirect to list of laboratoire
            return $this->redirect()->toRoute('parametres');
        }

        $viewModel->Nume = $Nume;
        $viewModel->list = $this->getDosaTable()->getDosa($Nume);
        return $viewModel;
    }

    public function deletegaleAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                 $Nume =  $request->getPost('Nume');
                $this->getGaleTable()->deleteGale($Nume);
                $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            }

            // Redirect to list of laboratoire
            return $this->redirect()->toRoute('parametres');
        }

        $viewModel->Nume = $Nume;
        $viewModel->list = $this->getGaleTable()->getGale($Nume);
        return $viewModel;
    }

    public function deleteprovAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                 $Nume =  $request->getPost('Nume');
                $this->getProvTable()->deleteProv($Nume);
                $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            }

            // Redirect to list of laboratoire
            return $this->redirect()->toRoute('parametres');
        }

        $viewModel->Nume = $Nume;
        $viewModel->list = $this->getProvTable()->getProv($Nume);
        return $viewModel;
    }

    public function deletefabrAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                 $Nume =  $request->getPost('Nume');
                $this->getFabrTable()->deleteFabr($Nume);
                $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            }

            // Redirect to list of laboratoire
            return $this->redirect()->toRoute('parametres');
        }

        $viewModel->Nume = $Nume;
        $viewModel->list = $this->getFabrTable()->getFabr($Nume);
        return $viewModel;
    }

    public function deletechrgAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                 $Nume =  $request->getPost('Nume');
                $this->getChrgTable()->deleteChrg($Nume);
                $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            }

            // Redirect to list of laboratoire
            return $this->redirect()->toRoute('parametres');
        }

        $viewModel->Nume = $Nume;
        $viewModel->list = $this->getChrgTable()->getChrg($Nume);
        return $viewModel;
    }

    public function deleteitemdestAction() {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $Nume =  $this->params()->fromRoute('Nume', 0);
        if (!$Nume) {
            return $this->redirect()->toRoute('parametres');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                 $Nume =  $request->getPost('Nume');
                $this->getItemdestTable()->deleteItemdest($Nume);
                $this->flashMessenger()->addSuccessMessage('La suppression a été faite avec succées.');
            }

            // Redirect to list of laboratoire
            return $this->redirect()->toRoute('parametres');
        }

        $viewModel->Nume = $Nume;
        $viewModel->list = $this->getItemdestTable()->getItemdest($Nume);
        return $viewModel;
    }

    public function bordAction() {
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $lastMonthstart = date("Y-m-01", strtotime("-1 Months", strtotime(date("Y-m-d"))));
        $lastMonthend = date("Y-m-01");

        $date = date("Y-m-d");
        // echo $date;
        //exit;
        $where = " ((ConfDat_>='" . $lastMonthend . "')AND(ConfDat_<'" . $date . "')AND (ConfSero>0))";
        $col = array('ConfSero', 'Sexe', 'count' => new \Zend\Db\Sql\Expression('COUNT(*)'));
        $group = array('Sexe', 'ConfSero');
        $depi = $this->getDepiTable()->Rapport($where, $col, $group)->toArray();
        $tabdepis = $this->initialisation(3, 2, 0);
        $i = 0;
        foreach ($depi as $depis) {
            $tabdepis[$depi[$i]['ConfSero']][$depi[$i]['Sexe']] = $depi[$i]['count'];
            $i++;
        }
        // % et total
        $j = 0;
        if (isset($tabdepis)) {
            $tabdepis = $this->totcol($tabdepis);
            $tabdepis = $this->totrow($tabdepis);
            end($tabdepis);
            $key = key($tabdepis);
            end($tabdepis[$key]);
            $key2 = key($tabdepis[$key]);
            $tabdepis = $this->pourcentrow($tabdepis, $tabdepis[$key][$key2]);
            $tabdepis = $this->pourcentcol($tabdepis, $tabdepis[$key][$key2]);
            $titre = array(1 => 'Positifs', 2 => "Négatifs", 3 => "Indéterminés", 4 => "Total", 5 => "Pourcentage");
            $tabdepis = $this->settitle($tabdepis, $titre);
        }

        $wherelast = " Modi >= '$lastMonthstart 00:00:00' AND Modi <= '$lastMonthend 23:59:59' ";
        $wherecurr = " Modi >= '$lastMonthend 00:00:00' AND Modi <= '$date 23:59:59' ";

        $mois_fr = Array("", "Jan", "Fév", "Mar", "Avr", "Mai", "Jui", "Juil", "Août",
            "Sept", "Oct", "Nov", "Déc");

        list($annee, $mois, $jour) = explode('-', date("Y-n-01", strtotime("-1 Months", strtotime(date("Y-n-d")))));
        $lastdate = $mois_fr[$mois] . ' ' . $annee;

        return new ViewModel(array(
            'accueil' => array('curr' => $this->getCount()->Rapport($this->prefixe . "entr", $wherecurr), 'last' => $this->getCount()->Rapport($this->prefixe . "entr", $wherelast)),
            'depistage' => array('curr' => $this->getCount()->Rapport($this->prefixe . "depi", $wherecurr), 'last' => $this->getCount()->Rapport($this->prefixe . "depi", $wherelast)),
            'dispensation' => array('curr' => $this->getCount()->Rapport($this->prefixe . "item", $wherecurr), 'last' => $this->getCount()->Rapport($this->prefixe . "item", $wherelast)),
            'pharmacie' => array('curr' => $this->getCount()->Rapport($this->prefixe . "item", $wherecurr), 'last' => $this->getCount()->Rapport($this->prefixe . "item", $wherelast)),
            'dossiers' => array('curr' => $this->getCount()->Rapport($this->prefixe . "doss", $wherecurr), 'last' => $this->getCount()->Rapport($this->prefixe . "doss", $wherelast)),
            'oev' => array('curr' => $this->getCount()->Rapport($this->prefixe . "oev_", $wherecurr), 'last' => $this->getCount()->Rapport($this->prefixe . "oev_", $wherelast)),
            'communaute' => array('curr' => $this->getCount()->Rapport($this->prefixe . "comm", $wherecurr), 'last' => $this->getCount()->Rapport($this->prefixe . "comm", $wherelast)),
            'laboratoire' => array('curr' => $this->getCount()->Rapport($this->prefixe . "entr", $wherecurr), 'last' => $this->getCount()->Rapport($this->prefixe . "entr", $wherelast)),
            'lastdate' => $lastdate,
            'tabdepis' => $tabdepis,
        ));
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
            if ($tot == 0) {
                $tabdepis[$k][] = "0%";
            } else {
                $tabdepis[$k][] = round($subArray[count($subArray)] * 100 / $tot) . "%";
            }
        }
        return($tabdepis);
    }

    public function pourcentcol($tabdepis, $tot) {
        //pourcentage col
        $col = 0;
        foreach ($tabdepis as $k => $subArray) {
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
                if ($tot == 0) {
                    $tabdepis[$newrow][$i] = "0%";
                } else {
                    $tabdepis[$newrow][$i] = round($tabdepis[$taillerow][$i] * 100 / $tot) . "%";
                    if (round($tabdepis[$taillerow][$i] * 100 / $tot) > 100) {
                        $tabdepis[$newrow][$i] = "";
                    }
                }
            }
        }
        return($tabdepis);
    }

    public function settitle($tabdepis, $titre) {
        foreach ($tabdepis as $k => $tabdepi) {
            $tabdepis[$k]['titre'] = $titre[$k];
        }
        return($tabdepis);
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

    public function getCount() {
        if (!$this->entrTable) {
            $sm = $this->getServiceLocator();
            $this->entrTable = $sm->get('Accueil\Model\EntrTable');
        }
        return $this->entrTable;
    }

    public function getRoleTable() {
        if (!$this->roleTable) {
            $sm = $this->getServiceLocator();
            $this->roleTable = $sm->get('Parametres\Model\RoleTable');
        }
        return $this->roleTable;
    }

    public function getDepiTable() {
        if (!$this->depiTable) {
            $sm = $this->getServiceLocator();
            $this->depiTable = $sm->get('Analyse\Model\DepiTable');
        }
        return $this->depiTable;
    }

    public function getPermissionTable() {
        if (!$this->permissionTable) {
            $sm = $this->getServiceLocator();
            $this->permissionTable = $sm->get('Parametres\Model\PermissionTable');
        }
        return $this->permissionTable;
    }

    public function getResourceTable() {
        if (!$this->resourceTable) {
            $sm = $this->getServiceLocator();
            $this->resourceTable = $sm->get('Parametres\Model\ResourceTable');
        }
        return $this->resourceTable;
    }

    public function getRolePermissionTable() {
        if (!$this->rolePermissionTable) {
            $sm = $this->getServiceLocator();
            $this->rolePermissionTable = $sm->get('Parametres\Model\RolePermissionTable');
        }
        return $this->rolePermissionTable;
    }

    public function getUserTable() {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Parametres\Model\UserTable');
        }
        return $this->userTable;
    }

    public function getListTable() {
        if (!$this->listTable) {
            $sm = $this->getServiceLocator();
            $this->listTable = $sm->get('Parametres\Model\ListeTable');
        }
        return $this->listTable;
    }

    public function getDciTable() {
        if (!$this->dciTable) {
            $sm = $this->getServiceLocator();
            $this->dciTable = $sm->get('Dossiers\Model\DciTable');
        }
        return $this->dciTable;
    }

    public function getDosaTable() {
        if (!$this->DosaTable) {
            $sm = $this->getServiceLocator();
            $this->DosaTable = $sm->get('Dossiers\Model\DosaTable');
        }
        return $this->DosaTable;
    }

    public function getGaleTable() {
        if (!$this->GaleTable) {
            $sm = $this->getServiceLocator();
            $this->GaleTable = $sm->get('Dossiers\Model\GaleTable');
        }
        return $this->GaleTable;
    }

    public function getProvTable() {
        if (!$this->ProvTable) {
            $sm = $this->getServiceLocator();
            $this->ProvTable = $sm->get('Dossiers\Model\ProvTable');
        }
        return $this->ProvTable;
    }

    public function getFabrTable() {
        if (!$this->FabrTable) {
            $sm = $this->getServiceLocator();
            $this->FabrTable = $sm->get('Dossiers\Model\FabrTable');
        }
        return $this->FabrTable;
    }

    public function getChrgTable() {
        if (!$this->ChrgTable) {
            $sm = $this->getServiceLocator();
            $this->ChrgTable = $sm->get('Dossiers\Model\ChrgTable');
        }
        return $this->ChrgTable;
    }

    public function getProdTable() {
        if (!$this->ProdTable) {
            $sm = $this->getServiceLocator();
            $this->ProdTable = $sm->get('Dossiers\Model\ProdTable');
        }
        return $this->ProdTable;
    }

    public function getItemdestTable() {
        if (!$this->ItemdestTable) {
            $sm = $this->getServiceLocator();
            $this->ItemdestTable = $sm->get('Dossiers\Model\ItemdestTable');
        }
        return $this->ItemdestTable;
    }

    public function getUserRoleTable() {
        if (!$this->userRoleTable) {
            $sm = $this->getServiceLocator();
            $this->userRoleTable = $sm->get('Parametres\Model\UserRoleTable');
        }
        return $this->userRoleTable;
    }

    public function getConfTable() {
        if (!$this->confTable) {
            $sm = $this->getServiceLocator();
            $this->confTable = $sm->get('Parametres\Model\ConfTable');
        }
        return $this->confTable;
    }

    public function getCentreTable() {
        if (!$this->centreTable) {
            $sm = $this->getServiceLocator();
            $this->centreTable = $sm->get('Parametres\Model\CentreTable');
        }
        return $this->centreTable;
    }

}
