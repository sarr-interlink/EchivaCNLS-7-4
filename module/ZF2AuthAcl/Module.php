<?php

namespace ZF2AuthAcl;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\Adapter\DbTable as DbAuthAdapter;
use Zend\Session\Container;
use ZF2AuthAcl\Model\User;
use ZF2AuthAcl\Model\UserRole;
use ZF2AuthAcl\Model\PermissionTable;
use ZF2AuthAcl\Model\ResourceTable;
use ZF2AuthAcl\Model\RolePermissionTable;
use Zend\Authentication\AuthenticationService;
use ZF2AuthAcl\Model\Role;
use ZF2AuthAcl\Utility\Acl;
use ZF2AuthAcl\Plugin\userAuthRole;
use Parametres\Model\UserRoleTable;

class Module {

    public function onBootstrap(MvcEvent $e) {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        $sm = $e->getApplication()->getServiceManager();
        $config = $sm->get('config');
        $zfcServiceEvents = $sm->get('zfcuser_user_service')->getEventManager();


        $zfcServiceEvents->attach('register.post', function($e) use($sm, $config) {
            $user = $e->getParam('user');  // User account object
            $form = $e->getParam('form');  // Form object
            if (isset($config['authRoleSettings'])) {
                $rolsselec = $form->get('profil')->getValue();
				$userrole = new \Parametres\Model\UserRole();
                foreach ($rolsselec as $rs) {
					$userrole = new \Parametres\Model\UserRole();
					$userrole->user_id = $user->getId();
					$userrole->role_id =  $rs;
					$userrole->id =  "14".hexdec(uniqid());
                    $sm->get('Parametres\Model\UserRoleTable')->saveUserRole($userrole);
                }
            } else {
                throw new \Exception('Role Auth setting are not present');
            }
        });
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array(
            $this,
            'boforeDispatch'
                ), 100);
    }

    function boforeDispatch(MvcEvent $event) {
        $request = $event->getRequest();
        $response = $event->getResponse();
        $target = $event->getTarget();

        $whiteList = array(
            'zfcuser-login',
            'goalioforgotpassword_forgot-forgot'
        );

        $globalList = array(
            'Accueil\Controller\Accueil-data',
            'Communaute\Controller\Communaute-data',
            'Depistage\Controller\Depistage-data',
            'Dispensation\Controller\Dispensation-data',
            'Dossiers\Controller\Dossiers-data',
            'Laboratoire\Controller\Laboratoire-data',
            'Parametres\Controller\Parametres-bord',
            'ZF2AuthAcl\Controller\Index-permission-denied',
            'zfcuser-index',
            'zfcuser-changepassword',
            'zfcuser-changeemail'
        );

        $requestUri = $request->getRequestUri();
        $controller = $event->getRouteMatch()->getParam('controller');

        $action = $event->getRouteMatch()->getParam('action');
        $requestedResourse = $controller . "-" . $action;
        $serviceManager = $event->getApplication()->getServiceManager();
        $config = $serviceManager->get('config');

        if (isset($config['authRoleSettings']['whiteList'])) {
            $whiteList = array_merge($whiteList, $config['authRoleSettings']['beforeLoginList']);
        }
        if (isset($config['authRoleSettings']['globalList'])) {
            $globalList = array_merge($globalList, $config['authRoleSettings']['globalList']);
        }

        $auth = $serviceManager->get('zfcuser_auth_service');

        if ($auth->hasIdentity()) {
            if ($requestedResourse == 'zfcuser-login' || in_array($requestedResourse, $whiteList)) {

                $url = '/';
                $response->setHeaders($response->getHeaders()
                                ->addHeaderLine('Location', $url));
                $response->setStatusCode(302);
            } else {
                $roleAtuth = $serviceManager->get('roleAuthService');
                $acl = $serviceManager->get('Acl');
                $acl->initAcl();
                $userRole = $roleAtuth->setUserRole($auth->getIdentity()->getId(), $serviceManager);
                $acl->addRole('someUser', $userRole);
                if (!in_array($requestedResourse, $globalList)) {
                    $status = $acl->isAccessAllowed('someUser', $controller, $action);
                    if (!$status) {
                        $url = '/';
                        $response->setHeaders($response->getHeaders()
                                        ->addHeaderLine('Location', $url));
                        $response->setStatusCode(302);
                    }
                }
            }
        } else {
            if ($requestedResourse != 'zfcuser-login' && !in_array($requestedResourse, $whiteList) && !in_array($requestedResourse, $globalList)) {
                $url = $event->getRouter()->assemble(array("controller" => "login"), array('name' => 'zfcuser'));
                $response->setHeaders($response->getHeaders()
                                ->addHeaderLine('Location', $url));
                $response->setStatusCode(302);
            }
            $response->sendHeaders();
        }
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
                )
            )
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'AuthService' => function ($serviceManager) {
                    $adapter = $serviceManager->get('Zend\Db\Adapter\Adapter');
                    $dbAuthAdapter = new DbAuthAdapter($adapter, 'users', 'email', 'password');
                    $auth = new AuthenticationService();
                    $auth->setAdapter($dbAuthAdapter);
                    return $auth;
                },
                'Acl' => function ($serviceManager) {
                    return new Acl($serviceManager->get('Zend\Db\Adapter\Adapter'));
                },
                'UserTable' => function ($serviceManager) {
                    return new User($serviceManager->get('Zend\Db\Adapter\Adapter'));
                },
                'RoleTable' => function ($serviceManager) {
                    return new Role($serviceManager->get('Zend\Db\Adapter\Adapter'));
                },
                'UserRoleTable' => function ($serviceManager) {
                    return new UserRole($serviceManager->get('Zend\Db\Adapter\Adapter'));
                },
                'PermissionTable' => function ($serviceManager) {
                    return new PermissionTable($serviceManager->get('Zend\Db\Adapter\Adapter'));
                },
                'ResourceTable' => function ($serviceManager) {
                    return new ResourceTable($serviceManager->get('Zend\Db\Adapter\Adapter'));
                },
                'RolePermissionTable' => function ($serviceManager) {
                    return new RolePermissionTable($serviceManager->get('Zend\Db\Adapter\Adapter'));
                },
                'roleAuthService' => function ($serviceManager) {
                    return new userAuthRole();
                },
				 'Parametres\Model\UserRoleTable' => function($sm) {
                    $tableGateway = $sm->get('UserRoleTableGatewayParametres');
                    $table = new  UserRoleTable($tableGateway);
                    return $table;
                },
                'UserRoleTableGatewayParametres' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new  Parametres\Model\UserRole());
                    return new TableGateway('user_role', $dbAdapter, null, $resultSetPrototype);
                },
            )
        );
    }

    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'navigation' => function($pm) {
                    $services = $pm->getServiceLocator();
                    $acl = $services->get('Acl');
                    $navigation = $pm->get('Zend\View\Helper\Navigation');
                    $navigation->setAcl($acl);
                    $navigation->setRole('someUser');
                    return $navigation;
                },
                'roleAuth' => function($sm) {
                    $roleAuth = new \ZF2AuthAcl\Plugin\View\userAuthRoleHelper();
                    return $roleAuth;
                },
                'IsAllowed' => function($sm) {
                    $IsAllowed = new \ZF2AuthAcl\Plugin\IsAllowed();
                    $services = $sm->getServiceLocator();
                    $acl = $services->get('Acl');
                    $IsAllowed->setAcl($acl);
                    $IsAllowed->setRole('someUser');
                    return $IsAllowed;
                },
            )
        );
    }

}
