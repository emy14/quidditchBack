<?php

namespace App\Repository;

use App\Entity\Terrain;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Terrain[]    findAll()
 * @method Terrain[]    findById(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TerrainRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Terrain::class);
    }

    public function findAll(): ?Terrain {
        return $this->createQueryBuilder('te')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findById($id): ?Terrain {
        return $this->createQueryBuilder('te')
            ->andWhere('te.IdTerrain = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
