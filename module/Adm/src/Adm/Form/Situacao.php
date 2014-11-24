<?php

namespace Adm\Form;

use Zend\Form\Form;

class Situacao extends Form
{
    public function __construct($param = null, $options = array())
    {
        parent::__construct('situacao', $options);

        $this->setInputFilter(new SituacaoFilter());
        $this->setAttributes(array(
            'method'      => 'post',
            'class'       => 'form-horizontal',
            'role'        => 'form'
            ));

        $milmatricula = new \Zend\Form\Element\Text('milmatricula');
        $milmatricula->setAttributes(array(
            'id'          => 'milmatricula',
            'class'       => 'small',
        ));
        $this->add($milmatricula);

        $milnomeguerra = new \Zend\Form\Element\Text('milnomeguerra');
        $milnomeguerra->setAttributes(array(
            'id'          => 'milnomeguerra',
            'class'       => 'small',
        ));
        $this->add($milnomeguerra);

        $milcodigo = new \Zend\Form\Element\Hidden('milcodigo');
        $milcodigo->setAttributes(array(
            'id'          => 'milcodigo',
        ));
        $this->add($milcodigo);

        $tpscodigo = new \Zend\Form\Element\Select('tpscodigo');
        $tpscodigo->setValueOptions($this->comboTipoSituacao($param['listaTipoSituacao']));
        $tpscodigo->setAttributes(array(
            'id'          => 'tpscodigo',
        ));
        $this->add($tpscodigo);

        $sitdatainicio = new \Zend\Form\Element\Text('sitdatainicio');
        $sitdatainicio->setAttributes(array(
            'id'          => 'sitdatainicio',
            'class'       => 'data date medium',
        ));
        $this->add($sitdatainicio);

        $sitdatafim = new \Zend\Form\Element\Text('sitdatafim');
        $sitdatafim->setAttributes(array(
            'id'          => 'sitdatafim',
            'class'       => 'data date medium',
        ));
        $this->add($sitdatafim);

        $salvar = new \Zend\Form\Element\Submit('salvar');
        $salvar->setAttributes(array(
            'value'       => 'Salvar',
            'id'          => 'salvar',
            'class'       => 'btn btn-primary'
        ));
        $this->add($salvar);

    }

    public function comboTipoSituacao($param)
    {
        $arrOptions = array();
        $arrOptions['']= '-- Selecione --';
        if ($param) {
            foreach ($param as $row) {
                $arrOptions[$row->getTpscodigo()] = $row->getTpsdescricao();
            }
        }
        return $arrOptions;
    }
}