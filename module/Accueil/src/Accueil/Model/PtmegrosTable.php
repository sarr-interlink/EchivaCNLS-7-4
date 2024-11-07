<?php

namespace Accueil\Model;

use Zend\Db\TableGateway\TableGateway;

class PtmegrosTable {

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
    
	public function getPtmegros($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function savePtmegrosg(Ptmegrosg $ptmegrosg) {
		$requete = "";
        $data = array(
            'Util' => $ptmegrosg->Util,
			'Modi' => $ptmegrosg->Modi,
			'AccoAzt_Nomb' => $ptmegrosg->AccoAzt_Nomb,
			'AccoDat_' => $ptmegrosg->AccoDat_,
			'AccoEpis' => $ptmegrosg->AccoEpis,
			'AccoForc' => $ptmegrosg->AccoForc,
			'AccoLieu' => $ptmegrosg->AccoLieu,
			'AccoNaisNomb' => $ptmegrosg->AccoNaisNomb,
			'AccoNvp_Nomb' => $ptmegrosg->AccoNvp_Nomb,
			'AccoPrev' => $ptmegrosg->AccoPrev,
			'AccoPris2h__' => $ptmegrosg->AccoPris2h__,
			'AccoRupt' => $ptmegrosg->AccoRupt,
			'AccoVoie' => $ptmegrosg->AccoVoie,
			'AnteCesa' => $ptmegrosg->AnteCesa,
			'AnteFcs_' => $ptmegrosg->AnteFcs_,
			'AnteGest' => $ptmegrosg->AnteGest,
			'AnteIvg_' => $ptmegrosg->AnteIvg_,
			'AntePari' => $ptmegrosg->AntePari,
			'Arv_Debu' => $ptmegrosg->Arv_Debu,
			'Arv_Trai' => $ptmegrosg->Arv_Trai,
			'Ddr_' => $ptmegrosg->Ddr_,
			'Doss' => $ptmegrosg->Doss,
			'EchoResu' => $ptmegrosg->EchoResu,
			'Enf0Apga' => $ptmegrosg->Enf0Apga,
			'Enf0Azt_Debu' => $ptmegrosg->Enf0Azt_Debu,
			'Enf0Azt_Dure' => $ptmegrosg->Enf0Azt_Dure,
			'Enf0DeceCaus' => $ptmegrosg->Enf0DeceCaus,
			'Enf0DeceDat_' => $ptmegrosg->Enf0DeceDat_,
			'Enf0Nais' => $ptmegrosg->Enf0Nais,
			'Enf0Nato' => $ptmegrosg->Enf0Nato,
			'Enf0Nom_' => $ptmegrosg->Enf0Nom_,
			'Enf0Nvp_Debu' => $ptmegrosg->Enf0Nvp_Debu,
			'Enf0Nvp_Nomb' => $ptmegrosg->Enf0Nvp_Nomb,
			'Enf0Pcr0Dat_' => $ptmegrosg->Enf0Pcr0Dat_,
			'Enf0Pcr0Resu' => $ptmegrosg->Enf0Pcr0Resu,
			'Enf0Pcr1Dat_' => $ptmegrosg->Enf0Pcr1Dat_,
			'Enf0Pcr1Resu' => $ptmegrosg->Enf0Pcr1Resu,
			'Enf0Pcr2Dat_' => $ptmegrosg->Enf0Pcr2Dat_,
			'Enf0Pcr2Resu' => $ptmegrosg->Enf0Pcr2Resu,
			'Enf0Pnom' => $ptmegrosg->Enf0Pnom,
			'Enf0Poid' => $ptmegrosg->Enf0Poid,
			'Enf0Sero' => $ptmegrosg->Enf0Sero,
			'Enf0SeroDat_' => $ptmegrosg->Enf0SeroDat_,
			'Enf0SeroTyp_' => $ptmegrosg->Enf0SeroTyp_,
			'Enf0Sexe' => $ptmegrosg->Enf0Sexe,
			'Enf0Ume_' => $ptmegrosg->Enf0Ume_,
			'Enf1Apga' => $ptmegrosg->Enf1Apga,
			'Enf1Azt_Debu' => $ptmegrosg->Enf1Azt_Debu,
			'Enf1Azt_Dure' => $ptmegrosg->Enf1Azt_Dure,
			'Enf1DeceCaus' => $ptmegrosg->Enf1DeceCaus,
			'Enf1DeceDat_' => $ptmegrosg->Enf1DeceDat_,
			'Enf1Nais' => $ptmegrosg->Enf1Nais,
			'Enf1Nato' => $ptmegrosg->Enf1Nato,
			'Enf1Nom_' => $ptmegrosg->Enf1Nom_,
			'Enf1Nvp_Debu' => $ptmegrosg->Enf1Nvp_Debu,
			'Enf1Nvp_Nomb' => $ptmegrosg->Enf1Nvp_Nomb,
			'Enf1Pcr0Dat_' => $ptmegrosg->Enf1Pcr0Dat_,
			'Enf1Pcr0Resu' => $ptmegrosg->Enf1Pcr0Resu,
			'Enf1Pcr1Dat_' => $ptmegrosg->Enf1Pcr1Dat_,
			'Enf1Pcr1Resu' => $ptmegrosg->Enf1Pcr1Resu,
			'Enf1Pcr2Dat_' => $ptmegrosg->Enf1Pcr2Dat_,
			'Enf1Pcr2Resu' => $ptmegrosg->Enf1Pcr2Resu,
			'Enf1Pnom' => $ptmegrosg->Enf1Pnom,
			'Enf1Poid' => $ptmegrosg->Enf1Poid,
			'Enf1Sero' => $ptmegrosg->Enf1Sero,
			'Enf1SeroDat_' => $ptmegrosg->Enf1SeroDat_,
			'Enf1SeroTyp_' => $ptmegrosg->Enf1SeroTyp_,
			'Enf1Sexe' => $ptmegrosg->Enf1Sexe,
			'Enf1Ume_' => $ptmegrosg->Enf1Ume_,
			'EnfaViva' => $ptmegrosg->EnfaViva,
			'EvolGros' => $ptmegrosg->EvolGros,
			'SaisDat_' => $ptmegrosg->SaisDat_,
			'Term' => $ptmegrosg->Term,
			'TermDdr_Echo' => $ptmegrosg->TermDdr_Echo,
			'Var0' => $ptmegrosg->Var0,
			'Var1' => $ptmegrosg->Var1,
        );

        $Nume =  $ptmegrosg->Nume;
        if (!$this->checkrecord($Nume)) {
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


    public function savePtmegros($ptmegros) {
		$requete = "";
        $Nume =  $ptmegros['Nume'];
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$ptmegros->Nume;
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($ptmegros);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
        } else {
            
                $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($ptmegros);
                $update->where(array('Nume' => $Nume));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
            
        }
		$this->saveQuery($requete);
    }

    public function deletePtmegros($Nume) {
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
