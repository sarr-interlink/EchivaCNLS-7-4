<?php

namespace Parametres\Model;

use Zend\Db\TableGateway\TableGateway;

class LogqueryTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
	
	public function checkrecord($id) {
		$id =  $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			return false;
		}
		return true;
	}

    public function fetchAll() {
        $resultSet = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
            //$select->where->like('name', 'Brit%');
            $select->order('id DESC');
        });
        return $resultSet;
    }

    public function getLogquery($id) {
        $id =  $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function getLogquerytab() {

        $resultSet = $this->tableGateway->select()->toArray();
        return $resultSet;
    }

	public function select($where = null, $col = null,$order = null, $limit = null) {
        $select = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
        if ($where != null) {
            $select->where($where);
        }
        if ($col != null) {
            $select->columns($col);
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

    public function saveLogquery(Logquery $logquery) {
		$requete = "";
        $data = array(
            'req' => $logquery->req,
            'etat' => $logquery->etat,
            'prov' => $logquery->prov,
            'date' => $logquery->date,   
        );

        $id =  $logquery->id;
        if (!$this->checkrecord($id)) {
			$data['id']=$logquery->id;
			$insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($data);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
        } else {
                $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($data);
                $update->where(array('id' => $id));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
            
        }
		$this->saveQuery($requete);
    }
	
	public function updt($value, $id) {
		$id = $id;
		$data = array(
            'state' => $value,
        );
		if ($id > 0) {
			  $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($data);
                $update->where(array('id' => $id));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
        }
    }

    public function deleteLogquery($id) {
        $requete = "";
        $delete = new \Zend\Db\Sql\Delete($this->tableGateway->getTable());
        $delete->where(array('id' => $id));
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
