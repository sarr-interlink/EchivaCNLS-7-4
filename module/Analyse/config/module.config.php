<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Analyse\Controller\Analyse' => 'Analyse\Controller\AnalyseController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'analyse' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/analyse[/:action][/:Nume]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'Nume'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Analyse\Controller\Analyse',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'analyse' => __DIR__ . '/../view',
        ),
    ),
);