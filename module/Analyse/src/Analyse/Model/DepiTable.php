<?php

namespace Analyse\Model;

use Zend\Db\TableGateway\TableGateway;

class DepiTable {

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
     public function select($where = null, $order = null, $limit = null,$col = null,$distinct = null) {
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

    

    public function getDepi($Nume) {
        $Nume = (int) $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function saveDepi(Depi $depi) {
        $data = array(
			'Util' => $depi->Util,
			'Modi' => $depi->Modi,
			'Age_' => $depi->Age_,
			'Circ' => $depi->Circ,
			'ConfDat_' => $depi->ConfDat_,
			'ConfRetr' => $depi->ConfRetr,
			'ConfSero' => $depi->ConfSero,
			'ConfSeroTyp_' => $depi->ConfSeroTyp_,
			'Dat_' => $depi->Dat_,
			'DejaSero' => $depi->DejaSero,
			'DejaSeroTyp_' => $depi->DejaSeroTyp_,
			'Matr' => $depi->Matr,
			'Nb__Chrg' => $depi->Nb__Chrg,
			'Nom_' => $depi->Nom_,
			'Pnom' => $depi->Pnom,
			'Prof' => $depi->Prof,
			'Ref_' => $depi->Ref_,
			'Sexe' => $depi->Sexe,
			'Tel_' => $depi->Tel_,
			'TestDat_' => $depi->TestDat_,
			'TestRetr' => $depi->TestRetr,
			'TestSero' => $depi->TestSero,
			'TestSeroTyp_' => $depi->TestSeroTyp_,
        );

        $Nume = (int) $depi->Nume;
        if ($Nume == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getDepi($Nume)) {
                $this->tableGateway->update($data, array('Nume' => $Nume));
            } else {
                throw new \Exception('Form Nume does not exist');
            }
        }
    }

    public function deleteDepi($Nume) {
        $this->tableGateway->delete(array('Nume' => $Nume));
    }

}
