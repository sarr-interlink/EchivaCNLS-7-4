<?php

namespace Analyse\Model;

use Zend\Db\TableGateway\TableGateway;

class MediconsTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
            //$select->where->like('name', 'Brit%');
            $select->order('Nume DESC')->limit(20);
        });
        return $resultSet;
    }
 
	public function select($where = null, $order = null, $limit = null,$col = null) {
        $select = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
        if ($where != null) {
            $select->where($where);
        }
        if ($order != null) {
            $select->order($order)->limit(20);
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
    
	public function Rapport($where = null,$columns = null,$group = null, $order = null, $limit = null) {
        $select = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
         if ($where != null) {
            $select->where($where);
        }
        if ($order != null) {
            $select->order($order);//->limit(20);
        }
        if ($limit != null) {
            $select->limit($limit);
        }
        if ($columns != null) {
            $select->columns($columns);
        }
        if ($group != null) {
         $select->group($group);
        }
        $resultSet = $this->tableGateway->selectWith($select);
	  $resultSet->buffer();
        return $resultSet;
    }
    
	public function Rapportjoint($where = null,$columns = null,$join,$condjoin,$group = null, $order = null, $limit = null) {
        $select = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
         if ($where != null) {
            $select->where($where);
        }
        if ($order != null) {
            $select->order($order);//->limit(20);
        }
        if ($limit != null) {
            $select->limit($limit);
        }
        if ($columns != null) {
            $select->columns($columns,false);
        }
        if ($join != null && $condjoin != null) {
            $select->join($join,$condjoin,array());
        }
        if ($group != null) {
         $select->group($group);
        }
       // echo $select->getSqlString();
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
  
    public function getMedicons($Nume) {
        $Nume = (int) $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function saveMedicons($medicons) {
		$requete = "";
        $Nume = (int) $medicons['Nume'];
        if ($Nume == 0) {
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($medicons);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
            
        } else {
            if ($this->getMedicons($Nume)) {
                $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($medicons);
                $update->where(array('Nume' => $Nume));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
            } else {
                throw new \Exception('Form Nume does not exist');
            }
        }
		$this->saveQuery($requete);
        return $medicons;
    }

	public function saveobjMedicons(Medicons $medicons) {
		$requete = "";
        $data = array(
        'Util' => $medicons->Util,
		'Modi' => $medicons->Modi,
		'Arv_Dure' => $medicons->Arv_Dure,
		'Arv_DureReno' => $medicons->Arv_DureReno,
		'Arv_DureTyp_' => $medicons->Arv_DureTyp_,
		'Arv_Into' => $medicons->Arv_Into,
		'Arv_IntoCase' => $medicons->Arv_IntoCase,
		'Arv_Modi' => $medicons->Arv_Modi,
		'Arv0Fois' => $medicons->Arv0Fois,
		'Arv0Form' => $medicons->Arv0Form,
		'Arv0Nomb' => $medicons->Arv0Nomb,
		'Arv0Nota' => $medicons->Arv0Nota,
		'Arv0Prsc' => $medicons->Arv0Prsc,
		'Arv0Serv' => $medicons->Arv0Serv,
		'Arv0Unit' => $medicons->Arv0Unit,
		'Arv1Fois' => $medicons->Arv1Fois,
		'Arv1Form' => $medicons->Arv1Form,
		'Arv1Nomb' => $medicons->Arv1Nomb,
		'Arv1Nota' => $medicons->Arv1Nota,
		'Arv1Prsc' => $medicons->Arv1Prsc,
		'Arv1Serv' => $medicons->Arv1Serv,
		'Arv1Unit' => $medicons->Arv1Unit,
		'Arv2Fois' => $medicons->Arv2Fois,
		'Arv2Form' => $medicons->Arv2Form,
		'Arv2Nomb' => $medicons->Arv2Nomb,
		'Arv2Nota' => $medicons->Arv2Nota,
		'Arv2Prsc' => $medicons->Arv2Prsc,
		'Arv2Serv' => $medicons->Arv2Serv,
		'Arv2Unit' => $medicons->Arv2Unit,
		'Arv3Fois' => $medicons->Arv3Fois,
		'Arv3Form' => $medicons->Arv3Form,
		'Arv3Nomb' => $medicons->Arv3Nomb,
		'Arv3Nota' => $medicons->Arv3Nota,
		'Arv3Prsc' => $medicons->Arv3Prsc,
		'Arv3Serv' => $medicons->Arv3Serv,
		'Arv3Unit' => $medicons->Arv3Unit,
		'Cdc_' => $medicons->Cdc_,
		'Conc' => $medicons->Conc,
		'ConcCase' => $medicons->ConcCase,
		'Cond' => $medicons->Cond,
		'Cont' => $medicons->Cont,
		'Dat_' => $medicons->Dat_,
		'Doss' => $medicons->Doss,
		'Hdj_' => $medicons->Hdj_,
		'Hdj_Acte' => $medicons->Hdj_Acte,
		'Hosp' => $medicons->Hosp,
		'HospSort' => $medicons->HospSort,
		'Imc_' => $medicons->Imc_,
		'Karn' => $medicons->Karn,
		'Med0Dci_' => $medicons->Med0Dci_,
		'Med0Dure' => $medicons->Med0Dure,
		'Med0DureTyp_' => $medicons->Med0DureTyp_,
		'Med0Fois' => $medicons->Med0Fois,
		'Med0Form' => $medicons->Med0Form,
		'Med0Nomb' => $medicons->Med0Nomb,
		'Med0Serv' => $medicons->Med0Serv,
		'Med0Unit' => $medicons->Med0Unit,
		'Med1Dci_' => $medicons->Med1Dci_,
		'Med1Dure' => $medicons->Med1Dure,
		'Med1DureTyp_' => $medicons->Med1DureTyp_,
		'Med1Fois' => $medicons->Med1Fois,
		'Med1Form' => $medicons->Med1Form,
		'Med1Nomb' => $medicons->Med1Nomb,
		'Med1Serv' => $medicons->Med1Serv,
		'Med1Unit' => $medicons->Med1Unit,
		'Med2Dci_' => $medicons->Med2Dci_,
		'Med2Dure' => $medicons->Med2Dure,
		'Med2DureTyp_' => $medicons->Med2DureTyp_,
		'Med2Fois' => $medicons->Med2Fois,
		'Med2Form' => $medicons->Med2Form,
		'Med2Nomb' => $medicons->Med2Nomb,
		'Med2Serv' => $medicons->Med2Serv,
		'Med2Unit' => $medicons->Med2Unit,
		'Med3Dci_' => $medicons->Med3Dci_,
		'Med3Dure' => $medicons->Med3Dure,
		'Med3DureTyp_' => $medicons->Med3DureTyp_,
		'Med3Fois' => $medicons->Med3Fois,
		'Med3Form' => $medicons->Med3Form,
		'Med3Nomb' => $medicons->Med3Nomb,
		'Med3Serv' => $medicons->Med3Serv,
		'Med3Unit' => $medicons->Med3Unit,
		'Med4Dci_' => $medicons->Med4Dci_,
		'Med4Dure' => $medicons->Med4Dure,
		'Med4DureTyp_' => $medicons->Med4DureTyp_,
		'Med4Fois' => $medicons->Med4Fois,
		'Med4Form' => $medicons->Med4Form,
		'Med4Nomb' => $medicons->Med4Nomb,
		'Med4Serv' => $medicons->Med4Serv,
		'Med4Unit' => $medicons->Med4Unit,
		'Med5Dci_' => $medicons->Med5Dci_,
		'Med5Dure' => $medicons->Med5Dure,
		'Med5DureTyp_' => $medicons->Med5DureTyp_,
		'Med5Fois' => $medicons->Med5Fois,
		'Med5Form' => $medicons->Med5Form,
		'Med5Nomb' => $medicons->Med5Nomb,
		'Med5Serv' => $medicons->Med5Serv,
		'Med5Unit' => $medicons->Med5Unit,
		'Moti' => $medicons->Moti,
		'MotiCase' => $medicons->MotiCase,
		'Obse' => $medicons->Obse,
		'ObseCase' => $medicons->ObseCase,
		'ObseManq' => $medicons->ObseManq,
		'ObseMoti' => $medicons->ObseMoti,
		'ObseNota' => $medicons->ObseNota,
		'Oms_' => $medicons->Oms_,
		'Poid' => $medicons->Poid,
		'Ptme' => $medicons->Ptme,
		'Tail' => $medicons->Tail,
		'Tb__Exte' => $medicons->Tb__Exte,
		'Temp' => $medicons->Temp,          
        );

        $Nume = (int) $medicons->Nume;
        if ($Nume == 0) {
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($data);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
        } else {
            if ($this->getMedicons($Nume)) {
                $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($data);
                $update->where(array('Nume' => $Nume));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
            } else {
                throw new \Exception('Form Nume does not exist');
            }
        }
		$this->saveQuery($requete);
    }


    public function deleteMedicons($Nume) {
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
