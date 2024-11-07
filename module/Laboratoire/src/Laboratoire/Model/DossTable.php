<?php

namespace Laboratoire\Model;

use Zend\Db\TableGateway\TableGateway;

class DossTable {

    protected $tableGateway;
    protected $sm;

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
                        $where->addPredicate(new \Zend\Db\Sql\Predicate\Like('Ref_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensNom_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensPnom', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensAge_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('OuvrDat_', "%$srch%"));
			$where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensTel_', "%$srch%"));

                        $i++;
                    } else {
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('Ref_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensNom_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensPnom', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensAge_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('OuvrDat_', "%$srch%"));
			$where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensTel_', "%$srch%"));

                    }
                }
            }
            $select->where($where);
            $selectcount->where($where);
        }
        $count = $this->tableGateway->selectWith($selectcount)->current();
        $resultSet = $this->tableGateway->selectWith($select);
        return array('data' => $resultSet->toArray(), 'count' => $count->count);
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
            $select->order('Nume DESC');
        });
        return $resultSet;
    }
    
	public function getDossByRef_($Ref_) {
           
        $rowset = $this->tableGateway->select(array('Ref_' => $Ref_));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Ref_");
        }
        return $row;
    }
    
	public function setServiceLocator($something) {
        $this->sm = $something;
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

    public function getLastvalue() {
        return $this->tableGateway->lastInsertValue;
    }
    
    public function getDoss($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

  
    public function saveDoss(Doss $doss) {
        $data = array(
            'RensNom_' => $doss->RensNom_,
            'RensPnom' => $doss->RensPnom,
            'RensAge_' => $doss->RensAge_,
            'RensSexe' => $doss->RensSexe,
            'Ref_' => $doss->Ref_,
        );

        $Nume =  $doss->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$doss->Nume;
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
    }

    public function deleteDoss($Nume) {
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
