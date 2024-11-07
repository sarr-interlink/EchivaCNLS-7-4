<?php

namespace Analyse\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Medicons implements InputFilterAwareInterface {

    public $Nume;
	public $Util;
	public $Modi;
	public $Arv_Dure;
	public $Arv_DureReno;
	public $Arv_DureTyp_;
	public $Arv_Into;
	public $Arv_IntoCase;
	public $Arv_Modi;
	public $Arv0Fois;
	public $Arv0Form;
	public $Arv0Nomb;
	public $Arv0Nota;
	public $Arv0Prsc;
	public $Arv0Serv;
	public $Arv0Unit;
	public $Arv1Fois;
	public $Arv1Form;
	public $Arv1Nomb;
	public $Arv1Nota;
	public $Arv1Prsc;
	public $Arv1Serv;
	public $Arv1Unit;
	public $Arv2Fois;
	public $Arv2Form;
	public $Arv2Nomb;
	public $Arv2Nota;
	public $Arv2Prsc;
	public $Arv2Serv;
	public $Arv2Unit;
	public $Arv3Fois;
	public $Arv3Form;
	public $Arv3Nomb;
	public $Arv3Nota;
	public $Arv3Prsc;
	public $Arv3Serv;
	public $Arv3Unit;
	public $Cdc_;
	public $Conc;
	public $ConcCase;
	public $Cond;
	public $Cont;
	public $Dat_;
	public $Doss;
	public $Hdj_;
	public $Hdj_Acte;
	public $Hosp;
	public $HospSort;
	public $Imc_;
	public $Karn;
	public $Med0Dci_;
	public $Med0Dure;
	public $Med0DureTyp_;
	public $Med0Fois;
	public $Med0Form;
	public $Med0Nomb;
	public $Med0Serv;
	public $Med0Unit;
	public $Med1Dci_;
	public $Med1Dure;
	public $Med1DureTyp_;
	public $Med1Fois;
	public $Med1Form;
	public $Med1Nomb;
	public $Med1Serv;
	public $Med1Unit;
	public $Med2Dci_;
	public $Med2Dure;
	public $Med2DureTyp_;
	public $Med2Fois;
	public $Med2Form;
	public $Med2Nomb;
	public $Med2Serv;
	public $Med2Unit;
	public $Med3Dci_;
	public $Med3Dure;
	public $Med3DureTyp_;
	public $Med3Fois;
	public $Med3Form;
	public $Med3Nomb;
	public $Med3Serv;
	public $Med3Unit;
	public $Med4Dci_;
	public $Med4Dure;
	public $Med4DureTyp_;
	public $Med4Fois;
	public $Med4Form;
	public $Med4Nomb;
	public $Med4Serv;
	public $Med4Unit;
	public $Med5Dci_;
	public $Med5Dure;
	public $Med5DureTyp_;
	public $Med5Fois;
	public $Med5Form;
	public $Med5Nomb;
	public $Med5Serv;
	public $Med5Unit;
	public $Moti;
	public $MotiCase;
	public $Obse;
	public $ObseCase;
	public $ObseManq;
	public $ObseMoti;
	public $ObseNota;
	public $Oms_;
	public $Poid;
	public $Ptme;
	public $Tail;
	public $Tb__Exte;
	public $Temp;
	public $count;
	public $RensAge_;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = (isset($data['Nume'])) ? $data['Nume'] : NULL;
        $this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
        $this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
	$this->Arv_Dure = (isset($data['Arv_Dure'])) ? $data['Arv_Dure'] : NULL;
        $this->Arv_DureReno = (isset($data['Arv_DureReno'])) ? $data['Arv_DureReno'] : NULL;
        $this->Arv_DureTyp_ = (isset($data['Arv_DureTyp_'])) ? $data['Arv_DureTyp_'] : NULL;
        $this->Arv_Into = (isset($data['Arv_Into'])) ? $data['Arv_Into'] : NULL;
        $this->Arv_IntoCase = (isset($data['Arv_IntoCase'])) ? $data['Arv_IntoCase'] : NULL;
        $this->Arv_Modi = (isset($data['Arv_Modi'])) ? $data['Arv_Modi'] : NULL;
        $this->Arv0Fois = (isset($data['Arv0Fois'])) ? $data['Arv0Fois'] : NULL;
        $this->Arv0Form = (isset($data['Arv0Form'])) ? $data['Arv0Form'] : NULL;
        $this->Arv0Nomb = (isset($data['Arv0Nomb'])) ? $data['Arv0Nomb'] : NULL;
        $this->Arv0Nota = (isset($data['Arv0Nota'])) ? $data['Arv0Nota'] : NULL;
        $this->Arv0Prsc = (isset($data['Arv0Prsc'])) ? $data['Arv0Prsc'] : NULL;
	$this->Arv0Serv = (isset($data['Arv0Serv'])) ? $data['Arv0Serv'] : NULL;
        $this->Arv0Unit = (isset($data['Arv0Unit'])) ? $data['Arv0Unit'] : NULL;
        $this->Arv1Fois = (isset($data['Arv1Fois'])) ? $data['Arv1Fois'] : NULL;
        $this->Arv1Form = (isset($data['Arv1Form'])) ? $data['Arv1Form'] : NULL;
        $this->Arv1Nomb = (isset($data['Arv1Nomb'])) ? $data['Arv1Nomb'] : NULL;
        $this->Arv1Nota = (isset($data['Arv1Nota'])) ? $data['Arv1Nota'] : NULL;
        $this->Arv1Prsc = (isset($data['Arv1Prsc'])) ? $data['Arv1Prsc'] : NULL;
        $this->Arv1Serv = (isset($data['Arv1Serv'])) ? $data['Arv1Serv'] : NULL;
        $this->Arv1Unit = (isset($data['Arv1Unit'])) ? $data['Arv1Unit'] : NULL;
        $this->Arv2Fois = (isset($data['Arv2Fois'])) ? $data['Arv2Fois'] : NULL;
        $this->Arv2Form = (isset($data['Arv2Form'])) ? $data['Arv2Form'] : NULL;
		$this->Arv2Nomb = (isset($data['Arv2Nomb'])) ? $data['Arv2Nomb'] : NULL;
		$this->Arv2Nota = (isset($data['Arv2Nota'])) ? $data['Arv2Nota'] : NULL;
		$this->Arv2Prsc = (isset($data['Arv2Prsc'])) ? $data['Arv2Prsc'] : NULL;
		$this->Arv2Serv = (isset($data['Arv2Serv'])) ? $data['Arv2Serv'] : NULL;
		$this->Arv2Unit = (isset($data['Arv2Unit'])) ? $data['Arv2Unit'] : NULL;
		$this->Arv3Fois = (isset($data['Arv3Fois'])) ? $data['Arv3Fois'] : NULL;
		$this->Arv3Form = (isset($data['Arv3Form'])) ? $data['Arv3Form'] : NULL;
		$this->Arv3Nomb = (isset($data['Arv3Nomb'])) ? $data['Arv3Nomb'] : NULL;
		$this->Arv3Nota = (isset($data['Arv3Nota'])) ? $data['Arv3Nota'] : NULL;
		$this->Arv3Prsc = (isset($data['Arv3Prsc'])) ? $data['Arv3Prsc'] : NULL;
		$this->Arv3Serv = (isset($data['Arv3Serv'])) ? $data['Arv3Serv'] : NULL;
		$this->Arv3Unit = (isset($data['Arv3Unit'])) ? $data['Arv3Unit'] : NULL;
		$this->Cdc_ = (isset($data['Cdc_'])) ? $data['Cdc_'] : NULL;
		$this->Conc = (isset($data['Conc'])) ? $data['Conc'] : NULL;
		$this->ConcCase = (isset($data['ConcCase'])) ? $data['ConcCase'] : NULL;
		$this->Cond = (isset($data['Cond'])) ? $data['Cond'] : NULL;
		$this->Cont = (isset($data['Cont'])) ? $data['Cont'] : NULL;
		$this->Dat_ = (isset($data['Dat_'])) ? $data['Dat_'] : NULL;
		$this->Doss = (isset($data['Doss'])) ? $data['Doss'] : NULL;
		$this->Hdj_ = (isset($data['Hdj_'])) ? $data['Hdj_'] : NULL;
		$this->Hdj_Acte = (isset($data['Hdj_Acte'])) ? $data['Hdj_Acte'] : NULL;
		$this->Hosp = (isset($data['Hosp'])) ? $data['Hosp'] : NULL;
		$this->HospSort = (isset($data['HospSort'])) ? $data['HospSort'] : NULL;
		$this->Imc_ = (isset($data['Imc_'])) ? $data['Imc_'] : NULL;
		$this->Karn = (isset($data['Karn'])) ? $data['Karn'] : NULL;
		$this->Med0Dci_ = (isset($data['Med0Dci_'])) ? $data['Med0Dci_'] : NULL;
		$this->Med0Dure = (isset($data['Med0Dure'])) ? $data['Med0Dure'] : NULL;
		$this->Med0DureTyp_ = (isset($data['Med0DureTyp_'])) ? $data['Med0DureTyp_'] : NULL;
		$this->Med0Fois = (isset($data['Med0Fois'])) ? $data['Med0Fois'] : NULL;
		$this->Med0Form = (isset($data['Med0Form'])) ? $data['Med0Form'] : NULL;
		$this->Med0Nomb = (isset($data['Med0Nomb'])) ? $data['Med0Nomb'] : NULL;
		$this->Med0Serv = (isset($data['Med0Serv'])) ? $data['Med0Serv'] : NULL;
		$this->Med0Unit = (isset($data['Med0Unit'])) ? $data['Med0Unit'] : NULL;
		$this->Med1Dci_ = (isset($data['Med1Dci_'])) ? $data['Med1Dci_'] : NULL;
		$this->Med1Dure = (isset($data['Med1Dure'])) ? $data['Med1Dure'] : NULL;
		$this->Med1DureTyp_ = (isset($data['Med1DureTyp_'])) ? $data['Med1DureTyp_'] : NULL;
		$this->Med1Fois = (isset($data['Med1Fois'])) ? $data['Med1Fois'] : NULL;
		$this->Med1Form = (isset($data['Med1Form'])) ? $data['Med1Form'] : NULL;
		$this->Med1Nomb = (isset($data['Med1Nomb'])) ? $data['Med1Nomb'] : NULL;
		$this->Med1Serv = (isset($data['Med1Serv'])) ? $data['Med1Serv'] : NULL;
		$this->Med1Unit = (isset($data['Med1Unit'])) ? $data['Med1Unit'] : NULL;
		$this->Med2Dci_ = (isset($data['Med2Dci_'])) ? $data['Med2Dci_'] : NULL;
		$this->Med2Dure = (isset($data['Med2Dure'])) ? $data['Med2Dure'] : NULL;
		$this->Med2DureTyp_ = (isset($data['Med2DureTyp_'])) ? $data['Med2DureTyp_'] : NULL;
		$this->Med2Fois = (isset($data['Med2Fois'])) ? $data['Med2Fois'] : NULL;
		$this->Med2Form = (isset($data['Med2Form'])) ? $data['Med2Form'] : NULL;
		$this->Med2Nomb = (isset($data['Med2Nomb'])) ? $data['Med2Nomb'] : NULL;
		$this->Med2Serv = (isset($data['Med2Serv'])) ? $data['Med2Serv'] : NULL;
		$this->Med2Unit = (isset($data['Med2Unit'])) ? $data['Med2Unit'] : NULL;
		$this->Med3Dci_ = (isset($data['Med3Dci_'])) ? $data['Med3Dci_'] : NULL;
		$this->Med3Dure = (isset($data['Med3Dure'])) ? $data['Med3Dure'] : NULL;
		$this->Med3DureTyp_ = (isset($data['Med3DureTyp_'])) ? $data['Med3DureTyp_'] : NULL;
		$this->Med3Fois = (isset($data['Med3Fois'])) ? $data['Med3Fois'] : NULL;
		$this->Med3Form = (isset($data['Med3Form'])) ? $data['Med3Form'] : NULL;
		$this->Med3Nomb = (isset($data['Med3Nomb'])) ? $data['Med3Nomb'] : NULL;
		$this->Med3Serv = (isset($data['Med3Serv'])) ? $data['Med3Serv'] : NULL;
		$this->Med3Unit = (isset($data['Med3Unit'])) ? $data['Med3Unit'] : NULL;
		$this->Med4Dci_ = (isset($data['Med4Dci_'])) ? $data['Med4Dci_'] : NULL;
		$this->Med4Dure = (isset($data['Med4Dure'])) ? $data['Med4Dure'] : NULL;
		$this->Med4DureTyp_ = (isset($data['Med4DureTyp_'])) ? $data['Med4DureTyp_'] : NULL;
		$this->Med4Fois = (isset($data['Med4Fois'])) ? $data['Med4Fois'] : NULL;
		$this->Med4Form = (isset($data['Med4Form'])) ? $data['Med4Form'] : NULL;
		$this->Med4Nomb = (isset($data['Med4Nomb'])) ? $data['Med4Nomb'] : NULL;
		$this->Med4Serv = (isset($data['Med4Serv'])) ? $data['Med4Serv'] : NULL;
		$this->Med4Unit = (isset($data['Med4Unit'])) ? $data['Med4Unit'] : NULL;
		$this->Med5Dci_ = (isset($data['Med5Dci_'])) ? $data['Med5Dci_'] : NULL;
		$this->Med5Dure = (isset($data['Med5Dure'])) ? $data['Med5Dure'] : NULL;
		$this->Med5DureTyp_ = (isset($data['Med5DureTyp_'])) ? $data['Med5DureTyp_'] : NULL;
		$this->Med5Fois = (isset($data['Med5Fois'])) ? $data['Med5Fois'] : NULL;
		$this->Med5Form = (isset($data['Med5Form'])) ? $data['Med5Form'] : NULL;
		$this->Med5Nomb = (isset($data['Med5Nomb'])) ? $data['Med5Nomb'] : NULL;
		$this->Med5Serv = (isset($data['Med5Serv'])) ? $data['Med5Serv'] : NULL;
		$this->Med5Unit = (isset($data['Med5Unit'])) ? $data['Med5Unit'] : NULL;
		$this->Moti = (isset($data['Moti'])) ? $data['Moti'] : NULL;
		$this->MotiCase = (isset($data['MotiCase'])) ? $data['MotiCase'] : NULL;
		$this->Obse = (isset($data['Obse'])) ? $data['Obse'] : NULL;
		$this->ObseCase = (isset($data['ObseCase'])) ? $data['ObseCase'] : NULL;
		$this->ObseManq = (isset($data['ObseManq'])) ? $data['ObseManq'] : NULL;
		$this->ObseMoti = (isset($data['ObseMoti'])) ? $data['ObseMoti'] : NULL;
		$this->ObseNota = (isset($data['ObseNota'])) ? $data['ObseNota'] : NULL;
		$this->Oms_ = (isset($data['Oms_'])) ? $data['Oms_'] : NULL;
		$this->Poid = (isset($data['Poid'])) ? $data['Poid'] : NULL;
		$this->Ptme = (isset($data['Ptme'])) ? $data['Ptme'] : NULL;
		$this->Tail = (isset($data['Tail'])) ? $data['Tail'] : NULL;
		$this->Tb__Exte = (isset($data['Tb__Exte'])) ? $data['Tb__Exte'] : NULL;
		$this->Temp = (isset($data['Temp'])) ? $data['Temp'] : NULL;
		$this->count = (isset($data['count'])) ? $data['count'] : NULL;
		$this->RensAge_ = (isset($data['RensAge_'])) ? $data['RensAge_'] : NULL;
                
        
        
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
