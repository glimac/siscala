<?php

namespace Adm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Adm\Entity\Servico
 *
 * @ORM\Table(name="SERVICO")
 * @ORM\Entity(repositoryClass="Adm\Entity\ServicoRepository")
 */
class Servico
{
    /**
     * @var integer $sercodigo
     *
     * @ORM\Column(name="SERCODIGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sercodigo;

    /**
     * @var string $serdata
     *
     * @ORM\Column(name="SERDATA", type="string", nullable=false)
     */
    private $serdata;

    /**
     * @var string $serboletim
     *
     * @ORM\Column(name="SERBOLETIM", type="string", length=25, nullable=true)
     */
    private $serboletim;

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
     * Get sercodigo
     *
     * @return integer
     */
    public function getSercodigo()
    {
        return $this->sercodigo;
    }

    /**
     * Set serdata
     *
     * @param string $serdata
     * @return Servico
     */
    public function setSerdata($serdata)
    {
        $this->serdata = $serdata;
        return $this;
    }

    /**
     * Get serdata
     *
     * @return string
     */
    public function getSerdata()
    {
        return $this->serdata;
    }

    /**
     * Set serboletim
     *
     * @param string $serboletim
     * @return Servico
     */
    public function setSerboletim($serboletim)
    {
        $this->serboletim = $serboletim;
        return $this;
    }

    /**
     * Get serboletim
     *
     * @return string
     */
    public function getSerboletim()
    {
        return $this->serboletim;
    }

    /**
     * Set milcodigo
     *
     * @param Adm\Entity\Militar $milcodigo
     * @return Servico
     */
    public function setMilcodigo(\Adm\Entity\Militar $milcodigo = null)
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