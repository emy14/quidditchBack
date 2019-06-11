<?php

namespace App\DataFixtures;

use App\Entity\Niveau;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class NiveauData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Niveau = new Niveau();
        $Niveau->setNom("National");
        $manager->persist($Niveau);

        $Niveau = new Niveau();
        $Niveau->setNom("Local");
        $manager->persist($Niveau);

        $Niveau = new Niveau();
        $Niveau->setNom("Championnat Jeune");
        $manager->persist($Niveau);

        $Niveau = new Niveau();
        $Niveau->setNom("Départmental");
        $manager->persist($Niveau);



        $manager->flush();
    }
}