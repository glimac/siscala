<?php

namespace Acl\Permissions;

use Zend\Permissions\Acl\Acl as ClassAcl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

class Acl extends ClassAcl
{

    protected $roles;
    protected $resources;
    protected $privileges;
    protected $validaAcessoControllerAction;

    public function __construct(array $roles, array $resources, array $privileges)
    {
        $this->roles = $roles;
        $this->resources = $resources;
        $this->privileges = $privileges;

        $this->loadRoles();
        $this->loadResources();
        $this->loadPrivileges();
    }

    protected function loadRoles()
    {
        foreach($this->roles as $role)
        {
            if ($role->getParent()) {
                VAR_DUMP($role->getParent()->getNome());

                $this->addRole(new Role($role->getNome()), new Role($role->getParent()->getNome()));
            } else {
                $this->addRole (new Role($role->getNome()));
            }
            if ($role->getIsAdmin()) {
                $this->allow($role->getNome(),array(),array());
            }
        }
    }

    protected function loadResources()
    {
        foreach($this->resources as $resource)
        {
            $this->addResource(new Resource($resource->getNome()));
        }
    }

    protected function loadPrivileges()
    {
        foreach($this->privileges as $privilege)
        {
            $this->allow($privilege->getRole()->getNome(), $privilege->getResource()->getNome(),$privilege->getNome());
        }
    }

    protected function validarPrivileges($controller, $action)
    {
        foreach($this->privileges as $privilege)
        {
            $arrPrivilege[] = strtolower($privilege->getResource()->getNome().'\\'.$privilege->getNome());
        }

        $routeAtual = strtolower($controller.'\\'.$action);
        return in_array($routeAtual, $arrPrivilege);
    }

    public function Identity()
    {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage("Usuario"));
        return $usuario = $auth->getIdentity();
    }

    public function verificarAcesso($route)
    {
//        var_Dump($route);exit;
        $usuario = $this->Identity();

        //Validar se a route e private
        if ($this->validarPrivileges($route['controller'], $route['action'])) {
            //Validar se o usuario esta logado
            if (!$usuario) {
                return array('status' => false, 'msg' => 'Usuário não autenticado');
            } else {
                //Validar se o usuario tem acesso a route
                if ($this->isAllowed($usuario[0]['perfil'], $route['controller'], $route['action'])) {
                    return array('status' => true);
                } else {
                    return array('status' => false, 'msg' => 'Usuário não tem acesso');
                }
            }
        } else {
            return array('status' => true);
        }
    }

}
