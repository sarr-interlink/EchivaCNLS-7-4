<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Oev\Controller\Oev' => 'Oev\Controller\OevController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'oev' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/oev[/:action][/:Nume]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'Nume' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Oev\Controller\Oev',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'oev' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
