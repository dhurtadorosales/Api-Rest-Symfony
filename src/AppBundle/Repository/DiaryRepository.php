<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class DiaryRepository extends EntityRepository
{
    public function getDiaryByUser(User $user)
    {
        /** @var EntityManager $em */
        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
            ->select('d')
            ->from('AppBundle:Diary', 'd')
            ->where('d.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();

        return $query;
    }
}