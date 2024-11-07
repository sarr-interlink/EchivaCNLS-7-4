<?php

namespace Laboratoire\Form;

use Zend\Form\Form;

class SerologieForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('serologie');
        $this->setAttribute('method', 'post');
        $this->setInputFilter($filter = new \Zend\InputFilter\InputFilter());

        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'hidden',
            ),
        ));
		$this->add(array(
            'name' => 'subFormMedicalBiohidden',
            'attributes' => array(
                'type' => 'text',
                'id' => 'subFormMedicalBiohidden',
            ),
        ));
        $this->add(array(
            'name' => 'Cta_Nume',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'N° dossier',
            ),
        ));

        // SerologieForm Start

        $this->add(array(
            'name' => 'Sero',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'Sero'
            ),
        ));

        $this->add(array(
            'name' => 'Ser0',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'VIH',
                'value_options' => array(
                    '1' => 'Négative',
                    '2' => 'Positive',
                    '3' => 'Indétrminée',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Ser0',
            'required' => false,
            'allow_empty' => true,
        ));


        $this->add(array(
            'name' => 'Ser1',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => ' ',
                'value_options' => array(
                    '1' => 'VIH 1',
                    '2' => 'VIH 2',
                    '3' => 'VIH 1+2',
                    '4' => 'Sans précision',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Ser1',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Ser2',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Antigenes HBs',
                'value_options' => array(
                    '1' => 'Négative',
                    '2' => 'Positive',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Ser2',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Ser3',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'IgG anti-VHC',
                'value_options' => array(
                    '1' => 'Négative',
                    '2' => 'Positive',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Ser3',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Ser4',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Antigènes HBe',
                'value_options' => array(
                    '2' => 'Négative',
                    '1' => 'Positive',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Ser4',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Ser5',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Cytomégalovirus(IgG)',
                'value_options' => array(
                    '1' => 'Négative',
                    '2' => 'Positive',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Ser5',
            'required' => false,
            'allow_empty' => true,
        ));


        $this->add(array(
            'name' => 'Ser6',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'UI',
            ),
        ));


        $this->add(array(
            'name' => 'Ser8',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Toxoplasmose(IgG)',
                'value_options' => array(
                    '1' => 'Négative',
                    '2' => 'Positive',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Ser8',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Ser7',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'UI',
            ),
        ));

        $this->add(array(
            'name' => 'Ser9',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Siphylis TPHA',
                'value_options' => array(
                    '1' => 'Négative',
                    '2' => 'Positive',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Ser9',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Se11',
            'required' => false,
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => ' ',
                'empty_option' => '',
                'value_options' => array(
                    '' => '',
                    '1/80' => '1/80',
                    '1/160' => '1/160',
                    '1/320' => '1/320',
                    '1/640' => '1/640',
                    '1/1280' => '1/1280',
                ),
            )
        ));

        $filter->add(array(
            'name' => 'Se11',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Se12',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => ' ',
                'empty_option' => '',
                'value_options' => array(
                    '' => '',
                    '1/2' => '1/2',
                    '1/4' => '1/4',
                    '1/8' => '1/8',
                    '1/16' => '1/16',
                    '1/32' => '1/32',
                    '1/64' => '1/64',
                    '1/128' => '1/128',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Se12',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Se10',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Test de grossesse',
                'value_options' => array(
                    '1' => 'Négative',
                    '2' => 'Positive',
                ),
            )
        ));

        $filter->add(array(
            'name' => 'Se10',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Se13',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Siphylis RPR',
                'value_options' => array(
                    '1' => 'Négative',
                    '2' => 'Positive',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Se13',
            'required' => false,
            'allow_empty' => true,
        ));
        // SerologieForm End
        // BiochimieForm Start


        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'BiocAutr',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Autre',
                'empty_option' => '',
                'value_options' => array(
                    '' => '',
                    'BiocAu01' => 'Bioc Au01',
                    'BiocAu02' => 'Bioc Au02',
                    'BiocAu03' => 'Bioc Au03',
                    'BiocAu04' => 'Bioc Au04',
                    'BiocAu05' => 'Bioc Au05',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'BiocAutr',
            'required' => false,
        ));

        $this->add(array(
            'name' => 'Bioc',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'Bioc'
            ),
        ));

        $this->add(array(
            'name' => 'Bi00',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Glycémie à jeun',
            ),
        ));

        $this->add(array(
            'name' => 'Bi01',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Creatiniemie',
            ),
        ));

        $this->add(array(
            'name' => 'Bi02',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Transaminases GOT',
            ),
        ));

        $this->add(array(
            'name' => 'Bi03',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Transaminases GPT',
            ),
        ));

        $this->add(array(
            'name' => 'Bi04',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Cholesterol Total',
            ),
        ));

        $this->add(array(
            'name' => 'Bi05',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Triglycerides',
            ),
        ));

        $this->add(array(
            'name' => 'Bi06',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Amylasemie',
            ),
        ));

        $this->add(array(
            'name' => 'Bi11',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Uree',
            ),
        ));

        $this->add(array(
            'name' => 'Bi12',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Phosphoremie',
            ),
        ));

        $this->add(array(
            'name' => 'Bi13',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Lipasémie',
            ),
        ));

        $this->add(array(
            'name' => 'Bi15',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Protidémie',
            ),
        ));

        $this->add(array(
            'name' => 'Bi14',
            'attributes' => array(
                'type' => 'Textarea',
                'class' => 'form-control',
                'rows' => 8
            ),
            'options' => array(
                'label' => 'Remarque',
            ),
        ));

        $this->add(array(
            'name' => 'Bi07',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Cetonurie',
            ),
        ));

        $this->add(array(
            'name' => 'Bi08',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Albumine',
            ),
        ));

        $this->add(array(
            'name' => 'Bi09',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Sucre',
            ),
        ));

        $this->add(array(
            'name' => 'Bi10',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Proteinurie des 24h',
            ),
        ));

        // BiochimieForm End
        // NFSForm Start 

        $this->add(array(
            'name' => 'Nfs_',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'Nfs_'
            ),
        ));

        $this->add(array(
            'name' => 'Nfs0',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'GB',
            ),
        ));

        $this->add(array(
            'name' => 'Nfs1',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'GR',
            ),
        ));

        $this->add(array(
            'name' => 'Nfs2',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'HB',
            ),
        ));

        $this->add(array(
            'name' => 'Nfs3',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'HT',
            ),
        ));

        $this->add(array(
            'name' => 'Nfs4',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'VGM',
            ),
        ));

        $this->add(array(
            'name' => 'Nfs5',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'TGMH',
            ),
        ));

        $this->add(array(
            'name' => 'Nfs6',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'CCMH',
            ),
        ));

        $this->add(array(
            'name' => 'Nfs7',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'PLA',
            ),
        ));

        $this->add(array(
            'name' => 'Nfs9',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'LYM#',
            ),
        ));

        $this->add(array(
            'name' => 'Nfs8',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'LYM%',
            ),
        ));

        $this->add(array(
            'name' => 'Nf10',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => '% Granulocytes neutrophiles',
            ),
        ));

        $this->add(array(
            'name' => 'Nf11',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => '% Granulocytes éosinophiles',
            ),
        ));

        $this->add(array(
            'name' => 'Nf12',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => '% Granulocytes basophiles',
            ),
        ));

        $this->add(array(
            'name' => 'Nf13',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'MON%',
            ),
        ));

        $this->add(array(
            'name' => 'Nf14',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Conclusion',
            ),
        ));

        $this->add(array(
            'name' => 'Nf15',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'GRA%',
            ),
        ));

        $this->add(array(
            'name' => 'Nf16',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'MON#',
            ),
        ));

        $this->add(array(
            'name' => 'Nf17',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'GRA#',
            ),
        ));

        $this->add(array(
            'name' => 'Nf18',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'IDR',
            ),
        ));

        $this->add(array(
            'name' => 'Nf19',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'VMP',
            ),
        ));

        $this->add(array(
            'name' => 'Nf20',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'THT',
            ),
        ));

        $this->add(array(
            'name' => 'Nf21',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'IDP',
            ),
        ));

        // NFSForm End 
        // CD4Form Start 

        $this->add(array(
            'name' => 'Cd4_',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'Cd4_'
            ),
        ));

        $this->add(array(
            'name' => 'Cd40',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'CD4',
            ),
        ));

        $this->add(array(
            'name' => 'Cd41',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => '% CD4',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Cd44',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'CD8',
                'value_options' => array(
                    '' => '',
                    '<' => '<',
                    '>' => '>',
                ),
            )
        ));

        $filter->add(array(
            'name' => 'Cd44',
            'required' => false,
        ));

        $this->add(array(
            'name' => 'Cd42',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'CD8',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Cd45',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'CD4/CD8',
                'value_options' => array(
                    '' => '',
                    '<' => '<',
                    '>' => '>',
                ),
            )
        ));

        $filter->add(array(
            'name' => 'Cd45',
            'required' => false,
        ));

        $this->add(array(
            'name' => 'Cd43',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'CD4/CD8',
            ),
        ));

        $this->add(array(
            'name' => 'Cd46',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'CD3',
            ),
        ));

        $this->add(array(
            'name' => 'Cd4_Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'RensNaisDat_',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),	
                'value' => date('Y-m-d')
            ),
            'options' => array(
                'label' => 'Date du prélévement',
            ),
        ));

        // CD4Form End
        // PCRForm Start

        $this->add(array(
            'name' => 'Pcr_',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'Pcr_'
            ),
        ));

        $this->add(array(
            'name' => 'Pcr_Dat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'RensNaisDat_',
                'min' => '1910-01-01',
                'max' => date('Y-m-d'),
                'value' => date('Y-m-d')
            ),
            'options' => array(
                'label' => 'Date du prélévement',
            ),
        ));

        $this->add(array(
            'name' => 'Pcr0',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Pcr0'
            ),
            'options' => array(
                'label' => 'Charge Virale (UI/ml)',
            ),
        ));

        $this->add(array(
            'name' => 'Pcr1',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Pcr1',
            ),
            'options' => array(
                'label' => 'Log',
            ),
        ));

        $this->add(array(
            'name' => 'Pcr5',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Pcr5',
            ),
            'options' => array(
                'label' => 'Copies/ml',
            ),
        ));

        $this->add(array(
            'name' => 'Pcr4',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Charge virale indétectable',
            ),
        ));
        $filter->add(array(
            'name' => 'Pcr4',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Pcr6',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Charge virale ( <20 UI/ml )',
            ),
        ));
        $filter->add(array(
            'name' => 'Pcr6',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Pcr2',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Dépistage enfant  1',
                'value_options' => array(
                    '1' => 'positif > 1000 copies',
                    '2' => 'Négatif < 1000 copies',
                    '3' => 'positif < 1000 copies',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Pcr2',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Pcr3',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Dépistage enfant 2',
                'value_options' => array(
                    '1' => 'positif > 1000 copies',
                    '2' => 'Négatif < 1000 copies',
                    '3' => 'positif < 1000 copies',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Pcr3',
            'required' => false,
            'allow_empty' => true,
        ));

        // PCRForm End
        // UrineForm Start

        $this->add(array(
            'name' => 'Urin',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'Urin'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Uri0',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Couleur',
                'empty_option' => '',
                'value_options' => array(
                    '' => '',
                    'Blanchâtre' => 'Blanchâtre',
                    'Jaune pâle' => 'Jaune pâle',
                    'Jaune clair' => 'Jaune clair',
                    'Jaune citron' => 'Jaune citron',
                    'Jaune foncé' => 'Jaune foncé',
                ),
            )
        ));

        $filter->add(array(
            'name' => 'Uri0',
            'required' => false,
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Uri1',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Aspect',
                'empty_option' => '',
                'value_options' => array(
                    '' => '',
                    'Clair' => 'Clair',
                    'Trouble' => 'Trouble',
                    'Hématurique' => 'Hématurique',
                    'Purulent' => 'Purulent',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Uri1',
            'required' => false,
        ));

        $this->add(array(
            'name' => 'Uri2',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Indices d’infection',
            ),
        ));

        $this->add(array(
            'name' => 'Uri3',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Cytologie',
            ),
        ));
        $this->add(array(
            'name' => 'Uri4',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Bactériologie  Bacilles',
            ),
        ));
        $this->add(array(
            'name' => 'Uri5',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Cocci',
            ),
        ));
        $this->add(array(
            'name' => 'Uri6',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Autre',
            ),
        ));
        // UrineForm End 
        // GoutteepForm Start 
        $this->add(array(
            'name' => 'Gout',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'Gout'
            ),
        ));

        $this->add(array(
            'name' => 'Gou0',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Recherche des hématozaires',
                'value_options' => array(
                    '1' => 'Négative',
                    '2' => 'Positive',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Gou0',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Gou1',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => ' ',
                'value_options' => array(
                    '1' => 'Densité faible',
                    '2' => 'Densité moyenne',
                    '3' => 'Densité élevée',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Gou1',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Gou4',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Ou',
            ),
        ));

        $this->add(array(
            'name' => 'Gou5',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => '% hématies parasitées',
            ),
        ));

        $this->add(array(
            'name' => 'Gou2',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Recherche des filaires',
                'value_options' => array(
                    '1' => 'Négative',
                    '2' => 'Positive',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Gou2',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Gou3',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => ' ',
                'value_options' => array(
                    '1' => 'Densité faible',
                    '2' => 'Densité moyenne',
                    '3' => 'Densité élevée',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Gou3',
            'required' => false,
            'allow_empty' => true,
        ));
        // GoutteepForm End
        // PrelVagiForm Start

        $this->add(array(
            'name' => 'Vagi',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'Vagi'
            ),
        ));

        $this->add(array(
            'name' => 'Vag0',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Aspect des leucorrhées',
            ),
        ));

        $this->add(array(
            'name' => 'Vag1',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Cytologie',
            ),
        ));
        $this->add(array(
            'name' => 'Vag2',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Bactériologie  Bacilles',
            ),
        ));
        $this->add(array(
            'name' => 'Vag3',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Cocci',
            ),
        ));
        $this->add(array(
            'name' => 'Vag4',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Autre',
            ),
        ));

        // PrelVagiForm End
        // LiqcephaForm Start

        $this->add(array(
            'name' => 'Ceph',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'Ceph'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Cep0',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Aspect',
                'empty_option' => '',
                'value_options' => array(
                    '' => '',
                    'Limpide' => 'Limpide',
                    'Comme eau de roche' => 'Comme eau de roche',
                    'Trouble' => 'Trouble',
                    'Rosé' => 'Rosé',
                    'Hématurique' => 'Hématurique',
                    'Purulent' => 'Purulent',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Cep0',
            'required' => false,
        ));

        $this->add(array(
            'name' => 'Cep1',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Cytologie',
            ),
        ));
        $this->add(array(
            'name' => 'Cep2',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Parasitologie',
            ),
        ));
        $this->add(array(
            'name' => 'Cep3',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Bactériologie',
            ),
        ));
        // LiqcephaForm End
        //AutreForm Start

        $this->add(array(
            'name' => 'Autr',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'Autr'
            ),
        ));

        $this->add(array(
            'name' => 'Au00',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'BAAR',
                'value_options' => array(
                    '1' => 'Négative',
                    '2' => 'Positive',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Au00',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Au01',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Groupe sanguin',
                'empty_option' => '',
                'value_options' => array(
                    '' => '',
                    'A+' => 'A+',
                    'A-' => 'A-',
                    'B+' => 'B+',
                    'B-' => 'B-',
                    'AB+' => 'AB+',
                    'AB-' => 'AB-',
                    'O+' => 'O+',
                    'O-' => 'O-',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Au01',
            'required' => false,
        ));

        $this->add(array(
            'name' => 'Au02',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Vitesse sanguine 1h',
            ),
        ));
        $this->add(array(
            'name' => 'Au03',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Vitesse sanguine 2h',
            ),
        ));

        $this->add(array(
            'name' => 'Au11',
            'type' => 'Zend\Form\Element\Radio',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'CRP',
                'value_options' => array(
                    '1' => 'Négative',
                    '2' => 'Positive',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Au11',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Au12',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'UI',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'Au04',
            'attributes' => array(
                'class' => 'selectpicker form-control',
                'data-live-search' => 'true'
            ),
            'options' => array(
                'label' => 'Aspect',
                'empty_option' => '',
                'value_options' => array(
                    '' => '',
                    'Solide' => 'Solide',
                    'Molle' => 'Molle',
                    'Glairo-sanguinolente' => 'Glairo-sanguinolente',
                    'Semi-solide' => 'Semi-solide',
                    'Diarrhéique' => 'Diarrhéique',
                ),
            )
        ));
        $filter->add(array(
            'name' => 'Au04',
            'required' => false,
        ));

        $this->add(array(
            'name' => 'Au05',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Parasites',
            ),
        ));

        $filter->add(array(
            'name' => 'Au05',
            'required' => false,
            'allow_empty' => true,
        ));

        $this->add(array(
            'name' => 'Au06',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Hématies',
            ),
        ));
        $this->add(array(
            'name' => 'Au07',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'polynucléaires',
            ),
        ));
        $this->add(array(
            'name' => 'Au08',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Végétatives',
            ),
        ));
        $this->add(array(
            'name' => 'Au09',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Kystes',
            ),
        ));
        $this->add(array(
            'name' => 'Au10',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
            ),
            'options' => array(
                'label' => 'Oeufs',
            ),
        ));
        $this->add(array(
            'name' => 'ArriHoro',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'ArriHoro',
                'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => "Date d'Arrivée",
            ),
        ));
		
		$this->add(array(
            'name' => 'LaboDat_',
            'attributes' => array(
                'type' => 'date',
                'class' => 'form-control',
                'id' => 'LaboDat_',
                'value' => date('Y-m-d'),
            ),
            'options' => array(
                'label' => 'Date des résultats',
            ),
        ));


        //AutreForm End
    }

}
