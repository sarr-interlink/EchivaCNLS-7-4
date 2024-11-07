<?php

namespace Dossiers\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class FicheTable {

    protected $tableGateway;
    protected $hydrator;

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
            $select->order('Nume DESC');
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
    
    public function getFiche($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        //$row->toArray();
        $row= $this->entityToArray($row);
        $row=$row['arrayCopy'];
        return $row;
    }
    
     public function getHydrator() {
        if (!$this->hydrator) {
            $this->hydrator = new ClassMethods(false);
        }
        return $this->hydrator;
    }
public function entityToArray($entity, HydratorInterface $hydrator = null) {
        if (is_array($entity)) {
            return $entity; // cut down on duplicate code
        } elseif (is_object($entity)) {
            if (!$hydrator) {
                $hydrator = $this->getHydrator();
            }
            return $hydrator->extract($entity);
        }
        throw new Exception\InvalidArgumentException('Entity passed to db mapper should be an array or object.');
    }
    public function saveFiche(Fiche $fiche) {
		$requete = "";
        $data = array(
                'Ref_' => $fiche->Ref_,
		'RensAdre' => $fiche->RensAdre,
		'RensAge_' => $fiche->RensAge_,
		'RensChrg' => $fiche->RensChrg,
		'RensDeceCaus' => $fiche->RensDeceCaus,
		'RensDeceDat_' => $fiche->RensDeceDat_,
		'RensDoub' => $fiche->RensDoub,
		'RensEmpl' => $fiche->RensEmpl,
		'RensEthn' => $fiche->RensEthn,
		'RensEtud' => $fiche->RensEtud,
		'RensExonArv_' => $fiche->RensExonArv_,
		'RensExonTota' => $fiche->RensExonTota,
		'RensIarvDat_' => $fiche->RensIarvDat_,
		'RensIarvNume' => $fiche->RensIarvNume,
		'RensLang' => $fiche->RensLang,
		'RensLoca' => $fiche->RensLoca,
		'RensMatr' => $fiche->RensMatr,
		'RensNaisDat_' => $fiche->RensNaisDat_,
		'RensNaisLieu' => $fiche->RensNaisLieu,
		'RensNati' => $fiche->RensNati,
		'RensNom_' => $fiche->RensNom_,
		'RensNon_Suiv' => $fiche->RensNon_Suiv,
		'RensNon_SuivDat_' => $fiche->RensNon_SuivDat_,
		'RensNumeUme_' => $fiche->RensNumeUme_,
		'RensOev_' => $fiche->RensOev_,
		'RensOev_Etab' => $fiche->RensOev_Etab,
		'RensOev_Sani' => $fiche->RensOev_Sani,
		'RensOev_Type' => $fiche->RensOev_Type,
		'RensOuvrUnit' => $fiche->RensOuvrUnit,
		'RensPnom' => $fiche->RensPnom,
		'RensProf' => $fiche->RensProf,
		'RensProfPrec' => $fiche->RensProfPrec,
		'RensPtmeNume' => $fiche->RensPtmeNume,
		'RensQuar' => $fiche->RensQuar,
		'RensSexe' => $fiche->RensSexe,
		'RensSui2' => $fiche->RensSui2,
		'RensSuiv' => $fiche->RensSuiv,
		'RensTel_' => $fiche->RensTel_,
		'RensVar0' => $fiche->RensVar0,
		'RensVar1' => $fiche->RensVar1,
		'RensVoya' => $fiche->RensVoya,
        );
        $Nume =  $fiche->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$fiche->Nume;
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
	
	public function deleteFiche($Nume) {
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
