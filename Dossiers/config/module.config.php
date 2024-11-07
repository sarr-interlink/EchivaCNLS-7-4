<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Dossiers\Controller\Dossiers' => 'Dossiers\Controller\DossiersController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'dossiers' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/dossiers[/:action][/:Nume]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'Nume' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Dossiers\Controller\Dossiers',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'dossiers' => __DIR__ . '/../view',
        ),
    ),
    'datatables' => array(
        'dossiersdatatable' => array(
            'id' => 'dossiersdb',
            'classes' => array('table', 'table-striped', 'table-bordered',),
            'collectorFactory' => 'Dossiers\Service\DossCollectorFactory',
            'columns' => array(
                array(
                    'decorator' => 'Dossiers\View\Ref',
                    'key' => 'Nume',
                ),
                array(
                    'decorator' => 'Dossiers\View\RensNom',
                    'key' => 'RensNom_',
                ),
                array(
                    'decorator' => 'Dossiers\View\RensPnom',
                    'key' => 'RensPnom',
                ),
                array(
                    'decorator' => 'Dossiers\View\RensAge',
                    'key' => 'RensAge_',
                ),
                array(
                    'decorator' => 'Dossiers\View\OuvrDat',
                    'key' => 'OuvrDat_',
                ),
                array(
                    'decorator' => 'Dossiers\View\Action',
                    'key' => 'Action',
                )
            )
        ),
    ),
);
