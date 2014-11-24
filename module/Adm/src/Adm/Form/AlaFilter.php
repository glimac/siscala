<?php

namespace Adm\Form;

use Zend\InputFilter\InputFilter;

class AlaFilter  extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name'     =>'alacodigo',
            'required' =>true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     =>'esccodigo',
            'required' =>true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     =>'milidt',
            'required' =>true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));
    }
}
