<?php

namespace Communaute\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CommCollectorFactory implements FactoryInterface {

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        return new CommCollector($serviceLocator);
    }

}
