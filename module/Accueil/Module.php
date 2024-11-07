<?php

namespace Accueil;

use Accueil\Model\Liste;
use Accueil\Model\ListeTable;
use Accueil\Model\Entr;
use Accueil\Model\EntrTable;
use Accueil\Model\Doss;
use Accueil\Model\DossTable;
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
                'Accueil\Model\ListeTable' => function($sm) {
                    $tableGateway = $sm->get('ListeTableGatewayAccueil');
                    $table = new ListeTable($tableGateway);
                    return $table;
                },
                'ListeTableGatewayAccueil' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Liste());
                    return new TableGateway('list', $dbAdapter, null, $resultSetPrototype);
                },
                'Accueil\Model\EntrTable' => function($sm) {
                    $tableGateway = $sm->get('EntrTableGatewayAccueil');
                    $table = new EntrTable($tableGateway);
                    return $table;
                },
                'EntrTableGatewayAccueil' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Entr());
                    return new TableGateway($this->prefixe . 'entr', $dbAdapter, null, $resultSetPrototype);
                },
                'Accueil\Model\DossTable' => function($sm) {
                    $tableGateway = $sm->get('DossTableGatewayAccueil');
                    $table = new DossTable($tableGateway);
                    return $table;
                },
                'DossTableGatewayAccueil' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Doss());
                    return new TableGateway($this->prefixe . 'doss', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

}
