<?php

namespace App\Repository;

use App\Entity\Equipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Equipe[]    findAll()
 * @method Equipe[]    findById(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Equipe::class);
    }

    public function findAllEquipe() {
        return $this->createQueryBuilder('e')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByEquipeId($id) {
        return $this->createQueryBuilder('e')
            ->andWhere('e.idEquipe = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function save($em, Equipe $equipe)
    {
        $em->persist($equipe);
        $em->flush();
    }

    public function delete($em, Equipe $equipe)
    {
        $em->remove($equipe);
        $em->flush();
    }
}
