<?php

namespace Autenticacao\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Crypt\Key\Derivation\Pbkdf2;

use Zend\Stdlib\Hydrator;
/**
 * @ORM\Table(name="siscala.usuario")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Autenticacao\Entity\UsuarioRepository")
 */
class Usuario
{
    /**
     * @var integer $idUsuario
     *
     * @ORM\Column(name="id_usuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="public.entidade_seq")
     */
    private $idUsuario;

    /**
     * @var string $nome
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=true)
     */
    private $nome;

    /**
     * @var string $dtNascimento
     *
     * @ORM\Column(name="dt_nascimento", type="string", length=100, nullable=true)
     */
    private $dtNascimento;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string $password
     *
     * @ORM\Column(name="password", type="string", length=20, nullable=true)
     */
    private $password;

    /**
     * @var datetime $dtInclusao
     *
     * @ORM\Column(name="dt_inclusao", type="datetime", nullable=true)
     */
    private $dtInclusao;

    /**
     * @var Acl\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="Acl\Entity\Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_role", referencedColumnName="id")
     * })
     */
    private $idRole;


    /**
     * Get idUsuario
     *
     * @return integer
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Usuario
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set dtNascimento
     *
     * @param string $nome
     * @return Usuario
     */
    public function setDtNascimento($dtNascimentoe)
    {
        $this->dtNascimentoe = $dtNascimentoe;
        return $this;
    }

    /**
     * Get nascimento
     *
     * @return string
     */
    public function getDtNascimento()
    {
        return $this->dtNascimento;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $this->encryptPassword($password);
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set dtInclusao
     *
     * @param datetime $dtInclusao
     * @return Usuario
     */
    public function setDtInclusao($dtInclusao)
    {
        $this->dtInclusao = $dtInclusao;
        return $this;
    }

    /**
     * Get dtInclusao
     *
     * @return datetime
     */
    public function getDtInclusao()
    {
        return $this->dtInclusao;
    }

    /**
     * Set idRole
     *
     * @return Usuario
     */
    public function setIdRole($idRole)
    {
        $this->idRole = $idRole;
        return $this;
    }

    /**
     * Get idRole
     *
     * @return Financeiro\Entity\AclRole
     */
    public function getIdRole()
    {
        return $this->idRole;
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
