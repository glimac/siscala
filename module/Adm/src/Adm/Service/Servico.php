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

    public function buscaDatasServico($mes = null)
    {
        $entity = $this->em->getRepository($this->entity);

        $periodoMesAtual = $this->montaDatasInicioEFimMesPorMes($mes);

        $dql         = $entity->buscaDatasServicoPorPeriodo($periodoMesAtual['dataInicial'], $periodoMesAtual['dataFinal']);
        $query       = $this->em->createQuery($dql);
        return $query->getResult();
    }

    public function buscaEscala12h($mes = null)
    {
        $entity = $this->em->getRepository($this->entity);

        $periodoMesAtual = $this->montaDatasInicioEFimMesPorMes($mes);

        $dql    = $entity->buscaEscala12hPorPeriodo($periodoMesAtual['dataInicial'], $periodoMesAtual['dataFinal']);
        $query  = $this->em->createQuery($dql);
        return $query->getResult();
    }

    public function montaDatasInicioEFimMesPorMes($mes = null)
    {
        $mes = (empty($mes)) ? date('m') : $mes;

        $mes31 = array(01, 03, 05, 07, 08, 10, 12);

        $ultimoDia = in_array($mes, $mes31) ? 30 : 29;
        $dataInicial = date('Y-m-d', strtotime(date('Y-m').'-01'));
        $dataFinal   = date('Y-m-d', strtotime(date('Y-m').'-01' . "+ {$ultimoDia} days"));

        return array('dataInicial' => $dataInicial, 'dataFinal' => $dataFinal);
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
