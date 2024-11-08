<?php

namespace Accueil\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class EntrCollectorFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        return new EntrCollector($serviceLocator);
    }

}
