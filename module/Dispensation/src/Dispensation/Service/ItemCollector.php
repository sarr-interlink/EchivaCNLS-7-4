<?php

namespace Dispensation\Service;

use GtnDataTables\Model\Collection;
use GtnDataTables\Service\CollectorInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ItemCollector implements CollectorInterface {

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
        $whr = isset($params['where']) ? $params['where'] : null;
		$Qte= isset($params['Qte']) ? $params['Qte'] : 'NombUnit';
        //rendre dynamique avec prefix
        $prefixe = new \Zend\Session\Container('prefixe');
        $this->prefixeagent = $prefixe->offsetGet('prefixeagent');
        $columns = array(
            'Nume' => $this->prefixeagent.'item.Nume',
            'Dat_' => $this->prefixeagent.'item.Dat_',
            'Doss' => $this->prefixeagent.'item.Doss',
            'Expi' => $this->prefixeagent.'item.Expi',
            'Prod' => $this->prefixeagent.'item.Prod',
            'Fabr' => $this->prefixeagent.'item.Fabr',
            'Lot_' => $this->prefixeagent.'item.Lot_',
			'NombUnit' => $this->prefixeagent.'item.'.$Qte,
            'MediCons' => $this->prefixeagent.'item.MediCons',
            'MediConsPrsc' => $this->prefixeagent.'item.MediConsPrsc',
            'prefixe' => $this->prefixeagent.'item.prefixe',
            'Gale' => $this->prefixeagent.'prod.Gale',
            'GaleDesi' => $this->prefixeagent.'prod.GaleDesi',
            'Designation' => new \Zend\Db\Sql\Expression("CONCAT_WS(' ',Dci_Desi,DosaDesi,GaleDesi)"),
            'Typ_' => $this->prefixeagent.'prod.Typ_',
        );
		if($Qte=='NombBoit')
			$columns['GaleDesi']=null;
		
		$table = $this->prefixeagent.'prod';
        $condjoin = $this->prefixeagent.'item.prod='.$this->prefixeagent.'prod.Nume';
        $req = $this->serviceLocator->get('Dispensation\Model\ItemTable')->findAll($start, $length, explode(" ", $search), $order, $whr, $table, $condjoin, $columns);
        foreach ($req['data'] as $k => $req1) {
            if ($req1['prefixe'] && $req1['Doss'] > 0) {
                $req2 = $this->serviceLocator->get('Dispensation\Model\DossTable')->selectup("Nume=" . $req1['Doss'], null, null, array('Ref_' => 'Ref_'), $req1['prefixe']);
                foreach ($req2 as $req3) {
                    $req['data'][$k]['Ref_'] = $req3->Ref_;
                }
            } else
                $req['data'][$k]['Ref_'] = "";
        }

        $this->servers = $req['data'];



        $servers = array();
        foreach ($this->servers as $server) {
            $servers[] = $server;
        }

        $total = $req['count'];
        //exit;
		if($length==-1)
			$length=$total;
        return Collection::factory(array_slice($servers, 0, $length), $total, $total);
    }

    public function get_numeric($val) {
        if (is_numeric($val)) {
            return $val + 0;
        }
        return 0;
    }

}
