<?php

namespace Accueil\Model;

use Zend\Db\TableGateway\TableGateway;

class Oev_Table {

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

    public function getOev_($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function saveOev_(Oev_ $oev_) {
		$requete = "";
        $data = array(
            'Util' => $oev_->Util,
			'Modi' => $oev_->Modi,
			'Age_' => $oev_->Age_,
			'Diff' => $oev_->Diff,
			'MereDece' => $oev_->MereDece,
			'MereRef_' => $oev_->MereRef_,
			'Nais' => $oev_->Nais,
			'Nom_' => $oev_->Nom_,
			'Nota' => $oev_->Nota,
			'PereDece' => $oev_->PereDece,
			'PereRef_' => $oev_->PereRef_,
			'Pnom' => $oev_->Pnom,
			'Ref_' => $oev_->Ref_,
			'Sani' => $oev_->Sani,
			'Scol' => $oev_->Scol,
			'Sexe' => $oev_->Sexe,
        );

        $Nume =  $oev_->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$oev_->Nume;
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
	
	public function deleteOev_($Nume) {
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
