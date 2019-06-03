<?php


namespace App\DataFixtures;

use App\Entity\Pays;
use App\Entity\Terrain;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class TerrainData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Terrain = new Terrain();
        $Terrain->setNom("Poudlard");

        $Pays = new Pays();
        $Pays->setNom("Ecosse");
        $manager->persist($Pays);

        $Terrain->setLieu($Pays);
        $manager->persist($Terrain);


        $Terrain = new Terrain();
        $Terrain->setNom("Terrain Volant");

        $Pays = new Pays();
        $Pays->setNom("France");
        $manager->persist($Pays);

        $Terrain->setLieu($Pays);

        $manager->persist($Terrain);

        $Terrain = new Terrain();
        $Terrain->setNom("Trois balais");


        $Pays = new Pays();
        $Pays->setNom("Espagne");
        $manager->persist($Pays);

        $Terrain->setLieu($Pays);

        $manager->persist($Terrain);

        $manager->flush();
    }
}