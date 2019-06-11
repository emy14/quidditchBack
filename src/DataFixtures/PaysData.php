<?php


namespace App\DataFixtures;

use App\Entity\Pays;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class PaysData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Pays = new Pays();
        $Pays->setNom("Etats Unis");
        $manager->persist($Pays);

        $Pays = new Pays();
        $Pays->setNom("Allemagne");
        $manager->persist($Pays);


        $manager->flush();
    }
}