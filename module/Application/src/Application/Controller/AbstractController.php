<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Application\Message\Message;

abstract class AbstractController extends AbstractActionController
{
    use Message;

    protected $translator;

    protected function translate($message)
    {
        if (!$this->translator) {
            $this->translator = $this->getServiceLocator()->get('translator');
        }
        return $this->translator->translate($message);
    }

    /**
     * Add a message with "error" type
     *
     * @param  string         $message
     * @return FlashMessenger
     */
    public function addErrorMessage($message)
    {
        return $this->flashMessenger()->addErrorMessage($this->translate($message));
    }

    /**
     * Add a message with "success" type
     *
     * @param  string         $message
     * @return FlashMessenger
     */
    public function addSuccessMessage($message)
    {
        return $this->flashMessenger()->addSuccessMessage($this->translate($message));
    }

    /**
     * Add a message with "info" type
     *
     * @param  string         $message
     * @return FlashMessenger
     */
    public function addInfoMessage($message)
    {
        return $this->flashMessenger()->addInfoMessage($this->translate($message));
    }
}