<?php

namespace Adm\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

use Adm\Form\Militar;
use Adm\Form\Situacao;

class MilitarController extends AbstractController
{

    public function indexAction()
    {
        $serviceMilitar  = $this->getServiceLocator()->get('Militar');
        $result          = $serviceMilitar->findAll();

        $form            = new Militar();

        return new ViewModel(array('form' => $form, 'result' => $result));
    }

    public function cadastrarAction()
    {
        $request               = $this->getRequest();
        $serviceMilitar        = $this->getServiceLocator()->get('Militar');
        $servicePostoGraduacao = $this->getServiceLocator()->get('PostoGraduacao');
        $serviceRole           = $this->getServiceLocator()->get('Role');
        $serviceQuadro         = $this->getServiceLocator()->get('Quadro');

        $option['listaPostoGraduacao'] = $servicePostoGraduacao->findAll();
        $option['listaRole']           = $serviceRole->findAll();
        $option['listaQuadro']         = $serviceQuadro->findAll();

        $form                  = new Militar($option);
        $form->setValidationGroup('milnome', 'milnomeguerra', 'milidt', 'milcpf', 'milmatricula', 'mildtnascimento', 'miltelefone',
                                  'milendereco', 'milemail', 'pgrcodigo', 'roleid', 'quacodigo');

        if ($request->isPost()) {

            $arrData = $request->getPost()->toArray();

            $form->setData($request->getPost());
            if ($form->isValid()) {

                try {
                    $result = $serviceMilitar->insert($arrData);
                    if ($result) {
                        $this->addSuccessMessage($this->MSG2);
                    }
                } catch (\Adm\Service\Exception\ServiceException $e) {
                    $this->addErrorMessage($e->getMessage());
                }
                return $this->redirect()->toRoute('adm/default', array('controller' => 'militar', 'action' => 'index'));
            } else {
                $form->populateValues($arrData);
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function atualizarAction()
    {
        $id                    = $this->params('id');
        $serviceMilitar        = $this->getServiceLocator()->get('Militar');
        $servicePostoGraduacao = $this->getServiceLocator()->get('PostoGraduacao');
        $serviceRole           = $this->getServiceLocator()->get('Role');
        $serviceQuadro         = $this->getServiceLocator()->get('Quadro');

        $option['listaPostoGraduacao'] = $servicePostoGraduacao->findAll();
        $option['listaRole']           = $serviceRole->findAll();
        $option['listaQuadro']         = $serviceQuadro->findAll();

        $form = new Militar($option);
        $form->setValidationGroup('milnome', 'milnomeguerra', 'milidt', 'milcpf', 'milmatricula', 'mildtnascimento', 'miltelefone',
                                  'milendereco', 'milemail', 'pgrcodigo', 'roleid', 'quacodigo');

        if ($id) {
            $entity = $serviceMilitar->find($id);
            $array  = $entity->toArray();
            $array['mildtnascimento'] = implode('/', array_reverse(explode('-', $array['mildtnascimento'])));
            $form->setData($array);
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $arrData = $request->getPost()->toArray();

            $form->setData($arrData);
            if ($form->isValid()) {
                $result = $serviceMilitar->update($arrData,$arrData['milcodigo']);

                if ($result) {
                    $this->addSuccessMessage($this->MSG2);
                } else {
                    $this->addErrorMessage($this->MSG3);
                }
                return $this->redirect()->toRoute('adm/default', array('controller' => 'militar', 'action' => 'index'));
            }
        }
        return new ViewModel(array('form'=> $form));
    }

    public function excluirAction()
    {
        $serviceMilitar = $this->getServiceLocator()->get('Militar');

        if ($this->params('id')) {
            try {
                $serviceMilitar->delete($this->params('id'));
                $this->flashMessenger()->addSuccessMessage($this->MSG2);
            } catch (\Adm\Service\Exception\ServiceException $e) {
                $this->flashMessenger()->addErrorMessage($this->MSG3);
            }

            return $this->redirect()->toRoute('adm/default', array('controller' => 'militar', 'action' => 'index'));
        }
    }

    public function ajaxMilitarAction()
    {
        $matricula      = $this->params()->fromPost('matricula');
        $serviceMilitar = $this->getServiceLocator()->get('Militar');

        $result  = $serviceMilitar->findBy(array('milmatricula' => $matricula));

        $viewModel = new ViewModel(array('result'=> $result));
        return $viewModel->setTerminal(true);
    }

    public function situacaoAction()
    {
        $serviceMilitar      = $this->getServiceLocator()->get('Militar');
        $serviceSituacao     = $this->getServiceLocator()->get('Situacao');
        $serviceTipoSituacao = $this->getServiceLocator()->get('TipoSituacao');

        $resultMilitar       = $serviceMilitar->findAll();
        $resultSituacao      = $serviceSituacao->findAll();
        $resultTipoSituacao  = $serviceTipoSituacao->findAll();

        return new ViewModel(array(
            'resultSituacao'        => $resultSituacao,
            'resultTipoSituacao'    => $resultTipoSituacao,
            'resultMilitar'         => $resultMilitar
        ));
    }

    public function cadastrarSituacaoAction()
    {
        $request             = $this->getRequest();
        $serviceTipoSituacao = $this->getServiceLocator()->get('TipoSituacao');
        $serviceSituacao     = $this->getServiceLocator()->get('Situacao');

        $resultTipoSituacao  = $serviceTipoSituacao->findAll();

        $form = new Situacao(array('listaTipoSituacao' => $resultTipoSituacao));

        if ($request->isPost()) {

            $arrData = $request->getPost()->toArray();

            $form->setData($request->getPost());
            if ($form->isValid()) {

                try {
                    $result = $serviceSituacao->insert($arrData);
                    if ($result) {
                        $this->addSuccessMessage($this->MSG2);
                    }
                } catch (\Adm\Service\Exception\ServiceException $e) {
                    $this->addErrorMessage($e->getMessage());
                }
                return $this->redirect()->toRoute('adm/default', array('controller' => 'militar', 'action' => 'situacao'));
            } else {
                $form->populateValues($arrData);
            }
        }

        return new ViewModel(array('form'=> $form));
    }

    public function removerSituacaoAction()
    {
        $serviceSituacao = $this->getServiceLocator()->get('Situacao');

        if ($this->params('id')) {
            try {
                $serviceSituacao->delete($this->params('id'));
                $this->flashMessenger()->addSuccessMessage($this->MSG2);
            } catch (\Adm\Service\Exception\ServiceException $e) {
                $this->flashMessenger()->addErrorMessage($this->MSG3);
            }

            return $this->redirect()->toRoute('adm/default', array('controller' => 'militar', 'action' => 'situacao'));
        }
    }

}
