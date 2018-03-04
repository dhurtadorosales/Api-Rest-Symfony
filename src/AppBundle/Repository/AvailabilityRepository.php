<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManager;

class AvailabilityRepository extends EntityRepository
{
    public function getAvailabilities($firstResult, $maxResult, $searchValue)
    {
        /** @var EntityManager $em */
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
            ->select('a')
            ->from('AppBundle:Availability', 'a')
            ->where('a.date LIKE :searchValue')
            ->orWhere('a.time LIKE :searchValue')
            ->setFirstResult($firstResult)
            ->setMaxResults($maxResult)
            ->setParameter('searchValue', '%' . $searchValue . '%')
            ->getQuery()
            ->getResult();

        return $query;
    }
}