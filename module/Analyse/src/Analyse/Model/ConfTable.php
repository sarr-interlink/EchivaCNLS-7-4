<?php

namespace Analyse\Model;

use Zend\Db\TableGateway\TableGateway;

class ConfTable {

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

    public function getConf($Nume) {
        $Nume = (int) $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

   public function saveConf($conf) {
       
      /*  $data = array(
            'Util' => $conf->Util,
            'Modi' => $conf->Modi,
            'AbrgEspa' => $conf->AbrgEspa,
            'AccuMotiDefa' => $conf->AccuMotiDefa,
            'AlerMess' => $conf->AlerMess,
            'AnalRequ' => $conf->AnalRequ,
            'AnalRequGene' => $conf->AnalRequGene,
            'Bi00' => $conf->Bi00,
            'Bi01' => $conf->Bi01,
            'Bi02' => $conf->Bi02,
            'Bi03' => $conf->Bi03,
            'Bi04' => $conf->Bi04,
            'Bi05' => $conf->Bi05,
            'Bi06' => $conf->Bi06,
            'Bi11' => $conf->Bi11,
            'Bi12' => $conf->Bi12,
            'Bi13' => $conf->Bi13,
            'ConfAccuPaim' => $conf->ConfAccuPaim,
            'ConfAler' => $conf->ConfAler,
            'ConfComm' => $conf->ConfComm,
            'ConfDeliPaim' => $conf->ConfDeliPaim,
            'ConfDepi' => $conf->ConfDepi,
            'ConfExon' => $conf->ConfExon,
            'ConfExpoOo__' => $conf->ConfExpoOo__,
            'ConfMediCons' => $conf->ConfMediCons,
            'ConfOev_' => $conf->ConfOev_,
            'Dat_Vers' => $conf->Dat_Vers,
            'Dat_VersMini' => $conf->Dat_VersMini,
            'DeliDiza' => $conf->DeliDiza,
            'DeliServ' => $conf->DeliServ,
            'DocsChem' => $conf->DocsChem,
            'DossEthn' => $conf->DossEthn,
            'DossLang' => $conf->DossLang,
            'DossRef_Libr' => $conf->DossRef_Libr,
            'DossSais' => $conf->DossSais,
            'Ent0' => $conf->Ent0,
            'Ent1' => $conf->Ent1,
            'ExecVers' => $conf->ExecVers,
            'Ftp_Auto' => $conf->Ftp_Auto,
            'Ftp_Chem' => $conf->Ftp_Chem,
            'Ftp_Doss' => $conf->Ftp_Doss,
            'Ftp_Jrnl' => $conf->Ftp_Jrnl,
            'Ftp_Motp' => $conf->Ftp_Motp,
            'Ftp_Util' => $conf->Ftp_Util,
            'Horo' => $conf->Horo,
            'IarvNom_' => $conf->IarvNom_,
            'LaboNom_' => $conf->LaboNom_,
            'LitsNomb' => $conf->LitsNomb,
            'MediConsTail' => $conf->MediConsTail,
            'MenuAccu' => $conf->MenuAccu,
            'MenuComm' => $conf->MenuComm,
            'MenuDepi' => $conf->MenuDepi,
            'MenuDepi' => $conf->MenuDepi,
            'MenuOev_' => $conf->MenuOev_,
            'MoisFile' => $conf->MoisFile,
            'MotpAccu' => $conf->MotpAccu,
            'MotpDoss' => $conf->MotpDoss,
            'OrdoDupl' => $conf->OrdoDupl,
            'ParaSql_Motp' => $conf->ParaSql_Motp,
            'PharDeli' => $conf->PharDeli,
            'PosoDefa' => $conf->PosoDefa,
            'Pres' => $conf->Pres,
            'Reta' => $conf->Reta,
            'SantPhar' => $conf->SantPhar,
            'SauvChe0' => $conf->SauvChe0,
            'SauvChe1' => $conf->SauvChe1,
            'SauvChe2' => $conf->SauvChe2,
            'SauvDat_' => $conf->SauvDat_,
            'SauvErro' => $conf->SauvErro,
            'SauvHeur' => $conf->SauvHeur,
            'SauvMotp' => $conf->SauvMotp,
            'SauvNom_' => $conf->SauvNom_,
            'ServRdv_' => $conf->ServRdv_,
            'ServRdv_Veri' => $conf->ServRdv_Veri,
            'SiteCode' => $conf->SiteCode,
            'Stoc' => $conf->Stoc,
            'StocItemNume' => $conf->StocItemNume,
            'TradAngl' => $conf->TradAngl,
        );*/

        $Nume = (int) $conf['Nume'];
        if ($Nume == 0) {
            $this->tableGateway->insert($conf);
        } else {
            if ($this->getConf($Nume)) {
                $this->tableGateway->update($conf, array('Nume' => $Nume));
            } else {
                throw new \Exception('Form Nume does not exist');
            }
        }
    }
   
   public function deleteConf($Nume) {
        $this->tableGateway->delete(array('Nume' => $Nume));
    }

}
