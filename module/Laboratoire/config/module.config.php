<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Laboratoire\Controller\Laboratoire' => 'Laboratoire\Controller\LaboratoireController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'laboratoire' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/laboratoire[/:action][/:Nume]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'Nume'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Laboratoire\Controller\Laboratoire',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'laboratoire' => __DIR__ . '/../view',
        ),
    ),
    'datatables' => array(
        'laboratoiredatatable' => array(
            'id' => 'laboratoiredb',
            'classes' => array('table', 'table-striped', 'table-bordered',),
            'collectorFactory' => 'Laboratoire\Service\EntrCollectorFactory',
            'columns' => array(
                array(
                    'decorator' => 'Laboratoire\View\ArriHoro',
                    'key' => 'ArriHoro',
                ),
                array(
                    'decorator' => 'Laboratoire\View\CtaNume',
                    'key' => 'Cta_Nume',
                ),
                array(
                    'decorator' => 'Laboratoire\View\Sexe',
                    'key' => 'Sexe',
                ),
                array(
                    'decorator' => 'Laboratoire\View\Age',
                    'key' => 'Age_',
                ),
                array(
                    'decorator' => 'Laboratoire\View\Moti',
                    'key' => 'Moti',
                ),
                array(
                    'decorator' => 'Laboratoire\View\Effectue',
                    'key' => 'Effectue',
                ),
                array(
                    'decorator' => 'Laboratoire\View\Prec',
                    'key' => 'Prec',
                ),
                array(
                    'decorator' => 'Laboratoire\View\Action',
                    'key' => 'Action',
                )
            )
        ),
    )
);