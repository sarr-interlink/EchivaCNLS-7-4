<?php

namespace Dossiers\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\InputFilter\InputFilter;
use Dossiers\Form\FicheForm;
use Dossiers\Form\SocialForm;
use Dossiers\Form\SocialsocialForm;
use Dossiers\Form\SocialpsyForm;
use Dossiers\Form\SocialserologieForm;
use Dossiers\Form\SocialenfantsForm;
use Dossiers\Form\SocialautreForm;
use Dossiers\Form\MedicalouvertureForm;
use Dossiers\Form\MedicalsuiviForm;
use Dossiers\Form\MedicalbiologieForm;
use Dossiers\Form\PTMEForm;
use Dossiers\Form\PTMEGrossesseForm;
use Dossiers\Form\PTMEAccouchementForm;
use Dossiers\Form\PTMEEnfantForm;
use Dossiers\Form\PTMEJumeau2Form;
use Dossiers\Form\EducationtherapForm;
use Dossiers\Form\MotifsForm;
use Dossiers\Form\MotifsHdjForm;
//use Dossiers\Form\ConcForm;
use Dossiers\Form\IntolForm;
use Dossiers\Form\ObsForm;
use Dossiers\Form\FacRisqForm;
use Dossiers\Form\MediAnteForm;
use Dossiers\Form\MedicourantForm;
use Dossiers\Form\RdvForm;
use Zend\Stdlib\Hydrator\ClassMethods as ClassMethodsHydrator;

class DossiersForm extends Form implements InputFilterProviderInterface{

    public $subFormFiche;
    public $subFormSocial;
    public $subFormSocialSocial;
    public $subFormSocialPsy;
    public $subFormSocialSer;
    public $subFormSocialEnf;
    public $subFormSocialAut;
    public $subFormMedical;
    public $subFormMedicalOuv;
    public $subFormMedicalSui;
    public $subFormMedicalBio;
    public $subFormPtme;
    public $subFormPtmeGros;
    public $subFormPtmeAcc;
    public $subFormPtmeEnf;
    public $subFormPtmeJum;
    public $subFormEducationtherap;

    public function __construct() {
// we want to ignore the name passed
        parent::__construct('dossiers');
        $this->setAttribute('method', 'post');



//initialisation
        $subFormFiche = new FicheForm();
        $subFormFiche->setName('subFormFiche');
        $subFormSocial = new SocialForm();
        $subFormSocial->setName('subFormSocial');
        $subFormSocialSocial = new SocialsocialForm();
        $subFormSocialSocial->setName('subFormSocialSocial');
        $subFormSocialPsy = new SocialpsyForm();
        $subFormSocialPsy->setName('subFormSocialPsy');
        $subFormSocialSer = new SocialserologieForm();
        $subFormSocialSer->setName('subFormSocialSer');
        $subFormSocialEnf = new SocialenfantsForm();
        $subFormSocialEnf->setName('subFormSocialEnf');
        $subFormSocialAut = new SocialautreForm();
        $subFormSocialAut->setName('subFormSocialAut');
        $subFormMedicalOuv = new MedicalouvertureForm();
        $subFormMedicalOuv->setName('subFormMedicalOuv');
        $subFormMedicalOuvFact = new FacRisqForm();
        $subFormMedicalOuvFact->setName('subFormMedicalOuvFact');
        $subFormMedicalOuvMedi = new MediAnteForm();
        $subFormMedicalOuvMedi->setName('subFormMedicalOuvMedi');
        $subFormMedicalSui = new MedicalsuiviForm();
        $subFormMedicalSui->setName('subFormMedicalSui');
        $subFormMedicalSuiMoti = new MotifsForm();
        $subFormMedicalSuiMoti->setName('subFormMedicalSuiMoti');
        $subFormMedicalSuiMotihdj = new MotifsHdjForm();
        $subFormMedicalSuiMotihdj->setName('subFormMedicalSuiMotihdj');
        $subFormMedicalSuiInto = new IntolForm();
        $subFormMedicalSuiInto->setName('subFormMedicalSuiInto');
        $subFormMedicalSuiObs = new ObsForm();
        $subFormMedicalSuiObs->setName('subFormMedicalSuiObs');
        $subFormMedicalSuiRdv = new RdvForm();
        $subFormMedicalSuiRdv->setName('subFormMedicalSuiRdv');
        $subFormMedicalSuiMedi = new MedicourantForm();
        $subFormMedicalSuiMedi->setName('subFormMedicalSuiMedi');
        $subFormMedicalBio = new MedicalbiologieForm();
        $subFormMedicalBio->setName('subFormMedicalBio');
        $subFormPtme = new PTMEForm();
        $subFormPtme->setName('subFormPtme');
        $subFormPtmeGros = new PTMEGrossesseForm();
        $subFormPtmeGros->setName('subFormPtmeGros');
        $subFormPtmeAcc = new PTMEAccouchementForm();
        $subFormPtmeAcc->setName('subFormPtmeAcc');
        $subFormPtmeEnf = new PTMEEnfantForm();
        $subFormPtmeEnf->setName('subFormPtmeEnf');
        $subFormPtmeJum = new PTMEJumeau2Form();
        $subFormPtmeJum->setName('subFormPtmeJum');
        $subFormEducationtherap = new EducationtherapForm();
        $subFormEducationtherap->setName('subFormEducationtherap');


        /**/

        $this->add(array(
            'name' => 'Nume',
            'attributes' => array(
                'type' => 'text',
            ),
        ));

        $subFormSocial->add($subFormSocialSocial);
        $subFormSocial->add($subFormSocialPsy);
        $subFormSocial->add($subFormSocialSer);
        $subFormSocial->add($subFormSocialEnf);
        $subFormSocial->add($subFormSocialAut);

        $subFormMedicalSui->add($subFormMedicalSuiMoti);
        $subFormMedicalSui->add($subFormMedicalSuiMotihdj);
        $subFormMedicalSui->add($subFormMedicalSuiInto);
        $subFormMedicalSui->add($subFormMedicalSuiObs);
        $subFormMedicalSui->add($subFormMedicalSuiRdv);
        $subFormMedicalSui->add($subFormMedicalSuiMedi);
        

        $subFormMedicalOuv->add($subFormMedicalOuvFact);
        $subFormMedicalOuv->add($subFormMedicalOuvMedi);

        $subFormPtme->add($subFormPtmeGros);
        $subFormPtme->add($subFormPtmeAcc);
        $subFormPtme->add($subFormPtmeEnf);
        $subFormPtme->add($subFormPtmeJum);




        $this->add($subFormFiche);
        $this->add($subFormSocial);
        $this->add($subFormMedicalOuv);
        $this->add($subFormMedicalSui);
        $this->add($subFormMedicalBio);
        $this->add($subFormPtme);
        $this->add($subFormEducationtherap);
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type' => 'submit',
                'value' => 'Valider',
                'class' => 'btn btn-primary',
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
            'nume' => array(
                'required' => false,
        )
            );
    }

}
