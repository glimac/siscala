<?php

namespace Adm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Adm\Entity\Situacao
 *
 * @ORM\Table(name="siscala.SITUACAO")
 * @ORM\Entity(repositoryClass="Adm\Entity\SituacaoRepository")
 */
class Situacao
{
    /**
     * @var integer $sitcodigo
     *
     * @ORM\Column(name="SITCODIGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sitcodigo;

    /**
     * @var string $sitdatainicio
     *
     * @ORM\Column(name="SITDATAINICIO", type="string", nullable=false)
     */
    private $sitdatainicio;

    /**
     * @var string $sitdatafim
     *
     * @ORM\Column(name="SITDATAFIM", type="string", nullable=false)
     */
    private $sitdatafim;

    /**
     * @var Adm\Entity\TipoSituacao
     *
     * @ORM\ManyToOne(targetEntity="Adm\Entity\TipoSituacao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TPSCODIGO", referencedColumnName="TPSCODIGO")
     * })
     */
    private $tpscodigo;

    /**
     * @var Adm\Entity\Militar
     *
     * @ORM\ManyToOne(targetEntity="Adm\Entity\Militar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MILCODIGO", referencedColumnName="MILCODIGO")
     * })
     */
    private $milcodigo;

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
     * Get sitcodigo
     *
     * @return integer
     */
    public function getSitcodigo()
    {
        return $this->sitcodigo;
    }

    /**
     * Set sitdatainicio
     *
     * @param date $sitdatainicio
     * @return Situacao
     */
    public function setSitdatainicio($sitdatainicio)
    {
        $this->sitdatainicio = $sitdatainicio;
        return $this;
    }

    /**
     * Get sitdatainicio
     *
     * @return date
     */
    public function getSitdatainicio()
    {
        return $this->sitdatainicio;
    }

    /**
     * Set sitdatafim
     *
     * @param date $sitdatafim
     * @return Situacao
     */
    public function setSitdatafim($sitdatafim)
    {
        $this->sitdatafim = $sitdatafim;
        return $this;
    }

    /**
     * Get sitdatafim
     *
     * @return date
     */
    public function getSitdatafim()
    {
        return $this->sitdatafim;
    }

    /**
     * Set tpscodigo
     *
     * @param Adm\Entity\TipoSituacao $tpscodigo
     * @return Situacao
     */
    public function setTpscodigo($tpscodigo)
    {
        $this->tpscodigo = $tpscodigo;
        return $this;
    }

    /**
     * Get tpscodigo
     *
     * @return Adm\Entity\TipoSituacao
     */
    public function getTpscodigo()
    {
        return $this->tpscodigo;
    }

    /**
     * Set milcodigo
     *
     * @param Adm\Entity\Militar $milcodigo
     * @return Situacao
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
}