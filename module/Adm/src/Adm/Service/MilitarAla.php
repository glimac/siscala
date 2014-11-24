<?php

namespace Adm\Service;

use Doctrine\ORM\EntityManager;

class MilitarAla extends \Adm\Service\AbstractService
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'Adm\Entity\MilitarAla';
    }

    /**
     * Efetua validações e verificações antes de executar o save
     */
    protected function preSave()
    {
    }

    /**
     * Efetua validações e verificações antes de executar o insert
     */
    protected function preInsert()
    {
        $arrFk['Adm\Entity\Militar'] = array('setMilcodigo' => $this->saveData['milcodigo']);
        $arrFk['Adm\Entity\Ala']     = array('setAlacodigo' => $this->saveData['alacodigo']);
        $this->saveObject = $arrFk;
    }
    /**
     * Efetua validações e verificações antes de executar o update
     */
    protected function preUpdate()
    {
    }
}
