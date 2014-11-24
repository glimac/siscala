<?php

namespace Adm\Form;

use Zend\Form\Form;

class Ala extends Form
{
    public function __construct($param = null, $options = array())
    {
        parent::__construct('ala', $options);

        $this->setInputFilter(new AlaFilter());
        $this->setAttributes(array(
            'method'      => 'post',
            'class'       => 'form-horizontal',
            'role'        => 'form'
            ));

        $alacodigo = new \Zend\Form\Element\Select('alacodigo');
        $alacodigo->setValueOptions($this->comboAla($param['listaAla']));
        $alacodigo->setAttributes(array(
            'id'          => 'alacodigo',
        ));
        $this->add($alacodigo);

        $milmatricula = new \Zend\Form\Element\Text('milmatricula');
        $milmatricula->setAttributes(array(
            'id'          => 'milmatricula',
            'class'       => 'small',
        ));
        $this->add($milmatricula);

        $milcodigo = new \Zend\Form\Element\Hidden('milcodigo');
        $milcodigo->setAttributes(array(
            'id'          => 'milcodigo',
        ));
        $this->add($milcodigo);

        $milnomeguerra = new \Zend\Form\Element\Text('milnomeguerra');
        $milnomeguerra->setAttributes(array(
            'id'          => 'milnomeguerra',
            'readonly'    => 'readonly',
            'class'       => 'medium',
        ));
        $this->add($milnomeguerra);

        $salvar = new \Zend\Form\Element\Submit('salvar');
        $salvar->setAttributes(array(
            'value'       => 'Salvar',
            'id'          => 'salvar',
            'class'       => 'btn btn-primary'
        ));
        $this->add($salvar);

    }

    public function comboAla($param)
    {
        $arrOptions = array();
        $arrOptions['']= '-- Selecione --';
        if ($param) {
            foreach ($param as $row) {
                $arrOptions[$row->getAlacodigo()] = $row->getAladescricao();
            }
        }
        return $arrOptions;
    }
}