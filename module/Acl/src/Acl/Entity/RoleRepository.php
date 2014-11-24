<?php

namespace Acl\Entity;

use Doctrine\ORM\EntityRepository;

class RoleRepository extends EntityRepository {

    public function fetchParent()
    {
        $entities = $this->findAll();
        $array = array();

        $array[0] = "Nenhum";
        foreach($entities as $entity)
        {
            $array[$entity->getId()] = $entity->getNome();
        }
        return $array;
    }

}
