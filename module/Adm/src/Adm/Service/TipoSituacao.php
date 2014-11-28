<?php

namespace Adm\Service;

use Doctrine\ORM\EntityManager;

class TipoSituacao extends \Adm\Service\AbstractService
{

    const TPS_PRONTO = 1;

        public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'Adm\Entity\TipoSituacao';
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
    }
    /**
     * Efetua validações e verificações antes de executar o update
     */
    protected function preUpdate()
    {
    }
}
