<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Dispensation\Controller\Dispensation' => 'Dispensation\Controller\DispensationController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'dispensation' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/dispensation[/:action][/:Nume]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'Nume' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Dispensation\Controller\Dispensation',
                        'action' => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'dispensation' => __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'datatables' => array(
        'dispdatatable' => array(
            'id' => 'dispdb',
            'classes' => array('table', 'table-striped', 'table-bordered',),
            'collectorFactory' => 'Dispensation\Service\DossCollectorFactory',
            'columns' => array(
                array(
                    'decorator' => 'Dispensation\View\Ref',
                    'key' => 'Nume',
                ),
                array(
                    'decorator' => 'Dispensation\View\RensNom',
                    'key' => 'RensNom_',
                ),
                array(
                    'decorator' => 'Dispensation\View\RensPnom',
                    'key' => 'RensPnom',
                ),
                array(
                    'decorator' => 'Dispensation\View\OuvrDat',
                    'key' => 'OuvrDat_',
                ),
                array(
                    'decorator' => 'Dispensation\View\Action',
                    'key' => 'Action',
                )
            )
        ),
        'histdatatable' => array(
            'id' => 'histdb',
            'classes' => array('table', 'table-striped', 'table-bordered',),
            'collectorFactory' => 'Dispensation\Service\ItemCollectorFactory',
            'columns' => array(
                array(
                    'decorator' => 'Dispensation\View\Dat',
                    'key' => 'Dat_',
                ),
                array(
                    'decorator' => 'Dispensation\View\Refh',
                    'key' => 'Doss',
                ),
                array(
                    'decorator' => 'Dispensation\View\Design',
                    'key' => "Designation",
                    //'key' => "CONCAT_WS(' ',Dci_Desi,DosaDesi,GaleDesi)",
                ),
                array(
                    'decorator' => 'Dispensation\View\Lot',
                    'key' => 'Lot_',
                ),
                array(
                    'decorator' => 'Dispensation\View\Expi',
                    'key' => 'Expi',
                ),
                array(
                    'decorator' => 'Dispensation\View\Qte',
                    'key' => 'NombUnit',
                ),
                array(
                    'decorator' => 'Dispensation\View\Actionhist',
                    'key' => 'Action',
                )
            )
        )
    ),
);
