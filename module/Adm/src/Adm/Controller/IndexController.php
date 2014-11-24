<?php

namespace Adm\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\AbstractController;

class IndexController extends AbstractController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
