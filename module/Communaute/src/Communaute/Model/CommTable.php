<?php

namespace Communaute\Model;

use Zend\Db\TableGateway\TableGateway;

class CommTable {

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

    public function fetchAll() {
        $resultSet = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
            //$select->where->like('name', 'Brit%');
            $select->order('Nume DESC');
        });
        return $resultSet;
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
                if ($ord['column'] == 'Dat_') {
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
                        $where->addPredicate(new \Zend\Db\Sql\Predicate\Like('Acti', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Dat_', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Nota', "%$srch%"));
                        $i++;
                    } else {
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('Acti', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Dat_', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Nota', "%$srch%"));
                    }
                }
            }
        }

        $select->where($where);
        $selectcount->where($where);
        $count = $this->tableGateway->selectWith($selectcount)->current();
        $resultSet = $this->tableGateway->selectWith($select);
        return array('data' => $resultSet->toArray(), 'count' => $count->count);
    }

	public function select($where = null, $order = null, $limit = null, $col = null) {
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
        if ($col != null) {
            $select->columns($col);
        }
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
	
    public function getComm($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function saveComm(Comm $comm) {
		$requete = "";
        $data = array(
            'Util' => $comm->Util,
            'Modi' => $comm->Modi,
            'Acti' => $comm->Acti,
            'Dat_' => $comm->Dat_,
            'Nota' => $comm->Nota,
        );

        $Nume =  $comm->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$comm->Nume;
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

    public function deleteComm($Nume) {
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
