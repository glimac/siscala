<?php

namespace Acl\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

class RolesController extends AbstractController
{

    public function __construct() {
        $this->entity     = "Acl\Entity\Role";
        $this->service    = "Acl\Service\Role";
        $this->form       = "Acl\Form\Role";
        $this->controller = "roles";
        $this->route      = "acl/default";
    }

    public function indexAction()
    {
        $list = $this->getServiceLocator()->get($this->service);

        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list->findAll()));
        $paginator->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage(20);
        return new ViewModel(array('data'=> $paginator, 'page'=>$page));
    }

    public function newAction()
    {
        $form = $this->getServiceLocator()->get('Acl\Form\Role');
        $request = $this->getRequest();

        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                if ($service->insert($request->getPost()->toArray())){
                    $this->flashMessenger()->addSuccessMessage($this->MSG2);
                } else {
                    $this->flashMessenger()->addSuccessMessage($this->MSG3);
                }
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }

        return new ViewModel(array('form'=>$form));
    }

    public function editAction()
    {
        $form    = $this->getServiceLocator()->get('Acl\Form\Role');
        $request = $this->getRequest();

        $repository = $this->getServiceLocator()->get($this->service);
        $entity     = $repository->find($this->params()->fromRoute('id',0));

        if($this->params()->fromRoute('id',0))
            $form->setData($entity->toArray());

        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());

                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }

        return new ViewModel(array('form' => $form));
    }

    public function deleteAction()
    {
        $service = $this->getServiceLocator()->get($this->service);
        if ($service->delete($this->params()->fromRoute('id',0))) {
            $this->flashMessenger()->addSuccessMessage($this->MSG2);
        } else {
            $this->flashMessenger()->addErrorMessage($this->MSG3);
        }
        return $this->redirect()->toRoute($this->route,array('controller' => $this->controller));
    }

    public function testeAction()
    {
        $acl = $this->getServiceLocator()->get("Acl\Permissions\Acl");
        $acl->validaAcessoControllerAction();exit;
    }
}
