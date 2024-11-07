<?php

namespace Laboratoire;

use Laboratoire\Model\Liste;
use Laboratoire\Model\ListeTable;
use Laboratoire\Model\Entr;
use Laboratoire\Model\EntrTable;
use Laboratoire\Model\Doss;
use Laboratoire\Model\DossTable;
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
				'Laboratoire\Model\ListeTable' => function($sm) {
                    $tableGateway = $sm->get('ListeTableGatewayLaboratoire');
                    $table = new ListeTable($tableGateway);
                    return $table;
                },
                'ListeTableGatewayLaboratoire' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Liste());
                    return new TableGateway('list', $dbAdapter, null, $resultSetPrototype);
                },
                'Laboratoire\Model\EntrTable' => function($sm) {
                    $tableGateway = $sm->get('EntrTableGatewayLaboratoire');
                    $table = new EntrTable($tableGateway);
                    return $table;
                },
                'EntrTableGatewayLaboratoire' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entr());
                    return new TableGateway($this->prefixe .'entr', $dbAdapter, null, $resultSetPrototype);
                },
                'Laboratoire\Model\DossTable' => function($sm) {
                    $tableGateway = $sm->get('DossTableGatewayLaboratoire');
                    $table = new DossTable($tableGateway);
                    return $table;
                },
                'DossTableGatewayLaboratoire' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Doss());
                    return new TableGateway($this->prefixe .'doss', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

}
