<?php

namespace Autenticacao\Service;

use Doctrine\ORM\EntityManager;
use Application\Service\AbstractService;
use Acl\Entity\Role;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

class Autenticacao extends AbstractService
{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->entity   = "Adm\Entity\Militar";
        $this->pk       = "milcodigo";
    }

    public function findBy(array $arrData)
    {
        $criteria = array(
            'milmatricula' => $arrData['milmatricula'],
            'password'     => $arrData['milpassword']);
        //var_dump($criteria);exit;
        return parent::findBy($criteria);
    }

    public function insert(array $arrData)
    {
        unset($arrData['confirmation']);
        unset($arrData['captcha']);
        unset($arrData['Cadastrar']);

        if (!$arrData['role']) {
            $arrData['role'] = Role::Perfil_Usuario;
        }

        //Validar se existe email ja cadastrado
        $em = $this->em->getRepository($this->entity);
        if ($em->findBy(array('milmatricula' => $arrData['milmatricula']))) {
            throw new \Exception($this->MSG6);
        } else {
            $setFk = array("Acl\Entity\Role" => array('setId' => $arrData['role']));
            return parent::insert($arrData, $setFk);
        }
        return false;
    }

    public function update(array $arrData)
    {
        unset($arrData['Cadastrar']);
        if($this->validarSenhaAuterada($arrData)){
            unset($arrData['milpassword']);
        }
        $setFk = array("Acl\Entity\Role" => array('setId' => $arrData['role']));
        return parent::update($arrData, $setFk);
    }

    public function validarSenhaAuterada(array $arrData)
    {
        $entity   = $this->em->getRepository($this->entity);
        $entities = $entity->find($arrData['milcodigo'])->toArray();
        return ((!$arrData['milpassword']) || ($entities['milpassword'] == $arrData['milpassword']))? true: false;
    }

    public function identity()
    {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage("Usuario"));
        return $auth->getIdentity();
    }

}
