<?php

namespace Parametres\Form;

use Zend\Form\Form;

class ListeForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('ListeForm');

        $this->setAttribute('method', 'post');
        $this->setInputFilter($filter = new \Zend\InputFilter\InputFilter());

        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'Desi',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Désignation',
            ),
        ));

        $this->add(array(
            'type' => 'Select',
            'name' => 'Typ_',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Type',
                'value_options' => array(
                    'Accueil | Moti' => 'Accueil | Moti',
                    'Accueil | Prec' => 'Accueil | Prec',
                    'Autre | Activité communautaire' => 'Autre | Activité communautaire',
                    'Autre | Composition de nutrition' => 'Autre | Composition de nutrition',
                    'Autre | Fréquence de nutrition' => 'Autre | Fréquence de nutrition',
                    'Autre | Niveau socio-éco' => 'Autre | Niveau socio-éco',
                    'Autre | Profil social' => 'Autre | Profil social',
                    'Autre | Qualité de lhabitat' => 'Autre | Qualité de lhabitat',
                    'Autre | Statut de résidence' => 'Autre | Statut de résidence',
                    'Circonstance de dépistage' => 'Circonstance de dépistage',
                    'Communauté | Activité' => 'Communauté | Activité',
                    'Enfant | Cause de décès' => 'Enfant | Cause de décès',
                    'Enfant | Etat clinique' => 'Enfant | Etat clinique',
                    'Fiche | Cause de décès' => 'Fiche | Cause de décès',
                    'Fiche | Nationalité' => 'Fiche | Nationalité',
                    'Fiche | Niveau détudes' => 'Fiche | Niveau détudes',
                    'Fiche | Ouverture par' => 'Fiche | Ouverture par',
                    'Fiche | Quartier' => 'Fiche | Quartier',
                    'Fiche | Situation matrimoniale' => 'Fiche | Situation matrimoniale',
                    'Fiche | Type dOEV' => 'Fiche | Type dOEV',
                    'Grossesse | Evolution de la grossesse' => 'Grossesse | Evolution de la grossesse',
                    'Grossesse | Résultat échographique' => 'Grossesse | Résultat échographique',
                    'Observance | Appréciation' => 'Observance | Appréciation',
                    'Observance | Appréciation' => 'Observance | Appréciation',
                    'Observance | Auto-questionnaire' => 'Observance | Auto-questionnaire',
                    'Observance | Contexte' => 'Observance | Contexte',
                    'Observance | Evaluation' => 'Observance | Evaluation',
                    'Observance | Support utilisé' => 'Observance | Support utilisé',
                    'Observance | Type de RDV' => 'Observance | Type de RDV',
                    'OEV | Difficulté' => 'OEV | Difficulté',
                    'OEV | Scolarité/formation' => 'OEV | Scolarité/formation',
                    'Profession' => 'Profession',
                    'Psy | Motif' => 'Psy | Motif',
                    'Social | Attitude de la famille' => 'Social | Attitude de la famille',
                    'Social | Cause de non information' => 'Social | Cause de non information',
                    'Social | Lien de parenté' => 'Social | Lien de parenté',
                    'Social | Motif de consultation' => 'Social | Motif de consultation',
                    'Social | Situation sanitaire' => 'Social | Situation sanitaire',
                    'Suivi | Acte dHDJ' => 'Suivi | Acte dHDJ',
                    'Suivi | Contexte' => 'Suivi | Contexte',
                    'Suivi | Modification de traitement' => 'Suivi | Modification de traitement',
                    'Suivi | Motif de non observance' => 'Suivi | Motif de non observance',
                    'Suivi | Observance' => 'Suivi | Observance',
                ),
            )
        ));
    }

}
