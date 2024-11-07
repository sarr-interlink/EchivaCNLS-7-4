<?php

namespace Accueil\Model;

use Zend\Db\TableGateway\TableGateway;

class CentreTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
	
	public function checkrecord($Id) {
		$Id =  $Id;
		$rowset = $this->tableGateway->select(array('Id' => $Id));
		$row = $rowset->current();
		if (!$row) {
			return false;
		}
		return true;
	}

    public function fetchAll() {
        $resultSet = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
            //$select->where->like('name', 'Brit%');
            $select->order('Id DESC');
        });
        return $resultSet;
    }

    public function getCentre($Id) {
        $Id =  $Id;
        $rowset = $this->tableGateway->select(array('Id' => $Id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Id");
        }
        return $row;
    }

    public function getCentretab() {

        $resultSet = $this->tableGateway->select()->toArray();
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

    public function saveCentre(Centre $centre) {
		$requete = "";
        $data = array(
            'Util' => $centre->Util,
            'Modi' => $centre->Modi,
            'Prefixe' => $centre->Prefixe,
            'Desi' => $centre->Desi,
        );

        $Id =  $centre->Id;
        if (!$this->checkrecord($Id)) {
			$data['Id']=$centre->Id;
			$insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($data);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
        } else {
                $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($data);
                $update->where(array('Id' => $Id));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
            
        }
		$this->saveQuery($requete);
    }
	
	public function updt($value, $Id) {
		$Id = $Id;
		$data = array(
            'state' => $value,
        );
		if ($Id > 0) {
			  $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($data);
                $update->where(array('Id' => $Id));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
        }
$this->saveQuery($requete);
    }

    public function deleteCentre($Id) {
        $requete = "";
        $delete = new \Zend\Db\Sql\Delete($this->tableGateway->getTable());
        $delete->where(array('Id' => $Id));
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
