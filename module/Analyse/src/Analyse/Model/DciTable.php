<?php

namespace Analyse\Model;

use Zend\Db\TableGateway\TableGateway;

class DciTable {

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
 public function select($where = null, $order = null, $limit = null) {
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
       // print_r($resultSet);exit;
        return $resultSet;
    }
    public function getDci($Nume) {
        $Nume = (int) $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }
    public function getDcitab() {
        $resultSet = $this->tableGateway->select()->toArray();
        return $resultSet;
    }
    public function saveDci(Dci $dci) {
        $data = array(
            'Util' => $dci->Util,
            'Modi' => $dci->Modi,
            'Desi' => $dci->Desi,
            'Typ_' => $dci->Typ_,
        );

        $Nume = (int) $dci->Nume;
        if ($Nume == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getDci($Nume)) {
                $this->tableGateway->update($data, array('Nume' => $Nume));
            } else {
                throw new \Exception('Form Nume does not exist');
            }
        }
    }

    public function deleteDci($Nume) {
        $this->tableGateway->delete(array('Nume' => $Nume));
    }

}
