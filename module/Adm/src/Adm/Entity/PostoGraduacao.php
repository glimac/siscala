<?php

namespace Adm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * Adm\Entity\PostoGraduacao
 *
 * @ORM\Table(name="siscala.POSTO_GRADUACAO")
 * @ORM\Entity(repositoryClass="Adm\Entity\PostoGraduacaoRepository")
 */
class PostoGraduacao
{
    /**
     * @var integer $pgrcodigo
     *
     * @ORM\Column(name="PGRCODIGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pgrcodigo;

    /**
     * @var string $pgrdescricao
     *
     * @ORM\Column(name="PGRDESCRICAO", type="string", length=45, nullable=false)
     */
    private $pgrdescricao;

    /**
     * @var string $pgrsigla
     *
     * @ORM\Column(name="PGRSIGLA", type="string", length=10, nullable=false)
     */
    private $pgrsigla;

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
     * Get pgrcodigo
     *
     * @return integer
     */
    public function getPgrcodigo()
    {
        return $this->pgrcodigo;
    }

    /**
     * Set pgrdescricao
     *
     * @param string $pgrdescricao
     * @return PostoGraduacao
     */
    public function setPgrdescricao($pgrdescricao)
    {
        $this->pgrdescricao = $pgrdescricao;
        return $this;
    }

    /**
     * Get pgrdescricao
     *
     * @return string
     */
    public function getPgrdescricao()
    {
        return $this->pgrdescricao;
    }

    /**
     * Set pgrsigla
     *
     * @param string $pgrsigla
     * @return PostoGraduacao
     */
    public function setPgrsigla($pgrsigla)
    {
        $this->pgrsigla = $pgrsigla;
        return $this;
    }

    /**
     * Get pgrsigla
     *
     * @return string
     */
    public function getPgrsigla()
    {
        return $this->pgrsigla;
    }
}