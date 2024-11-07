<?php

namespace Dossiers\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class MedicalouvTable {

    protected $tableGateway;
    protected $hydrator;
    protected $sm;

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

    public function setServiceLocator($something) {
        $this->sm = $something;
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

    public function getMedicalouv($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
       //$row->subFormMedicalouvSer = $this->sm->get('Dossiers\Model\MedicalouvserTable')->getMedicalouvser($Nume);
        //$row->subFormMedicalouvAut = $this->sm->get('Dossiers\Model\MedicalouvautTable')->getMedicalouvaut($Nume);
        $row = $this->entityToArray($row);
        $row = $row['arrayCopy'];
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

    public function saveMedicalouv(Medicalouv $medicalouv) {
		$requete = "";
        $data = array(
            'Ref_' => $medicalouv->Ref_,
            'RensAdre' => $medicalouv->RensAdre,
            'RensAge_' => $medicalouv->RensAge_,
            'RensChrg' => $medicalouv->RensChrg,
            'RensDeceCaus' => $medicalouv->RensDeceCaus,
            'RensDeceDat_' => $medicalouv->RensDeceDat_,
            'RensDoub' => $medicalouv->RensDoub,
            'RensEmpl' => $medicalouv->RensEmpl,
            'RensEthn' => $medicalouv->RensEthn,
            'RensEtud' => $medicalouv->RensEtud,
            'RensExonArv_' => $medicalouv->RensExonArv_,
            'RensExonTota' => $medicalouv->RensExonTota,
            'RensIarvDat_' => $medicalouv->RensIarvDat_,
            'RensIarvNume' => $medicalouv->RensIarvNume,
            'RensLang' => $medicalouv->RensLang,
            'RensLoca' => $medicalouv->RensLoca,
            'RensMatr' => $medicalouv->RensMatr,
            'RensNaisDat_' => $medicalouv->RensNaisDat_,
            'RensNaisLieu' => $medicalouv->RensNaisLieu,
            'RensNati' => $medicalouv->RensNati,
            'RensNom_' => $medicalouv->RensNom_,
            'RensNon_Suiv' => $medicalouv->RensNon_Suiv,
            'RensNon_SuivDat_' => $medicalouv->RensNon_SuivDat_,
            'RensNumeUme_' => $medicalouv->RensNumeUme_,
            'RensOev_' => $medicalouv->RensOev_,
            'RensOev_Etab' => $medicalouv->RensOev_Etab,
            'RensOev_Sani' => $medicalouv->RensOev_Sani,
            'RensOev_Type' => $medicalouv->RensOev_Type,
            'RensOuvrUnit' => $medicalouv->RensOuvrUnit,
            'RensPnom' => $medicalouv->RensPnom,
            'RensProf' => $medicalouv->RensProf,
            'RensProfPrec' => $medicalouv->RensProfPrec,
            'RensPtmeNume' => $medicalouv->RensPtmeNume,
            'RensQuar' => $medicalouv->RensQuar,
            'RensSexe' => $medicalouv->RensSexe,
            'RensSui2' => $medicalouv->RensSui2,
            'RensSuiv' => $medicalouv->RensSuiv,
            'RensTel_' => $medicalouv->RensTel_,
            'RensVar0' => $medicalouv->RensVar0,
            'RensVar1' => $medicalouv->RensVar1,
            'RensVoya' => $medicalouv->RensVoya,
        );
        $Nume =  $medicalouv->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$medicalouv->Nume;
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
	
	public function deleteMedicalouv($Nume) {
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
