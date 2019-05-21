<?php

namespace App\Repository;

use App\Entity\Classement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Classement[]    findAll()
 * @method Classement[]    findById(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassementRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Classement::class);
    }

    public function findAllClassement() {
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByClassementId($id) {
        return $this->createQueryBuilder('c')
            ->andWhere('c.IdEquipe = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
