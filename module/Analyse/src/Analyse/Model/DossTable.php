<?php

namespace Analyse\Model;

use Zend\Db\TableGateway\TableGateway;

class DossTable {

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
    public function countv() {
        $req = "SELECT Nume FROM doss where rensdecedat_ = 0 or rensdecedat_ is null ";
        $statement = $this->tableGateway->getadapter()->query($req);
        $total = count($statement->execute());
        $datefin= '2017-09-30'; 
        $datedebfilact = date('Y-m-d', strtotime($datefin . ' -180 day')); 
        $sql = " ( SELECT DISTINCT Doss FROM medicons where Dat_ >= '$datedebfilact' and Dat_ <= '$datefin') t1 ";
        $sql .= "UNION ( SELECT Doss from entr where ArriHoro >= '$datedebfilact' and ArriHoro <= '$datefin') t2";
        $sql .= "UNION ( SELECT Doss from obsecons where Dat_ >= '$datedebfilact' and Dat_ <= '$datefin') t3";
        $sql .= "UNION ( SELECT Doss from ptmeenfacons where Dat_ >= '$datedebfilact' and Dat_ <= '$datefin') t4";
        $sql .= "UNION ( SELECT Doss from ptmegros where SaisDat_ >= '$datedebfilact' and SaisDat_ <= '$datefin') t5";
        $sql .= "UNION ( SELECT Doss from socicons where Dat_ >= '$datedebfilact' and Dat_ <= '$datefin') t6";
        $sql .= "UNION ( SELECT Doss from item where Dat_ >= '$datedebfilact' and Dat_ <= '$datefin' and dest = 6 )";
   /*     echo $sql;exit;
        SELECT A
FROM
(
    SELECT A, B FROM TableA
    UNION
    SELECT A, B FROM TableB
) AS tbl
WHERE B > 'some value'*/
                $sql1='select doss.Nume from doss,'.$sql.' AS tbl where(doss.Nume=tbl.Doss)';
                 echo $sql1;exit;
        $statement = $this->tableGateway->getadapter()->query($sql);
        $visites = count($statement->execute());
        
        print_r($total.'<br>');
        print_r($visites.'<br>');
        print_r($total-$visites);
        exit();
        
    }
    public function test(){
        $sql1 = new \Zend\Db\Sql\Select('medicons');
        $sql1->columns(array('Doss','Dat_'));
        $sql2 = new \Zend\Db\Sql\Select('socicons');
        $sql2->columns(array('Doss','Dat_'));
        $sql3 = new \Zend\Db\Sql\Select('psy_cons');
        $sql3->columns(array('Doss','Dat_'));
        //$sql1->combine($sql2,'UNION');
        $sql = new \Zend\Db\Sql\Sql($this->tableGateway->adapter);
        $sql1_string = $sql->getSqlStringForSqlObject($sql1);
        $sql2_string = $sql->getSqlStringForSqlObject($sql2);
        $sql3_string = $sql->getSqlStringForSqlObject($sql3);
        $sql_string = '('.$sql1_string.') UNION ('.$sql2_string.') UNION ('.$sql3_string.')';
        $statement = $this->tableGateway->adapter->createStatement($sql_string);
        $resultSet = $statement->execute();
          //count($resultSet);
          foreach($resultSet as $resultSe){
              print_r($resultSe);exit;
          } 
    print_r($resultSet);exit;      
          
                        
        /*$selectall3 =  new \Zend\Db\Sql\Select(array('sel1and2' => $sql1));
        $selectall3->combine($sql3);*/
         $sql3->combine($sql1,'UNION');
        $sql4 = new \Zend\Db\Sql\Select('obsecons');
        $sql5 = new \Zend\Db\Sql\Select('ptmecons');
        $sql6 = new \Zend\Db\Sql\Select('ptmegros');
        $sql7 = new \Zend\Db\Sql\Select('entr');
        $sql8 = new \Zend\Db\Sql\Select('item');
        
        
        $resultSet = $this->tableGateway->selectWith($sql1);
        print_r($resultSet);exit;
        $select1 = $sql1->order('dat_');
        
        
        //union of two first selects
        $select1->combine ( $select2, 'UNION ALL' );
        $select = $sql->select()->from(array('result' => $select1));
        //Final result. Yo can use other method like group,order etc.
        $select->order('your order by statement');
        $select->group('your group by statement');
        
        $resultSet = $this->tableGateway->selectWith($select);
        
        echo "$resultSet";exit;
        
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
      public function Rapportjoint($where = null,$columns = null,$join,$condjoin,$group = null, $order = null, $limit = null) {
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
            $select->columns($columns,false);
        }
        if ($join != null && $condjoin != null) {
            $select->join($join,$condjoin,array());
        }
        if ($group != null) {
         $select->group($group);
        }
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
    public function getDoss($Nume) {
        $Nume = (int) $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        return $row;
    }

    public function getDossByRef_($Ref_) {
    
        $rowset = $this->tableGateway->select(array('Ref_' => $Ref_));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Ref_");
        }
        return $row;
    }
    public function saveDoss(Doss $doss) {
        $data = array(
            'Util' => $doss->Util,
'Modi' => $doss->Modi,
'Arv_Desi' => $doss->Arv_Desi,
'Arv_Lign' => $doss->Arv_Lign,
'Arv0' => $doss->Arv0,
'Arv1' => $doss->Arv1,
'Arv2' => $doss->Arv2,
'Arv3' => $doss->Arv3,
'BiolDern' => $doss->BiolDern,
'Cta_Ume_' => $doss->Cta_Ume_,
'Info' => $doss->Info,
'MediAnte' => $doss->MediAnte,
'MediAnteArv_' => $doss->MediAnteArv_,
'MediAnteCase' => $doss->MediAnteCase,
'MediCdc_' => $doss->MediCdc_,
'MediCsi_' => $doss->MediCsi_,
'MediDepiCirc' => $doss->MediDepiCirc,
'MediDepiDat_' => $doss->MediDepiDat_,
'MediDepiNume' => $doss->MediDepiNume,
'MediDiag' => $doss->MediDiag,
'MediKarn' => $doss->MediKarn,
'MediRefe' => $doss->MediRefe,
'MediRisqHomo' => $doss->MediRisqHomo,
'MediRisqMere' => $doss->MediRisqMere,
'MediRisqMult' => $doss->MediRisqMult,
'MediRisqOcca' => $doss->MediRisqOcca,
'MediRisqPart' => $doss->MediRisqPart,
'MediRisqPiqu' => $doss->MediRisqPiqu,
'MediRisqPoly' => $doss->MediRisqPoly,
'MediRisqPres' => $doss->MediRisqPres,
'MediRisqScar' => $doss->MediRisqScar,
'MediRisqTran' => $doss->MediRisqTran,
'MediSero' => $doss->MediSero,
'MediSeroTyp_' => $doss->MediSeroTyp_,
'MediTail' => $doss->MediTail,
'MediVar0' => $doss->MediVar0,
'MediVar1' => $doss->MediVar1,
'OuvrDat_' => $doss->OuvrDat_,
'Postit__' => $doss->Postit__,
'Ref_' => $doss->Ref_,
'Ref2' => $doss->Ref2,
'RensAdre' => $doss->RensAdre,
'RensAge_' => $doss->RensAge_,
'RensChrg' => $doss->RensChrg,
'RensDeceCaus' => $doss->RensDeceCaus,
'RensDeceDat_' => $doss->RensDeceDat_,
'RensDoub' => $doss->RensDoub,
'RensEmpl' => $doss->RensEmpl,
'RensEthn' => $doss->RensEthn,
'RensEtud' => $doss->RensEtud,
'RensExonArv_' => $doss->RensExonArv_,
'RensExonTota' => $doss->RensExonTota,
'RensIarvDat_' => $doss->RensIarvDat_,
'RensIarvNume' => $doss->RensIarvNume,
'RensLang' => $doss->RensLang,
'RensLoca' => $doss->RensLoca,
'RensMatr' => $doss->RensMatr,
'RensNaisDat_' => $doss->RensNaisDat_,
'RensNaisLieu' => $doss->RensNaisLieu,
'RensNati' => $doss->RensNati,
'RensNom_' => $doss->RensNom_,
'RensNon_Suiv' => $doss->RensNon_Suiv,
'RensNon_SuivDat_' => $doss->RensNon_SuivDat_,
'RensNumeUme_' => $doss->RensNumeUme_,
'RensOev_' => $doss->RensOev_,
'RensOev_Etab' => $doss->RensOev_Etab,
'RensOev_Sani' => $doss->RensOev_Sani,
'RensOev_Type' => $doss->RensOev_Type,
'RensOuvrUnit' => $doss->RensOuvrUnit,
'RensPnom' => $doss->RensPnom,
'RensProf' => $doss->RensProf,
'RensProfPrec' => $doss->RensProfPrec,
'RensPtmeNume' => $doss->RensPtmeNume,
'RensQuar' => $doss->RensQuar,
'RensSexe' => $doss->RensSexe,
'RensSui2' => $doss->RensSui2,
'RensSuiv' => $doss->RensSuiv,
'RensTel_' => $doss->RensTel_,
'RensVar0' => $doss->RensVar0,
'RensVar1' => $doss->RensVar1,
'RensVoya' => $doss->RensVoya,
'SociAutrAgr_Dat_' => $doss->SociAutrAgr_Dat_,
'SociAutrAgr_Mont' => $doss->SociAutrAgr_Mont,
'SociAutrAgr_Suiv' => $doss->SociAutrAgr_Suiv,
'SociAutrCommActi' => $doss->SociAutrCommActi,
'SociAutrCommParo' => $doss->SociAutrCommParo,
'SociAutrEconEau_' => $doss->SociAutrEconEau_,
'SociAutrEconElec' => $doss->SociAutrEconElec,
'SociAutrEconLatr' => $doss->SociAutrEconLatr,
'SociAutrEconNive' => $doss->SociAutrEconNive,
'SociAutrEconProf' => $doss->SociAutrEconProf,
'SociAutrEconRefr' => $doss->SociAutrEconRefr,
'SociAutrHabiQual' => $doss->SociAutrHabiQual,
'SociAutrNutrAide' => $doss->SociAutrNutrAide,
'SociAutrNutrComp' => $doss->SociAutrNutrComp,
'SociAutrNutrFreq' => $doss->SociAutrNutrFreq,
'SociAutrResiStat' => $doss->SociAutrResiStat,
'SociConjAge_' => $doss->SociConjAge_,
'SociConjInfo' => $doss->SociConjInfo,
'SociConjInfoCaus' => $doss->SociConjInfoCaus,
'SociConjPrec' => $doss->SociConjPrec,
'SociConjProf' => $doss->SociConjProf,
'SociConjRef_' => $doss->SociConjRef_,
'SociConjSani' => $doss->SociConjSani,
'SociConjVih_Chrg' => $doss->SociConjVih_Chrg,
'SociEnfaChrg' => $doss->SociEnfaChrg,
'SociEnfaScol' => $doss->SociEnfaScol,
'SociEnfaVih_' => $doss->SociEnfaVih_,
'SociEnfaVih_Chrg' => $doss->SociEnfaVih_Chrg,
'SociFamiAtti' => $doss->SociFamiAtti,
'SociFamiInfo' => $doss->SociFamiInfo,
'SociFinaAdre' => $doss->SociFinaAdre,
'SociFinaChrg' => $doss->SociFinaChrg,
'SociFinaNom_' => $doss->SociFinaNom_,
'SociFinaPnom' => $doss->SociFinaPnom,
'SociFinaPrec' => $doss->SociFinaPrec,
'SociFinaProf' => $doss->SociFinaProf,
'SociOev_Lien' => $doss->SociOev_Lien,
'SociPersChrg' => $doss->SociPersChrg,
'SociPersInfo' => $doss->SociPersInfo,
'SociPersVih_' => $doss->SociPersVih_,
'SociRefu' => $doss->SociRefu,
'SociUrgeAdre' => $doss->SociUrgeAdre,
'SociUrgeNom_' => $doss->SociUrgeNom_,
'SociUrgePnom' => $doss->SociUrgePnom,
'SociUrgeTel_' => $doss->SociUrgeTel_,
'Tran' => $doss->Tran,
'TranDat_' => $doss->TranDat_,
'TranSite' => $doss->TranSite,
        );

        $Nume = (int) $doss->Nume;
        if ($Nume == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getDoss($Nume)) {
                $this->tableGateway->update($data, array('Nume' => $Nume));
            } else {
                throw new \Exception('Form Nume does not exist');
            }
        }
    }

 /*a sup*/
	public function saveDossArray($doss) {
     
        $Nume = (int) $doss['Nume'];
        if ($Nume == 0) {
            $this->tableGateway->insert($doss);
            
        } else {
            if ($this->getDoss($Nume)) {
                $this->tableGateway->update($doss, array('Nume' => $Nume));
            } else {
                throw new \Exception('Form Nume does not exist');
            }
        }
        return $doss;
    }
	public function saveDossArray1($doss) {
     
        $Nume = (int) $doss['Nume'];
        if ($Nume == 0) {
            $this->tableGateway->insert($doss);
            
        } else {
            if ($dossV=$this->getDoss($Nume)) {
				$doss['Info'].=$dossV->Info;
                $this->tableGateway->update($doss, array('Nume' => $Nume));
            } else {
                throw new \Exception('Form Nume does not exist');
            }
        }
        return $doss;
    }
/**/	
	
	public function deleteDoss($Nume) {
        $this->tableGateway->delete(array('Nume' => $Nume));
    }

}
