<?php

namespace Acl\Service;

use Application\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class Resource extends AbstractService
{
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = "Acl\Entity\Resource";
        $this->pk     = "id";
    }

}
