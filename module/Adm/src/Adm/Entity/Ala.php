<?php

namespace Adm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Adm\Entity\Ala
 *
 * @ORM\Table(name="ALA")
 * @ORM\Entity(repositoryClass="Adm\Entity\AlaRepository")
 */
class Ala
{
    /**
     * @var integer $alacodigo
     *
     * @ORM\Column(name="ALACODIGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $alacodigo;

    /**
     * @var string $aladescricao
     *
     * @ORM\Column(name="ALADESCRICAO", type="string", length=45, nullable=false)
     */
    private $aladescricao;

    /**
     * @var Adm\Entity\Escala
     *
     * @ORM\ManyToOne(targetEntity="Adm\Entity\Escala")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ESCCODIGO", referencedColumnName="ESCCODIGO")
     * })
     */
    private $esccodigo;

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
     * Get alacodigo
     *
     * @return integer
     */
    public function getAlacodigo()
    {
        return $this->alacodigo;
    }

    /**
     * Set aladescricao
     *
     * @param string $aladescricao
     * @return Ala
     */
    public function setAladescricao($aladescricao)
    {
        $this->aladescricao = $aladescricao;
        return $this;
    }

    /**
     * Get aladescricao
     *
     * @return string
     */
    public function getAladescricao()
    {
        return $this->aladescricao;
    }

    /**
     * Set esccodigo
     *
     * @param Adm\Entity\Escala $esccodigo
     * @return Ala
     */
    public function setEsccodigo(\Adm\Entity\Escala $esccodigo = null)
    {
        $this->esccodigo = $esccodigo;
        return $this;
    }

    /**
     * Get esccodigo
     *
     * @return Adm\Entity\Escala
     */
    public function getEsccodigo()
    {
        return $this->esccodigo;
    }
}