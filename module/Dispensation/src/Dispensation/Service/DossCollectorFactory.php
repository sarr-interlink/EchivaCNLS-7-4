<?php

namespace Dispensation\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DossCollectorFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        return new DossCollector($serviceLocator);
    }

}
