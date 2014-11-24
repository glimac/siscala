<?php

namespace Adm\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Crypt\Key\Derivation\Pbkdf2;

use Zend\Stdlib\Hydrator;

/**
 * Adm\Entity\Militar
 *
 * @ORM\Table(name="siscala.MILITAR")
 * @ORM\Entity(repositoryClass="Adm\Entity\MilitarRepository")
 */
class Militar
{
    /**
     * @var integer $milcodigo
     *
     * @ORM\Column(name="MILCODIGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $milcodigo;

    /**
     * @var string $milcpf
     *
     * @ORM\Column(name="MILCPF", type="string", length=14, nullable=false)
     */
    private $milcpf;

    /**
     * @var string $milidt
     *
     * @ORM\Column(name="MILIDT", type="string", length=20, nullable=false)
     */
    private $milidt;

    /**
     * @var string $milmatricula
     *
     * @ORM\Column(name="MILMATRICULA", type="string", length=20, nullable=false)
     */
    private $milmatricula;

    /**
     * @var string $milnome
     *
     * @ORM\Column(name="MILNOME", type="string", length=100, nullable=false)
     */
    private $milnome;

    /**
     * @var string $milnomeguerra
     *
     * @ORM\Column(name="MILNOMEGUERRA", type="string", length=45, nullable=false)
     */
    private $milnomeguerra;

    /**
     * @var string $mildtnascimento
     *
     * @ORM\Column(name="MILDTNASCIMENTO", type="string", nullable=false)
     */
    private $mildtnascimento;

    /**
     * @var string $milpassword
     *
     * @ORM\Column(name="MILPASSWORD", type="string", length=20, nullable=false)
     */
    private $milpassword;

    /**
     * @var string $miltelefone
     *
     * @ORM\Column(name="MILTELEFONE", type="string", length=15, nullable=true)
     */
    private $miltelefone;

    /**
     * @var string $miltelefonesec
     *
     * @ORM\Column(name="MILTELEFONESEC", type="string", length=15, nullable=true)
     */
    private $miltelefonesec;

    /**
     * @var string $milendereco
     *
     * @ORM\Column(name="MILENDERECO", type="string", length=200, nullable=true)
     */
    private $milendereco;

    /**
     * @var string $milemail
     *
     * @ORM\Column(name="MILEMAIL", type="string", length=100, nullable=true)
     */
    private $milemail;

    /**
     * @var string $milemailsec
     *
     * @ORM\Column(name="MILEMAILSEC", type="string", length=100, nullable=true)
     */
    private $milemailsec;

    /**
     * @var Adm\Entity\PostoGraduacao
     *
     * @ORM\ManyToOne(targetEntity="Adm\Entity\PostoGraduacao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PGRCODIGO", referencedColumnName="PGRCODIGO")
     * })
     */
    private $pgrcodigo;

    /**
     * @var Acl\Entity\Role
     *
     * @ORM\OneToOne(targetEntity="Acl\Entity\Role")
     * @ORM\JoinColumn(name="roleid", referencedColumnName="id")
     */
    private $roleid;

    /**
     * @var Adm\Entity\Quadro
     *
     * @ORM\OneToOne(targetEntity="Adm\Entity\Quadro")
     * @ORM\JoinColumn(name="QUACODIGO", referencedColumnName="QUACODIGO")
     */
    private $quacodigo;

    /**
     * Get milcodigo
     *
     * @return integer
     */
    public function getMilcodigo()
    {
        return $this->milcodigo;
    }

    /**
     * Set milcpf
     *
     * @param string $milcpf
     * @return Militar
     */
    public function setMilcpf($milcpf)
    {
        $this->milcpf = $milcpf;
        return $this;
    }

    /**
     * Get milcpf
     *
     * @return string
     */
    public function getMilcpf()
    {
        return $this->milcpf;
    }

    /**
     * Set milidt
     *
     * @param string $milidt
     * @return Militar
     */
    public function setMilidt($milidt)
    {
        $this->milidt = $milidt;
        return $this;
    }

    /**
     * Get milidt
     *
     * @return string
     */
    public function getMilidt()
    {
        return $this->milidt;
    }

    /**
     * Set milmatricula
     *
     * @param string $milmatricula
     * @return Militar
     */
    public function setMilmatricula($milmatricula)
    {
        $this->milmatricula = $milmatricula;
        return $this;
    }

    /**
     * Get milmatricula
     *
     * @return string
     */
    public function getMilmatricula()
    {
        return $this->milmatricula;
    }

