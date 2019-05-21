<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findById(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Utilisateur[]    findByLogin()
 */
class UtilisateurRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    public function findAll(): ?Utilisateur {
        return $this->createQueryBuilder('u')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findById($id): ?Utilisateur {
        return $this->createQueryBuilder('u')
            ->andWhere('u.IdUtilisateur = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findByLogin($email, $motDePasse): ?Utilisateur {
        return $this->createQueryBuilder('u')
          ->andWhere('u.email = :email')
          ->andWhere('u.motDePasse = :motDePasse')
          ->setParameter('email', $email)
          ->setParameter('motDePasse', $motDePasse)
          ->getQuery()
          ->getOneOrNullResult()
        ;
    }

}
