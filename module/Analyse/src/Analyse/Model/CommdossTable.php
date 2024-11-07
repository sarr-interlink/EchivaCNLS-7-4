<?php

namespace Analyse\Model;

use Zend\Db\TableGateway\TableGateway;

class CommdossTable {

    protected $tableGateway;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
            //$select->where->like('name', 'Brit%');
            $select->order('Nume DESC');
        });
        return $resultSet;
    }

    public function select($where = null, $order = null, $limit = null, $col = null) {
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
        if ($col != null) {
            $select->columns($col);
        }
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }

    public function getCommdoss($Nume) {
        $Nume = (int) $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function saveCommdoss(Commdoss $commdoss) {
		$requete = "";
        $data = array(
            'Util' => $commdoss->Util,
            'Modi' => $commdoss->Modi,
            'Comm' => $commdoss->Comm,
            'Doss' => $commdoss->Doss,
            'Nom_' => $commdoss->Nom_,
            'Oev_' => $commdoss->Oev_,
            'Pnom' => $commdoss->Pnom,
            'Ref_' => $commdoss->Ref_,
            'Sexe' => $commdoss->Sexe,
            'Age_' => $commdoss->Age_,
            'Montant' => $commdoss->Montant,
            'Tuteur' => $commdoss->Tuteur,
        );

        $Nume = (int) $commdoss->Nume;
        if ($Nume == 0) {
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($data);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
            $commdoss->Nume = $this->tableGateway->lastInsertValue;
        } else {
            if ($this->getCommdoss($Nume)) {
				$update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
                $update->set($data);
                $update->where(array('Nume' => $Nume));
				$requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
                $this->tableGateway->updateWith($update);
            } else {
                throw new \Exception('Form Nume does not exist');
            }
        }
        return $commdoss;
    }

    public function deleteCommdoss($Nume) {
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
