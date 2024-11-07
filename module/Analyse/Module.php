<?php

namespace Analyse;

use Analyse\Model\ConfTable;
use Analyse\Model\Conf;
use Analyse\Model\Doss;
use Analyse\Model\DossTable;
use Analyse\Model\Comm;
use Analyse\Model\CommTable;
use Analyse\Model\Commdoss;
use Analyse\Model\CommdossTable;
use Analyse\Model\Medicons;
use Analyse\Model\MediconsTable;
use Analyse\Model\Entr;
use Analyse\Model\EntrTable;
use Analyse\Model\Ptmegros;
use Analyse\Model\PtmegrosTable;
use Analyse\Model\Item;
use Analyse\Model\ItemTable;
use Analyse\Model\Socienfa;
use Analyse\Model\SocienfaTable;
use Analyse\Model\Liste;
use Analyse\Model\ListeTable;
use Analyse\Model\Obsecons;
use Analyse\Model\ObseconsTable;
use Analyse\Model\Loca;
use Analyse\Model\LocaTable;
use Analyse\Model\Csi;
use Analyse\Model\CsiTable;
use Analyse\Model\Dci;
use Analyse\Model\DciTable;
use Analyse\Model\Prod;
use Analyse\Model\ProdTable;
use Analyse\Model\Psycons;
use Analyse\Model\PsyconsTable;
use Analyse\Model\Ptmeenfacons;
use Analyse\Model\PtmeenfaconsTable;
use Analyse\Model\Socicons;
use Analyse\Model\SociconsTable;
use Analyse\Model\Droi;
use Analyse\Model\DroiTable;
use Analyse\Model\Depi;
use Analyse\Model\DepiTable;
use Analyse\Model\Chrg;
use Analyse\Model\ChrgTable;
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
		
        return array(
            'factories' => array(
                'Analyse\Model\EntrTable' => function($sm) {
                    $tableGateway = $sm->get('EntrTableGatewayanal');
                    $table = new EntrTable($tableGateway);
                    return $table;
                },
                'EntrTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entr());
                    return new TableGateway($this->prefixe .'entr', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\ConfTable' => function($sm) {
                    $tableGateway = $sm->get('ConfTableGatewayanal');
                    $table = new ConfTable($tableGateway);
                    return $table;
                },
                'ConfTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Conf());
                    return new TableGateway('conf', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\DossTable' => function($sm) {
                    $tableGateway = $sm->get('DossTableGatewayanal');
                    $table = new DossTable($tableGateway);
                    return $table;
                },
                'DossTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Doss());
                    return new TableGateway($this->prefixe .'doss', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\MediconsTable' => function($sm) {
                    $tableGateway = $sm->get('MediconsTableGatewayanal');
                    $table = new MediconsTable($tableGateway);
                    return $table;
                },
                'MediconsTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Medicons());
                    return new TableGateway($this->prefixe .'medicons', $dbAdapter, null, $resultSetPrototype);
                },
                
                'Analyse\Model\DossTable' => function($sm) {
                    $tableGateway = $sm->get('DossTableGatewayanal');
                    $table = new DossTable($tableGateway);
                    return $table;
                },
                'Analyse\Model\PtmegrosTable' => function($sm) {
                    $tableGateway = $sm->get('PtmegrosTableGatewayanal');
                    $table = new PtmegrosTable($tableGateway);
                    return $table;
                },
                'PtmegrosTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Ptmegros());
                    return new TableGateway($this->prefixe .'ptmegros', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\ItemTable' => function($sm) {
                    $tableGateway = $sm->get('ItemTableGatewayanal');
                    $table = new ItemTable($tableGateway);
                    return $table;
                },
                'ItemTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Item());
                    return new TableGateway($this->prefixe .'item', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\CommTable' => function($sm) {
                    $tableGateway = $sm->get('CommTableGatewayanal');
                    $table = new CommTable($tableGateway);
                    return $table;
                },
                'CommTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Comm());
                    return new TableGateway($this->prefixe .'comm', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\CommdossTable' => function($sm) {
                    $tableGateway = $sm->get('CommdossTableGatewayanal');
                    $table = new CommdossTable($tableGateway);
                    return $table;
                },
                'CommdossTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Commdoss());
                    return new TableGateway($this->prefixe .'commdoss', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\SocienfaTable' => function($sm) {
                    $tableGateway = $sm->get('SocienfaTableGatewayanal');
                    $table = new SocienfaTable($tableGateway);
                    return $table;
                },
                'SocienfaTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Socienfa());
                    return new TableGateway($this->prefixe .'socienfa', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\ListeTable' => function($sm) {
                    $tableGateway = $sm->get('ListeTableGatewayanal');
                    $table = new ListeTable($tableGateway);
                    return $table;
                },
                'ListeTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Liste());
                    return new TableGateway('list', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\ObseconsTable' => function($sm) {
                    $tableGateway = $sm->get('ObseconsTableGatewayanal');
                    $table = new ObseconsTable($tableGateway);
                    return $table;
                },
                'ObseconsTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Obsecons());
                    return new TableGateway($this->prefixe .'obsecons', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\ProdTable' => function($sm) {
                    $tableGateway = $sm->get('ProdTableGatewayanal');
                    $table = new ProdTable($tableGateway);
                    return $table;
                },
                'ProdTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Prod());
                    return new TableGateway($this->prefixe .'prod', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\PsyconsTable' => function($sm) {
                    $tableGateway = $sm->get('PsyconsTableGatewayanal');
                    $table = new PsyconsTable($tableGateway);
                    return $table;
                },
                'PsyconsTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Psycons());
                    return new TableGateway($this->prefixe .'psy_cons', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\PtmeenfaconsTable' => function($sm) {
                    $tableGateway = $sm->get('PtmeenfaconsTableGatewayanal');
                    $table = new PtmeenfaconsTable($tableGateway);
                    return $table;
                },
                'PtmeenfaconsTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Ptmeenfacons());
                    return new TableGateway($this->prefixe .'ptmeenfacons', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\SociconsTable' => function($sm) {
                    $tableGateway = $sm->get('SociconsTableGatewayanal');
                    $table = new SociconsTable($tableGateway);
                    return $table;
                },
                'SociconsTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Socicons());
                    return new TableGateway($this->prefixe .'socicons', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\DroiTable' => function($sm) {
                    $tableGateway = $sm->get('DroiTableGatewayanal');
                    $table = new DroiTable($tableGateway);
                    return $table;
                },
                'DroiTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Droi());
                    return new TableGateway('droi', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\DepiTable' => function($sm) {
                    $tableGateway = $sm->get('DepiTableGatewayanal');
                    $table = new DepiTable($tableGateway);
                    return $table;
                },
                'DepiTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Depi());
                    return new TableGateway($this->prefixe .'depi', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\LocaTable' => function($sm) {
                    $tableGateway = $sm->get('LocaTableGatewayanal');
                    $table = new LocaTable($tableGateway);
                    return $table;
                },
                'LocaTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Loca());
                    return new TableGateway('loca', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\CsiTable' => function($sm) {
                    $tableGateway = $sm->get('CsiTableGatewayanal');
                    $table = new CsiTable($tableGateway);
                    return $table;
                },
                'CsiTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Csi());
                    return new TableGateway('csi_', $dbAdapter, null, $resultSetPrototype);
                },
                'Analyse\Model\DciTable' => function($sm) {
                    $tableGateway = $sm->get('DciTableGatewayanal');
                    $table = new DciTable($tableGateway);
                    return $table;
                },
                'DciTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Dci());
                    return new TableGateway('dci_', $dbAdapter, null, $resultSetPrototype);
                },
				'Analyse\Model\ChrgTable' => function($sm) {
                    $tableGateway = $sm->get('ChrgTableGatewayanal');
                    $table = new ChrgTable($tableGateway);
                    return $table;
                },
                'ChrgTableGatewayanal' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Chrg());
                    return new TableGateway($this->prefixe .'chrg', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

}
