<?php

namespace Adm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Adm\Entity\TipoSituacao
 *
 * @ORM\Table(name="siscala.TIPO_SITUACAO")
 * @ORM\Entity(repositoryClass="Adm\Entity\TipoSituacaoRepository")
 */
class TipoSituacao
{
    /**
     * @var integer $tpscodigo
     *
     * @ORM\Column(name="TPSCODIGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $tpscodigo;

    /**
     * @var string $tpsdescricao
     *
     * @ORM\Column(name="TPSDESCRICAO", type="string", length=45, nullable=false)
     */
    private $tpsdescricao;

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
     * Get tpscodigo
     *
     * @return integer
     */
    public function getTpscodigo()
    {
        return $this->tpscodigo;
    }

    /**
     * Set tpsdescricao
     *
     * @param string $tpsdescricao
     * @return TipoSituacao
     */
    public function setTpsdescricao($tpsdescricao)
    {
        $this->tpsdescricao = $tpsdescricao;
        return $this;
    }

    /**
     * Get tpsdescricao
     *
     * @return string
     */
    public function getTpsdescricao()
    {
        return $this->tpsdescricao;
    }
}