<?php

namespace Analyse\Model;

use Zend\Db\TableGateway\TableGateway;

class ListeTable {

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
    public function getListe($Nume) {
        $Nume = (int) $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function getListetab() {

        $resultSet = $this->tableGateway->select()->toArray();        
        return $resultSet;
    }

    public function saveListe(Liste $liste) {
        $data = array(
            'Util' => $liste->Util,
            'Modi' => $liste->Modi,
            'Desi' => $liste->Desi,
            'Typ_' => $liste->Typ_,
        );

        $Nume = (int) $liste->Nume;
        if ($Nume == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getListe($Nume)) {
                $this->tableGateway->update($data, array('Nume' => $Nume));
            } else {
                throw new \Exception('Form Nume does not exist');
            }
        }
    }

    public function deleteListe($Nume) {
        $this->tableGateway->delete(array('Nume' => $Nume));
    }

}
