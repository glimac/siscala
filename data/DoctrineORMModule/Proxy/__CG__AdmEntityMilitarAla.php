<?php

namespace DoctrineORMModule\Proxy\__CG__\Adm\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class MilitarAla extends \Adm\Entity\MilitarAla implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function toArray()
    {
        $this->__load();
        return parent::toArray();
    }

    public function getMiacodigo()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["miacodigo"];
        }
        $this->__load();
        return parent::getMiacodigo();
    }

    public function setMilcodigo($milcodigo)
    {
        $this->__load();
        return parent::setMilcodigo($milcodigo);
    }

    public function getMilcodigo()
    {
        $this->__load();
        return parent::getMilcodigo();
    }

    public function setAlacodigo($alacodigo)
    {
        $this->__load();
        return parent::setAlacodigo($alacodigo);
    }

    public function getAlacodigo()
    {
        $this->__load();
        return parent::getAlacodigo();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'miacodigo', 'milcodigo', 'alacodigo');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}