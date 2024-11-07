<?php

namespace Parametres\Model;

use Zend\Db\TableGateway\TableGateway;

class RolePermissionTable {

    protected $tableGateway;

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
            $select->order('role_id');
        });
        return $resultSet;
    }

    public function updt($permi, $rol) {
        $requete = "";
        foreach ($permi as $per) {
            $data = array(
                'role_id' => $rol,
                'permission_id' => $per,
            );
            $data['id'] =  "14".hexdec(uniqid());

            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($data);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
            $this->saveQuery($requete);
        }
    }

    public function randomDigits($length) {
        $numbers = range(0, $length);
        shuffle($numbers);
        for ($i = 0; $i < $length; $i++)
            echo $numbers[$i] . " ";
        return $numbers;
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

    public function getRolePermission($id) {
        $id =  $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveRolePermission(RolePermission $entr) {
        //$data = $entr->getArrayCopy();
        $data = array(
            'role_id' => $entr->role_id,
            'permission_id' => $entr->permission_id,
        );
        /*
          $id =  $entr->id;
          if ($id == 0) {
          $this->tableGateway->insert($data);
          $entr->id = $this->tableGateway->lastInsertValue;
          } else {
          if ($this->getRolePermission($id)) {
          $this->tableGateway->update($data, array('id' => $id));
          } else {
          throw new \Exception('Form id does not exist');
          }
          } */

        $id =  $entr->id;
        if (!$this->checkrecord($id)) {
            $data['id'] = $entr->id;
            $insert = new \Zend\Db\Sql\Insert($this->tableGateway->getTable());
            $insert->values($data);
            $this->tableGateway->insertWith($insert);
            $requete = $insert->getSqlString($this->tableGateway->getadapter()->getPlatform());
        } else {
            $update = new \Zend\Db\Sql\Update($this->tableGateway->getTable());
            $update->set($data);
            $update->where(array('id' => $id));
            $requete = $update->getSqlString($this->tableGateway->getadapter()->getPlatform());
            $this->tableGateway->updateWith($update);
        }
        $this->saveQuery($requete);


        return $entr;
    }

    public function deleteRolePermission($id) {
        $delete = new \Zend\Db\Sql\Delete($this->tableGateway->getTable());
        $delete->where(array('id' => $id));
        $this->tableGateway->deleteWith($delete);
        $requete = $delete->getSqlString($this->tableGateway->getadapter()->getPlatform());
        $this->saveQuery($requete);
    }

    public function deleteRole($id) {
        $delete = new \Zend\Db\Sql\Delete($this->tableGateway->getTable());
        $delete->where(array('role_id' => $id));
        $this->tableGateway->deleteWith($delete);
        $requete = $delete->getSqlString($this->tableGateway->getadapter()->getPlatform());
        $this->saveQuery($requete);
    }

    public function saveQuery($query = "") {
        $query = str_ireplace('\\','\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\',$query);
        $logstr = "INSERT INTO `log_query` (`id`, `req`, `etat`, `prov`, `date`) VALUES (NULL,\"" . $query . "\" , '0', '', '" . date('Y-m-d h:i:s') . "')";
        $statement = $this->tableGateway->getadapter()->query($logstr);
        $result = $statement->execute();
        return $result;
    }

}