    /**
     * Set milnome
     *
     * @param string $milnome
     * @return Militar
     */
    public function setMilnome($milnome)
    {
        $this->milnome = $milnome;
        return $this;
    }

    /**
     * Get milnome
     *
     * @return string
     */
    public function getMilnome()
    {
        return $this->milnome;
    }

    /**
     * Set milnomeguerra
     *
     * @param string $milnomeguerra
     * @return Militar
     */
    public function setMilnomeguerra($milnomeguerra)
    {
        $this->milnomeguerra = $milnomeguerra;
        return $this;
    }

    /**
     * Get milnomeguerra
     *
     * @return string
     */
    public function getMilnomeguerra()
    {
        return $this->milnomeguerra;
    }

    /**
     * Set mildtnascimento
     *
     * @param date $mildtnascimento
     * @return Militar
     */
    public function setMildtnascimento($mildtnascimento)
    {
        $this->mildtnascimento = $mildtnascimento;
        return $this;
    }

    /**
     * Get mildtnascimento
     *
     * @return date
     */
    public function getMildtnascimento()
    {
        return $this->mildtnascimento;
    }

    /**
     * Set milpassword
     *
     * @param string $milpassword
     * @return Militar
     */
    public function setMilpassword($milpassword)
    {
        $this->milpassword = $this->encryptPassword($milpassword);
        return $this;
    }

    /**
     * Get milpassword
     *
     * @return string
     */
    public function getMilpassword()
    {
        return $this->milpassword;
    }

    /**
     * Set miltelefone
     *
     * @param string $miltelefone
     * @return Militar
     */
    public function setMiltelefone($miltelefone)
    {
        $this->miltelefone = $miltelefone;
        return $this;
    }

    /**
     * Get miltelefone
     *
     * @return string
     */
    public function getMiltelefone()
    {
        return $this->miltelefone;
    }

    /**
     * Set milendereco
     *
     * @param string $milendereco
     * @return Militar
     */
    public function setMilendereco($milendereco)
    {
        $this->milendereco = $milendereco;
        return $this;
    }

    /**
     * Get milendereco
     *
     * @return string
     */
    public function getMilendereco()
    {
        return $this->milendereco;
    }

    /**
     * Set milemail
     *
     * @param string $milemail
     * @return Militar
     */
    public function setMilemail($milemail)
    {
        $this->milemail = $milemail;
        return $this;
    }

    /**
     * Get milemail
     *
     * @return string
     */
    public function getMilemail()
    {
        return $this->milemail;
    }

    /**
     * Set pgrcodigo
     *
     * @param Adm\Entity\PostoGraduacao $pgrcodigo
     * @return Militar
     */
    public function setPgrcodigo($pgrcodigo)
    {
        $this->pgrcodigo = $pgrcodigo;
        return $this;
    }

    /**
     * Get pgrcodigo
     *
     * @return Adm\Entity\PostoGraduacao
     */
    public function getPgrcodigo()
    {
        return $this->pgrcodigo;
    }

    /**
     * Set role
     *
     * @param Acl\Entity\Role $roleid
     * @return Militar
     */
    public function setRoleid($roleid)
    {
        $this->roleid = $roleid;
        return $this;
    }

    /**
     * Get role
     *
     * @return Acl\Entity\Role
     */
    public function getRoleid()
    {
        return $this->roleid;
    }

    /**
     * Get miltelefonesec
     *
     * @return string
     */
    public function getMiltelefonesec()
    {
        return $this->miltelefonesec;
    }

    /**
     * Get milemailsec
     *
     * @return string
     */
    public function getMilemailsec()
    {
        return $this->milemailsec;
    }

    /**
     * Get quacodigo
     *
     * @return Adm\Entity\Quadro
     */
    public function getQuacodigo()
    {
        return $this->quacodigo;
    }

    /**
     * Get miltelefonesec
     *
     * @return string
     */
    public function setMiltelefonesec($miltelefonesec)
    {
        $this->miltelefonesec = $miltelefonesec;
    }

    /**
     * Get milemailsec
     *
     * @return string
     */
    public function setMilemailsec($milemailsec)
    {
        $this->milemailsec = $milemailsec;
    }

    /**
     * Set quacodigo
     *
     * @param Adm\Entity\Quadro $quacodigo
     * @return quacodigo
     */
    public function setQuacodigo($quacodigo)
    {
        $this->quacodigo = $quacodigo;
    }

    public function encryptPassword($password)
    {
        return base64_encode(Pbkdf2::calc('sha256', $password, null, 10000, strlen($password*2)));
    }

    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }

    public function __construct(array $options = array())
    {
        (new Hydrator\ClassMethods)->hydrate($options,$this);
    }

}