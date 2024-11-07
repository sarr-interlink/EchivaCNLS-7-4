<?php

namespace Accueil\Model;

use Zend\Db\TableGateway\TableGateway;

class ProdTable {

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
	
	public function select($where = null, $order = null, $limit = null,$col = null) {
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
    
	public function getProd($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }
    
	public function getProdtab() {
         $resultSet = $this->tableGateway->select()->toArray();
        return $resultSet;  
    }

    public function saveProd(Prod $prod) {
		$requete = "";
        $data = array(
            'Util' => $prod->Util,
			'Modi' => $prod->Modi,
			'Cont' => $prod->Cont,
			'Dci_' => $prod->Dci_,
			'Dci_Desi' => $prod->Dci_Desi,
			'Dosa' => $prod->Dosa,
			'DosaDesi' => $prod->DosaDesi,
			'Gale' => $prod->Gale,
			'GaleDesi' => $prod->GaleDesi,
			'Marq' => $prod->Marq,
			'Nomb' => $prod->Nomb,
			'Prix' => $prod->Prix,
			'Typ_' => $prod->Typ_,
			'Unit' => $prod->Unit,
        );

        $Nume =  $prod->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$prod->Nume;
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($data);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
            $prod->Nume = $this->tableGateway->lastInsertValue;
        } else {
            
                $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($data);
                $update->where(array('Nume' => $Nume));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
            
        }
		$this->saveQuery($requete);
        return $prod;
    }

    public function deleteProd($Nume) {
        $requete = "";
        $delete = new \Zend\Db\Sql\Delete($this->tableGateway->getTable());
        $delete->where(array('Nume' => $Nume));
        $this->tableGateway->deleteWith($delete);
        $requete = $delete->getSqlString($this->tableGateway->getadapter()->getPlatform());
        $this->saveQuery($requete);$this->tableGateway->delete(array('Nume' => $Nume));
    }
	
	public function saveQuery($query = "") {
        $query = str_ireplace('\\','\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\',$query);
        $logstr = "INSERT INTO `log_query` (`id`, `req`, `etat`, `prov`, `date`) VALUES (NULL,\"" . $query . "\" , '0', '', '".date('Y-m-d h:i:s')."')";
        $statement = $this->tableGateway->getadapter()->query($logstr);
        $result = $statement->execute();
        return $result;
    }

}
