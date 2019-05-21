<?php

namespace App\Repository;

use App\Entity\Poste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Poste[]    findAll()
 * @method Poste[]    findById(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PosteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Poste::class);
    }

    public function findAll(): ?Poste {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findById($id): ?Poste {
        return $this->createQueryBuilder('p')
            ->andWhere('p.IdPoste = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
