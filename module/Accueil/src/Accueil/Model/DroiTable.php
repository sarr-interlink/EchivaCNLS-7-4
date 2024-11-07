<?php

namespace Accueil\Model;

use Zend\Db\TableGateway\TableGateway;

class DroiTable {

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

    public function getDroi($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function saveDroi(Droi $droi) {
		$requete = "";
        $data = array(
            'Util' => $droi->Util,
            'Modi' => $droi->Modi,
            'Accu' => $droi->Accu,
            'Anal' => $droi->Anal,
            'Comm' => $droi->Comm,
            'Deli' => $droi->Deli,
            'Depi' => $droi->Depi,
            'Desi' => $droi->Desi,
            'DossMedi' => $droi->DossMedi,
            'DossObse' => $droi->DossObse,
            'DossPsy_' => $droi->DossPsy_,
            'DossPtme' => $droi->DossPtme,
            'DossRens' => $droi->DossRens,
            'DossSoci' => $droi->DossSoci,
            'Droi' => $droi->Droi,
            'Labo' => $droi->Labo,
            'Nom_' => $droi->Nom_,
            'Oev_' => $droi->Oev_,
            'Para' => $droi->Para,
            'Phar' => $droi->Phar,
            'PharPara' => $droi->PharPara,
        );

        $Nume =  $droi->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$droi->Nume;
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

    public function deleteDroi($Nume) {
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
