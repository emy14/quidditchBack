<?php

namespace App\Repository;

use App\Entity\Niveau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Niveau[]    findAll()
 * @method Niveau[]    findById(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NiveauRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Niveau::class);
    }

    public function findAllNiveau() {
        return $this->createQueryBuilder('n')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByNiveauId($id) {
        return $this->createQueryBuilder('n')
            ->andWhere('n.IdNiveau = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function save($em, Niveau $niveau)
    {
        $em->persist($niveau);
        $em->flush();
    }

    public function delete($em, Niveau $niveau)
    {
        $em->remove($niveau);
        $em->flush();
    }
}
