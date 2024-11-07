<?php

namespace Communaute;

use Communaute\Model\Commdoss;
use Communaute\Model\CommdossTable;
use Communaute\Model\Comm;
use Communaute\Model\CommTable;
use Communaute\Model\Liste;
use Communaute\Model\ListeTable;
use Communaute\Model\Doss;
use Communaute\Model\DossTable;
use Communaute\Model\Oev;
use Communaute\Model\OevTable;
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
                'Communaute\Model\CommdossTable' => function($sm) {
                    $tableGateway = $sm->get('CommdossTableGateway');
                    $table = new CommdossTable($tableGateway);
                    return $table;
                },
                'CommdossTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Commdoss());
                    return new TableGateway($this->prefixe.'commdoss', $dbAdapter, null, $resultSetPrototype);
                },
                'Communaute\Model\CommTable' => function($sm) {
                    $tableGateway = $sm->get('CommTableGateway');
                    $table = new CommTable($tableGateway);
                    return $table;
                },
                'CommTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Comm());
                    return new TableGateway($this->prefixe.'comm', $dbAdapter, null, $resultSetPrototype);
                },
                'Communaute\Model\DossTable' => function($sm) {
                    $tableGateway = $sm->get('DossTableGateway');
                    $table = new DossTable($tableGateway);
                    return $table;
                },
                'DossTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Doss());
                    return new TableGateway($this->prefixe.'doss', $dbAdapter, null, $resultSetPrototype);
                },
                'Communaute\Model\OevTable' => function($sm) {
                    $tableGateway = $sm->get('OevTableGateway');
                    $table = new OevTable($tableGateway);
                    return $table;
                },
                'OevTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Oev());
                    return new TableGateway($this->prefixe.'oev_', $dbAdapter, null, $resultSetPrototype);
                },
                'Communaute\Model\ListeTable' => function($sm) {
                    $tableGateway = $sm->get('ListeTableGatewayCom');
                    $table = new ListeTable($tableGateway);
                    return $table;
                },
                'ListeTableGatewayCom' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Liste());
                    return new TableGateway('list', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

}
