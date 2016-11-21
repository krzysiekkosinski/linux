<?php

namespace Application\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Uzytkownik
{
    public $id_dzialacz;
    public $d_imie;
    public $d_nazwisko;
    public $d_login;
    public $d_haslo;
    public $d_mail;
    
    protected $inputFilter;

    public function exchangeArray($data)
    {
        $this->id_dzialacz = (!empty($data['id_dzialacz'])) ? $data['id_dzialacz'] : null;
        $this->d_imie = (!empty($data['d_imie'])) ? $data['d_imie'] : null;
        $this->d_nazwisko = (!empty($data['d_nazwisko'])) ? $data['d_nazwisko'] : null;
        $this->d_login = (!empty($data['d_login'])) ? $data['d_login'] : null;
        $this->d_haslo = (!empty($data['d_haslo'])) ? $data['d_haslo'] : null;
        $this->d_mail = (!empty($data['d_mail'])) ? $data['d_mail'] : null;
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
    
    public function getInputFilter()
    {
        if(!$this->inputFilter)
        {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'id_dzialacz',
                'requird' => true,
                'filtres' => array(
                    array(
                        'name' => 'Int',
                    ),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'd_imie',
                'requird' => true,
                'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
                'filtres' => array(
                    array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                ),
                
            ));
            
            $inputFilter->add(array(
                'name' => 'd_nazwisko',
                'requird' => true,
                'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
                'filtres' => array(
                    array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                ),
                
            ));

            $inputFilter->add(array(
                'name' => 'd_mail',
                'requird' => true,
                'type' => 'Zend\Form\Element\Email',
                'filtres' => array(
                    array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                ),
                'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
            ));


            $inputFilter->add(array(
                'name' => 'd_login',
                'requird' => true,
                'filtres' => array(
                    array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                ),
                'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
            ));
            $inputFilter->add(array(
                'name' => 'd_haslo',
                'requird' => true,
                'filtres' => array(
                    array(
                        array('name' => 'StripTags'),
                        array('name' => 'StringTrim'),
                    ),
                ),
                'validators' => array(
                     array(
                         'name'    => 'StringLength',
                         'options' => array(
                             'encoding' => 'UTF-8',
                             'min'      => 1,
                             'max'      => 100,
                         ),
                     ),
                 ),
            ));

            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }
}
