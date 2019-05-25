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

    public function findAllTerrain() {
        return $this->createQueryBuilder('te')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByTerrainId($id){
        return $this->createQueryBuilder('te')
            ->andWhere('te.idTerrain = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function save($em, Terrain $terrain)
    {
        $em->persist($terrain);
        $em->flush();
    }

    public function delete($em, Terrain $terrain)
    {
        $em->remove($terrain);
        $em->flush();
    }
}
