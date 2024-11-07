<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Accueil\Controller\Accueil' => 'Accueil\Controller\AccueilController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'accueil' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/accueil[/:action][/:Nume]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'Nume' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Accueil\Controller\Accueil',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'accueil' => __DIR__ . '/../view',
        ),
    ),
    'datatables' => array(
        'accueildatatable' => array(
            'id' => 'accueildb',
            'classes' => array('table', 'table-striped', 'table-bordered',),
            'collectorFactory' => 'Accueil\Service\EntrCollectorFactory',
            'columns' => array(
                array(
                    'decorator' => 'Accueil\View\ArriHoro',
                    'key' => 'ArriHoro',
                ),
                array(
                    'decorator' => 'Accueil\View\RdvHoro',
                    'key' => 'Rdv_Horo',
                ),
                array(
                    'decorator' => 'Accueil\View\CtaNume',
                    'key' => 'Cta_Nume',
                ),
                array(
                    'decorator' => 'Accueil\View\Sexe',
                    'key' => 'Sexe',
                ),
                array(
                    'decorator' => 'Accueil\View\Nom',
                    'key' => 'Nom_',
                ),
                array(
                    'decorator' => 'Accueil\View\Pnom',
                    'key' => 'Pnom',
                ),
                array(
                    'decorator' => 'Accueil\View\Age',
                    'key' => 'Age_',
                ),
                array(
                    'decorator' => 'Accueil\View\Moti',
                    'key' => 'Moti',
                ),
                array(
                    'decorator' => 'Accueil\View\Action',
                    'key' => 'Action',
                )
            )
        ),
    )
);
