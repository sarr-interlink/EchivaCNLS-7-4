<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Depistage\Controller\Depistage' => 'Depistage\Controller\DepistageController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'depistage' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/depistage[/:action][/:Nume]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'Nume' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Depistage\Controller\Depistage',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'depistage' => __DIR__ . '/../view',
        ),
    ),
    'datatables' => array(
        'depistagedatatable' => array(
            'id' => 'depistagedb',
            'classes' => array('table', 'table-striped', 'table-bordered',),
            'collectorFactory' => 'Depistage\Service\DepiCollectorFactory',
            'columns' => array(
                array(
                    'decorator' => 'Depistage\View\Ref',
                    'key' => 'Nume',
                ),
                array(
                    'decorator' => 'Depistage\View\Sexe',
                    'key' => 'Sexe',
                ),
                array(
                    'decorator' => 'Depistage\View\Age',
                    'key' => 'Age_',
                ),
                array(
                    'decorator' => 'Depistage\View\Circ',
                    'key' => 'Circ',
                ),
                array(
                    'decorator' => 'Depistage\View\Matr',
                    'key' => 'Matr',
                ),
                array(
                    'decorator' => 'Depistage\View\Prof',
                    'key' => 'Prof',
                ),
                array(
                    'decorator' => 'Depistage\View\Action',
                    'key' => 'Action',
                ),
                
            )
        ),
    )
);
