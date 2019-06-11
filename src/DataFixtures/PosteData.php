<?php

namespace App\DataFixtures;

use App\Entity\Poste;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class PosteData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $poste = new Poste();
        $poste->setNom("Attrapeur");
        $manager->persist($poste);


        $poste = new Poste();
        $poste->setNom("Poursuiveur");
        $manager->persist($poste);

        $poste = new Poste();
        $poste->setNom("Gardien");
        $manager->persist($poste);

        $poste = new Poste();
        $poste->setNom("Batteur");
        $manager->persist($poste);



        $manager->flush();
    }
}