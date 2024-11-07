<?php

namespace Dispensation\Service;

use GtnDataTables\Model\Collection;
use GtnDataTables\Service\CollectorInterface;
use Dispensation\Model\Doss;
use Zend\ServiceManager\ServiceLocatorInterface;

class DossCollector implements CollectorInterface {

    /** @var array */
    protected $servers;
    protected $serviceLocator;

    public function __construct(ServiceLocatorInterface $serviceLocator) {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * @param array $params
     * @return array
     */
    public function findAll(array $params = null) {
        $start = $this->get_numeric(isset($params['start']) ? $params['start'] : 0);
        $length = $this->get_numeric(isset($params['length']) ? $params['length'] : 10);
        $search = isset($params['search']['value']) ? $params['search']['value'] : null;
        $order = isset($params['order']) ? $params['order'] : null;


        $req = $this->serviceLocator->get('Dispensation\Model\DossTable')->findAll($start, $length, explode(" ", $search), $order);
        $this->servers = $req['data'];

        $servers = array();
        foreach ($this->servers as $server) {
            $servers[] = $server;
        }

        $total = $req['count'];
        return Collection::factory(array_slice($servers, 0, $length), $total, $total);
    }

    public function get_numeric($val) {
        if (is_numeric($val)) {
            return $val + 0;
        }
        return 0;
    }

}
