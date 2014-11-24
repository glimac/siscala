<?php

namespace Autenticacao\Form;

use Zend\Form\Form;
use Zend\Captcha\Image as Captcha;

class Autenticacao extends Form
{
    public function __construct($name = null, $options = null, $urlCaptcha = null) {

        parent::__construct('usuario', $options);
        if (!$name) {
            $this->setInputFilter(new AutenticacaoFilter());
        }
        $this->setAttributes(array(
            'method'      => 'post',
            'class'       => 'form-signin',
            'id'          => 'login',
            'role'        => 'form'
        ));

        $milcodigo = new \Zend\Form\Element\Hidden("milcodigo");
        $milcodigo->setValue($options['milcodigo']);
        $this->add($milcodigo);

        $role = new \Zend\Form\Element\Select("role");
        $role->setOptions(array('value_options' => $options['roles']))
               ->setAttributes(array('class' => 'form-control'));
        $this->add($role);

        $milmatricula = new \Zend\Form\Element\Text("milmatricula");
        $milmatricula->setAttributes(array(
            'placeholder' => 'matrícula',
            'id'          => 'username',
            'title'       => 'Entre com a matrícula',
            'class'       => 'password tip-stay validate'));
        $this->add($milmatricula);

        $milemail = new \Zend\Form\Element\Text("milemail");
        $milemail->setAttributes(array('placeholder' => 'Entre com o email do militar',
                                   'class'       => 'form-control'));
        $this->add($milemail);

        $milpassword = new \Zend\Form\Element\Password("milpassword");
        $milpassword->setAttributes(array(
            'placeholder' => 'senha',
            'id'          => 'password',
            'title'       => 'Entre com a senha',
            'class'       => 'password tip-stay validate'));
        $this->add($milpassword);

        $confirmation = new \Zend\Form\Element\Password("confirmation");
        $confirmation->setAttributes(array('placeholder' => 'Redigite a senha',
                                           'class'       => 'form-control'));
        $this->add($confirmation);

        $dirdata = './data';
        //pass captcha image options
        $captchaImage = new Captcha( array(
                'font' => $dirdata . '/fonts/ARLRDBD.TTF',
                'width' => 200,
                'height' => 100,
                'dotNoiseLevel' => 40,
                'lineNoiseLevel' => 3)
        );
        $captchaImage->setImgDir($dirdata.'/captcha');
        $captchaImage->setImgUrl($urlCaptcha);

        //add captcha element...
        $this->add(array(
            'type' => 'Zend\Form\Element\Captcha',
            'name' => 'captcha',
            'options' => array(
                'label'   => '',
                'captcha' => $captchaImage,
            ),
            'attributes' => array(
                'class'  => 'form-control span8',
//                'style'  => 'z-index: -1px;'
            ),
        ));

        $btnCadastra = new \Zend\Form\Element\Submit("Cadastrar");
        $btnCadastra->setAttributes(array('value' => 'Cadastrar',
                                          'class' => 'btn btn-lg btn-login btn-block'));
        $this->add($btnCadastra);

        $btnEntrar = new \Zend\Form\Element\Submit("Entrar");
        $btnEntrar->setAttributes(array(
            'value' => 'Entrar',
            'class' => 'tip'));
        $this->add($btnEntrar);
    }

}
