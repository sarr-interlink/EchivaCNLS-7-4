<?php

/**
 * Coolcsn Zend Framework 2 Navigation Module
 * 
 * @link https://github.com/coolcsn/CsnAclNavigation for the canonical source repository
 * @copyright Copyright (c) 2005-2013 LightSoft 2005 Ltd. Bulgaria
 * @license https://github.com/coolcsn/CsnAclNavigation/blob/master/LICENSE BSDLicense
 * @authors Stoyan Cheresharov <stoyan@coolcsn.com>, Anton Tonev <atonevbg@gmail.com>
 */
return array(
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Tableau de bord',
                'route' => 'bord',
                'resource' => 'Parametres\Controller\Parametres',
                'privilege' => 'bord',
                'icon' => 'fa fa-tachometer',
            ),
            array(
                'label' => 'Accueil',
                'route' => 'accueil',
                'resource' => 'Accueil\Controller\Accueil',
                'privilege' => 'index',
                'icon' => 'fa fa-home',
            ),
            array(
                'label' => 'Depistage',
                'route' => 'depistage',
                'resource' => 'Depistage\Controller\Depistage',
                'privilege' => 'index',
                'icon' => 'fa fa-search',
            ),
            array(
                'label' => 'Laboratoire',
                'route' => 'laboratoire',
                'resource' => 'Laboratoire\Controller\Laboratoire',
                'privilege' => 'index',
                'icon' => 'flaticon-microscope',
            ),            
            array(
                'label' => 'Dossiers',
                'route' => 'dossiers',
                'resource' => 'Dossiers\Controller\Dossiers',
                'privilege' => 'index',
                'icon' => 'fa fa-folder-open',
            ),
            array(
                'label' => 'Dispensation',
                'route' => 'dispensation',
                'resource' => 'Dispensation\Controller\Dispensation',
                'privilege' => 'index',
                'icon' => 'fa fa-medkit',
            ),
            array(
                'label' => 'Pharmacie',
                'route' => 'pharmacie',
                'resource' => 'Pharmacie\Controller\Pharmacie',
                'privilege' => 'index',
                'icon' => 'flaticon-medicine-2',
            ),
            array(
                'label' => 'Oev',
                'route' => 'oev',
                'resource' => 'Oev\Controller\Oev',
                'privilege' => 'index',
                'icon' => 'fa fa-child',
            ),
            array(
                'label' => 'Communaute',
                'route' => 'communaute',
                'resource' => 'Communaute\Controller\Communaute',
                'privilege' => 'index',
                'icon' => 'fa fa-globe',
            ),
            array(
                'label' => 'Reporting',
                'route' => 'analyse',
                'resource' => 'Analyse\Controller\Analyse',
                'privilege' => 'index',
                'icon' => 'fa fa-bar-chart',
            ),
            array(
                'label' => 'Parametres',
                'route' => 'parametres',
                'resource' => 'Parametres\Controller\Parametres',
                'privilege' => 'index',
                'icon' => 'fa fa-cog',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
        ),
    ),
);
