<?php

namespace Acl;

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

    public function onBootstrap(MvcEvent $e)
    {
        $translator = $e->getApplication()->getServiceManager()->get('translator');

        $moduleManager = $e->getApplication()->getServiceManager()->get('modulemanager');
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach('Zend\Mvc\Controller\AbstractController', MvcEvent::EVENT_DISPATCH, array($this, 'controllerDispatch'), -100);
    }


    /**
     * @param MvcEvent $e
     * @return null|\Zend\Http\PhpEnvironment\Response
     */
    public function controllerDispatch(MvcEvent $e)
    {
        $application = $e->getParam('application');

        $locator     = $e->getTarget()->getServiceLocator();
        $controller  = $e->getTarget();

        $route    = $e->getTarget()->getEvent()->getRouteMatch()->getParams();

        $em = $locator->get('Doctrine\ORM\EntityManager');

        $repoRole = $em->getRepository("Acl\Entity\Role");
        $roles    = $repoRole->findAll();

        $repoResource = $em->getRepository("Acl\Entity\Resource");
        $resources    = $repoResource->findAll();

        $repoPrivilege = $em->getRepository("Acl\Entity\Privilege");
        $privileges    = $repoPrivilege->findAll();

        $acl = new Permissions\Acl($roles,$resources,$privileges);
        //NOME DA ROTA PARA BLOQUEIO
//        var_dump($route);exit;
        $validarAcl = $acl->verificarAcesso($route);

        if (!$validarAcl['status']) {
            $controller->flashMessenger()->addErrorMessage($validarAcl['msg']);
            $controller->plugin('redirect')->toRoute('autenticacao');
        }

    }

    public function getServiceConfig()
    {

        return array(
          'factories' => array(
              'Acl\Form\Role' => function($sm){
                $em   = $sm->get('Doctrine\ORM\EntityManager');
                $repo = $em->getRepository('Acl\Entity\Role');
                $parent = $repo->fetchParent();

                return new Form\Role('role',$parent);
              },
              'Acl\Form\Privilege' => function($sm){
                $em = $sm->get('Doctrine\ORM\EntityManager');
                $repoRoles = $em->getRepository('Acl\Entity\Role');
                $roles = $repoRoles->fetchParent();

                $repoResources = $em->getRepository('Acl\Entity\Resource');
                $resources = $repoResources->fetchPairs();

                return new Form\Privilege("privilege", $roles, $resources);
              },
              'Acl\Service\Role' => function($sm){
                return new Service\Role($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'Acl\Service\Resource' => function($sm){
                return new Service\Resource($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'Acl\Service\Privilege' => function($sm){
                return new Service\Privilege($sm->get('Doctrine\ORM\Entitymanager'));
              },
              'Acl\Permissions\Acl' => function($sm){
                  $em = $sm->get('Doctrine\ORM\EntityManager');

                  $repoRole = $em->getRepository("Acl\Entity\Role");
                  $roles = $repoRole->findAll();

                  $repoResource = $em->getRepository("Acl\Entity\Resource");
                  $resources = $repoResource->findAll();

                  $repoPrivilege = $em->getRepository("Acl\Entity\Privilege");
                  $privileges = $repoPrivilege->findAll();

                  return new Permissions\Acl($roles,$resources,$privileges);
              }
          )
        );

    }

}
