<?php

namespace Dossiers\Model;

use Zend\Db\TableGateway\TableGateway;

class EntrTable {

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

    public function Rapport($table, $where) {
        $select = new \Zend\Db\Sql\Select($table);
        $select->columns(array('count' => new \Zend\Db\Sql\Expression('COUNT(*)')));
        $select->where($where);
        $resultSet = $this->tableGateway->selectWith($select)->current();
        return $resultSet->count;
    }

    public function findAll($start = null, $length = null, $search = null, $order = null, $whr = null) {
        $select = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
        $selectcount = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
        $selectcount->columns(array('count' => new \Zend\Db\Sql\Expression('COUNT(*)')));
        if ($start != null) {
            $select->offset($start);
        }
        if ($length != null) {
            $select->limit($length);
        }
        if ($order != null) {
            foreach ($order as $ord) {
                if ($ord['column'] == 'ArriHoro') {
                    if (strtolower($ord['dir']) == "asc") {
                        $ord['dir'] = "desc";
                    } else {
                        $ord['dir'] = "asc";
                    }
                    $ords = $ord['column'] . " " . $ord['dir'];
                } else {
                    $ords = $ord['column'] . " " . $ord['dir'];
                }
                $select->order("$ords");
            }
        }
        $where = new \Zend\Db\Sql\Where();

        if ($whr != null) {
            $comb = \Zend\Db\Sql\Predicate\PredicateSet::OP_AND;
            $where->addPredicate(new \Zend\Db\Sql\Predicate\Expression($whr), $comb);
        }

        if ($search != null) {
            $i = 0;
            foreach ($search as $srch) {
                if ($srch != "") {

                    if ($i == 0) {
                        $where->addPredicate(new \Zend\Db\Sql\Predicate\Like('Arri', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('ArriHoro', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Rdv_Horo', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Cta_Nume', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('ExteNume', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Sexe', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Nom_', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Pnom', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Age_', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Moti', "%$srch%"));
                        $i++;
                    } else {
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('Arri', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('ArriHoro', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Rdv_Horo', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Cta_Nume', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('ExteNume', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Sexe', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Nom_', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Pnom', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Age_', "%$srch%"))
                                ->orPredicate(new \Zend\Db\Sql\Predicate\Like('Moti', "%$srch%"));
                    }
                }
            }
        }

        $select->where($where);
        $selectcount->where($where);
        $count = $this->tableGateway->selectWith($selectcount)->current();
        $resultSet = $this->tableGateway->selectWith($select);
        return array('data' => $resultSet->toArray(), 'count' => $count->count);
    }

	public function select($where = null, $order = null, $limit = null,$columns = null,$group = null) {
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
		if ($columns != null) {
            $select->columns($columns);
        }
        if ($group != null) {
         $select->group($group);
        }
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }

    public function getEntr($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function saveEntr(Entr $entr) {
		$requete = "";
           $data = array(
            'Util' => $entr->Util,
            'Modi' => $entr->Modi,
            'Age_' => $entr->Age_,
            'AiguHoro' => $entr->AiguHoro,
            'Arri' => $entr->Arri,
            'ArriHeur' => $entr->ArriHeur,
            'ArriHoro' => $entr->ArriHoro,
            'Au00' => $entr->Au00,
            'Au01' => $entr->Au01,
            'Au02' => $entr->Au02,
            'Au03' => $entr->Au03,
            'Au04' => $entr->Au04,
            'Au05' => $entr->Au05,
            'Au06' => $entr->Au06,
            'Au07' => $entr->Au07,
            'Au08' => $entr->Au08,
            'Au09' => $entr->Au09,
            'Au10' => $entr->Au10,
            'Au11' => $entr->Au11,
            'Au12' => $entr->Au12,
            'Autr' => $entr->Autr,
            'Bi00' => $entr->Bi00,
            'Bi01' => $entr->Bi01,
            'Bi02' => $entr->Bi02,
            'Bi03' => $entr->Bi03,
            'Bi04' => $entr->Bi04,
            'Bi05' => $entr->Bi05,
            'Bi06' => $entr->Bi06,
            'Bi07' => $entr->Bi07,
            'Bi08' => $entr->Bi08,
            'Bi09' => $entr->Bi09,
            'Bi10' => $entr->Bi10,
            'Bi11' => $entr->Bi11,
            'Bi12' => $entr->Bi12,
            'Bi13' => $entr->Bi13,
            'Bi14' => $entr->Bi14,
            'Bi15' => $entr->Bi15,
            'Bioc' => $entr->Bioc,
            'Cd4_' => $entr->Cd4_,
            'Cd4_Dat_' => $entr->Cd4_Dat_,
            'Cd40' => $entr->Cd40,
            'Cd41' => $entr->Cd41,
            'Cd42' => $entr->Cd42,
            'Cd43' => $entr->Cd43,
            'Cd44' => $entr->Cd44,
            'Cd45' => $entr->Cd45,
            'Cd46' => $entr->Cd46,
            'Cep0' => $entr->Cep0,
            'Cep1' => $entr->Cep1,
            'Cep2' => $entr->Cep2,
            'Cep3' => $entr->Cep3,
            'Ceph' => $entr->Ceph,
            'Cta_Exte' => $entr->Cta_Exte,
            'Cta_Nume' => $entr->Cta_Nume,
            'Cta_Ume_' => $entr->Cta_Ume_,
            'Dat_' => $entr->Dat_,
            'Doss' => $entr->Doss,
            'ExteNume' => $entr->ExteNume,
            'Gou0' => $entr->Gou0,
            'Gou1' => $entr->Gou1,
            'Gou2' => $entr->Gou2,
            'Gou3' => $entr->Gou3,
            'Gou4' => $entr->Gou4,
            'Gou5' => $entr->Gou5,
            'Gout' => $entr->Gout,
            'Labo' => $entr->Labo,
            'LaboDat_' => $entr->LaboDat_,
            'LaboDesi' => $entr->LaboDesi,
            'Moti' => $entr->Moti,
            'NaisDat_' => $entr->NaisDat_,
            'Nf10' => $entr->Nf10,
            'Nf11' => $entr->Nf11,
            'Nf12' => $entr->Nf12,
            'Nf13' => $entr->Nf13,
            'Nf14' => $entr->Nf14,
            'Nf15' => $entr->Nf15,
            'Nf16' => $entr->Nf16,
            'Nf17' => $entr->Nf17,
            'Nf18' => $entr->Nf18,
            'Nf19' => $entr->Nf19,
            'Nf20' => $entr->Nf20,
            'Nf21' => $entr->Nf21,
            'Nfs_' => $entr->Nfs_,
            'Nfs0' => $entr->Nfs0,
            'Nfs1' => $entr->Nfs1,
            'Nfs2' => $entr->Nfs2,
            'Nfs3' => $entr->Nfs3,
            'Nfs4' => $entr->Nfs4,
            'Nfs5' => $entr->Nfs5,
            'Nfs6' => $entr->Nfs6,
            'Nfs7' => $entr->Nfs7,
            'Nfs8' => $entr->Nfs8,
            'Nfs9' => $entr->Nfs9,
            'Nom_' => $entr->Nom_,
            'Paim' => $entr->Paim,
            'Pcr_' => $entr->Pcr_,
            'Pcr_Dat_' => $entr->Pcr_Dat_,
            'Pcr0' => $entr->Pcr0,
            'Pcr1' => $entr->Pcr1,
            'Pcr2' => $entr->Pcr2,
            'Pcr3' => $entr->Pcr3,
            'Pcr4' => $entr->Pcr4,
            'Pcr5' => $entr->Pcr5,
            'Pcr6' => $entr->Pcr6,
            'Pnom' => $entr->Pnom,
            'Prec' => $entr->Prec,
            'Prsc' => $entr->Prsc,
            'Rdv_Heur' => $entr->Rdv_Heur,
            'Rdv_Horo' => $entr->Rdv_Horo,
            'Se10' => $entr->Se10,
            'Se11' => $entr->Se11,
            'Se12' => $entr->Se12,
            'Se13' => $entr->Se13,
            'Ser0' => $entr->Ser0,
            'Ser1' => $entr->Ser1,
            'Ser2' => $entr->Ser2,
            'Ser3' => $entr->Ser3,
            'Ser4' => $entr->Ser4,
            'Ser5' => $entr->Ser5,
            'Ser6' => $entr->Ser6,
            'Ser7' => $entr->Ser7,
            'Ser8' => $entr->Ser8,
            'Ser9' => $entr->Ser9,
            'Sero' => $entr->Sero,
            'Sexe' => $entr->Sexe,
            'Ume_Nume' => $entr->Ume_Nume,
            'Uri0' => $entr->Uri0,
            'Uri1' => $entr->Uri1,
            'Uri2' => $entr->Uri2,
            'Uri3' => $entr->Uri3,
            'Uri4' => $entr->Uri4,
            'Uri5' => $entr->Uri5,
            'Uri6' => $entr->Uri6,
            'Urin' => $entr->Urin,
            'Vag0' => $entr->Vag0,
            'Vag1' => $entr->Vag1,
            'Vag2' => $entr->Vag2,
            'Vag3' => $entr->Vag3,
            'Vag4' => $entr->Vag4,
            'Vagi' => $entr->Vagi,
        );

        $Nume =  $entr->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$entr->Nume;
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($data);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
        }
        else{
            $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
            $update->set($data);
            $update->where(array('Nume' => $Nume));
            $requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
            $this->tableGateway->updateWith($update);
        }
		$this->saveQuery($requete);
        return $entr;
    }

    public function saveEntrArray($entr) {
		$requete = "";
        $Nume =  $entr['Nume'];
        if(!$this->checkrecord($Nume)){
            //unset($entr['Nume']);
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($entr);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
        } else {
          
            
                $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($entr);
                $update->where(array('Nume' => $Nume));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
            }
            $this->saveQuery($requete); 
    }
	
	public function deleteEntr($Nume) {
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
