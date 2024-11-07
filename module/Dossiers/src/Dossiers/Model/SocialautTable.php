<?php

namespace Dossiers\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class SocialautTable {

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
    
    public function getSocialaut($Nume) {
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
    public function saveSocialaut(Socialaut $socialaut) {
		$requete = "";
        $data = array(
                'Ref_' => $socialaut->Ref_,
		'RensAdre' => $socialaut->RensAdre,
		'RensAge_' => $socialaut->RensAge_,
		'RensChrg' => $socialaut->RensChrg,
		'RensDeceCaus' => $socialaut->RensDeceCaus,
		'RensDeceDat_' => $socialaut->RensDeceDat_,
		'RensDoub' => $socialaut->RensDoub,
		'RensEmpl' => $socialaut->RensEmpl,
		'RensEthn' => $socialaut->RensEthn,
		'RensEtud' => $socialaut->RensEtud,
		'RensExonArv_' => $socialaut->RensExonArv_,
		'RensExonTota' => $socialaut->RensExonTota,
		'RensIarvDat_' => $socialaut->RensIarvDat_,
		'RensIarvNume' => $socialaut->RensIarvNume,
		'RensLang' => $socialaut->RensLang,
		'RensLoca' => $socialaut->RensLoca,
		'RensMatr' => $socialaut->RensMatr,
		'RensNaisDat_' => $socialaut->RensNaisDat_,
		'RensNaisLieu' => $socialaut->RensNaisLieu,
		'RensNati' => $socialaut->RensNati,
		'RensNom_' => $socialaut->RensNom_,
		'RensNon_Suiv' => $socialaut->RensNon_Suiv,
		'RensNon_SuivDat_' => $socialaut->RensNon_SuivDat_,
		'RensNumeUme_' => $socialaut->RensNumeUme_,
		'RensOev_' => $socialaut->RensOev_,
		'RensOev_Etab' => $socialaut->RensOev_Etab,
		'RensOev_Sani' => $socialaut->RensOev_Sani,
		'RensOev_Type' => $socialaut->RensOev_Type,
		'RensOuvrUnit' => $socialaut->RensOuvrUnit,
		'RensPnom' => $socialaut->RensPnom,
		'RensProf' => $socialaut->RensProf,
		'RensProfPrec' => $socialaut->RensProfPrec,
		'RensPtmeNume' => $socialaut->RensPtmeNume,
		'RensQuar' => $socialaut->RensQuar,
		'RensSexe' => $socialaut->RensSexe,
		'RensSui2' => $socialaut->RensSui2,
		'RensSuiv' => $socialaut->RensSuiv,
		'RensTel_' => $socialaut->RensTel_,
		'RensVar0' => $socialaut->RensVar0,
		'RensVar1' => $socialaut->RensVar1,
		'RensVoya' => $socialaut->RensVoya,
        );
        $Nume =  $socialaut->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$socialaut->Nume;
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
	
	public function deleteSocialaut($Nume) {
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
            
