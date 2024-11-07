<?php

namespace Dispensation\Model;

use Zend\Db\TableGateway\TableGateway;

class DossTable {

    protected $tableGateway;
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
    
	public function findAll($start = null, $length = null, $search = null, $order = null) {
        $select = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
        $selectcount = new \Zend\Db\Sql\Select($this->tableGateway->getTable());
        $selectcount->columns(array('count' => new \Zend\Db\Sql\Expression('COUNT(*)')));
        if ($start != null) {
            $select->offset($start);
        }
        if ($length != null) {
            $select->limit($length);
        }
        if ($order != null) {
            foreach ($order as $ord) {
                $ords = $ord['column'] . " " . $ord['dir'];
                $select->order("$ords");
            }
        }
        if ($search != null) {
            $i = 0;
            $where = new \Zend\Db\Sql\Where();
            foreach ($search as $srch) {
                if ($srch != "") {
                    if ($i == 0) {
                        $where->addPredicate(new \Zend\Db\Sql\Predicate\Like('Ref_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensNom_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensPnom', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensAge_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('OuvrDat_', "%$srch%"));
			$where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensTel_', "%$srch%"));

                        $i++;
                    } else {
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('Ref_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensNom_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensPnom', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensAge_', "%$srch%"));
                        $where->orPredicate(new \Zend\Db\Sql\Predicate\Like('OuvrDat_', "%$srch%"));
			$where->orPredicate(new \Zend\Db\Sql\Predicate\Like('RensTel_', "%$srch%"));

                    }
                }
            }
            $select->where($where);
            $selectcount->where($where);
        }
        $count = $this->tableGateway->selectWith($selectcount)->current();
        $resultSet = $this->tableGateway->selectWith($select);
        return array('data' => $resultSet->toArray(), 'count' => $count->count);
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select(function (\Zend\Db\Sql\Select $select) {
            $select->order('Nume DESC');
        });
        return $resultSet;
    }
    
	public function getDossByRef_($Ref_) {

        $rowset = $this->tableGateway->select(array('Ref_' => $Ref_));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Ref_");
        }
        return $row;
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
    
    public function selectup($where = null, $order = null, $limit = null,$col=null,$prefix=null) {
        $select = new \Zend\Db\Sql\Select($prefix . 'doss');
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

    public function getLastvalue() {
        return $this->tableGateway->lastInsertValue;
    }
    
    public function getDoss($Nume) {
        $Nume =  $Nume;
        $rowset = $this->tableGateway->select(array('Nume' => $Nume));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $Nume");
        }
        
        $row->subFormFiche = $this->sm->get('Dossiers\Model\FicheTable')->getFiche($Nume);
        $row->subFormSocial = $this->sm->get('Dossiers\Model\SocialTable')->getSocial($Nume);
        $row->subFormMedicalOuv = $this->sm->get('Dossiers\Model\MedicalouvTable')->getMedicalouv($Nume);
       
        return $row;
    }

    public function saveDoss(Doss $doss) {
		$requete = "";
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
            'RensProv' => $doss->RensProv,
            'Imc_info' => $doss->Imc_info,
            'Conc_info' => $doss->Conc_info,
        );
        $Nume =  $doss->Nume;
        if(!$this->checkrecord($Nume)){
            $data['Nume']=$doss->Nume;
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

    public function deleteDoss($Nume) {
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
