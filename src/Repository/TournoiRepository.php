<?php

namespace App\Repository;

use App\Entity\Tournoi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tournoi[]    findAll()
 * @method Tournoi[]    findById(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TournoiRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tournoi::class);
    }

    public function findAllTournoi() {
        return $this->createQueryBuilder('t')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByTournoiId($id) {
        return $this->createQueryBuilder('t')
            ->andWhere('t.IdTournoi = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function save($em, Tournoi $tournoi)
    {
        $em->persist($tournoi);
        $em->flush();
    }
}
