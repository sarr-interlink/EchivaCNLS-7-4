<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Parametres\Controller\Parametres' => 'Parametres\Controller\ParametresController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'parametres' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/parametres[/:action][/:Nume]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'Nume'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Parametres\Controller\Parametres',
                        'action'     => 'index',
                    ),
                ),
            ),
            'bord' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'Nume'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Parametres\Controller\Parametres',
                        'action'     => 'bord',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'parametres' => __DIR__ . '/../view',
        ),
    ),
);