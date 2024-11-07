<?php

namespace Depistage;

use Depistage\Model\Depi;
use Depistage\Model\DepiTable;
use Depistage\Model\Entr;
use Depistage\Model\EntrTable;
use Depistage\Model\Liste;
use Depistage\Model\ListeTable;
use Depistage\Model\Doss;
use Depistage\Model\DossTable;
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
                'Depistage\Model\DepiTable' => function($sm) {
                    $tableGateway = $sm->get('DepiTableGatewaydepis');
                    $table = new DepiTable($tableGateway);
                    return $table;
                },
                'DepiTableGatewaydepis' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Depi());
                    return new TableGateway($this->prefixe . 'depi', $dbAdapter, null, $resultSetPrototype);
                },
                'Depistage\Model\EntrTable' => function($sm) {
                    $tableGateway = $sm->get('EntrTableGatewaydepis');
                    $table = new EntrTable($tableGateway);
                    return $table;
                },
                'EntrTableGatewaydepis' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entr());
                    return new TableGateway($this->prefixe . 'entr', $dbAdapter, null, $resultSetPrototype);
                },
                'Depistage\Model\DossTable' => function($sm) {
                    $tableGateway = $sm->get('DossTableGatewaydepis');
                    $table = new DossTable($tableGateway);
                    return $table;
                },
                'DossTableGatewaydepis' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Doss());
                    return new TableGateway($this->prefixe . 'doss', $dbAdapter, null, $resultSetPrototype);
                },
				'Depistage\Model\ListeTable' => function($sm) {
                    $tableGateway = $sm->get('ListeTableGatewaydepis');
                    $table = new ListeTable($tableGateway);
                    return $table;
                },
                'ListeTableGatewaydepis' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Liste());
                    return new TableGateway( 'list', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

}
