<?php

namespace Dossiers\Form;

use Zend\Form\Form;

class MediAnteForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {

        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'MediAnteCase_1',
            'options' => array(
                'label' => '1',
                'value_options' => array(
                    'Patient asymtomatique' => 'Patient asymtomatique',
                    'Lymphadénopathie persistante généralisée' => 'Lymphadénopathie persistante généralisée',
                ),
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'MediAnteCase_2',
            'options' => array(
                'label' => '2',
                'value_options' => array(
                    'Perte de poids inférieur a 10% du poids corporel' => 'Perte de poids inférieur a 10% du poids corporel',
                    'Manifestations cutanéomuqueuses mineures' => 'Manifestations cutanéomuqueuses mineures',
                    'Zona' => 'Zona',
                    'Infections récidivantes des voies aériennes sup.' => 'Infections récidivantes des voies aériennes sup.',
                ),
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'MediAnteCase_3',
            'options' => array(
                'label' => '3',
                'value_options' => array(
                    'Alité moins de 50% de la journée par la maladie' => 'Alité moins de 50% de la journée par la maladie',
                    'Perte de poids supérieure à 10% du poids corporel' => 'Perte de poids supérieure à 10% du poids corporel',
                    'Diarrhée chronique pendant plus de 1 mois' => 'Diarrhée chronique pendant plus de 1 mois',
                    'Fièvre intermittente ou constante pdt plus de 1 mois' => 'Fièvre intermittente ou constante pdt plus de 1 mois',
                    'Candidose buccale' => 'Candidose buccale',
                    'Candidose vulvovaginal pdt plus de 1 mois' => 'Candidose vulvovaginal pdt plus de 1 mois',
                    'Leucoplasie orale chevelue' => 'Leucoplasie orale chevelue',
                    'Tubercolose pulmonaire' => 'Tubercolose pulmonaire',
                    'Pneumonie bactérienne sévère' => 'Pneumonie bactérienne sévère',
                    'Autres infections bactériennes sévères (myosites...)' => 'Autres infections bactériennes sévères (myosites...)',
                ),
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'MediAnteCase_4',
            'options' => array(
                'label' => '4',
                'value_options' => array(
                    'Alité plus de 50% de la journée par maladie' => 'Alité plus de 50% de la journée par maladie',
                    'Syndrome cachectique' => 'Syndrome cachectique',
                    'Toxoplasmose célébrale' => 'Toxoplasmose célébrale',
                    'Pneumopathie à Pneumocystis carinii' => 'Pneumopathie à Pneumocystis carinii',
                    'Cryptosporidiose avec diarrhée pdt plus de 1 mois' => 'Cryptosporidiose avec diarrhée pdt plus de 1 mois',
                    'Cryptococcose extra-pulmonaire' => 'Cryptococcose extra-pulmonaire',
                    'Isosporidiose avec diarrhé > 1 mois' => 'Isosporidiose avec diarrhé > 1 mois',
                    'Cryptomégalovirose autre que foie, rate, ganglion' => 'Cryptomégalovirose autre que foie, rate, ganglion',
                    'Candidose oesophagienne, trachéale...' => 'Candidose oesophagienne, trachéale...',
                    'Herpès cutanéomuqueux pendant plus de 1 mois' => 'Herpès cutanéomuqueux pendant plus de 1 mois ou vicéral',
                    'Tubercolose extra-pulmonaire' => 'Tubercolose extra-pulmonaire',
                    'Mucobactériose atypique généralisée' => 'Mucobactériose atypique généralisée',
                    'Toute mucose endémique généralisée' => 'Toute mucose endémique généralisée',
                    'Septicémie à salmonelles non typhique' => 'Septicémie à salmonelles non typhique',
                    'Lymphome' => 'Lymphome',
                    'Maladie de kaposi' => 'Maladie de kaposi',
                    'Encéphalopathie à VIH' => 'Encéphalopathie à VIH',
                    'Isosporidiose avec diarrhée pdt plus de 1 mois' => 'Isosporidiose avec diarrhée pdt plus de 1 mois',
                ),
            )
        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'MediAnteCase_5',
            'options' => array(
                'label' => '',
                'value_options' => array(
                    'Paludisme' => 'Paludisme',
                    'Neuropathie périphérique' => 'Neuropathie périphérique',
                    'Rhumatismes inflammatoires' => 'Rhumatismes inflammatoires',
                    'Manifestations cutanées majeures' => 'Manifestations cutanées majeures',
                ),
            )
        ));
        $this->add(array(
            'name' => 'submitmediante',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Fermer',
                'class' => 'btn btn-success',
                'data-dismiss' => 'modal',
                'id' => 'submitmediante',
            ),
            'options' => array(
                'label' => 'Fermer',
            ),
        ));
    }

}
