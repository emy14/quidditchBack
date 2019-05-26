<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Tests\Common\DataFixtures\TestEntity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }



    public function load(ObjectManager $manager)
    {

        $adminRole = new Role();
        $adminRole->setName("ADMIN");


        $arbitreRole = new Role();
        $arbitreRole->setName("ARBITRE");

        $manager->persist($arbitreRole);
        $manager->persist($adminRole);

        // create 20 users! Bam!
        for ($i = 0; $i < 10; $i++) {
            $user = new Utilisateur();
            $email = "admin".$i."@mail.com";
            $user->setNom("admin".$i);

            $user->setEmail($email);


            $user->setRole($adminRole);
            //encode it.
            $encoded = $this->encoder->encodePassword($user, 'admin');;

            $user->setMotDePasse($encoded);
            $manager->persist($user);
        }

        for ($i = 0; $i < 10; $i++) {
            $user = new Utilisateur();
            $email = "arbitre".$i."@mail.com";

            $user->setEmail($email);
            $user->setNom("arbitre".$i);

            $user->setRole($arbitreRole);
            //encode it.
            $encoded = $this->encoder->encodePassword($user, 'arbitre');;

            $user->setMotDePasse($encoded);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
