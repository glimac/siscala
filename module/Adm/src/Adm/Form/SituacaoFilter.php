<?php

namespace Adm\Form;

use Zend\InputFilter\InputFilter;

class SituacaoFilter  extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name'     =>'milmatricula',
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
            'name'     =>'tpscodigo',
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
            'name'     =>'sitdatainicio',
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
            'name'     =>'sitdatafim',
            'required' =>false,
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
