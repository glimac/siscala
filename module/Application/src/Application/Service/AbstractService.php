<?php

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

use Application\Message\Message;

abstract class AbstractService
{
    use Message;

    /**
     *
     * @var EntityManager
     */
    protected $em;
    protected $entity;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert($arrData, $arrSetterFk = null)
    {
        $entity = new $this->entity($arrData);
        return $this->persist($entity, $arrSetterFk);
    }

    public function update($arrData, $arrSetterFk = null)
    {
        $entity = $this->em->getReference($this->entity, $arrData[$this->pk]);
        (new Hydrator\ClassMethods())->hydrate($arrData, $entity);
        return $this->persist($entity, $arrSetterFk);
    }

    protected function setFk($entity, $arrSetterFk = null)
    {
       if (!$arrSetterFk) {
           return false;
       } else {
           foreach ($arrSetterFk as $arrEntity => $arrFk) {
              foreach($arrFk as $set => $value ){
                  $setFk  = $this->em->getReference($arrEntity, $value);
                  $entity->$set($setFk);
              }
           }
       }
    }

    private function persist($entity, $arrSetterFk = null)
    {
        $this->setFk($entity, $arrSetterFk);
        $this->getEntityManager()->persist($entity);
        $this->getEntityManager()->flush();
        $this->getEntityManager()->clear();
        return $entity;
    }

    public function delete($intPk, $entity = null)
    {
        $entity = $this->em->getReference($this->entity, $intPk);
        if ($entity) {
            $this->getEntityManager()->remove($entity);
            $this->getEntityManager()->flush();
            $this->getEntityManager()->clear();
        }
        return $entity;
    }

    public function fetchPairs(array $arrCriteria = null, $strMethodValue = null, $strMethodText = null, array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        return $this->getRepositoryEntity()->fetchPairs($strMethodValue, $strMethodText, $arrCriteria, $arrOrderBy, $intLimit, $intOffset);
    }

    public function fetchPairsToXmlJson(array $arrCriteria = null, $strMethodValue = null, $strMethodText = null, array $arrOrderBy = null, $intLimit = null, $intOffset = null)
    {
        return $this->getRepositoryEntity()->fetchPairsToXmlJson($strMethodValue, $strMethodText, $arrCriteria, $arrOrderBy, $intLimit, $intOffset);
    }

    public function findByPaged(array $arrCriteria = null, $strSortName = null, $strSortOrder = null, $intPage = 1, $intItemPerPage = 10, $mixDQL = null)
    {
        return $this->getRepositoryEntity()->findByPaged($arrCriteria, $strSortName, $strSortOrder, $intPage, $intItemPerPage, $mixDQL);
    }

    public function findAll()
    {
       $em = $this->em->getRepository($this->entity);
       return $em->findAll();
    }

    public function find($mixPk)
    {
        return $this->getRepositoryEntity()->find($mixPk);
    }

    public function findBy(array $arrCriteria = array(), array $strOrderBy = null, $intLimit = null, $intOffset = null)
    {
        return $this->getRepositoryEntity()->findBy($arrCriteria, $strOrderBy, $intLimit, $intOffset);
    }

    protected function getEntityManager()
    {
        if (is_null($this->em))
            $this->em = new \Doctrine\ORM\EntityManager();
        return $this->em;
    }

    protected function getRepositoryEntity($entity = null)
    {
        if (empty($entity))
            $entity = $this->entity;
        return ($entity) ? $this->getEntityManager()->getRepository($entity) : false;
    }

}
