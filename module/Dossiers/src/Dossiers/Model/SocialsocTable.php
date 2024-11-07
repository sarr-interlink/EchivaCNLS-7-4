<?php

namespace Dossiers\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class SocialsocTable {

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
            //$select->where->like('name', 'Brit%');
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
        $resultSet = $this->tableGateway->selectWith($select)->toArray();
        //print_r($resultSet);exit;
        return $resultSet;
    }

    public function getSocialsoc($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        //$row->toArray();
        $row = $this->entityToArray($row);
        $row = $row['arrayCopy'];

        exit;
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

    public function saveSocialsoc(Socialsoc $socialsoc) {
		$requete = "";
        $data = array(
            'Util' => $socialsoc->Util,
            'Modi' => $socialsoc->Modi,
            'Acte' => $socialsoc->Acte,
            'ActeDesi' => $socialsoc->ActeDesi,
            'Conc' => $socialsoc->Conc,
            'Dat_' => $socialsoc->Dat_,
            'Doss' => $socialsoc->Doss,
            'Moti' => $socialsoc->Moti,
            'Nota' => $socialsoc->Nota,
        );

        $Nume =  $socialsoc->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$socialsoc->Nume;
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
	
	public function deleteSocialsoc($Nume) {
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
