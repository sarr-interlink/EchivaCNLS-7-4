<?php

namespace Accueil\Model;

use Zend\Db\TableGateway\TableGateway;

class DepiTable {

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

    public function findAll($start = null, $length = null, $search = null, $order = null, $whr = null) {
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
                if ($ord['column'] == 'Ref_') {
                    if ($ord['dir'] == 'asc') {
                        $ord['dir'] = 'desc';
                    } else {
                        $ord['dir'] = 'asc';
                    }
                }
                $ords = $ord['column'] . " " . $ord['dir'];
                $select->order("$ords");
            }
        }
        $where = new \Zend\Db\Sql\Where();

        if ($whr != null) {
            foreach ($whr as $value) {
                $comb = \Zend\Db\Sql\Predicate\PredicateSet::OP_AND;
                $where->addPredicate($value, $comb);
            }
        }

        if ($search != null) {
            $i = 0;
            foreach ($search as $srch) {
                if ($srch != "") {
                    if ($i == 0) {
                        $where->addPredicate(new \Zend\Db\Sql\Predicate\Like('Sexe', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Matr', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Prof', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Ref_', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Age_', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Circ', "%$srch%"));
                        $i++;
                    } else {
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('Sexe', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Matr', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Prof', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Ref_', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Age_', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Circ', "%$srch%"));
                    }
                }
            }
        }

        $select->where($where);
        $selectcount->where($where);
        $count = $this->tableGateway->selectWith($selectcount)->current();
        $resultSet = $this->tableGateway->selectWith($select)->toArray();
        return array('data' => $resultSet, 'count' => $count->count);
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
            $select->order('Nume ASC');
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

    public function Rapport() {
        $select = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
        $select->columns(array('TestSero', 'Sexe', 'count' => new \Zend\Db\Sql\Expression('COUNT(*)')));
        $select->group(array('Sexe', 'TestSero'));
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }

	public function getLastvalue() {
        return $this->tableGateway->lastInsertValue;
    }
    
	public function getDepi($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function saveDepi(Depi $depi) {
		$requete = "";
        $data = array(
            'Util' => $depi->Util,
            'Modi' => $depi->Modi,
            'Age_' => $depi->Age_,
            'Circ' => $depi->Circ,
            'ConfDat_' => $depi->ConfDat_,
            'ConfRetr' => $depi->ConfRetr,
            'ConfSero' => $depi->ConfSero,
            'ConfSeroTyp_' => $depi->ConfSeroTyp_,
            'Dat_' => $depi->Dat_,
            'DejaSero' => $depi->DejaSero,
            'DejaSeroTyp_' => $depi->DejaSeroTyp_,
            'Matr' => $depi->Matr,
            'Nb__Chrg' => $depi->Nb__Chrg,
            'Nom_' => $depi->Nom_,
            'Pnom' => $depi->Pnom,
            'Prof' => $depi->Prof,
            'Ref_' => $depi->Ref_,
            'Sexe' => $depi->Sexe,
            'Tel_' => $depi->Tel_,
            'TestDat_' => $depi->TestDat_,
            'TestRetr' => $depi->TestRetr,
            'TestSero' => $depi->TestSero,
            'TestSeroTyp_' => $depi->TestSeroTyp_,
            'ObsTest' => $depi->ObsTest,
            'ObsConf' => $depi->ObsConf,
            'Observation' => $depi->Observation,
        );

        $Nume =  $depi->Nume;
        if (!$this->checkrecord($Nume)) {
			$data['Nume']=$depi->Nume;
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

    public function deleteDepi($Nume) {
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
