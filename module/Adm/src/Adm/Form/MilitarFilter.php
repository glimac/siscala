<?php

namespace Adm\Form;

use Zend\InputFilter\InputFilter;

class MilitarFilter  extends InputFilter
{

    public function __construct()
    {
        $this->add(array(
            'name'     =>'milnome',
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
            'name'     => 'milnomeguerra',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     => 'milcpf',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     => 'milidt',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     => 'milmatricula',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     => 'quacodigo',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     => 'mildtnascimento',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     => 'miltelefone',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     => 'miltelefonesec',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     => 'milendereco',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     => 'milemail',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     => 'milemailsec',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array('name' => 'NotEmpty', 'options' => array('messages' => array('isEmpty' => 'Campo Obrigatório')))
            )
        ));

        $this->add(array(
            'name'     => 'pgrcodigo',
            'required' => true,
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
