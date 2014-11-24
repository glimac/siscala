<?php

namespace Adm\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

abstract class AbstractService
{
    /**
     * @var EntityManager
     */
    protected $em;

    protected $entity;

    /**@#+
     * @const status of the save
    */
    const STATUS_UPDATE = 'Update';
    const STATUS_INSERT = 'Insert';
    /**@#-*/

    /**
     * Default messages namespace
     */
    const NAMESPACE_DEFAULT = 'default';

    /**
     * Success messages namespace
     */
    const NAMESPACE_SUCCESS = 'success';

    /**
     * Error messages namespace
     */
    const NAMESPACE_ERROR = 'error';

    /**
     * Info messages namespace
     */
    const NAMESPACE_INFO = 'info';

    protected $saveData = array();

    protected $saveObject = array();

    protected static $messages = array();

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Grava os dados passados
     * @param array $data
     * @return boolean
     */
    public function save(array $data, $controlTransaction = false)
    {
        $this->saveData   = $data;
        /*
        $primary           = $this->info(Zend_Db_Table::PRIMARY);
        $primaryValues     = array();

        foreach ($primary as $current) {
            if (!empty($this->saveData[$current])) {
                $primaryValues[$current] = $this->saveData[$current];
            }
        }

        $row = null;
        if (count($primaryValues) > 0) {
            $callback = array($this, 'find');
            $row      = call_user_func_array($callback, $primaryValues)->current();
            $action   = self::STATUS_UPDATE;
        }
        */

        if ($row === null){
            $row    = $this->createRow();
            $action = self::STATUS_INSERT;
        }

        //start transaction
        if ($controlTransaction === true) {
            $db = self::getDefaultAdapter();
            $db->beginTransaction();
        }

        try {
            // pre-save
            $this->preSave();
            $this->{"_pre$action"}();

            $return = $row->setFromArray($this->saveData)
                             ->save();

            $this->{"_post$action"}();

            // post-save
            $this->postSave();
        } catch (Exception $dbException) {
            if ($controlTransaction === true) {
                $db->rollBack();
            }
            throw $dbException;
        }

        // force update primary key to method post<Action>
        if (count($primary) == 1 && !is_array($return)) {
            $this->saveData[$primary[1]] = $return;
        }

        return true;
    }

    /**
     * Efetua validações e verificações antes de executar o save
     */
    protected function preSave() {}

    /**
     * Efetua validações e verificações depois de executar o save
     */
    protected function postSave() {}

    /**
     * Efetua validações e verificações antes de executar o insert
     */
    protected function preInsert() {}

    /**
     * Efetua validações e verificações depois de executar o insert
     */
    protected function postInsert() {}

    /**
     * Efetua validações e verificações antes de executar o update
     */
    protected function preUpdate() {}

    /**
     * Efetua validações e verificações depois de executar o update
     */
    protected function postUpdate(){}

    protected function setFk($entity, array $arrSetterFk = array())
    {
       foreach ($arrSetterFk as $arrEntity => $arrFk) {
          foreach($arrFk as $set => $value ) {
              $setFk  = $this->em->getReference($arrEntity, $value);
              $entity->$set($setFk);
          }
       }
    }

    public function insert(array $data)
    {
        if (!$data) {
            throw \Adm\Service\Exception\DataNotFoundException('Não foi possível encontrar dados para inserir');
        }
        $this->saveData = $data;

        // pre-save
        $this->preSave();
        $this->preInsert();

        // insert
        $entity = new $this->entity($this->saveData);
        $this->setFk($entity, $this->saveObject);

        $this->em->persist($entity);
        $this->em->flush();

        // post-save
        $this->postInsert();
        $this->postSave();

        return $entity;
    }

    public function update(array $data, $id)
    {
        $this->saveData = $data;

        // pre-save
        $this->preSave();
        $this->preUpdate();

        // update
        $entity = $this->em->getReference($this->entity, $id);
        $hydrator = new Hydrator\ClassMethods();
        $hydrator->hydrate($this->saveData, $entity);
        $this->setFk($entity, $this->saveObject);

        $this->em->persist($entity);
        $this->em->flush();

        // post-save
        $this->postUpdate();
        $this->postSave();
        return $entity;
    }

    public function delete($id)
    {
        $entity = $this->em->getReference($this->entity, $id);
        if ($entity) {
            $this->em->remove($entity);
            $this->em->flush();
            return $id;
        }
    }

    public function find($id)
    {
        return $this->em->getReference($this->entity, $id);
    }

    public function findAll()
   {
       $em = $this->em->getRepository($this->entity);
       return $em->findAll();
   }

   public function findBy($arrCriteria = array())
   {
       $em = $this->em->getRepository($this->entity);
       return ($em->findBy($arrCriteria))? $em->findBy($arrCriteria) : null;
   }

   public function findOneBy($arrCriteria = array())
   {
       $em = $this->em->getRepository($this->entity);
       return $em->findOneBy($arrCriteria);
   }

    /**
     * Adicionar mensagens a pilha
     * @param string|array $messages
     * @param string $type
     */
    protected static function addMessage($messages, $type = self::NAMESPACE_DEFAULT)
    {
        if (!is_array($messages)) {
            $messages = array($messages);
        }
        foreach ($messages as $message) {
            self::$messages[] = (string) $message;
        }
    }

    /**
     * Reseta e define novas mensagens
     * @param string|array $messages
     * @param string $type
     */
    protected static function setMessage($messages, $type = self::NAMESPACE_DEFAULT)
    {
        if (!is_array($messages)) {
            $messages = array($messages);
        }
        // Reset messages
        self::$messages = array();
        foreach ($messages as $message) {
            self::$messages[] = (string) $message;
        }
    }

    /**
     * Retorna as mensagens por tipo
     * @return array
     */
    public static function getMessage($type = self::NAMESPACE_DEFAULT)
    {
        return isset(self::$messages[$type]) ? self::$messages[$type] : array();
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getRepository()
    {
        return $this->em->getRepository($this->entity);
    }

    public function getEntityManager(){
        return $this->em;
    }
}
