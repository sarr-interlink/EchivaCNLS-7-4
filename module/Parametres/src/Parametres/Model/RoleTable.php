<?php

namespace Parametres\Model;

use Zend\Db\TableGateway\TableGateway;

class RoleTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
	
	public function checkrecord($rid) {
		$rid =  $rid;
		$rowset = $this->tableGateway->select(array('rid' => $rid));
		$row = $rowset->current();
		if (!$row) {
			return false;
		}
		return true;
	}

    public function fetchAll() {
        $resultSet = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
            $select->order('role_name');
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

    public function getRole($rid) {
        $rid =  $rid;
        $rowset = $this->tableGateway->select(array('rid' => $rid));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $rid");
        }
        return $row;
    }

    public function saveRole(Role $entr) {
		$requete = "";
        //$data = $entr->getArrayCopy();
        $data = array(
            'role_name' => $entr->role_name,
            'status' => $entr->status,        );
		$rid =  $entr->rid;
        if(!$this->checkrecord($rid)){
            $data['rid']=$entr->rid;
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($data);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
        }
        else{
            $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
            $update->set($data);
            $update->where(array('rid' => $rid));
            $requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
            $this->tableGateway->updateWith($update);
        }
		$this->saveQuery($requete);
        return $entr;
		
		
    }

    public function deleteRole($rid) {
	    $requete = "";
        $delete = new \Zend\Db\Sql\Delete($this->tableGateway->getTable());
        $delete->where(array('rid' => $rid));
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
