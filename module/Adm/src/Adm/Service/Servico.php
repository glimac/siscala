<?php

namespace Adm\Service;

use Doctrine\ORM\EntityManager;

class Servico extends \Adm\Service\AbstractService
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'Adm\Entity\Servico';
    }

    public function buscaEscala12hPorMes($mes)
    {
        $repo = $this->em->getRepository($this->entity);
        $dql    = $repo->buscaEscala12hPorMes($mes);
//        $query  = $this->em->createQuery($dql);
//        $result = $query->getResult();
//        \Zend\Debug\Debug::dump($dql);
//        exit();
        if(!$result){
            throw new \Application\Service\Exception\ServiceException('MSG11');
        }

        return $result;
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
