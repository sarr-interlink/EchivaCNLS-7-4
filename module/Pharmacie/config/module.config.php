<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Pharmacie\Controller\Pharmacie' => 'Pharmacie\Controller\PharmacieController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'pharmacie' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/pharmacie[/:action][/:Nume]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'Nume' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Pharmacie\Controller\Pharmacie',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'pharmacie' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
);
