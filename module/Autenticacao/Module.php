<?php

namespace Autenticacao;

use Zend\Mvc\MvcEvent;
use Autenticacao\Auth\Adapter as AuthAdapter;

class Module
{

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
          'factories' => array(
              'Autenticacao\Service\Autenticacao' => function($sm) {
                  return new Service\Autenticacao($sm->get('Doctrine\ORM\EntityManager'));
              },
              'Autenticacao\Auth\Adapter' => function($sm){
                  return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
              },
           )
        );
    }

    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
                'UsuarioIdentity' => new View\Helper\UsuarioIdentity()
            )
        );
    }

}
