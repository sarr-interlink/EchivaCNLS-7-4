<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Communaute\Controller\Communaute' => 'Communaute\Controller\CommunauteController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'communaute' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/communaute[/:action][/:Nume]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'Nume' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Communaute\Controller\Communaute',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'communaute' => __DIR__ . '/../view',
        ),
    ),
    'datatables' => array(
        'communautedatatable' => array(
            'id' => 'communautedb',
            'classes' => array('table', 'table-striped', 'table-bordered',),
            'collectorFactory' => 'Communaute\Service\CommCollectorFactory',
            'columns' => array(
                array(
                    'decorator' => 'Communaute\View\Acti',
                    'key' => 'Acti',
                ),
                array(
                    'decorator' => 'Communaute\View\Dat',
                    'key' => 'Dat_',
                ),
                array(
                    'decorator' => 'Communaute\View\Nota',
                    'key' => 'Nota',
                ),
                array(
                    'decorator' => 'Communaute\View\Action',
                    'key' => 'Action',
                )
            )
        ),
    )
);
