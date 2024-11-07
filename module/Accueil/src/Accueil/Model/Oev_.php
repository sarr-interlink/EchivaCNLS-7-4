<?php

namespace Accueil\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Oev_ implements InputFilterAwareInterface {

    public $Nume;
	public $Util;
	public $Modi;
	public $Age_;
	public $Diff;
	public $MereDece;
	public $MereRef_;
	public $Nais;
	public $Nom_;
	public $Nota;
	public $PereDece;
	public $PereRef_;
	public $Pnom;
	public $Ref_;
	public $Sani;
	public $Scol;
	public $Sexe;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->Nume = ( isset($data['Nume']) && !empty($data['Nume']) ) ? $data['Nume'] : "14".hexdec(uniqid());
        $this->Util = (isset($data['Util'])) ? $data['Util'] : NULL;
        $this->Modi = (isset($data['Modi'])) ? $data['Modi'] : NULL;
		$this->Age_ = (isset($data['Age_'])) ? $data['Age_'] : NULL;
		$this->Diff = (isset($data['Diff'])) ? $data['Diff'] : NULL;
		$this->MereDece = (isset($data['MereDece'])) ? $data['MereDece'] : NULL;
		$this->MereRef_ = (isset($data['MereRef_'])) ? $data['MereRef_'] : NULL;
		$this->Nais = (isset($data['Nais'])) ? $data['Nais'] : NULL;
		$this->Nom_ = (isset($data['Nom_'])) ? $data['Nom_'] : NULL;
		$this->Nota = (isset($data['Nota'])) ? $data['Nota'] : NULL;
		$this->PereDece = (isset($data['PereDece'])) ? $data['PereDece'] : NULL;
		$this->PereRef_ = (isset($data['PereRef_'])) ? $data['PereRef_'] : NULL;
		$this->Pnom = (isset($data['Pnom'])) ? $data['Pnom'] : NULL;
		$this->Ref_ = (isset($data['Ref_'])) ? $data['Ref_'] : NULL;
		$this->Sani = (isset($data['Sani'])) ? $data['Sani'] : NULL;
		$this->Scol = (isset($data['Scol'])) ? $data['Scol'] : NULL;
		$this->Sexe = (isset($data['Sexe'])) ? $data['Sexe'] : NULL;
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
