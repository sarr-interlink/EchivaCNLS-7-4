<?php

namespace Dispensation;

use Dispensation\Model\Doss;
use Dispensation\Model\DossTable;
use Dispensation\Model\ConfTable;
use Dispensation\Model\Conf;
use Dispensation\Model\Prod;
use Dispensation\Model\ProdTable;
use Dispensation\Model\Dci;
use Dispensation\Model\DciTable;
use Dispensation\Model\Dosa;
use Dispensation\Model\DosaTable;
use Dispensation\Model\Gale;
use Dispensation\Model\GaleTable;
use Dispensation\Model\Fabr;
use Dispensation\Model\FabrTable;
use Dispensation\Model\Medicons;
use Dispensation\Model\MediconsTable;
use Dispensation\Model\Item;
use Dispensation\Model\ItemTable;
use Dispensation\Model\Liste;
use Dispensation\Model\ListeTable;
use Dispensation\Model\Obsecons;
use Dispensation\Model\ObseconsTable;
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
                'Dispensation\Model\DossTable' => function($sm) {
                    $tableGateway = $sm->get('DossTableGatewaydisp');
                    $table = new DossTable($tableGateway);
                    $table->setServiceLocator($sm);
                    return $table;
                },
                'DossTableGatewaydisp' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Doss());
                    return new TableGateway($this->prefixe . 'doss', $dbAdapter, null, $resultSetPrototype);
                },
                'Dispensation\Model\ConfTable' => function($sm) {
                    $tableGateway = $sm->get('ConfTableGatewaydisp');
                    $table = new ConfTable($tableGateway);
                    return $table;
                },
                'ConfTableGatewaydisp' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Conf());
                    return new TableGateway($this->prefixeagent . 'conf', $dbAdapter, null, $resultSetPrototype);
                },
                'Dispensation\Model\ProdTable' => function($sm) {
                    $tableGateway = $sm->get('ProdTableGatewaydisp');
                    $table = new ProdTable($tableGateway);
                    return $table;
                },
                'ProdTableGatewaydisp' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Prod());
                    return new TableGateway($this->prefixeagent . 'prod', $dbAdapter, null, $resultSetPrototype);
                },
                'Dispensation\Model\DciTable' => function($sm) {
                    $tableGateway = $sm->get('DciTableGatewaydisp');
                    $table = new DciTable($tableGateway);
                    return $table;
                },
                'DciTableGatewaydisp' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Dci());
                    return new TableGateway('dci_', $dbAdapter, null, $resultSetPrototype);
                },
                'Dispensation\Model\DosaTable' => function($sm) {
                    $tableGateway = $sm->get('DosaTableGatewaydisp');
                    $table = new DosaTable($tableGateway);
                    return $table;
                },
                'DosaTableGatewaydisp' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Dosa());
                    return new TableGateway($this->prefixeagent . 'dosa', $dbAdapter, null, $resultSetPrototype);
                },
                'Dispensation\Model\GaleTable' => function($sm) {
                    $tableGateway = $sm->get('GaleTableGatewaydisp');
                    $table = new GaleTable($tableGateway);
                    return $table;
                },
                'GaleTableGatewaydisp' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Gale());
                    return new TableGateway($this->prefixeagent . 'gale', $dbAdapter, null, $resultSetPrototype);
                },
                'Dispensation\Model\FabrTable' => function($sm) {
                    $tableGateway = $sm->get('FabrTableGatewaydisp');
                    $table = new FabrTable($tableGateway);
                    return $table;
                },
                'FabrTableGatewaydisp' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Fabr());
                    return new TableGateway($this->prefixeagent . 'fabr', $dbAdapter, null, $resultSetPrototype);
                },
                'Dispensation\Model\MediconsTable' => function($sm) {
                    $tableGateway = $sm->get('MediconsTableGatewaydisp');
                    $table = new MediconsTable($tableGateway);
                    return $table;
                },
                'MediconsTableGatewaydisp' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Medicons());
                    return new TableGateway($this->prefixe . 'medicons', $dbAdapter, null, $resultSetPrototype);
                },
                'Dispensation\Model\ItemTable' => function($sm) {
                    $tableGateway = $sm->get('ItemTableGatewaydisp');
                    $table = new ItemTable($tableGateway);
                    return $table;
                },
                'ItemTableGatewaydisp' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Item());
                    return new TableGateway($this->prefixeagent . 'item', $dbAdapter, null, $resultSetPrototype);
                },
                'Dispensation\Model\ListeTable' => function($sm) {
                    $tableGateway = $sm->get('ListeTableGatewaydisp');
                    $table = new ListeTable($tableGateway);
                    return $table;
                },
                'ListeTableGatewaydisp' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Liste());
                    return new TableGateway('list', $dbAdapter, null, $resultSetPrototype);
                },
                'Dispensation\Model\ObseconsTable' => function($sm) {
                    $tableGateway = $sm->get('ObseconsTableGatewaydisp');
                    $table = new ObseconsTable($tableGateway);
                    return $table;
                },
                'ObseconsTableGatewaydisp' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Obsecons());
                    return new TableGateway($this->prefixe . 'Obsecons', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

}
