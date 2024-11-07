<?php

namespace Dossiers\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class SocialserTable {

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
    
    public function getSocialser($Nume) {
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
    public function saveSocialser(Socialser $socialser) {
		$requete = "";
        $data = array(
                'Ref_' => $socialser->Ref_,
		'RensAdre' => $socialser->RensAdre,
		'RensAge_' => $socialser->RensAge_,
		'RensChrg' => $socialser->RensChrg,
		'RensDeceCaus' => $socialser->RensDeceCaus,
		'RensDeceDat_' => $socialser->RensDeceDat_,
		'RensDoub' => $socialser->RensDoub,
		'RensEmpl' => $socialser->RensEmpl,
		'RensEthn' => $socialser->RensEthn,
		'RensEtud' => $socialser->RensEtud,
		'RensExonArv_' => $socialser->RensExonArv_,
		'RensExonTota' => $socialser->RensExonTota,
		'RensIarvDat_' => $socialser->RensIarvDat_,
		'RensIarvNume' => $socialser->RensIarvNume,
		'RensLang' => $socialser->RensLang,
		'RensLoca' => $socialser->RensLoca,
		'RensMatr' => $socialser->RensMatr,
		'RensNaisDat_' => $socialser->RensNaisDat_,
		'RensNaisLieu' => $socialser->RensNaisLieu,
		'RensNati' => $socialser->RensNati,
		'RensNom_' => $socialser->RensNom_,
		'RensNon_Suiv' => $socialser->RensNon_Suiv,
		'RensNon_SuivDat_' => $socialser->RensNon_SuivDat_,
		'RensNumeUme_' => $socialser->RensNumeUme_,
		'RensOev_' => $socialser->RensOev_,
		'RensOev_Etab' => $socialser->RensOev_Etab,
		'RensOev_Sani' => $socialser->RensOev_Sani,
		'RensOev_Type' => $socialser->RensOev_Type,
		'RensOuvrUnit' => $socialser->RensOuvrUnit,
		'RensPnom' => $socialser->RensPnom,
		'RensProf' => $socialser->RensProf,
		'RensProfPrec' => $socialser->RensProfPrec,
		'RensPtmeNume' => $socialser->RensPtmeNume,
		'RensQuar' => $socialser->RensQuar,
		'RensSexe' => $socialser->RensSexe,
		'RensSui2' => $socialser->RensSui2,
		'RensSuiv' => $socialser->RensSuiv,
		'RensTel_' => $socialser->RensTel_,
		'RensVar0' => $socialser->RensVar0,
		'RensVar1' => $socialser->RensVar1,
		'RensVoya' => $socialser->RensVoya,
        );
        $Nume =  $socialser->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$socialser->Nume;
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
	
	public function deleteSocialser($Nume) {
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
