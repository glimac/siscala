<?php

namespace Application\Controller;

//use Zend\Mvc\Controller\AbstractActionController;
use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        $serviceServico = $this->getServiceLocator()->get('Servico');

        $rsDatasServico     = $serviceServico->buscaDatasServico(date('m'));
        $rsMilitaresServico = $serviceServico->buscaEscala12h(date('m'));

        return new ViewModel(array('militaresServico' => $rsMilitaresServico, 'datasServico' => $rsDatasServico));
    }
}
