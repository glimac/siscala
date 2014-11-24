<?php

namespace Acl\Form;

use Zend\Form\Form;

class Privilege extends Form {

    protected $roles;
    protected $resources;

    public function __construct($name = null, array $roles = null, array $resources = null) {
        parent::__construct($name);
        $this->roles = $roles;
        $this->resources = $resources;

        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setAttribute('placeholder', "Entre com o nome");
        $this->add($nome);

        $role = new \Zend\Form\Element\Select('role');
        $role->setName("role")
                ->setOptions(array('value_options' => $roles));
        $this->add($role);

        $resource = new \Zend\Form\Element\Select('resource');
        $resource->setName("resource")
                ->setOptions(array('value_options' => $resources));
        $this->add($resource);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn-success'
            )
        ));


    }

}
