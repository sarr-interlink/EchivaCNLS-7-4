<?php

namespace Dossiers\Form;

use Zend\Form\Form;

class MedicourantForm extends Form {

    public $Med0Dci_;

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');
    }

    public function initialise() {

        $this->add(array(
            'name' => 'Med0Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med0Dci_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med0Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med0Formmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med0Nomb',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med0Nombmedcourant',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med0Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med0Unitmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med0Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med0Foismedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med0Dure',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med0Duremedcourant',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med0DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med0DureTyp_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med1Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med1Dci_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med1Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med1Formmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med1Nomb',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med1Nombmedcourant',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med1Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med1Unitmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med1Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med1Foismedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '1 fois/jour' => '1 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med1Dure',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med1Duremedcourant',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med1DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med1DureTyp_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med2Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med2Dci_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med2Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med2Formmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med2Nomb',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med2Nombmedcourant',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med2Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med2Unitmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med2Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med2Foismedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '2 fois/jour' => '2 fois/jour',
                    '2 fois/jour' => '2 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med2Dure',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med2Duremedcourant',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med2DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med2DureTyp_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med3Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med3Dci_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med3Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med3Formmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med3Nomb',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med3Nombmedcourant',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med3Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med3Unitmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med3Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med3Foismedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '3 fois/jour' => '3 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '3 fois/jour' => '3 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med3Dure',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med3Duremedcourant',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med3DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med3DureTyp_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med4Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med4Dci_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med4Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med4Formmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med4Nomb',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med4Nombmedcourant',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med4Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med4Unitmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med4Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med4Foismedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '4 fois/jour' => '4 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '4 fois/jour' => '4 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med4Dure',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med4Duremedcourant',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med4DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med4DureTyp_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med5Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med5Dci_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med5Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med5Formmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med5Nomb',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med5Nombmedcourant',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med5Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med5Unitmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med5Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med5Foismedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med5Dure',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med5Duremedcourant',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med5DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med5DureTyp_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
          $this->add(array(
            'name' => 'Med6Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med6Dci_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med6Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med6Formmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med6Nomb',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med6Nombmedcourant',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med6Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med6Unitmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med6Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med6Foismedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med6Dure',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med6Duremedcourant',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med6DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med6DureTyp_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
          $this->add(array(
            'name' => 'Med7Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med7Dci_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med7Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med7Formmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med7Nomb',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med7Nombmedcourant',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med7Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med7Unitmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med7Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med7Foismedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med7Dure',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med7Duremedcourant',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med7DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med7DureTyp_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));  $this->add(array(
            'name' => 'Med8Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med8Dci_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med8Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med8Formmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med8Nomb',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med8Nombmedcourant',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med8Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med8Unitmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med8Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med8Foismedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med8Dure',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med8Duremedcourant',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med8DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med8DureTyp_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
          $this->add(array(
            'name' => 'Med9Dci_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med9Dci_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
        $this->add(array(
            'name' => 'Med9Form',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med9Formmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Forme',
            )
        ));
        $this->add(array(
            'name' => 'Med9Nomb',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med9Nombmedcourant',
            ),
            'options' => array(
                'label' => 'Nb',
            ),
        ));
        $this->add(array(
            'name' => 'Med9Unit',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med9Unitmedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'comprimé(s)' => 'comprimé(s)',
                    'ml' => 'ml',
                    'comprimé(s)' => 'comprimé(s)',
                    'goutte(s)' => 'goutte(s)',
                    'cuillère(s) mesure' => 'cuillère(s) mesure',
                    'application(s)' => 'application(s)',
                    'ampoules' => 'ampoules',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Med9Fois',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med9Foismedcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Fois/jour',
                'value_options' => array(
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '5 fois/jour' => '5 fois/jour',
                    '6 fois/jour' => '6 fois/jour',
                ),
            )
        ));

        $this->add(array(
            'name' => 'Med9Dure',
            'attributes' => array(
                'type' => 'text',
                'class' => 'form-control',
                'id' => 'Med9Duremedcourant',
            ),
            'options' => array(
                'label' => 'Durée',
            ),
        ));
        $this->add(array(
            'name' => 'Med9DureTyp_',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'Med9DureTyp_medcourant',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => '',
                'value_options' => array(
                    'jour(s)' => 'jour(s)',
                    'semaine(s)' => 'semaine(s)',
                    'mois' => 'mois',
                ),
            )
        ));
        $this->add(array(
            'name' => 'Presauto',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Prescription autom.',
                'class' => 'btn btn-success',
            ),
        ));
        $this->add(array(
            'name' => 'closemedicourant',
            'attributes' => array(
                'type' => 'button',
                'value' => 'Fermer',
                'class' => 'btn btn-success',
                'data-dismiss' => 'modal',
                'id' => 'closemedicourant',
            ),
              'options' => array(
                'label' => 'Fermer',
            ),
        ));
        $this->add(array(
            'name' => 'SetField',
            'type' => 'Select',
            'attributes' => array(
                'class' => 'form-control',
                'multiple' => 'multiple',
            ),
            'options' => array(
                'empty_option' => '',
                'label' => 'Designation',
                'value_options' => $this->Med0Dci_,
            )
        ));
    }

}
