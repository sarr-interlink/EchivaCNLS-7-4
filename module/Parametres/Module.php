<?php

namespace Parametres;

use Parametres\Model\UserRole;
use Parametres\Model\UserRoleTable;
use Parametres\Model\Liste;
use Parametres\Model\ListeTable;
use Parametres\Model\Centre;
use Parametres\Model\CentreTable;
use Parametres\Model\Logquery;
use Parametres\Model\LogqueryTable;
use Parametres\Model\RolePermission;
use Parametres\Model\RolePermissionTable;
use Parametres\Model\Permission;
use Parametres\Model\PermissionTable;
use Parametres\Model\Resource;
use Parametres\Model\ResourceTable;
use Parametres\Model\Role;
use Parametres\Model\RoleTable;
use Parametres\Model\User;
use Parametres\Model\UserTable;
use Parametres\Model\Dci;
use Parametres\Model\DciTable;
use Parametres\Model\Conf;
use Parametres\Model\ConfTable;
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
                'Parametres\Model\UserRoleTable' => function($sm) {
                    $tableGateway = $sm->get('UserRoleTableGatewayParametres');
                    $table = new UserRoleTable($tableGateway);
                    return $table;
                },
                'UserRoleTableGatewayParametres' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new UserRole());
                    return new TableGateway('user_role', $dbAdapter, null, $resultSetPrototype);
                },
                'Parametres\Model\ListeTable' => function($sm) {
                    $tableGateway = $sm->get('ListeTableGatewayParametres');
                    $table = new ListeTable($tableGateway);
                    return $table;
                },
                'ListeTableGatewayParametres' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Liste());
                    return new TableGateway('list', $dbAdapter, null, $resultSetPrototype);
                },
                'Parametres\Model\RolePermissionTable' => function($sm) {
                    $tableGateway = $sm->get('RolePermissionTableGatewayParametres');
                    $table = new RolePermissionTable($tableGateway);
                    return $table;
                },
                'RolePermissionTableGatewayParametres' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new RolePermission());
                    return new TableGateway('role_permission', $dbAdapter, null, $resultSetPrototype);
                },
                'Parametres\Model\PermissionTable' => function($sm) {
                    $tableGateway = $sm->get('PermissionTableGatewayParametres');
                    $table = new PermissionTable($tableGateway);
                    return $table;
                },
                'PermissionTableGatewayParametres' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Permission());
                    return new TableGateway('permission', $dbAdapter, null, $resultSetPrototype);
                },
                'Parametres\Model\ResourceTable' => function($sm) {
                    $tableGateway = $sm->get('ResourceTableGatewayParametres');
                    $table = new ResourceTable($tableGateway);
                    return $table;
                },
                'ResourceTableGatewayParametres' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Resource());
                    return new TableGateway('resource', $dbAdapter, null, $resultSetPrototype);
                },
                'Parametres\Model\RoleTable' => function($sm) {
                    $tableGateway = $sm->get('RoleTableGatewayParametres');
                    $table = new RoleTable($tableGateway);
                    return $table;
                },
                'RoleTableGatewayParametres' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Role());
                    return new TableGateway('role', $dbAdapter, null, $resultSetPrototype);
                },
                'Parametres\Model\UserTable' => function($sm) {
                    $tableGateway = $sm->get('UserTableGatewayParametres');
                    $table = new UserTable($tableGateway);
                    return $table;
                },
                'UserTableGatewayParametres' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
                'Parametres\Model\DciTable' => function($sm) {
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
				'Parametres\Model\ConfTable' => function($sm) {
                    $tableGateway = $sm->get('ConfTableGatewaypara');
                    $table = new ConfTable($tableGateway);
                    return $table;
                },
                'ConfTableGatewaypara' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Conf());
                    return new TableGateway($this->prefixe .'conf', $dbAdapter, null, $resultSetPrototype);
                },
		'Parametres\Model\CentreTable' => function($sm) {
                    $tableGateway = $sm->get('CentreTableGatewayAccueil');
                    $table = new CentreTable($tableGateway);
                    return $table;
                },
                'CentreTableGatewayAccueil' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Centre());
                    return new TableGateway('centre', $dbAdapter, null, $resultSetPrototype);
                },
		'Parametres\Model\LogqueryTable' => function($sm) {
                    $tableGateway = $sm->get('LogqueryTableGatewayAccueil');
                    $table = new LogqueryTable($tableGateway);
                    return $table;
                },
                'LogqueryTableGatewayAccueil' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Logquery());
                    return new TableGateway('log_query', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

}
