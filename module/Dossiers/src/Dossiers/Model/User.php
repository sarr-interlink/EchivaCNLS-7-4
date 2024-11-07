<?php

namespace Dossiers\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use Zend\Db\Sql\Expression;

class User implements InputFilterAwareInterface {

    public $user_id;
    public $username;
    public $email;
    public $display_name;
    public $password;
    public $state;
    public $centre;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->user_id = (isset($data['user_id']) && !empty($data['user_id']) ) ? $data['user_id'] : "14".hexdec(uniqid());
        $this->username = (isset($data['username']) && !empty($data['username']) ) ? $data['username'] : null;
        $this->email = (isset($data['email']) && !empty($data['email']) ) ? $data['email'] : null;
        $this->display_name = (isset($data['display_name']) && !empty($data['display_name']) ) ? $data['display_name'] : null;
        //ajouter
        $this->password = (isset($data['password']) && !empty($data['password']) ) ? $data['password'] : null;
        $this->state = (isset($data['state']) && !empty($data['state']) ) ? $data['state'] : null;
        $this->centre = (isset($data['centre']) && !empty($data['centre']) ) ? $data['centre'] : null;
    }

    public function someValues(array $array) {
        foreach ($array as $key => $value) {
            if (empty($value)) {
                $this->$key = null;
            } else {
                $this->$key = $value;
            }
        }
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
