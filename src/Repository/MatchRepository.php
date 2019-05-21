<?php

namespace App\Repository;

use App\Entity\Match;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Match[]    findAll()
 * @method Match[]    findById(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Match::class);
    }

    public function findAllMatch() {
        return $this->createQueryBuilder('m')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByMatchId($id) {
        return $this->createQueryBuilder('m')
            ->andWhere('m.IdMatch = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
