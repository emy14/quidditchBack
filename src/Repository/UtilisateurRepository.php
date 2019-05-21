<?php

namespace App\Repository;

use App\Entity\Utilisateur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\EntityManagerInterface;

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

    public function findAllUsers() {
        return $this->createQueryBuilder('u')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByUserId($id)  {
        return $this->createQueryBuilder('u')
            ->andWhere('u.idUtilisateur = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }


    public function findByUserLogin($email, $motDePasse)  {
        return $this->createQueryBuilder('u')
          ->andWhere('u.email = :email')
          ->andWhere('u.mot_de_passe = :mot_de_passe')
          ->setParameter('email', $email)
          ->setParameter('mot_de_passe', $motDePasse)
          ->getQuery()
          ->getOneOrNullResult()
        ;
    }

    public function save($em, Utilisateur $customer)
    {
        $em->persist($customer);
        $em->flush();
    }

    public function delete($em, Utilisateur $customer)
    {
        $em->remove($customer);
        $em->flush();
    }
}
