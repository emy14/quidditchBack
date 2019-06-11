<?php

namespace App\DataFixtures;

use App\Entity\Pays;
use App\Entity\Tournoi;
use App\Entity\User;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserTournoiData extends Fixture implements ContainerAwareInterface
{
    const USER_MANAGER = 'fos_user.user_manager';

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var UserManager
     */
    private $userManager;

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->userManager = $this->container->get(static::USER_MANAGER);
    }

    public function load(ObjectManager $manager)
    {

        /** @var Utilisateur $user */
        $user = $this->userManager->createUser();

        $user
            ->setFirstName("SuperAdmin")
            ->setLastName("SuperAdmin")
            ->setEnabled(true)
            ->setRoles(array(Utilisateur::ROLE_SUPER_ADMIN))
            ->setUsername("superadmin")
            ->setPlainPassword("superadmin")
            ->setEmail("superadmin@gmail.com")
        ;
        $manager->persist($user);
        $manager->flush();

        /** @var Utilisateur $user */
        $user = $this->userManager->createUser();

        $user
            ->setFirstName("Noémie")
            ->setLastName("Mais")
            ->setEnabled(true)
            ->setRoles(array(Utilisateur::ROLE_ADMIN))
            ->setUsername("nm")
            ->setPlainPassword("admin")
            ->setEmail("nm@gmail.com")
        ;
        $manager->persist($user);
        $manager->flush();

        /** @var Utilisateur $user */
        $user = $this->userManager->createUser();

        $user
            ->setFirstName("Admin")
            ->setLastName("admin")
            ->setEnabled(true)
            ->setRoles(array(Utilisateur::ROLE_ADMIN))
            ->setUsername("admin")
            ->setPlainPassword("admin")
            ->setEmail("admin@gmail.com")
        ;
        $manager->persist($user);
        $manager->flush();


        //user for the admin

        $Tournoi = new Tournoi();
        $Tournoi->setNom("Coupe du Monde de Quidditch");
        $Tournoi->setDateDebut(new \DateTime());

        $Pays = new Pays();
        $Pays->setNom("Burkina Faso");
        $manager->persist($Pays);


        $Tournoi->setCreatedBy($user);

        $Tournoi->setPays($Pays);

        $manager->persist($Tournoi);

        $manager->flush();



        /** @var Utilisateur $user */
        $user = $this->userManager->createUser();

        $user
            ->setFirstName("Arbitre")
            ->setLastName("arbitre")
            ->setEnabled(true)
            ->setRoles(array(Utilisateur::ROLE_ARBITRE))
            ->setUsername("arbitre")
            ->setPlainPassword("arbitre")
            ->setEmail("arbitre@gmail.com")
        ;
        $manager->persist($user);
        $manager->flush();


        /** @var Utilisateur $user */
        $user = $this->userManager->createUser();

        $user
            ->setFirstName("Renee")
            ->setLastName("Bibine")
            ->setEnabled(true)
            ->setRoles(array(Utilisateur::ROLE_ARBITRE))
            ->setUsername("rb")
            ->setPlainPassword("arbitre")
            ->setEmail("reneebibine@gmail.com")
        ;
        $manager->persist($user);
        $manager->flush();


        /** @var Utilisateur $user */
        $user = $this->userManager->createUser();

        $user
            ->setFirstName("Hassan")
            ->setLastName("Mostafa")
            ->setEnabled(true)
            ->setRoles(array(Utilisateur::ROLE_ARBITRE))
            ->setUsername("hm")
            ->setPlainPassword("arbitre")
            ->setEmail("hassanmostafa@gmail.com")
        ;
        $manager->persist($user);
        $manager->flush();
    }
}