<?php

namespace Oev\Model;

use Zend\Db\TableGateway\TableGateway;

class OevTable {

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
     public function select($where = null, $order = null, $limit = null,$col=null) {
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

    public function getOev($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

   public function getOevByRef_($Ref_) {
        $Ref_ =  $Ref_;
        $rowset = $this->tableGateway->select(array('Ref_' => $Ref_));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Ref_");
        }
        return $row;
    }

    public function saveOev(Oev $oev) {
		$requete = "";
        $data = array(
            'Util' => $oev->Util,
			'Modi' => $oev->Modi,
			'Age_' => $oev->Age_,
			'Diff' => $oev->Diff,
			'MereDece' => $oev->MereDece,
			'MereRef_' => $oev->MereRef_,
			'Nais' => $oev->Nais,
			'Nom_' => $oev->Nom_,
			'Nota' => $oev->Nota,
			'PereDece' => $oev->PereDece,
			'PereRef_' => $oev->PereRef_,
			'Pnom' => $oev->Pnom,
			'Ref_' => $oev->Ref_,
			'Sani' => $oev->Sani,
			'Scol' => $oev->Scol,
			'Sexe' => $oev->Sexe,
        );

        $Nume =  $oev->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$oev->Nume;
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

    public function deleteOev($Nume) {
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
