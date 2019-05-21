<?php

namespace App\Repository;

use App\Entity\Pays;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pays[]    findAll()
 * @method Pays[]    findById(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaysRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pays::class);
    }

    public function findAllPays() {
        return $this->createQueryBuilder('pa')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByPaysId($id) {
        return $this->createQueryBuilder('pa')
            ->andWhere('pa.IdPays = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function save($em, Pays $pays)
    {
        $em->persist($pays);
        $em->flush();
    }
}
