<?php

namespace Adm\Controller;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

use Adm\Form\Ala;

class AlaController extends AbstractController
{

    public function indexAction()
    {
        $serviceMilitarAla  = $this->getServiceLocator()->get('MilitarAla');
        $serviceEscala      = $this->getServiceLocator()->get('Escala');
        $serviceAla         = $this->getServiceLocator()->get('Ala');

        $resultMilitarAla   = $serviceMilitarAla->findAll();
        $resultEscala       = $serviceEscala->findAll();
        $resultAla          = $serviceAla->findAll();

        return new ViewModel(array('resultAla' => $resultAla, 'resultMilitarAla' => $resultMilitarAla, 'resultEscala' => $resultEscala));
    }

    public function associarMilitarAction()
    {
        $request            = $this->getRequest();
        $serviceAla         = $this->getServiceLocator()->get('Ala');
        $serviceMilitarAla  = $this->getServiceLocator()->get('MilitarAla');

        $alas = $serviceAla->findBy(array('esccodigo' => $this->params('id')));

        $form                  = new Ala(array('listaAla' => $alas));
        $form->setValidationGroup('alacodigo', 'milmatricula');

        if ($request->isPost()) {

            $arrData = $request->getPost()->toArray();

            $form->setData($request->getPost());
            if ($form->isValid()) {

                try {
                    $result = $serviceMilitarAla->insert($arrData);
                    if ($result) {
                        $this->addSuccessMessage($this->MSG2);
                    }
                } catch (\Adm\Service\Exception\ServiceException $e) {
                    $this->addErrorMessage($this->MSG3);
                }
                return $this->redirect()->toRoute('adm/default', array('controller' => 'ala', 'action' => 'index'));
            } else {
                $form->populateValues($arrData);
            }
        }
        return new ViewModel(array('form' => $form, 'result' => $alas));
    }

    public function excluirAction()
    {
        $serviceMilitarAla = $this->getServiceLocator()->get('MilitarAla');

        if ($this->params('id')) {
            try {
                $serviceMilitarAla->delete($this->params('id'));
                $this->flashMessenger()->addSuccessMessage($this->MSG2);
            } catch (\Adm\Service\Exception\ServiceException $e) {
                $this->flashMessenger()->addErrorMessage($this->MSG3);
            }

            return $this->redirect()->toRoute('adm/default', array('controller' => 'ala', 'action' => 'index'));
        }
    }

}
