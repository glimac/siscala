<?php

namespace Acl\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Acl\Entity\Role
 *
 * @ORM\Table(name="siscala.ACL_ROLE")
 * @ORM\Entity(repositoryClass="Acl\Entity\RoleRepository")
 */
class Role
{
    const Perfil_Usuario = 1;
    //const Perfil_Usuario = 39;

    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer $parent
     *
     * @ORM\OneToOne(targetEntity="Acl\Entity\Role")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var string $nome
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=true)
     */
    private $nome;

    /**
     * @var boolean $isadmin
     *
     * @ORM\Column(name="isadmin", type="integer", length=100, nullable=true)
     */
    private $isadmin;

    /**
     * @var date $createdat
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    private $createdAt;

    /**
     * @var date $updatedat
     *
     * @ORM\Column(name="updated_at", type="date", nullable=true)
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set parent
     *
     * @param integer $parent
     * @return AclRole
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return AclRole
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set isadmin
     *
     * @param string $isadmin
     * @return AclRole
     */
    public function setIsadmin($isadmin)
    {
        $this->isadmin = $isadmin;
        return $this;
    }

    /**
     * Get isadmin
     *
     * @return string
     */
    public function getIsadmin()
    {
        return $this->isadmin;
    }

    public function setCreatedAt() {
        $this->createdAt = new \Datetime("now");
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return date
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setUpdatedAt() {
        $this->createdAt = new \Datetime("now");
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return date
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function __toString() {
        return $this->nome;
    }

    public function toArray()
    {
        if(isset($this->parent))
            $parent = $this->parent->getId();
        else
            $parent = false;


        return array(
          'id'      => $this->id,
          'nome'    => $this->nome,
          'isAdmin' => $this->isadmin,
          'parent'  => $parent
        );
    }

    public function __construct($options = array())
    {
        (new Hydrator\ClassMethods)->hydrate($options, $this);
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
    }
    
}