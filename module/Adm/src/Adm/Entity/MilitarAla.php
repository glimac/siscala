<?php

namespace Adm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Adm\Entity\MilitarAla
 *
 * @ORM\Table(name="siscala.MILITAR_ALA")
 * @ORM\Entity(repositoryClass="Adm\Entity\MilitarAlaRepository")
 */
class MilitarAla
{
    /**
     * @var integer $miacodigo
     *
     * @ORM\Column(name="MIACODIGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $miacodigo;

    /**
     * @var Adm\Entity\Militar
     *
     * @ORM\ManyToOne(targetEntity="Adm\Entity\Militar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MILCODIGO", referencedColumnName="MILCODIGO")
     * })
     */
    private $milcodigo;

    /**
     * @var Adm\Entity\Ala
     *
     * @ORM\ManyToOne(targetEntity="Adm\Entity\Ala")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ALACODIGO", referencedColumnName="ALACODIGO")
     * })
     */
    private $alacodigo;

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
     * Get miacodigo
     *
     * @return integer
     */
    public function getMiacodigo()
    {
        return $this->miacodigo;
    }

    /**
     * Set milcodigo
     *
     * @param Adm\Entity\Militar $milcodigo
     * @return MilitarAla
     */
    public function setMilcodigo($milcodigo)
    {
        $this->milcodigo = $milcodigo;
        return $this;
    }

    /**
     * Get milcodigo
     *
     * @return Adm\Entity\Militar
     */
    public function getMilcodigo()
    {
        return $this->milcodigo;
    }

    /**
     * Set alacodigo
     *
     * @param Adm\Entity\Ala $alacodigo
     * @return MilitarAla
     */
    public function setAlacodigo($alacodigo)
    {
        $this->alacodigo = $alacodigo;
        return $this;
    }

    /**
     * Get alacodigo
     *
     * @return Adm\Entity\Ala
     */
    public function getAlacodigo()
    {
        return $this->alacodigo;
    }
}