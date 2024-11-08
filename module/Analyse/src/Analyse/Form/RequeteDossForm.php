<?php

namespace Analyse\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class RequeteDossForm extends Form implements InputFilterProviderInterface{

    public $Listetitre;
    public $Listerqtedoss;
    public $corresp;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('RequeteDossForm');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {
        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
        $this->add(array(
            'name' => 'requetedosshidden',
            'attributes' => array(
                'type' => 'text',
                'id' => 'requetedosshidden',
            ),
        ));
        $this->add(array(
            'name' => 'Listetitre',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Listetitre',
            ),
            'options' => array(
                'label' => 'Requêtes',
                'empty_option' => '',
                'value_options' => $this->Listetitre,
            )
        ));
        $this->add(array(
            'name' => 'Listerqtedoss',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Listerqtedoss',
            ),
            'options' => array(
                'label' => 'Requêtes',
                'empty_option' => '',
                'value_options' => $this->Listerqtedoss = array(
                //'Arv_;Debu' => 'ARV Début prescription',
                'Arv_;Prot' => 'ARV Protocole en cours',
                /*'Arv_Chng;Date' => 'ARV dernier chgt Date',
                'Arv_Chng;Into' => 'ARV dernier chgt Intolérances',
                'Arv_Chng;Modi' => 'ARV dernier chgt Modification',
                'Arv_Chng;Moti' => 'ARV dernier chgt Motif',
                'Arv_Chng;Nouv' => 'ARV dernier chgt Nouveau protocole',
                'Arv_Chng;Prec' => 'ARV dernier chgt Protocole précédent',
                'Arv_Deli;Dat1' => 'ARV délivrances Date 1ère délivrance',
                'Arv_Deli;Dat2' => 'ARV délivrances Date dernière déliv.',
                'Arv_Deli;Dat3' => 'ARV délivrances Date avant-dern. déliv.',
                'Autr;Alim' => 'Autre Aide alim.',
                'Autr;Paro' => 'Autre Groupe parole',
                'Biol;Cd41Date' => 'Biologie  Date CD4 initial',
                'Biol;Cd41Taux' => 'Biologie  CD4 initial',
                'Biol;Cd42Date' => 'Biologie  Date dernier CD4',
                'Biol;Cd42Taux' => 'Biologie  Dernier CD4',
                'Biol;Pcr2Date' => 'Biologie  Date dern. PCR',
                'Biol;Pcr2Uiml' => 'Biologie  Dern. PCR UI/ml',
                'Biol;Pcr2Log_' => 'Biologie  Dern. PCR Log',
                'BiolM00_;Cd4%' => 'Biologie m0  CD4 %',
                'BiolM00_;Cd4_' => 'Biologie m0  CD4',
                'BiolM00_;Crea' => 'Biologie m0  Créatine',
                'BiolM00_;Poly' => 'Biologie m0  Granulo. neutro. %',
                'BiolM00_;Hemo' => 'Biologie m0  Hémoglobine',
                'BiolM00_;Lymp' => 'Biologie m0  Lymphocytes',
                'BiolM00_;Tran' => 'Biologie m0  Transaminases GPT',
                'BiolM00_;Pcr_' => 'Biologie m0  PCR',
                'BiolM06_;Cd4%' => 'Biologie m6  CD4 %',
                'BiolM06_;Cd4_' => 'Biologie m6  CD4',
                'BiolM06_;Crea' => 'Biologie m6  Créatine',
                'BiolM06_;Poly' => 'Biologie m6  Granulo. neutro. %',
                'BiolM06_;Hemo' => 'Biologie m6  Hémoglobine',
                'BiolM06_;Lymp' => 'Biologie m6  Lymphocytes',
                'BiolM06_;Tran' => 'Biologie m6  Transaminases GPT',
                'BiolM06_;Pcr_' => 'Biologie m6  PCR',
                'BiolM12_;Cd4%' => 'Biologie m12  CD4 %',
                'BiolM12_;Cd4_' => 'Biologie m12  CD4',
                'BiolM12_;Crea' => 'Biologie m12  Créatine',
                'BiolM12_;Poly' => 'Biologie m12  Granulo. neutro. %',
                'BiolM12_;Hemo' => 'Biologie m12  Hémoglobine',
                'BiolM12_;Lymp' => 'Biologie m12  Lymphocytes',
                'BiolM12_;Tran' => 'Biologie m12  Transaminases GPT',
                'BiolM12_;Pcr_' => 'Biologie m12  PCR',
                'BiolM18_;Cd4%' => 'Biologie m18  CD4 %',
                'BiolM18_;Cd4_' => 'Biologie m18  CD4',
                'BiolM18_;Crea' => 'Biologie m18  Créatine',
                'BiolM18_;Poly' => 'Biologie m18  Granulo. neutro. %',
                'BiolM18_;Hemo' => 'Biologie m18  Hémoglobine',
                'BiolM18_;Lymp' => 'Biologie m18  Lymphocytes',
                'BiolM18_;Tran' => 'Biologie m18  Transaminases GPT',
                'BiolM18_;Pcr_' => 'Biologie m18  PCR',
                'BiolM24_;Cd4%' => 'Biologie m24  CD4 %',
                'BiolM24_;Cd4_' => 'Biologie m24  CD4',
                'BiolM24_;Crea' => 'Biologie m24  Créatine',
                'BiolM24_;Poly' => 'Biologie m24  Granulo. neutro. %',
                'BiolM24_;Hemo' => 'Biologie m24  Hémoglobine',
                'BiolM24_;Lymp' => 'Biologie m24  Lymphocytes',
                'BiolM24_;Tran' => 'Biologie m24  Transaminases GPT',
                'BiolM24_;Pcr_' => 'Biologie m24  PCR',
                'BiolM30_;Cd4%' => 'Biologie m30  CD4 %',
                'BiolM30_;Cd4_' => 'Biologie m30  CD4',
                'BiolM30_;Crea' => 'Biologie m30  Créatine',
                'BiolM30_;Poly' => 'Biologie m30  Granulo. neutro. %',
                'BiolM30_;Hemo' => 'Biologie m30  Hémoglobine',
                'BiolM30_;Lymp' => 'Biologie m30  Lymphocytes',
                'BiolM30_;Tran' => 'Biologie m30  Transaminases GPT',
                'BiolM30_;Pcr_' => 'Biologie m30  PCR',
                'BiolM36_;Cd4%' => 'Biologie m36  CD4 %',
                'BiolM36_;Cd4_' => 'Biologie m36  CD4',
                'BiolM36_;Crea' => 'Biologie m36  Créatine',
                'BiolM36_;Poly' => 'Biologie m36  Granulo. neutro. %',
                'BiolM36_;Hemo' => 'Biologie m36  Hémoglobine',
                'BiolM36_;Lymp' => 'Biologie m36  Lymphocytes',
                'BiolM36_;Tran' => 'Biologie m36  Transaminases GPT',
                'BiolM36_;Pcr_' => 'Biologie m36  PCR',
                'BiolM42_;Cd4%' => 'Biologie m42  CD4 %',
                'BiolM42_;Cd4_' => 'Biologie m42  CD4',
                'BiolM42_;Crea' => 'Biologie m42  Créatine',
                'BiolM42_;Poly' => 'Biologie m42  Granulo. neutro. %',
                'BiolM42_;Hemo' => 'Biologie m42  Hémoglobine',
                'BiolM42_;Lymp' => 'Biologie m42  Lymphocytes',
                'BiolM42_;Tran' => 'Biologie m42  Transaminases GPT',
                'BiolM42_;Pcr_' => 'Biologie m42  PCR',
                'Clin;Cand' => 'Clinique Candidose buc.',
                'Clin;Cryp' => 'Clinique Cryptococcose',
                'Clin;Cyto' => 'Clinique Cryptomégalovirose',
                'Clin;Imc1' => 'Clinique IMC initial',
                'Clin;Imc1Date' => 'Clinique Date IMC initial',
                'Clin;Imc2' => 'Clinique Dernier IMC',
                'Clin;Imc2Date' => 'Clinique Date dernier IMC',
                'Clin;Kapo' => 'Clinique Kaposi',
                'Clin;Oms1' => 'Clinique Stade OMS initial',
                'Clin;Oms1Date' => 'Clinique Date stade OMS initial',
                'Clin;Oms2' => 'Clinique Dernier stade OMS',
                'Clin;Oms2Date' => 'Clinique Date dernier stade OMS',
                'Clin;Toxo' => 'Clinique Toxoplasmose',
                'Clin;Tube' => 'Clinique Tubercole pulm.',
                'ClinM00_;Cand' => 'Clinique m0 Candidose buc.',
                'ClinM00_;Cryp' => 'Clinique m0 Cryptococcose',
                'ClinM00_;Cyto' => 'Clinique m0 Cryptomégalovirose',
                'ClinM00_;Imc_' => 'Clinique m0 IMC',
                'ClinM00_;Kapo' => 'Clinique m0 Kaposi',
                'ClinM00_;Toxo' => 'Clinique m0 Toxoplasmose',
                'ClinM00_;Tube' => 'Clinique m0 Tubercole pulm.',
                'ClinM03_;Imc_' => 'Clinique m3 IMC',
                'ClinM06_;Cand' => 'Clinique m6 Candidose buc.',
                'ClinM06_;Cryp' => 'Clinique m6 Cryptococcose',
                'ClinM06_;Cyto' => 'Clinique m6 Cryptomégalovirose',
                'ClinM06_;Imc_' => 'Clinique m6 IMC',
                'ClinM06_;Kapo' => 'Clinique m6 Kaposi',
                'ClinM06_;Toxo' => 'Clinique m6 Toxoplasmose',
                'ClinM06_;Tube' => 'Clinique m6 Tubercole pulm.',
                'ClinM09_;Imc_' => 'Clinique m9 IMC',
                'ClinM12_;Cand' => 'Clinique m12 Candidose buc.',
                'ClinM12_;Cryp' => 'Clinique m12 Cryptococcose',
                'ClinM12_;Cyto' => 'Clinique m12 Cryptomégalovirose',
                'ClinM12_;Imc_' => 'Clinique m12 IMC',
                'ClinM12_;Kapo' => 'Clinique m12 Kaposi',
                'ClinM12_;Toxo' => 'Clinique m12 Toxoplasmose',
                'ClinM12_;Tube' => 'Clinique m12 Tubercole pulm.',
                'ClinM18_;Cand' => 'Clinique m18 Candidose buc.',
                'ClinM18_;Cryp' => 'Clinique m18 Cryptococcose',
                'ClinM18_;Cyto' => 'Clinique m18 Cryptomégalovirose',
                'ClinM18_;Imc_' => 'Clinique m18 IMC',
                'ClinM18_;Kapo' => 'Clinique m18 Kaposi',
                'ClinM18_;Toxo' => 'Clinique m18 Toxoplasmose',
                'ClinM18_;Tube' => 'Clinique m18 Tubercole pulm.',
                'ClinM24_;Cand' => 'Clinique m24 Candidose buc.',
                'ClinM24_;Cryp' => 'Clinique m24 Cryptococcose',
                'ClinM24_;Cyto' => 'Clinique m24 Cryptomégalovirose',
                'ClinM24_;Imc_' => 'Clinique m24 IMC',
                'ClinM24_;Kapo' => 'Clinique m24 Kaposi',
                'ClinM24_;Toxo' => 'Clinique m24 Toxoplasmose',
                'ClinM24_;Tube' => 'Clinique m24 Tubercole pulm.',
                'ClinM30_;Cand' => 'Clinique m30 Candidose buc.',
                'ClinM30_;Cryp' => 'Clinique m30 Cryptococcose',
                'ClinM30_;Cyto' => 'Clinique m30 Cryptomégalovirose',
                'ClinM30_;Imc_' => 'Clinique m30 IMC',
                'ClinM30_;Kapo' => 'Clinique m30 Kaposi',
                'ClinM30_;Toxo' => 'Clinique m30 Toxoplasmose',
                'ClinM30_;Tube' => 'Clinique m30 Tubercole pulm.',
                'ClinM36_;Cand' => 'Clinique m36 Candidose buc.',
                'ClinM36_;Cryp' => 'Clinique m36 Cryptococcose',
                'ClinM36_;Cyto' => 'Clinique m36 Cryptomégalovirose',
                'ClinM36_;Imc_' => 'Clinique m36 IMC',
                'ClinM36_;Kapo' => 'Clinique m36 Kaposi',
                'ClinM36_;Toxo' => 'Clinique m36 Toxoplasmose',
                'ClinM36_;Tube' => 'Clinique m36 Tubercole pulm.',
                'ClinM42_;Cand' => 'Clinique m42 Candidose buc.',
                'ClinM42_;Cryp' => 'Clinique m42 Cryptococcose',
                'ClinM42_;Cyto' => 'Clinique m42 Cryptomégalovirose',
                'ClinM42_;Imc_' => 'Clinique m42 IMC',
                'ClinM42_;Kapo' => 'Clinique m42 Kaposi',
                'ClinM42_;Toxo' => 'Clinique m42 Toxoplasmose',
                'ClinM42_;Tube' => 'Clinique m42 Tubercole pulm.',
                'Comm;DernDate' => 'Communauté Date dernière participation',*/
                'Fich;Adre' => 'Fiche  Adresse',
                'Fich;Age_' => 'Fiche  Age',
                'Fich;Ref2' => 'Fiche  Ancien n° dossier',
                'Fich;Dece' => 'Fiche  Date décès',
                'Fich;Incl' => 'Fiche  Date inclusion',
                'Fich;Ouvr' => 'Fiche  Date ouverture',
                'Fich;Dcd_' => 'Fiche  Décédé',
                'Fich;Exo1' => 'Fiche  Exon. total',
                'Fich;Exo2' => 'Fiche  Exon. ARV',
                'Fich;Loca' => 'Fiche  Localité de résidence',
                'Fich;Doss' => 'Fiche  N° de dossier',
                'Fich;Nati' => 'Fiche  Nationalité',
                'Fich;Etud' => 'Fiche  Niveau d\'étude',
                'Fich;Matr' => 'Fiche  Situation matrimoniale',
                'Fich;Medi' => 'Fiche  Suivi par',
                'Fich;Nom_' => 'Fiche  Nom',
                'Fich;Non_Suiv' => 'Fiche  Non suivi',
                'Fich;Non_SuivDat_' => 'Fiche  Non suivi depuis le',
                'Fich;Oev_' => 'Fiche  OEV',
                'Fich;Post' => 'Fiche  Post-it',
                'Fich;Pnom' => 'Fiche  Prénom',
                'Fich;Chrg' => 'Fiche  Prise en charge',
                'Fich;Prof' => 'Fiche  Profession',
                'Fich;ProfPrec' => 'Fiche  Profession (préciser)',
                'Fich;Sexe' => 'Fiche  Sexe',
                'Fich;Tel_' => 'Fiche  Téléphone',
                'Medi;DernMediCons' => 'Medical Date dern. cons. médical',
                'Medi;SeroTyp_' => 'Medical Type sérologie VIH',
                'Ptme;DernGrosAcco' => 'PTME Date accouch. (dern. gros.)',
                'Ptme;DernGrosPrev' => 'PTME Date accouch. prev. (dern. gros.)',
                'Ptme;DernGrosSais' => 'PTME Date saisi dern. grossesse',
                'Soci;Nive' => 'Social Niveau socio-éco.',
                'Soci;PersChrg' => 'Social Nb personnes à charge',
                'Soci;EnfaChrg' => 'Social Nb enfants a charge',
                'Soci;PersVih_Chrg' => 'Social Nb adultes infectés',
                'Soci;EnfaVih_Chrg' => 'Social Nb enfants infectés',
                'Soci;Prof' => 'Social Profil social',
                ),
            )
        ));
        $this->corresp = array(
            'Arv_;Debu' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Arv_;Prot' => 'renseigné$vide',
            'Arv_Chng;Date' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Arv_Chng;Into' => 'renseigné$vide',
            'Arv_Chng;Modi' => 'renseigné$vide',
            'Arv_Chng;Moti' => 'renseigné$vide',
            'Arv_Chng;Nouv' => '',
            'Arv_Chng;Prec' => '',
            'Arv_Deli;Dat1' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Arv_Deli;Dat2' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Arv_Deli;Dat3' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Autr;Alim' => 'oui$non',
            'Autr;Paro' => 'oui$non',
            'Biol;Cd41Date' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Biol;Cd41Taux' => '>$<$<50$<100$<200$<350$>350',
            'Biol;Cd42Date' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Biol;Cd42Taux' => '>$<$<50$<100$<200$<350$>350',
            'Biol;Pcr2Date' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Biol;Pcr2Uiml' => '>$<',
            'Biol;Pcr2Log_' => '>$<',
            'BiolM00_;Cd4%' => '>$<',
            'BiolM00_;Cd4_' => '>$<',
            'BiolM00_;Crea' => '>$<',
            'BiolM00_;Poly' => '>$<',
            'BiolM00_;Hemo' => '>$<',
            'BiolM00_;Lymp' => '>$<',
            'BiolM00_;Tran' => '>$<',
            'BiolM00_;Pcr_' => '>$<',
            'BiolM06_;Cd4%' => '>$<',
            'BiolM06_;Cd4_' => '>$<',
            'BiolM06_;Crea' => '>$<',
            'BiolM06_;Poly' => '>$<',
            'BiolM06_;Hemo' => '>$<',
            'BiolM06_;Lymp' => '>$<',
            'BiolM06_;Tran' => '>$<',
            'BiolM06_;Pcr_' => '>$<',
            'BiolM12_;Cd4%' => '>$<',
            'BiolM12_;Cd4_' => '>$<',
            'BiolM12_;Crea' => '>$<',
            'BiolM12_;Poly' => '>$<',
            'BiolM12_;Hemo' => '>$<',
            'BiolM12_;Lymp' => '>$<',
            'BiolM12_;Tran' => '>$<',
            'BiolM12_;Pcr_' => '>$<',
            'BiolM18_;Cd4%' => '>$<',
            'BiolM18_;Cd4_' => '>$<',
            'BiolM18_;Crea' => '>$<',
            'BiolM18_;Poly' => '>$<',
            'BiolM18_;Hemo' => '>$<',
            'BiolM18_;Lymp' => '>$<',
            'BiolM18_;Tran' => '>$<',
            'BiolM18_;Pcr_' => '>$<',
            'BiolM24_;Cd4%' => '>$<',
            'BiolM24_;Cd4_' => '>$<',
            'BiolM24_;Crea' => '>$<',
            'BiolM24_;Poly' => '>$<',
            'BiolM24_;Hemo' => '>$<',
            'BiolM24_;Lymp' => '>$<',
            'BiolM24_;Tran' => '>$<',
            'BiolM24_;Pcr_' => '>$<',
            'BiolM30_;Cd4%' => '>$<',
            'BiolM30_;Cd4_' => '>$<',
            'BiolM30_;Crea' => '>$<',
            'BiolM30_;Poly' => '>$<',
            'BiolM30_;Hemo' => '>$<',
            'BiolM30_;Lymp' => '>$<',
            'BiolM30_;Tran' => '>$<',
            'BiolM30_;Pcr_' => '>$<',
            'BiolM36_;Cd4%' => '>$<',
            'BiolM36_;Cd4_' => '>$<',
            'BiolM36_;Crea' => '>$<',
            'BiolM36_;Poly' => '>$<',
            'BiolM36_;Hemo' => '>$<',
            'BiolM36_;Lymp' => '>$<',
            'BiolM36_;Tran' => '>$<',
            'BiolM36_;Pcr_' => '>$<',
            'BiolM42_;Cd4%' => '>$<',
            'BiolM42_;Cd4_' => '>$<',
            'BiolM42_;Crea' => '>$<',
            'BiolM42_;Poly' => '>$<',
            'BiolM42_;Hemo' => '>$<',
            'BiolM42_;Lymp' => '>$<',
            'BiolM42_;Tran' => '>$<',
            'BiolM42_;Pcr_' => '>$<',
            'Clin;Cand' => '>$<',
            'Clin;Cryp' => '>$<',
            'Clin;Cyto' => '>$<',
            'Clin;Imc1' => '>$<$<15$<18.5$>18.5$>25$>30',
            'Clin;Imc1Date' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Clin;Imc2' => '>$<$<15$<18.5$>18.5$>25$>30',
            'Clin;Imc2Date' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Clin;Kapo' => '>$<',
            'Clin;Oms1' => '1$2$3$4',
            'Clin;Oms1Date' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Clin;Oms2' => '1$2$3$4',
            'Clin;Oms2Date' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Clin;Toxo' => '>$<',
            'Clin;Tube' => '>$<',
            'ClinM00_;Cand' => '>$<',
            'ClinM00_;Cryp' => '>$<',
            'ClinM00_;Cyto' => '>$<',
            'ClinM00_;Imc_' => '>$<',
            'ClinM00_;Kapo' => '>$<',
            'ClinM00_;Toxo' => '>$<',
            'ClinM00_;Tube' => '>$<',
            'ClinM03_;Imc_' => '>$<',
            'ClinM06_;Cand' => '>$<',
            'ClinM06_;Cryp' => '>$<',
            'ClinM06_;Cyto' => '>$<',
            'ClinM06_;Imc_' => '>$<',
            'ClinM06_;Kapo' => '>$<',
            'ClinM06_;Toxo' => '>$<',
            'ClinM06_;Tube' => '>$<',
            'ClinM09_;Imc_' => '>$<',
            'ClinM12_;Cand' => '>$<',
            'ClinM12_;Cryp' => '>$<',
            'ClinM12_;Cyto' => '>$<',
            'ClinM12_;Imc_' => '>$<',
            'ClinM12_;Kapo' => '>$<',
            'ClinM12_;Toxo' => '>$<',
            'ClinM12_;Tube' => '>$<',
            'ClinM18_;Cand' => '>$<',
            'ClinM18_;Cryp' => '>$<',
            'ClinM18_;Cyto' => '>$<',
            'ClinM18_;Imc_' => '>$<',
            'ClinM18_;Kapo' => '>$<',
            'ClinM18_;Toxo' => '>$<',
            'ClinM18_;Tube' => '>$<',
            'ClinM24_;Cand' => '>$<',
            'ClinM24_;Cryp' => '>$<',
            'ClinM24_;Cyto' => '>$<',
            'ClinM24_;Imc_' => '>$<',
            'ClinM24_;Kapo' => '>$<',
            'ClinM24_;Toxo' => '>$<',
            'ClinM24_;Tube' => '>$<',
            'ClinM30_;Cand' => '>$<',
            'ClinM30_;Cryp' => '>$<',
            'ClinM30_;Cyto' => '>$<',
            'ClinM30_;Imc_' => '>$<',
            'ClinM30_;Kapo' => '>$<',
            'ClinM30_;Toxo' => '>$<',
            'ClinM30_;Tube' => '>$<',
            'ClinM36_;Cand' => '>$<',
            'ClinM36_;Cryp' => '>$<',
            'ClinM36_;Cyto' => '>$<',
            'ClinM36_;Imc_' => '>$<',
            'ClinM36_;Kapo' => '>$<',
            'ClinM36_;Toxo' => '>$<',
            'ClinM36_;Tube' => '>$<',
            'ClinM42_;Cand' => '>$<',
            'ClinM42_;Cryp' => '>$<',
            'ClinM42_;Cyto' => '>$<',
            'ClinM42_;Imc_' => '>$<',
            'ClinM42_;Kapo' => '>$<',
            'ClinM42_;Toxo' => '>$<',
            'ClinM42_;Tube' => '>$<',
            'Comm;DernDate' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Fich;Adre' => 'renseigné$vide',
            'Fich;Age_' => '>$<$<5$<15$>15',
            'Fich;Ref2' => '>$<',
            'Fich;Dece' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Fich;Incl' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Fich;Ouvr' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Fich;Dcd_' => 'oui$non',
            'Fich;Exo1' => 'oui$non',
            'Fich;Exo2' => 'oui$non',
            'Fich;Loca' => 'renseigné$vide',
            'Fich;Doss' => '>$<',
            'Fich;Nati' => 'renseigné$vide',
            'Fich;Etud' => 'renseigné$vide',
            'Fich;Matr' => 'renseigné$vide',
            'Fich;Medi' => 'renseigné$vide',
            'Fich;Nom_' => 'renseigné$vide',
            'Fich;Non_Suiv' => 'oui$non',
            'Fich;Non_SuivDat_' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Fich;Oev_' => 'oui$non',
            'Fich;Post' => 'renseigné$vide',
            'Fich;Pnom' => 'renseigné$vide',
            'Fich;Chrg' => '',
            'Fich;Prof' => 'renseigné$vide',
            'Fich;ProfPrec' => 'renseigné$vide',
            'Fich;Sexe' => 'homme$femme',
            'Fich;Tel_' => 'renseigné$vide',
            'Medi;DernMediCons' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Medi;SeroTyp_' => 'renseigné$vide',
            'Ptme;DernGrosAcco' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Ptme;DernGrosPrev' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Ptme;DernGrosSais' => 'aujourd\'hui$ce moi-ci$cette année$>$<',
            'Soci;Nive' => 'renseigné$vide',
            'Soci;PersChrg' => '>$<',
            'Soci;EnfaChrg' => '>$<',
            'Soci;PersVih_Chrg' => '>$<',
            'Soci;EnfaVih_Chrg' => '>$<',
            'Soci;Prof' => 'renseigné$vide',
        );
        $this->correspDB = array(
            'Arv_;Debu' => 'Dat_$Medicons',
            'Arv_;Prot' => 'Arv_Desi$Doss',
            'Arv_Chng;Date' => 'Dat_$Medicons',
            'Arv_Chng;Into' => 'Arv_Into$Medicons',
            'Arv_Chng;Modi' => 'Arv_Modi$Medicons',
            'Arv_Chng;Moti' => 'requeteMedi$Medicons',
            'Arv_Chng;Nouv' => 'requeteMedi$Medicons',
            'Arv_Chng;Prec' => 'Arv0pscr#Arv1pscr#Arv2pscr#Arv3pscr$Medicons',
            'Arv_Deli;Dat1' => 'Doss#Dat_#Prod$Item',
            'Arv_Deli;Dat2' => 'Doss#Dat_#Prod$Item',
            'Arv_Deli;Dat3' => 'Doss#Dat_#Prod$Item',
            'Autr;Alim' => 'SociAutrNutrAide$Doss',
            'Autr;Paro' => 'SociAutrNutrAide$Doss',
            'Biol;Cd41Date' => 'Info$Doss',
            'Biol;Cd41Taux' => 'Info$Doss',
            'Biol;Cd42Date' => 'Info$Doss',
            'Biol;Cd42Taux' => 'Info$Doss',
            'Biol;Pcr2Date' => 'Info$Doss',
            'Biol;Pcr2Uiml' => 'Info$Doss',
            'Biol;Pcr2Log_' => 'Info$Doss',
            'BiolM00_;Cd4%' => 'requeteEntr$Entr',
            'BiolM00_;Cd4_' => 'requeteEntr$Entr',
            'BiolM00_;Crea' => 'requeteEntr$Entr',
            'BiolM00_;Poly' => 'requeteEntr$Entr',
            'BiolM00_;Hemo' => 'requeteEntr$Entr',
            'BiolM00_;Lymp' => 'requeteEntr$Entr',
            'BiolM00_;Tran' => 'requeteEntr$Entr',
            'BiolM00_;Pcr_' => 'requeteEntr$Entr',
            'BiolM06_;Cd4%' => 'requeteEntr$Entr',
            'BiolM06_;Cd4_' => 'requeteEntr$Entr',
            'BiolM06_;Crea' => 'requeteEntr$Entr',
            'BiolM06_;Poly' => 'requeteEntr$Entr',
            'BiolM06_;Hemo' => 'requeteEntr$Entr',
            'BiolM06_;Lymp' => 'requeteEntr$Entr',
            'BiolM06_;Tran' => 'requeteEntr$Entr',
            'BiolM06_;Pcr_' => 'requeteEntr$Entr',
            'BiolM12_;Cd4%' => 'requeteEntr$Entr',
            'BiolM12_;Cd4_' => 'requeteEntr$Entr',
            'BiolM12_;Crea' => 'requeteEntr$Entr',
            'BiolM12_;Poly' => 'requeteEntr$Entr',
            'BiolM12_;Hemo' => 'requeteEntr$Entr',
            'BiolM12_;Lymp' => 'requeteEntr$Entr',
            'BiolM12_;Tran' => 'requeteEntr$Entr',
            'BiolM12_;Pcr_' => 'requeteEntr$Entr',
            'BiolM18_;Cd4%' => 'requeteEntr$Entr',
            'BiolM18_;Cd4_' => 'requeteEntr$Entr',
            'BiolM18_;Crea' => 'requeteEntr$Entr',
            'BiolM18_;Poly' => 'requeteEntr$Entr',
            'BiolM18_;Hemo' => 'requeteEntr$Entr',
            'BiolM18_;Lymp' => 'requeteEntr$Entr',
            'BiolM18_;Tran' => 'requeteEntr$Entr',
            'BiolM18_;Pcr_' => 'requeteEntr$Entr',
            'BiolM24_;Cd4%' => 'requeteEntr$Entr',
            'BiolM24_;Cd4_' => 'requeteEntr$Entr',
            'BiolM24_;Crea' => 'requeteEntr$Entr',
            'BiolM24_;Poly' => 'requeteEntr$Entr',
            'BiolM24_;Hemo' => 'requeteEntr$Entr',
            'BiolM24_;Lymp' => 'requeteEntr$Entr',
            'BiolM24_;Tran' => 'requeteEntr$Entr',
            'BiolM24_;Pcr_' => 'requeteEntr$Entr',
            'BiolM30_;Cd4%' => 'requeteEntr$Entr',
            'BiolM30_;Cd4_' => 'requeteEntr$Entr',
            'BiolM30_;Crea' => 'requeteEntr$Entr',
            'BiolM30_;Poly' => 'requeteEntr$Entr',
            'BiolM30_;Hemo' => 'requeteEntr$Entr',
            'BiolM30_;Lymp' => 'requeteEntr$Entr',
            'BiolM30_;Tran' => 'requeteEntr$Entr',
            'BiolM30_;Pcr_' => 'requeteEntr$Entr',
            'BiolM36_;Cd4%' => 'requeteEntr$Entr',
            'BiolM36_;Cd4_' => 'requeteEntr$Entr',
            'BiolM36_;Crea' => 'requeteEntr$Entr',
            'BiolM36_;Poly' => 'requeteEntr$Entr',
            'BiolM36_;Hemo' => 'requeteEntr$Entr',
            'BiolM36_;Lymp' => 'requeteEntr$Entr',
            'BiolM36_;Tran' => 'requeteEntr$Entr',
            'BiolM36_;Pcr_' => 'requeteEntr$Entr',
            'BiolM42_;Cd4%' => 'requeteEntr$Entr',
            'BiolM42_;Cd4_' => 'requeteEntr$Entr',
            'BiolM42_;Crea' => 'requeteEntr$Entr',
            'BiolM42_;Poly' => 'requeteEntr$Entr',
            'BiolM42_;Hemo' => 'requeteEntr$Entr',
            'BiolM42_;Lymp' => 'requeteEntr$Entr',
            'BiolM42_;Tran' => 'requeteEntr$Entr',
            'BiolM42_;Pcr_' => 'requeteEntr$Entr',
            'Clin;Cand' => 'requeteMedi$Medicons',
            'Clin;Cryp' => 'requeteMedi$Medicons',
            'Clin;Cyto' => 'Info$Doss',
            'Clin;Imc1' => 'Info$Doss',
            'Clin;Imc1Date' => 'Info$Doss',
            'Clin;Imc2' => 'Info$Doss',
            'Clin;Imc2Date' => 'Info$Doss',
            'Clin;Kapo' => 'requeteMedi$Medicons',
            'Clin;Oms1' => 'Info$Doss',
            'Clin;Oms1Date' => 'Info$Doss',
            'Clin;Oms2' => 'Info$Doss',
            'Clin;Oms2Date' => 'Info$Doss',
            'Clin;Toxo' => 'requeteMedi$Medicons',
            'Clin;Tube' => 'requeteMedi$Medicons',
            'ClinM00_;Cand' => 'requeteMedi$Medicons',
            'ClinM00_;Cryp' => 'requeteMedi$Medicons',
            'ClinM00_;Cyto' => 'requeteMedi$Medicons',
            'ClinM00_;Imc_' => 'requeteMedi$Medicons',
            'ClinM00_;Kapo' => 'requeteMedi$Medicons',
            'ClinM00_;Toxo' => 'requeteMedi$Medicons',
            'ClinM00_;Tube' => 'requeteMedi$Medicons',
            'ClinM03_;Imc_' => 'requeteMedi$Medicons',
            'ClinM06_;Cand' => 'requeteMedi$Medicons',
            'ClinM06_;Cryp' => 'requeteMedi$Medicons',
            'ClinM06_;Cyto' => 'requeteMedi$Medicons',
            'ClinM06_;Imc_' => 'requeteMedi$Medicons',
            'ClinM06_;Kapo' => 'requeteMedi$Medicons',
            'ClinM06_;Toxo' => 'requeteMedi$Medicons',
            'ClinM06_;Tube' => 'requeteMedi$Medicons',
            'ClinM09_;Imc_' => 'requeteMedi$Medicons',
            'ClinM12_;Cand' => 'requeteMedi$Medicons',
            'ClinM12_;Cryp' => 'requeteMedi$Medicons',
            'ClinM12_;Cyto' => 'requeteMedi$Medicons',
            'ClinM12_;Imc_' => 'requeteMedi$Medicons',
            'ClinM12_;Kapo' => 'requeteMedi$Medicons',
            'ClinM12_;Toxo' => 'requeteMedi$Medicons',
            'ClinM12_;Tube' => 'requeteMedi$Medicons',
            'ClinM18_;Cand' => 'requeteMedi$Medicons',
            'ClinM18_;Cryp' => 'requeteMedi$Medicons',
            'ClinM18_;Cyto' => 'requeteMedi$Medicons',
            'ClinM18_;Imc_' => 'requeteMedi$Medicons',
            'ClinM18_;Kapo' => 'requeteMedi$Medicons',
            'ClinM18_;Toxo' => 'requeteMedi$Medicons',
            'ClinM18_;Tube' => 'requeteMedi$Medicons',
            'ClinM24_;Cand' => 'requeteMedi$Medicons',
            'ClinM24_;Cryp' => 'requeteMedi$Medicons',
            'ClinM24_;Cyto' => 'requeteMedi$Medicons',
            'ClinM24_;Imc_' => 'requeteMedi$Medicons',
            'ClinM24_;Kapo' => 'requeteMedi$Medicons',
            'ClinM24_;Toxo' => 'requeteMedi$Medicons',
            'ClinM24_;Tube' => 'requeteMedi$Medicons',
            'ClinM30_;Cand' => 'requeteMedi$Medicons',
            'ClinM30_;Cryp' => 'requeteMedi$Medicons',
            'ClinM30_;Cyto' => 'requeteMedi$Medicons',
            'ClinM30_;Imc_' => 'requeteMedi$Medicons',
            'ClinM30_;Kapo' => 'requeteMedi$Medicons',
            'ClinM30_;Toxo' => 'requeteMedi$Medicons',
            'ClinM30_;Tube' => 'requeteMedi$Medicons',
            'ClinM36_;Cand' => 'requeteMedi$Medicons',
            'ClinM36_;Cryp' => 'requeteMedi$Medicons',
            'ClinM36_;Cyto' => 'requeteMedi$Medicons',
            'ClinM36_;Imc_' => 'requeteMedi$Medicons',
            'ClinM36_;Kapo' => 'requeteMedi$Medicons',
            'ClinM36_;Toxo' => 'requeteMedi$Medicons',
            'ClinM36_;Tube' => 'requeteMedi$Medicons',
            'ClinM42_;Cand' => 'requeteMedi$Medicons',
            'ClinM42_;Cryp' => 'requeteMedi$Medicons',
            'ClinM42_;Cyto' => 'requeteMedi$Medicons',
            'ClinM42_;Imc_' => 'requeteMedi$Medicons',
            'ClinM42_;Kapo' => 'requeteMedi$Medicons',
            'ClinM42_;Toxo' => 'requeteMedi$Medicons',
            'ClinM42_;Tube' => 'requeteMedi$Medicons',
            'Comm;DernDate' => 'requeteComm$Comm',
            'Fich;Adre' => 'RensAdre$Doss',
            'Fich;Age_' => 'RensAge_$Doss',
            'Fich;Ref2' => 'Ref2$Doss',
            'Fich;Dece' => 'RensDeceDat_$Doss',
            'Fich;Incl' => 'RensIarvDat_$Doss',
            'Fich;Ouvr' => 'OuvrDat_$Doss',
            'Fich;Dcd_' => 'oui$Doss',
            'Fich;Exo1' => 'RensExonTota$Doss',
            'Fich;Exo2' => 'RensExonArv_$Doss',
            'Fich;Loca' => 'RensLoca$Doss',
            'Fich;Doss' => 'Ref_$Doss',
            'Fich;Nati' => 'RensNati$Doss',
            'Fich;Etud' => 'RensEtud$Doss',
            'Fich;Matr' => 'RensMatr$Doss',
            'Fich;Medi' => 'RensSuiv$Doss',
            'Fich;Nom_' => 'RensNom_$Doss',
            'Fich;Non_Suiv' => 'RensNon_Suiv$Doss',
            'Fich;Non_SuivDat_' => 'RensNon_SuivDat_$Doss',
            'Fich;Oev_' => 'RensOev_$Doss',
            'Fich;Post' => 'Postit__$Doss',
            'Fich;Pnom' => 'RensPnom$Doss',
            'Fich;Chrg' => 'RensChrg$Doss',
            'Fich;Prof' => 'RensProf$Doss',
            'Fich;ProfPrec' => 'RensProfPrec$Doss',
            'Fich;Sexe' => 'RensSexe$Doss',
            'Fich;Tel_' => 'RensTel_$Doss',
            'Medi;DernMediCons' => ' $ ',
            'Medi;SeroTyp_' => 'MediSeroTyp_$Doss',
            'Ptme;DernGrosAcco' => 'SaisDat_$PtmeGros',
            'Ptme;DernGrosPrev' => 'AccoPrev$PtmeGros',
            'Ptme;DernGrosSais' => 'AccoDat_$PtmeGros',
            'Soci;Nive' => 'SociAutrEconNive$Doss',
            'Soci;PersChrg' => 'SociPersChrg$Doss',
            'Soci;EnfaChrg' => 'SociEnfaChrg$Doss',
            'Soci;PersVih_Chrg' => 'SociPersVih_$Doss',
            'Soci;EnfaVih_Chrg' => 'SociEnfaVih_$Doss',
            'Soci;Prof' => 'SociAutrEconProf$Doss',
        );
        $this->add(array(
            'name' => 'Visible',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'Visible',
            ),
            'options' => array(
                'label' => 'Affichage',
            ),
        ));
        $this->add(array(
            'name' => 'Statcond',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'with-font',
                'id' => 'Statcond',
            ),
            'options' => array(
                'label' => 'Critères de sélection',
            ),
        ));
        $this->add(array(
            'name' => 'Cond1',
            'type' => 'Select',
            'attributes' => array(
            'disabled' => 'disabled',
                'class' => 'form-control',
                'id' => 'Cond1',
            ),
            'options' => array(
                'label' => 'Requêtes',
                'empty_option' => '',
            )
        ));
        $this->add(array(
            'name' => 'Cond2',
            'type' => 'text',
            'attributes' => array(
                'disabled' => 'disabled',
                'class' => 'form-control',
                'id' => 'Cond2',
            ),
            'options' => array(
                'label' => 'Requêtes',
                'empty_option' => '',
            )
        ));

        $this->add(array(
            'name' => 'ajtmodrkete',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Valider',
                'class' => 'btn btn-success ',
                'id' => 'ajtmodrkete',
            ),
            'options' => array(
                'label' => 'Ajouter',
            ),
        ));
         $this->add(array(
            'name' => 'resetrkete',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Annuler',
                'class' => 'btn btn-sm btn-default',
                'id'=> 'resetrkete'
            ),
              'options' => array(
                'label' => 'Annuler',
            ),
        ));
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Valider',
                'class' => 'btn btn-success',
            ),
            'options' => array(
                'label' => 'Valider',
            ),
        ));
        $this->add(array(
            'name' => 'rest',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Annuler',
                'class' => 'btn btn-sm btn-default',
                'data-dismiss' => "modal",
                'aria-label' => "Close"
            ),
            'options' => array(
                'label' => 'Annuler',
            ),
        ));
    }
public function getInputFilterSpecification() {

        return array(
            'Listerqtedoss' => array(
                'required' => false,
            ),
            'Cond1' => array(
                'required' => false,
            ),
           
        );
    }

}
