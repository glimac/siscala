<?php

namespace Adm;

use Zend\Mvc\MvcEvent;

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
              'Militar' => function($sm){
                  return new \Adm\Service\Militar($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'PostoGraduacao' => function($sm){
                  return new \Adm\Service\PostoGraduacao($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'Ala' => function($sm){
                  return new \Adm\Service\Ala($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'Escala' => function($sm){
                  return new \Adm\Service\Escala($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'MilitarAla' => function($sm){
                  return new \Adm\Service\MilitarAla($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'Situacao' => function($sm){
                  return new \Adm\Service\Situacao($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'TipoSituacao' => function($sm){
                  return new \Adm\Service\TipoSituacao($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'Role' => function($sm){
                  return new \Acl\Service\Role($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'Servico' => function($sm){
                  return new \Adm\Service\Servico($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'Quadro' => function($sm){
                  return new \Adm\Service\Quadro($sm->get('Doctrine\ORM\Entitymanager'));
              },
          )
        );

    }
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(
                'FormataCpfCnpj' => function($sm) {
                    return new View\Helper\FormataCpfCnpj();
                },
                'FormataData' => function($sm) {
                    return new View\Helper\FormataData();
                }

            ),
            'invokables' => array(
                'formelementerrors' => 'Adm\View\Helper\FormElementErrors'
            ),
        );
    }

}
