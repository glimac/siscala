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

//	public function __construct($param = null, $options = array())
//    {
//        parent::__construct('ala', $options);
//
////        $this->setInputFilter(new ServicoFilter());
//        $this->setAttributes(array(
//            'method'      => 'post',
//            'class'       => 'form-horizontal',
//            'role'        => 'form'
//            ));
//
//        $servico = new \Zend\Form\Element\Select('servico[]');
//        $servico->setValueOptions(array(
//            1 => 'SIM',
//            2 => 'NÃO'
//        ));
//        $servico->setAttributes(array(
//            'id'          => 'servico',
//        ));
//        $this->add($servico);
//
//        $serboletim = new \Zend\Form\Element\Text('serboletim');
//        $serboletim->setAttributes(array(
//            'id'          => 'serboletim',
//            'class'       => 'medium'
//        ));
//        $this->add($serboletim);
//
//        $salvar = new \Zend\Form\Element\Submit('salvar');
//        $salvar->setAttributes(array(
//            'value'       => 'Salvar',
//            'id'          => 'salvar',
//            'class'       => 'btn btn-primary'
//        ));
//        $this->add($salvar);
//
//    }
}