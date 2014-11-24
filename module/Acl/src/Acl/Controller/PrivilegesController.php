<?php

namespace Acl\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

class PrivilegesController extends AbstractController
{

    public function __construct() {
        $this->entity     = "Acl\Entity\Privilege";
        $this->service    = "Acl\Service\Privilege";
        $this->form       = "Acl\Form\Privilege";
        $this->controller = "privileges";
        $this->route      = "acl/default";
    }

    public function indexAction() {

        $list = $this->getServiceLocator()->get($this->service);

        $page = $this->params()->fromRoute('page');

        $paginator = new Paginator(new ArrayAdapter($list->findAll()));
        $paginator->setCurrentPageNumber($page)
                  ->setDefaultItemCountPerPage(10);

        return new ViewModel(array('data'=> $paginator, 'page'=>$page));

    }
 
    public function newAction()
    {
        $form = $this->getServiceLocator()->get('Acl\Form\Privilege');
        $request = $this->getRequest();

        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                if ($service->insert($request->getPost()->toArray())) {
                    $this->flashMessenger()->addSuccessMessage($this->MSG2);
                } else {
                    $this->flashMessenger()->addErrorMessage($this->MSG3);
                }
                return $this->redirect()->toRoute($this->route,array('controller' => $this->controller));
            }
        }

        return new ViewModel(array('form' => $form));
    }

    public function editAction()
    {
        $form = $this->getServiceLocator()->get('Acl\Form\Privilege');
        $request = $this->getRequest();

        $serPrivilege = $this->getServiceLocator()->get($this->service);
        $entity = $serPrivilege->find($this->params()->fromRoute('id',0));

        if($this->params()->fromRoute('id',0))
            $form->setData($entity->toArray());

        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                if ($serPrivilege->update($request->getPost()->toArray())) {
                    $this->flashMessenger()->addSuccessMessage($this->MSG2);
                } else {
                    $this->flashMessenger()->addErrorMessage($this->MSG3);
                }
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
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
}
