<?php

namespace Parametres\Model;

use Zend\Db\TableGateway\TableGateway;

class UserRoleTable {

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
            $select->order('id');
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

    public function getUserRole($id) {
        $id =  $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveUserRole(UserRole $entr) {
        //$data = $entr->getArrayCopy();
        $data = array(
            'user_id' => $entr->user_id,
            'role_id' => $entr->role_id,        );

       /* $id =  $entr->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
            $entr->id = $this->tableGateway->lastInsertValue;
        } else {
            if ($this->getUserRole($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
        return $entr;*/
		
		$id = $entr->id;
        if(!$this->checkrecord($id)){
            $data['id']=$entr->id;
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($data);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());			
        }
        else{
            $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
            $update->set($data);
            $update->where(array('id' => $id));
            $requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
            $this->tableGateway->updateWith($update);
        }
		$this->saveQuery($requete);
        return $entr;
		
		
		
    }

    public function deleteUserRole($id) {
    	$requete = "";
        $delete = new \Zend\Db\Sql\Delete($this->tableGateway->getTable());
        $delete->where(array('id' => $id));
        $this->tableGateway->deleteWith($delete);
        $requete = $delete->getSqlString($this->tableGateway->getadapter()->getPlatform());
        $this->saveQuery($requete);
    }

    public function deleteUserRoleByUser($id) {
		$requete = "";
        $delete = new \Zend\Db\Sql\Delete($this->tableGateway->getTable());
        $delete->where(array('user_id' => $id));
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
