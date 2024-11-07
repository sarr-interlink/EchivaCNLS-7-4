<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Social implements InputFilterAwareInterface {

    public $SociUrgeNom_;
    public $SociUrgePnom;
    public $SociUrgeAdre;
    public $SociUrgeTel_;
    public $SociPersChrg;
    public $SociEnfaChrg;
    public $SociEnfaScol;
    public $SociEnfaVih_;
    public $SociEnfaVih_Chrg;
    public $SociPersVih_;
    public $SociConjAge_;
    public $SociConjProf;
    public $SociConjPrec;
    public $SociConjSani;
    public $SociConjRef_;
    public $SociConjVih_Chrg;
    public $SociFinaNom_;
    public $SociFinaPnom;
    public $SociFinaAdre;
    public $SociFinaProf;
    public $SociFinaPrec;
    public $SociFinaChrg;
    public $SociRefu;
    /**subform**/
    public $subFormSocialSocial;
    public $subFormSocialPsy;
    public $subFormSocialSer;
    public $subFormSocialEnf;
    public $subFormSocialAut;
    /****/
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->SociUrgeAdre = (isset($data['SociUrgeAdre'])) ? $data['SociUrgeAdre'] : NULL;
        $this->SociUrgeNom_ = (isset($data['SociUrgeNom_'])) ? $data['SociUrgeNom_'] : NULL;
        $this->SociUrgePnom = (isset($data['SociUrgePnom'])) ? $data['SociUrgePnom'] : NULL;
        $this->SociUrgeTel_ = (isset($data['SociUrgeTel_'])) ? $data['SociUrgeTel_'] : NULL;
        $this->SociPersChrg = (isset($data['SociPersChrg'])) ? $data['SociPersChrg'] : NULL;
        $this->SociEnfaChrg = (isset($data['SociEnfaChrg'])) ? $data['SociEnfaChrg'] : NULL;
        $this->SociEnfaScol = (isset($data['SociEnfaScol'])) ? $data['SociEnfaScol'] : NULL;
        $this->SociEnfaVih_ = (isset($data['SociEnfaVih_'])) ? $data['SociEnfaVih_'] : NULL;
        $this->SociEnfaVih_Chrg = (isset($data['SociEnfaVih_Chrg'])) ? $data['SociEnfaVih_Chrg'] : NULL;
        $this->SociPersVih_ = (isset($data['SociPersVih_'])) ? $data['SociPersVih_'] : NULL;
        $this->SociConjAge_ = (isset($data['SociConjAge_'])) ? $data['SociConjAge_'] : NULL;
        $this->SociConjProf = (isset($data['SociConjProf'])) ? $data['SociConjProf'] : NULL;
        $this->SociConjPrec = (isset($data['SociConjPrec'])) ? $data['SociConjPrec'] : NULL;
        $this->SociConjSani = (isset($data['SociConjSani'])) ? $data['SociConjSani'] : NULL;
        $this->SociConjRef_ = (isset($data['SociConjRef_'])) ? $data['SociConjRef_'] : NULL;
        $this->SociConjVih_Chrg = (isset($data['SociConjVih_Chrg'])) ? $data['SociConjVih_Chrg'] : NULL;
        $this->SociFinaAdre = (isset($data['SociFinaAdre'])) ? $data['SociFinaAdre'] : NULL;
        $this->SociFinaChrg = (isset($data['SociFinaChrg'])) ? $data['SociFinaChrg'] : NULL;
        $this->SociFinaNom_ = (isset($data['SociFinaNom_'])) ? $data['SociFinaNom_'] : NULL;
        $this->SociFinaPnom = (isset($data['SociFinaPnom'])) ? $data['SociFinaPnom'] : NULL;
        $this->SociFinaPrec = (isset($data['SociFinaPrec'])) ? $data['SociFinaPrec'] : NULL;
        $this->SociFinaProf = (isset($data['SociFinaProf'])) ? $data['SociFinaProf'] : NULL;
        $this->SociRefu = (isset($data['SociRefu'])) ? $data['SociRefu'] : NULL;
    }

    // Add the following method:
    public function getArrayCopy() {
        return get_object_vars($this);
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name' => 'id',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'artist',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'title',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                        ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}
