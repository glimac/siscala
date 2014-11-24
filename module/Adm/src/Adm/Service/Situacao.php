<?php

namespace Adm\Service;

use Doctrine\ORM\EntityManager;

class Situacao extends \Adm\Service\AbstractService
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'Adm\Entity\Situacao';
    }

    /**
     * Efetua validações e verificações antes de executar o save
     */
    protected function preSave()
    {
        $arrFk['Adm\Entity\TipoSituacao'] = array('setTpscodigo' => $this->saveData['tpscodigo']);
        $arrFk['Adm\Entity\Militar']      = array('setMilcodigo' => $this->saveData['milcodigo']);
        $this->saveObject = $arrFk;

        $this->saveData['sitdatainicio'] = implode('-', array_reverse(explode('/', $this->saveData['sitdatainicio'])));
        $this->saveData['sitdatafim']    = implode('-', array_reverse(explode('/', $this->saveData['sitdatafim'])));

//        \Zend\Debug\Debug::dump($this->saveData);
//        exit();
    }

    /**
     * Efetua validações e verificações antes de executar o insert
     */
    protected function preInsert()
    {
    }
    /**
     * Efetua validações e verificações antes de executar o update
     */
    protected function preUpdate()
    {
    }
}
