<?php

namespace App\Repository;

use App\Entity\Joueur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Joueur[]    findAll()
 * @method Joueur[]    findById(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JoueurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Joueur::class);
    }

    public function findAllJoueur() {
        return $this->createQueryBuilder('j')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByJoueurId($id) {
        return $this->createQueryBuilder('j')
            ->andWhere('j.IdJoueur = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function save($em, Joueur $joueur)
    {
        $em->persist($joueur);
        $em->flush();
    }

    public function delete($em, Joueur $joueur)
    {
        $em->remove($joueur);
        $em->flush();
    }
}
