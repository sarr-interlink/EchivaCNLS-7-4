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
                $defaultRole = $sm->get('RoleTable')->getUserRoles(array('role_name' =>
                    $config['authRoleSettings']['defaultRaoleId']));

                if (!empty($defaultRole)) {
                    $rolsselec = $form->get('profil')->getValue();
                    foreach ($rolsselec as $rs) {
                        $sm->get('UserRoleTable')->addNewuserRole(
                                array(
                                    'user_id' => $user->getId(),
                                    'role_id' => $rs,
                                )
                        );
                    }
                } else {
                    throw new \Exception(sprintf('%s role is not  present', $config['authRoleSettings']['defaultRaoleId']));
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

        if ($auth->hasIdentity() && !in_array($requestedResourse, $globalList)) {

            if ($requestedResourse == 'zfcuser-login' || in_array($requestedResourse, $whiteList)) {

                $url = '/Echiva2/public/user';
                $response->setHeaders($response->getHeaders()
                                ->addHeaderLine('Location', $url));
                $response->setStatusCode(302);
            } else {
                $roleAtuth = $serviceManager->get('roleAuthService');
                $userRole = $roleAtuth->setUserRole($auth->getIdentity()->getId(), $serviceManager);
                $acl = $serviceManager->get('Acl');
                $acl->initAcl();
                $status = $acl->isAccessAllowed($userRole, $controller, $action);

                if (!$status) {
                    $url = '/Echiva2/public/user';
                    $response->setHeaders($response->getHeaders()
                                    ->addHeaderLine('Location', $url));
                    $response->setStatusCode(302);
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
                    return new Acl();
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
            // global service for filesystem cache.
            /* 'Zend\Cache\Storage\Filesystem' => function ($sm) {
              $config = $sm->get('config');
              $fileCache = $config['fileCache'];
              $cache = \Zend\Cache\StorageFactory::factory(array(
              'adapter' => 'filesystem',
              'plugins' => array(
              'exception_handler' => array(
              'throw_exceptions' => true
              ),
              'serializer'
              )
              ));
              $cache->setOptions($fileCache);

              return $cache;
              }, */
            )
        );
    }

    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'navigation' => function(\Zend\View\HelperPluginManager $pm) {
                    $navigation = $pm->get('Zend\View\Helper\Navigation');
                    return $navigation;
                },
                'roleAuth' => function($sm) {
                    $roleAuth = new \ZF2AuthAcl\Plugin\View\userAuthRoleHelper();
                    return $roleAuth;
                },
                'acl' => function(\Zend\View\HelperPluginManager $pm) {
                    $serviceManager = $pm->getServiceLocator();
                    $acl = $serviceManager->get('Acl');
                    $acl->initAcl();
                    return $acl;
                },
            )
        );
    }

}
