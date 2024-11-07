<?php

namespace Accueil\Model;

use Zend\Db\TableGateway\TableGateway;

class ItemTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
	
	public function checkrecord($Nume) {
		$Nume =  $Nume;
		$rowset = $this->tableGateway->select(array('Nume' => $Nume));
		$row = $rowset->current();
		if (!$row) {
			return false;
		}
		return true;
	}
    
    public function findAll($start = null, $length = null, $search = null, $order = null) {
        $select = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
        $selectcount = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
        $selectcount->columns(array('count' => new \Zend\Db\Sql\Expression('COUNT(*)')));
        
        
        if ($start != null) {
            $select->offset($start);
        }
        if ($length != null) {
            $select->limit($length);
        }
        if ($order != null) {
            foreach ($order as $ord) {
                $ords = $ord['column'] . " " . $ord['dir'];
                $select->order("$ords");
            }
        }
        if ($search != null) {
            $i = 0;
            $where = new \Zend\Db\Sql\Where();
            foreach ($search as $srch) {
                if ($srch != "") {
                    if ($i == 0) {
                        $where->addPredicate(new \Zend\Db\Sql\Predicate\Like('Dat_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('Lot_', "%$srch%"));
                        //$where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensPnom', "%$srch%"));
                        //$where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensAge_', "%$srch%"));
                        //$where->orPredicate(new \Zend\Db\Sql\Predicate\Like('OuvrDat_', "%$srch%"));
                        $i++;
                    } else {
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('Dat_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('Lot_', "%$srch%"));
                        //$where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensNom_', "%$srch%"));
                        //$where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensPnom', "%$srch%"));
                        //$where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensAge_', "%$srch%"));
                        //$where->orPredicate(new \Zend\Db\Sql\Predicate\Like('OuvrDat_', "%$srch%"));
                    }
                }
            }
            $where->equalTo('Dest', '6');
            $where->between('Dat_', '2017-10-25', date('Y-m-d'));
            
            $select->where($where);
            $selectcount->where($where);
        }
        $count = $this->tableGateway->selectWith($selectcount)->current();
        $resultSet = $this->tableGateway->selectWith($select);
        
        return array('data' => $resultSet->toArray(), 'count' => $count->count);
    }
    
    public function fetchAll() {
        $resultSet = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
            //$select->where->like('name', 'Brit%');
            $select->order('Nume DESC');
        });
        return $resultSet;
    }
     
	public function select($where = null, $order = null, $limit = null) {
        $select = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
        if ($where != null) {
            $select->where($where);
        }
        if ($order != null) {
            $select->order($order);
        }
        if ($limit != null) {
            $select->limit($limit);
        }
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }

	public function selectlimit($where = null, $order = null, $limit = null, $offset = null) {
        $select = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
        if ($where != null) {
            $select->where($where);
        }
        if ($order != null) {
            $select->order($order);
        }
        if ($limit != null) {
            $select->limit($limit);
			$select->offset($offset);
        }
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }

    public function getItem($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function getlastItem() {
        return $this->tableGateway->lastInsertValue;
    }
	
    public function saveItem(Item $item) {
		$requete = "";
        $data = array(
            'Util' => $item->Util,
            'Modi' => $item->Modi,
            'Chrg' => $item->Chrg,
            'Dat_' => $item->Dat_,
            'Dest' => $item->Dest,
            'Doss' => $item->Doss,
            'Expi' => $item->Expi,
            'Fabr' => $item->Fabr,
            'Lot_' => $item->Lot_,
            'MediCons' => $item->MediCons,
            'MediConsPrsc' => $item->MediConsPrsc,
            'NombBoit' => $item->NombBoit,
            'NombUnit' => $item->NombUnit,
            'Paim' => $item->Paim,
            'Prod' => $item->Prod,
            'Prov' => $item->Prov,
            'Sour' => $item->Sour,    
        );

        $Nume =  $item->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$item->Nume;
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($data);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
        } else {
            
                $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($data);
                $update->where(array('Nume' => $Nume));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
            
        }
		$this->saveQuery($requete);
        return $item ;
    }
     
	public function saveItemtab($item) {
		$requete = "";
        $Nume =  $item['Nume'];
        if(!$this->checkrecord($Nume)){
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($item);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
            
        } else {
            
                $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($item);
                $update->where(array('Nume' => $Nume));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
            
        }
		$this->saveQuery($requete);
        return $item;
    }

    public function deleteItem($Nume) {
        $requete = "";
        $delete = new \Zend\Db\Sql\Delete($this->tableGateway->getTable());
        $delete->where(array('Nume' => $Nume));
        $this->tableGateway->deleteWith($delete);
        $requete = $delete->getSqlString($this->tableGateway->getadapter()->getPlatform());
        $this->saveQuery($requete);
    }
	
	public function saveQuery($query = "") {
        $query = str_ireplace('\\','\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\',$query);
        $logstr = "INSERT INTO `log_query` (`id`, `req`, `etat`, `prov`, `date`) VALUES (NULL,\"" . $query . "\" , '0', '', '".date('Y-m-d h:i:s')."')";
        $statement = $this->tableGateway->getadapter()->query($logstr);
        $result = $statement->execute();
        return $result;
    }

}
