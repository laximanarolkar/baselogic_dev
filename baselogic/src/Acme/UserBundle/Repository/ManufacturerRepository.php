<?php

namespace Acme\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ManufacturerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ManufacturerRepository extends EntityRepository
{

		public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT * FROM manufacturers m ORDER BY m.name ASC')
            ->getResult();
    }
}