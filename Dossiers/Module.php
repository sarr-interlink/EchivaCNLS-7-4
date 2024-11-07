<?php

namespace Dossiers;

use Dossiers\Form\CategoryFieldset;
use Dossiers\Model\Entr;
use Dossiers\Model\EntrTable;
use Dossiers\Model\Entrlab;
use Dossiers\Model\EntrlabTable;
use Dossiers\Model\Doss;
use Dossiers\Model\DossTable;
use Dossiers\Model\Dosa;
use Dossiers\Model\DosaTable;
use Dossiers\Model\Prov;
use Dossiers\Model\ProvTable;
use Dossiers\Model\Gale;
use Dossiers\Model\GaleTable;
use Dossiers\Model\Itemdest;
use Dossiers\Model\ItemdestTable;
use Dossiers\Model\Fabr;
use Dossiers\Model\FabrTable;
use Dossiers\Model\Fiche;
use Dossiers\Model\FicheTable;
use Dossiers\Model\Social;
use Dossiers\Model\SocialTable;
use Dossiers\Model\Socialser;
use Dossiers\Model\SocialserTable;
use Dossiers\Model\Socialaut;
use Dossiers\Model\SocialautTable;
use Dossiers\Model\Socialsoc;
use Dossiers\Model\SocialsocTable;
use Dossiers\Model\Liste;
use Dossiers\Model\ListeTable;
use Dossiers\Model\Loca;
use Dossiers\Model\LocaTable;
use Dossiers\Model\Chrg;
use Dossiers\Model\ChrgTable;
use Dossiers\Model\Sociconsconc;
use Dossiers\Model\SociconsconcTable;
use Dossiers\Model\Socicons;
use Dossiers\Model\SociconsTable;
use Dossiers\Model\Psyconsconc;
use Dossiers\Model\PsyconsconcTable;
use Dossiers\Model\Psycons;
use Dossiers\Model\PsyconsTable;
use Dossiers\Model\Socienfa;
use Dossiers\Model\SocienfaTable;
use Dossiers\Model\Csi;
use Dossiers\Model\CsiTable;
use Dossiers\Model\Medicalouv;
use Dossiers\Model\MedicalouvTable;
use Dossiers\Model\Mediconscond;
use Dossiers\Model\MediconscondTable;
use Dossiers\Model\Medicons;
use Dossiers\Model\MediconsTable;
use Dossiers\Model\Ptmegros;
use Dossiers\Model\PtmegrosTable;
use Dossiers\Model\Ptmeenfacons;
use Dossiers\Model\PtmeenfaconsTable;
use Dossiers\Model\Dci;
use Dossiers\Model\DciTable;
use Dossiers\Model\Lieuacco;
use Dossiers\Model\LieuaccoTable;
use Dossiers\Model\Prod;
use Dossiers\Model\ProdTable;
use Dossiers\Model\Obsecons;
use Dossiers\Model\ObseconsTable;
use Dossiers\Model\Conf;
use Dossiers\Model\ConfTable;
use Dossiers\Model\User;
use Dossiers\Model\UserTable;
use Dossiers\Model\Trans;
use Dossiers\Model\TransTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module {

    public $prefixe;

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {

        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixe = $prefixe->offsetGet('prefixe');
        $this->prefixeagent = $prefixe->offsetGet('prefixeagent');

        return array(
            'factories' => array(
                'CategoryFieldset' => function($sm) {
                    // I assume here that the Album\Model\AlbumTable
                    // dependency have been defined too
                    $serviceLocator = $sm->getServiceLocator();
                    $listeTable = $serviceLocator->get('Dossiers\Model\ListeTable');
                    $fieldset = new CategoryFieldset($listeTable);
                    return $fieldset;
                },
                'Dossiers\Model\EntrTable' => function($sm) {
                    $tableGateway = $sm->get('EntrTableGatewaydoss');
                    $table = new EntrTable($tableGateway);
                    return $table;
                },
                'EntrTableGatewaydoss' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entr());
                    return new TableGateway($this->prefixe . 'entr', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\EntrlabTable' => function($sm) {
                    $tableGateway = $sm->get('EntrlabTableGatewaydoss');
                    $table = new EntrlabTable($tableGateway);
                    return $table;
                },
                'EntrlabTableGatewaydoss' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entrlab());
                    return new TableGateway($this->prefixe . 'entr', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\DossTable' => function($sm) {
                    $tableGateway = $sm->get('DossTableGateway');
                    $table = new DossTable($tableGateway);
                    $table->setServiceLocator($sm);
                    return $table;
                },
                'DossTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Doss());
                    return new TableGateway($this->prefixe . 'doss', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\DosaTable' => function($sm) {
                    $tableGateway = $sm->get('DosaTableGateway');
                    $table = new DosaTable($tableGateway);
                    //$table->setServiceLocator($sm);
                    return $table;
                },
                'DosaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Dosa());
                    return new TableGateway($this->prefixeagent . 'dosa', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\GaleTable' => function($sm) {
                    $tableGateway = $sm->get('GaleTableGateway');
                    $table = new GaleTable($tableGateway);
                    //$table->setServiceLocator($sm);
                    return $table;
                },
                'GaleTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Gale());
                    return new TableGateway($this->prefixeagent . 'gale', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\ItemdestTable' => function($sm) {
                    $tableGateway = $sm->get('ItemdestTableGateway');
                    $table = new ItemdestTable($tableGateway);
                    //$table->setServiceLocator($sm);
                    return $table;
                },
                'ItemdestTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Itemdest());
                    return new TableGateway($this->prefixeagent . 'itemdest', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\FabrTable' => function($sm) {
                    $tableGateway = $sm->get('FabrTableGateway');
                    $table = new FabrTable($tableGateway);
                    //$table->setServiceLocator($sm);
                    return $table;
                },
                'FabrTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Fabr());
                    return new TableGateway($this->prefixeagent . 'fabr', $dbAdapter, null, $resultSetPrototype);
                }, 'Dossiers\Model\ProvTable' => function($sm) {
                    $tableGateway = $sm->get('ProvTableGateway');
                    $table = new ProvTable($tableGateway);
                    //$table->setServiceLocator($sm);
                    return $table;
                },
                'ProvTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Prov());
                    return new TableGateway($this->prefixeagent . 'prov', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\FicheTable' => function($sm) {
                    $tableGateway = $sm->get('FicheTableGateway');
                    $table = new FicheTable($tableGateway);
                    //   $table->setServiceLocator($sm);
                    return $table;
                },
                'FicheTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Fiche());
                    return new TableGateway($this->prefixe . 'doss', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\SocialTable' => function($sm) {
                    $tableGateway = $sm->get('SocialTableGateway');
                    $table = new SocialTable($tableGateway);
                    $table->setServiceLocator($sm);
                    return $table;
                },
                'SocialTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Social());
                    return new TableGateway($this->prefixe . 'doss', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\SocialserTable' => function($sm) {
                    $tableGateway = $sm->get('SocialserTableGateway');
                    $table = new SocialserTable($tableGateway);
                    // $table->setServiceLocator($sm);
                    return $table;
                },
                'SocialserTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Socialser());
                    return new TableGateway($this->prefixe . 'doss', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\SocialautTable' => function($sm) {
                    $tableGateway = $sm->get('SocialautTableGateway');
                    $table = new SocialautTable($tableGateway);
                    // $table->setServiceLocator($sm);
                    return $table;
                },
                'SocialautTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Socialaut());
                    return new TableGateway($this->prefixe . 'doss', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\SocialsocTable' => function($sm) {
                    $tableGateway = $sm->get('SocialsocTableGateway');
                    $table = new SocialsocTable($tableGateway);
                    // $table->setServiceLocator($sm);
                    return $table;
                },
                'SocialsocTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Socialsoc());
                    return new TableGateway($this->prefixe . 'socicons', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\MedicalouvTable' => function($sm) {
                    $tableGateway = $sm->get('MedicalouvTableGateway');
                    $table = new MedicalouvTable($tableGateway);
                    $table->setServiceLocator($sm);
                    return $table;
                },
                'MedicalouvTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Medicalouv());
                    return new TableGateway($this->prefixe . 'doss', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\ListeTable' => function($sm) {
                    $tableGateway = $sm->get('ListeTableGateway');
                    $table = new ListeTable($tableGateway);
                    return $table;
                },
                'ListeTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Liste());
                    return new TableGateway( 'list', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\LocaTable' => function($sm) {
                    $tableGateway = $sm->get('LocaTableGateway');
                    $table = new LocaTable($tableGateway);
                    return $table;
                },
                'LocaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Loca());
                    return new TableGateway('loca', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\ChrgTable' => function($sm) {
                    $tableGateway = $sm->get('ChrgTableGateway');
                    $table = new ChrgTable($tableGateway);
                    return $table;
                },
                'ChrgTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Chrg());
                    return new TableGateway($this->prefixeagent . 'chrg', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\SociconsconcTable' => function($sm) {
                    $tableGateway = $sm->get('SociconsconcTableGateway');
                    $table = new SociconsconcTable($tableGateway);
                    return $table;
                },
                'SociconsconcTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Sociconsconc());
                    return new TableGateway($this->prefixe . 'sociconsconc', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\PsyconsconcTable' => function($sm) {
                    $tableGateway = $sm->get('PsyconsconcTableGateway');
                    $table = new PsyconsconcTable($tableGateway);
                    return $table;
                },
                'PsyconsconcTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Psyconsconc());
                    return new TableGateway($this->prefixe . 'psy_consconc', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\CsiTable' => function($sm) {
                    $tableGateway = $sm->get('CsiTableGateway');
                    $table = new CsiTable($tableGateway);
                    return $table;
                },
                'CsiTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Csi());
                    return new TableGateway('csi_', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\MediconscondTable' => function($sm) {
                    $tableGateway = $sm->get('MediconscondTableGateway');
                    $table = new MediconscondTable($tableGateway);
                    return $table;
                },
                'MediconscondTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Mediconscond());
                    return new TableGateway($this->prefixe . 'mediconscond', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\DciTable' => function($sm) {
                    $tableGateway = $sm->get('DciTableGateway');
                    $table = new DciTable($tableGateway);
                    return $table;
                },
                'DciTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Dci());
                    return new TableGateway('dci_', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\LieuaccoTable' => function($sm) {
                    $tableGateway = $sm->get('LieuaccoTableGateway');
                    $table = new LieuaccoTable($tableGateway);
                    return $table;
                },
                'LieuaccoTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Lieuacco());
                    return new TableGateway($this->prefixe . 'lieuacco', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\ProdTable' => function($sm) {
                    $tableGateway = $sm->get('ProdTableGateway');
                    $table = new ProdTable($tableGateway);
                    return $table;
                },
                'ProdTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Prod());
                    return new TableGateway($this->prefixeagent . 'prod', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\SociconsTable' => function($sm) {
                    $tableGateway = $sm->get('SociconsTableGateway');
                    $table = new SociconsTable($tableGateway);
                    return $table;
                },
                'SociconsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Socicons());
                    return new TableGateway($this->prefixe . 'socicons', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\PsyconsTable' => function($sm) {
                    $tableGateway = $sm->get('PsyconsTableGateway');
                    $table = new PsyconsTable($tableGateway);
                    return $table;
                },
                'PsyconsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Psycons());
                    return new TableGateway($this->prefixe . 'psy_cons', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\SocienfaTable' => function($sm) {
                    $tableGateway = $sm->get('SocienfaTableGateway');
                    $table = new SocienfaTable($tableGateway);
                    return $table;
                },
                'SocienfaTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Socienfa());
                    return new TableGateway($this->prefixe . 'socienfa', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\MediconsTable' => function($sm) {
                    $tableGateway = $sm->get('MediconsTableGatewaytest');
                    $table = new MediconsTable($tableGateway);
                    return $table;
                },
                'MediconsTableGatewaytest' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Medicons());
                    return new TableGateway($this->prefixe . 'medicons', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\PtmegrosTable' => function($sm) {
                    $tableGateway = $sm->get('PtmegrosTableGateway');
                    $table = new PtmegrosTable($tableGateway);
                    return $table;
                },
                'PtmegrosTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Ptmegros());
                    return new TableGateway($this->prefixe . 'ptmegros', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\PtmeenfaconsTable' => function($sm) {
                    $tableGateway = $sm->get('PtmeenfaconsTableGateway');
                    $table = new PtmeenfaconsTable($tableGateway);
                    return $table;
                },
                'PtmeenfaconsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Ptmeenfacons());
                    return new TableGateway($this->prefixe . 'ptmeenfacons', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\ObseconsTable' => function($sm) {
                    $tableGateway = $sm->get('ObseconsTableGateway');
                    $table = new ObseconsTable($tableGateway);
                    return $table;
                },
                'ObseconsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Obsecons());
                    return new TableGateway($this->prefixe . 'obsecons', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\ConfTable' => function($sm) {
                    $tableGateway = $sm->get('ConfTableGateway');
                    $table = new ConfTable($tableGateway);
                    return $table;
                },
                'ConfTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Conf());
                    return new TableGateway($this->prefixeagent . 'conf', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\UserTable' => function($sm) {
                    $tableGateway = $sm->get('UserTableGatewaye');
                    $table = new UserTable($tableGateway);
                    return $table;
                },
                'UserTableGatewaye' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
                'Dossiers\Model\TransTable' => function($sm) {
                    $tableGateway = $sm->get('TransTableGatewaye');
                    $table = new TransTable($tableGateway);
                    return $table;
                },
                'TransTableGatewaye' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Trans());
                    return new TableGateway('trans', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

}
