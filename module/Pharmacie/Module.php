<?php

namespace Pharmacie;

use Pharmacie\Model\Doss;
use Pharmacie\Model\DossTable;
use Pharmacie\Model\ConfTable;
use Pharmacie\Model\Conf;
use Pharmacie\Model\Prod;
use Pharmacie\Model\ProdTable;
use Pharmacie\Model\Dci;
use Pharmacie\Model\DciTable;
use Pharmacie\Model\Dosa;
use Pharmacie\Model\DosaTable;
use Pharmacie\Model\Gale;
use Pharmacie\Model\GaleTable;
use Pharmacie\Model\Fabr;
use Pharmacie\Model\FabrTable;
use Pharmacie\Model\Medicons;
use Pharmacie\Model\MediconsTable;
use Pharmacie\Model\Chrg;
use Pharmacie\Model\ChrgTable;
use Pharmacie\Model\Prov;
use Pharmacie\Model\ProvTable;
use Pharmacie\Model\Item;
use Pharmacie\Model\ItemTable;
use Pharmacie\Model\Itemdest;
use Pharmacie\Model\ItemdestTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module {

    public $prefixe;
    public $prefixeagent;
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
                'Pharmacie\Model\DossTable' => function($sm) {
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
                'Pharmacie\Model\ConfTable' => function($sm) {
                    $tableGateway = $sm->get('ConfTableGatewaypharm');
                    $table = new ConfTable($tableGateway);
                    return $table;
                },
                'ConfTableGatewaypharm' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Conf());
                    return new TableGateway($this->prefixeagent . 'conf', $dbAdapter, null, $resultSetPrototype);
                },
                'Pharmacie\Model\ProdTable' => function($sm) {
                    $tableGateway = $sm->get('ProdTableGatewaypharm');
                    $table = new ProdTable($tableGateway);
                    return $table;
                },
                'ProdTableGatewaypharm' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Prod());
                    return new TableGateway($this->prefixeagent . 'prod', $dbAdapter, null, $resultSetPrototype);
                },
                'Pharmacie\Model\DciTable' => function($sm) {
                    $tableGateway = $sm->get('DciTableGatewaypharm');
                    $table = new DciTable($tableGateway);
                    return $table;
                },
                'DciTableGatewaypharm' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Dci());
                    return new TableGateway('dci_', $dbAdapter, null, $resultSetPrototype);
                },
                'Pharmacie\Model\DosaTable' => function($sm) {
                    $tableGateway = $sm->get('DosaTableGatewaypharm');
                    $table = new DosaTable($tableGateway);
                    return $table;
                },
                'DosaTableGatewaypharm' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Dosa());
                    return new TableGateway($this->prefixeagent . 'dosa', $dbAdapter, null, $resultSetPrototype);
                },
                'Pharmacie\Model\GaleTable' => function($sm) {
                    $tableGateway = $sm->get('GaleTableGatewaypharm');
                    $table = new GaleTable($tableGateway);
                    return $table;
                },
                'GaleTableGatewaypharm' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Gale());
                    return new TableGateway($this->prefixeagent . 'gale', $dbAdapter, null, $resultSetPrototype);
                },
                'Pharmacie\Model\FabrTable' => function($sm) {
                    $tableGateway = $sm->get('FabrTableGatewaypharm');
                    $table = new FabrTable($tableGateway);
                    return $table;
                },
                'FabrTableGatewaypharm' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Fabr());
                    return new TableGateway($this->prefixeagent . 'fabr', $dbAdapter, null, $resultSetPrototype);
                },
                'Pharmacie\Model\ProvTable' => function($sm) {
                    $tableGateway = $sm->get('ProvTableGatewaypharm');
                    $table = new ProvTable($tableGateway);
                    return $table;
                },
                'ProvTableGatewaypharm' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Prov());
                    return new TableGateway($this->prefixeagent . 'prov', $dbAdapter, null, $resultSetPrototype);
                },
                'Pharmacie\Model\ChrgTable' => function($sm) {
                    $tableGateway = $sm->get('ChrgTableGatewaypharm');
                    $table = new ChrgTable($tableGateway);
                    return $table;
                },
                'ChrgTableGatewaypharm' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Chrg());
                    return new TableGateway($this->prefixeagent . 'chrg', $dbAdapter, null, $resultSetPrototype);
                },
                'Pharmacie\Model\MediconsTable' => function($sm) {
                    $tableGateway = $sm->get('MediconsTableGatewaypharm');
                    $table = new MediconsTable($tableGateway);
                    return $table;
                },
                'MediconsTableGatewaypharm' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Medicons());
                    return new TableGateway($this->prefixe . 'medicons', $dbAdapter, null, $resultSetPrototype);
                },
                'Pharmacie\Model\ItemTable' => function($sm) {
                    $tableGateway = $sm->get('ItemTableGatewaypharm');
                    $table = new ItemTable($tableGateway);
                    return $table;
                },
                'ItemTableGatewaypharm' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Item());
                    return new TableGateway($this->prefixeagent . 'item', $dbAdapter, null, $resultSetPrototype);
                },
                'Pharmacie\Model\ItemdestTable' => function($sm) {
                    $tableGateway = $sm->get('ItemdestTableGatewaypharm');
                    $table = new ItemdestTable($tableGateway);
                    return $table;
                },
                'ItemdestTableGatewaypharm' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Itemdest());
                    return new TableGateway($this->prefixeagent . 'itemdest', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

}
