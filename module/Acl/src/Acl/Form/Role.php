<?php

namespace Acl\Form;

use Zend\Form\Form,
    Zend\Form\Element\Select;

class Role extends Form {

    protected $parent;

    public function __construct($name = null, array $parent = null) {
        parent::__construct('roles');
        $this->parent  = $parent;

        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setAttribute('placeholder', "Entre com o nome");
        $this->add($nome);

        $parent = new \Zend\Form\Element\Select('parent');
        $parent->setName("parent")
                ->setOptions(array('value_options' => $this->parent));
        $this->add($parent);

        $isAdmin = new \Zend\Form\Element\Checkbox("isAdmin");
        $this->add($isAdmin);

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
