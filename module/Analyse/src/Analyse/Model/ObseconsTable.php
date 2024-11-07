<?php

namespace Analyse\Model;

use Zend\Db\TableGateway\TableGateway;

class ObseconsTable {

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
            $select->order($order)->limit(20);
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
        return $resultSet;
    }
     
	public function Rapportjoint($where = null,$columns = null,$join,$condjoin,$group = null, $order = null, $limit = null) {
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
        if ($columns != null) {
            $select->columns($columns,false);
        }
        if ($join != null && $condjoin != null) {
            $select->join($join,$condjoin,array());
        }
        if ($group != null) {
         $select->group($group);
        }
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
    
	public function getObsecons($Nume) {
        $Nume = (int) $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function saveObsecons($obsecons) {
		$requete = "";
        $Nume = (int) $obsecons['Nume'];
        if ($Nume == 0) {
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($obsecons);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
        } else {
            if ($this->getObsecons($Nume)) {
                $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($obsecons);
                $update->where(array('Nume' => $Nume));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
            } else {
                throw new \Exception('Form Nume does not exist');
            }
        }
		$this->saveQuery($requete);
    }
	
	public function saveObseconsObj(Obsecons $obsecons) {
		$requete = "";
		$data = array(
            'Util' => $obsecons->Util,
			'Modi' => $obsecons->Modi,
			'Apci' => $obsecons->Apci,
			'ApprDat_' => $obsecons->ApprDat_,
			'ApprReta' => $obsecons->ApprReta,
			'Comp' => $obsecons->Comp,
			'Cont' => $obsecons->Cont,
			'Dat_' => $obsecons->Dat_,
			'Doss' => $obsecons->Doss,
			'Eval' => $obsecons->Eval,
			'Nota' => $obsecons->Nota,
			'Obje' => $obsecons->Obje,
			'Obse' => $obsecons->Obse,
			'Ques' => $obsecons->Ques,
			'Rdv_Dat_' => $obsecons->Rdv_Dat_,
			'Rdv_Heur' => $obsecons->Rdv_Heur,
			'Rdv_Minu' => $obsecons->Rdv_Minu,
			'Supp' => $obsecons->Supp,
			'Typ_' => $obsecons->Typ_,
			'Var0' => $obsecons->Var0,
			'Var1' => $obsecons->Var1,
        );

        $Nume = (int) $obsecons->Nume;
        if ($Nume == 0) {
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($data);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
        } else {
            if ($this->getObsecons($Nume)) {
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

    public function deleteObsecons($Nume) {
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
