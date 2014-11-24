<?php

namespace Adm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Adm\Entity\Quadro
 *
 * @ORM\Table(name="siscala.QUADRO")
 * @ORM\Entity(repositoryClass="Adm\Entity\QuadroRepository")
 */
class Quadro
{
    /**
     * @var integer $quacodigo
     *
     * @ORM\Column(name="QUACODIGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $quacodigo;

    /**
     * @var string $quadescricao
     *
     * @ORM\Column(name="QUADESCRICAO", type="string", length=45, nullable=false)
     */
    private $quadescricao;

    public function __construct(array $options = array())
    {
        $hydrator = new Hydrator\ClassMethods;
        $hydrator->hydrate($options,$this);
    }

    public function toArray()
    {
        $hydrator = new Hydrator\ClassMethods();
        return $hydrator->extract($this);
    }

    /**
     * Get quacodigo
     *
     * @return integer
     */
    public function getQuacodigo()
    {
        return $this->quacodigo;
    }

    /**
     * Set quadescricao
     *
     * @param string $quadescricao
     * @return Quadro
     */
    public function setQuadescricao($quadescricao)
    {
        $this->quadescricao = $quadescricao;
        return $this;
    }

    /**
     * Get quadescricao
     *
     * @return string
     */
    public function getQuadescricao()
    {
        return $this->quadescricao;
    }
}