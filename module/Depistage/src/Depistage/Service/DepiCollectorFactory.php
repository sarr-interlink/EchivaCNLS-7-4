<?php

namespace Depistage\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DepiCollectorFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        return new DepiCollector($serviceLocator);
    }

}
