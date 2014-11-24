<?php

namespace Adm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Adm\Entity\TrocaServico
 *
 * @ORM\Table(name="TROCA_SERVICO")
 * @ORM\Entity(repositoryClass="Adm\Entity\TrocaServicoRepository")
 */
class TrocaServico
{
    /**
     * @var integer $trscodigo
     *
     * @ORM\Column(name="TRSCODIGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $trscodigo;

    /**
     * @var Adm\Entity\Servico
     *
     * @ORM\ManyToOne(targetEntity="Adm\Entity\Servico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="SERCODIGO", referencedColumnName="SERCODIGO")
     * })
     */
    private $sercodigo;

    /**
     * @var Adm\Entity\Militar
     *
     * @ORM\ManyToOne(targetEntity="Adm\Entity\Militar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MILCODIGOTROCA", referencedColumnName="MILCODIGO")
     * })
     */
    private $milcodigotroca;

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
     * Get trscodigo
     *
     * @return integer
     */
    public function getTrscodigo()
    {
        return $this->trscodigo;
    }

    /**
     * Set sercodigo
     *
     * @param Adm\Entity\Servico $sercodigo
     * @return TrocaServico
     */
    public function setSercodigo(\Adm\Entity\Servico $sercodigo = null)
    {
        $this->sercodigo = $sercodigo;
        return $this;
    }

    /**
     * Get sercodigo
     *
     * @return Adm\Entity\Servico
     */
    public function getSercodigo()
    {
        return $this->sercodigo;
    }

    /**
     * Set milcodigotroca
     *
     * @param Adm\Entity\Militar $milcodigotroca
     * @return TrocaServico
     */
    public function setMilcodigotroca(\Adm\Entity\Militar $milcodigotroca = null)
    {
        $this->milcodigotroca = $milcodigotroca;
        return $this;
    }

    /**
     * Get milcodigotroca
     *
     * @return Adm\Entity\Militar
     */
    public function getMilcodigotroca()
    {
        return $this->milcodigotroca;
    }
}