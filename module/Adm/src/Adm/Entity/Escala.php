<?php

namespace Adm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Adm\Entity\Escala
 *
 * @ORM\Table(name="ESCALA")
 * @ORM\Entity(repositoryClass="Adm\Entity\EscalaRepository")
 */
class Escala
{
    /**
     * @var integer $esccodigo
     *
     * @ORM\Column(name="ESCCODIGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $esccodigo;

    /**
     * @var string $escdescricao
     *
     * @ORM\Column(name="ESCDESCRICAO", type="string", length=45, nullable=false)
     */
    private $escdescricao;

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
     * Get esccodigo
     *
     * @return integer
     */
    public function getEsccodigo()
    {
        return $this->esccodigo;
    }

    /**
     * Set escdescricao
     *
     * @param string $escdescricao
     * @return Escala
     */
    public function setEscdescricao($escdescricao)
    {
        $this->escdescricao = $escdescricao;
        return $this;
    }

    /**
     * Get escdescricao
     *
     * @return string
     */
    public function getEscdescricao()
    {
        return $this->escdescricao;
    }
}