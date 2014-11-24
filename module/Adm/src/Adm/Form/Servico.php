<?php

namespace Adm\Form;

use Zend\Form\Form;

class Servico extends Form
{
    public function __construct($param = null, $options = array())
    {
        parent::__construct('servico', $options);

//        $this->setInputFilter(new ServicoFilter());
        $this->setAttributes(array(
            'method'      => 'post',
            'class'       => 'form-horizontal',
            'role'        => 'form'
            ));

        $milmatricula = new \Zend\Form\Element\Text('milmatricula');
        $milmatricula->setAttributes(array(
            'id'          => 'milmatricula',
            'class'       => 'medium'
        ));
        $this->add($milmatricula);

        $pesquisar = new \Zend\Form\Element\Submit('pesquisar');
        $pesquisar->setAttributes(array(
            'value'       => 'Pesquisar',
            'id'          => 'Pesquisar',
            'class'       => 'btn btn-primary'
        ));
        $this->add($pesquisar);
    }
}