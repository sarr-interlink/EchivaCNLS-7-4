<?php

namespace Dossiers\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class SocialTable {

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
    
    public function getSocial($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        //$row->toArray();
        
        //$row->subFormSocialSocial = $this->sm->get('Dossiers\Model\SocialsocTable')->select("Doss=".$Nume);
        //$row->subFormSocialPsy = $this->sm->get('Dossiers\Model\SocialTable')->getSocial($Nume);
        $row->subFormSocialSer = $this->sm->get('Dossiers\Model\SocialserTable')->getSocialser($Nume);
        //$row->subFormSocialEnf = $this->sm->get('Dossiers\Model\SocialTable')->getSocial($Nume);
        $row->subFormSocialAut = $this->sm->get('Dossiers\Model\SocialautTable')->getSocialaut($Nume);
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
    public function saveSocial(Social $social) {
		$requete = "";
        $data = array(
                'Ref_' => $social->Ref_,
		'RensAdre' => $social->RensAdre,
		'RensAge_' => $social->RensAge_,
		'RensChrg' => $social->RensChrg,
		'RensDeceCaus' => $social->RensDeceCaus,
		'RensDeceDat_' => $social->RensDeceDat_,
		'RensDoub' => $social->RensDoub,
		'RensEmpl' => $social->RensEmpl,
		'RensEthn' => $social->RensEthn,
		'RensEtud' => $social->RensEtud,
		'RensExonArv_' => $social->RensExonArv_,
		'RensExonTota' => $social->RensExonTota,
		'RensIarvDat_' => $social->RensIarvDat_,
		'RensIarvNume' => $social->RensIarvNume,
		'RensLang' => $social->RensLang,
		'RensLoca' => $social->RensLoca,
		'RensMatr' => $social->RensMatr,
		'RensNaisDat_' => $social->RensNaisDat_,
		'RensNaisLieu' => $social->RensNaisLieu,
		'RensNati' => $social->RensNati,
		'RensNom_' => $social->RensNom_,
		'RensNon_Suiv' => $social->RensNon_Suiv,
		'RensNon_SuivDat_' => $social->RensNon_SuivDat_,
		'RensNumeUme_' => $social->RensNumeUme_,
		'RensOev_' => $social->RensOev_,
		'RensOev_Etab' => $social->RensOev_Etab,
		'RensOev_Sani' => $social->RensOev_Sani,
		'RensOev_Type' => $social->RensOev_Type,
		'RensOuvrUnit' => $social->RensOuvrUnit,
		'RensPnom' => $social->RensPnom,
		'RensProf' => $social->RensProf,
		'RensProfPrec' => $social->RensProfPrec,
		'RensPtmeNume' => $social->RensPtmeNume,
		'RensQuar' => $social->RensQuar,
		'RensSexe' => $social->RensSexe,
		'RensSui2' => $social->RensSui2,
		'RensSuiv' => $social->RensSuiv,
		'RensTel_' => $social->RensTel_,
		'RensVar0' => $social->RensVar0,
		'RensVar1' => $social->RensVar1,
		'RensVoya' => $social->RensVoya,
        );
        $Nume =  $social->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$social->Nume;
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
	
	public function deleteSocial($Nume) {
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
