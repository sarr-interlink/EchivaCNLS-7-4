<?php

namespace Oev;

use Oev\Model\Oev;
use Oev\Model\OevTable;
use Oev\Model\Liste;
use Oev\Model\ListeTable;
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
                'Oev\Model\OevTable' => function($sm) {
                    $tableGateway = $sm->get('OevTableGateway');
                    $table = new OevTable($tableGateway);
                    return $table;
                },
                'OevTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Oev());
                    return new TableGateway($this->prefixe . 'oev_', $dbAdapter, null, $resultSetPrototype);
                },
                'Oev\Model\ListeTable' => function($sm) {
                    $tableGateway = $sm->get('ListeTableGateway');
                    $table = new ListeTable($tableGateway);
                    return $table;
                },
                'ListeTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Liste());
                    return new TableGateway($this->prefixe . 'list', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

}
