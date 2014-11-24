<?php

namespace Adm\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\AbstractController;

use Adm\Form\Servico;

class ServicoController extends AbstractController
{
    public function indexAction()
    {
        $form            = new Servico();

        return new ViewModel(array('form' => $form));
    }

    public function trocarAction()
    {
        return new ViewModel();
    }
}
