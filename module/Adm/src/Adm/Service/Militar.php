<?php

namespace Adm\Service;

use Doctrine\ORM\EntityManager;

class Militar extends \Adm\Service\AbstractService
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->entity = 'Adm\Entity\Militar';
    }

    /**
     * Efetua validações e verificações antes de executar o save
     */
    protected function preSave()
    {
        $this->saveData['mildtnascimento'] = implode('-', array_reverse(explode('/', $this->saveData['mildtnascimento'])));
    }

    /**
     * Efetua validações e verificações antes de executar o insert
     */
    protected function preInsert()
    {
        $arrFk['Adm\Entity\PostoGraduacao'] = array('setPgrcodigo' => $this->saveData['pgrcodigo']);
        $arrFk['Acl\Entity\Role']           = array('setRoleid'    => $this->saveData['roleid']);
        $arrFk['Adm\Entity\Quadro']         = array('setQuacodigo' => $this->saveData['quacodigo']);
        $this->saveObject = $arrFk;

        $this->saveData['milpassword']     = 'cbmdf123';
        $this->saveData['milcpf']          = str_replace('-', '', str_replace('.', '', $this->saveData['milcpf']));

    }
    /**
     * Efetua validações e verificações antes de executar o update
     */
    protected function preUpdate()
    {
        $arrFk['Adm\Entity\PostoGraduacao'] = array('setPgrcodigo' => $this->saveData['pgrcodigo']);
        $arrFk['Acl\Entity\Role']           = array('setRoleid'    => $this->saveData['roleid']);
        $arrFk['Adm\Entity\Quadro']         = array('setQuacodigo' => $this->saveData['quacodigo']);
        $this->saveObject = $arrFk;

        $this->saveData['milcpf']      = str_replace('-', '', str_replace('.', '', $this->saveData['milcpf']));
    }

    /**
     *
     */
//    protected function postInsert()
//    {
////        \Zend\Debug\Debug::dump($this->getEntityManager()->);
////        exit();
//        $serviceSituacao = new \Adm\Service\Situacao($this->getEntityManager());
//        $serviceSituacao->insert(array(
//            'milcodigo'     => $this->saveData['milcodigo'],                            //CORRIGIR-> PEGAR CHAVE INSERIDA
//            'sitdatainicio' => $this->saveData['sitdatainicio'],
//            'sitdatafim'    => null,
//            'tpscodigo'     => TipoSituacao::TPS_PRONTO
//        ));
//    }
}
