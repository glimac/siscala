<?php

namespace Adm\Form;

use Zend\Form\Form;

class Militar extends Form
{
    public function __construct($param = null, $options = array())
    {
        parent::__construct('militar', $options);

        $this->setInputFilter(new MilitarFilter());
        $this->setAttributes(array(
            'method'      => 'post',
            'class'       => 'form-horizontal',
            'role'        => 'form'
            ));

        $milcodigo = new \Zend\Form\Element\Hidden('milcodigo');
        $milcodigo->setAttributes(array(
            'id'          => 'milcodigo',
        ));
        $this->add($milcodigo);

        $milroleid = new \Zend\Form\Element\Hidden('roleid');
        $milroleid->setAttributes(array(
            'id'          => 'milroleid',
            'value'       => 2
        ));
        $this->add($milroleid);

        $milnome = new \Zend\Form\Element\Text('milnome');
        $milnome->setAttributes(array(
            'id'          => 'milnome',
            'class'       => 'big'
        ));
        $this->add($milnome);

        $milnomeguerra = new \Zend\Form\Element\Text('milnomeguerra');
        $milnomeguerra->setAttributes(array(
            'id'          => 'milnomeguerra',
            'class'       => 'big'

        ));
        $this->add($milnomeguerra);

        $milpgrcodigo = new \Zend\Form\Element\Select('pgrcodigo');
        $milpgrcodigo->setValueOptions($this->comboPostoGraduacao($param['listaPostoGraduacao']));
        $milpgrcodigo->setAttributes(array(
            'id'          => 'milpgrcodigo',
        ));
        $this->add($milpgrcodigo);

        $roleid = new \Zend\Form\Element\Select('roleid');
        $roleid->setValueOptions($this->comboRole($param['listaRole']));
        $roleid->setAttributes(array(
            'id'          => 'roleid',
        ));
        $this->add($roleid);

        $quacodigo = new \Zend\Form\Element\Select('quacodigo');
        $quacodigo->setValueOptions($this->comboQuadro($param['listaQuadro']));
        $quacodigo->setAttributes(array(
            'id'          => 'quacodigo',
        ));
        $this->add($quacodigo);

        $milcpf = new \Zend\Form\Element\Text('milcpf');
        $milcpf->setAttributes(array(
            'id'          => 'milcpf',
            'class'       => 'small cpf'
        ));
        $this->add($milcpf);

        $milidt = new \Zend\Form\Element\Text('milidt');
        $milidt->setAttributes(array(
            'id'          => 'milidt',
            'class'       => 'small'
        ));
        $this->add($milidt);

        $milmatricula = new \Zend\Form\Element\Text('milmatricula');
        $milmatricula->setAttributes(array(
            'id'          => 'milmatricula',
            'class'       => 'small'
        ));
        $this->add($milmatricula);

        $mildtnascimento = new \Zend\Form\Element\Text('mildtnascimento');
        $mildtnascimento->setAttributes(array(
            'id'          => 'mildtnascimento',
            'class'       => 'data date small'
        ));
        $this->add($mildtnascimento);

        $miltelefone = new \Zend\Form\Element\Text('miltelefone');
        $miltelefone->setAttributes(array(
            'id'          => 'miltelefone',
            'class'       => 'telefone small'
        ));
        $this->add($miltelefone);

        $miltelefonesec = new \Zend\Form\Element\Text('miltelefonesec');
        $miltelefonesec->setAttributes(array(
            'id'          => 'miltelefonesec',
            'class'       => 'telefone small'
        ));
        $this->add($miltelefonesec);

        $milendereco = new \Zend\Form\Element\Text('milendereco');
        $milendereco->setAttributes(array(
            'id'          => 'milendereco',
            'class'       => 'big'
        ));
        $this->add($milendereco);

        $milemail = new \Zend\Form\Element\Email('milemail');
        $milemail->setAttributes(array(
            'id'          => 'milemail',
            'class'       => 'big email'
        ));
        $this->add($milemail);

        $milemailsec = new \Zend\Form\Element\Email('milemailsec');
        $milemailsec->setAttributes(array(
            'id'          => 'milemailsec',
            'class'       => 'big email'
        ));
        $this->add($milemailsec);

        $salvar = new \Zend\Form\Element\Submit('salvar');
        $salvar->setAttributes(array(
            'value'       => 'Salvar',
            'id'          => 'salvar',
            'class'       => 'btn btn-primary'
        ));
        $this->add($salvar);

        $confirmacao = new \Zend\Form\Element\Button('confirmacao');
        $confirmacao->setLabel('Ok');
        $confirmacao->setAttributes(array(
            'id'          => 'confirmacao',
            'class'       => 'btn btn-primary'
        ));
        $this->add($confirmacao);
    }

    public function comboPostoGraduacao($param)
    {
        $arrOptions = array();
        $arrOptions['']= '-- Selecione --';
        if ($param) {
            foreach ($param as $row) {
                $arrOptions[$row->getPgrcodigo()] = $row->getPgrsigla();
            }
        }
        return $arrOptions;
    }

    public function comboRole($param)
    {
        $arrOptions = array();
        $arrOptions['']= '-- Selecione --';
        if ($param) {
            foreach ($param as $row) {
                $arrOptions[$row->getId()] = $row->getNome();
            }
        }
        return $arrOptions;
    }

    public function comboQuadro($param)
    {
        $arrOptions = array();
        $arrOptions['']= '-- Selecione --';
        if ($param) {
            foreach ($param as $row) {
                $arrOptions[$row->getQuacodigo()] = $row->getQuadescricao();
            }
        }
        return $arrOptions;
    }
}