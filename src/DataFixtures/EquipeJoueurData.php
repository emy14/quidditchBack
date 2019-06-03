<?php


namespace App\DataFixtures;

use App\Entity\Equipe;
use App\Entity\Joueur;
use App\Entity\Pays;
use App\Entity\Poste;
use App\Entity\Tournoi;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class EquipeJoueurData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $Equipe = new Equipe();
        $Equipe->setNom("Gryffondor");
        $manager->persist($Equipe);

        $Tournoi = new Tournoi();
        $Tournoi->setNom("Coupe de Quidditch des Quatre Maison");
        $Tournoi->setDateDebut(new \DateTime());

        $Pays = new Pays();
        $Pays->setNom("Angleterre");
        $manager->persist($Pays);

        $Tournoi->setPays($Pays);
        $manager->persist($Tournoi);

        $Joueur = new Joueur();
        $Joueur->setNom("Ginny Weasley");
        $Joueur->setEquipe($Equipe);
        $Joueur->setAge("20");
        $Joueur->setNationalite($Pays);

        $poste = new Poste();
        $poste->setNom("Attrapeur");
        $manager->persist($poste);

        $Joueur->setPoste($poste);

        $manager->persist($Joueur);

        $Equipe = new Equipe();
        $Equipe->setNom("Poufsouffle");
        $manager->persist($Equipe);

        $Equipe = new Equipe();
        $Equipe->setNom("Serdaigle");
        $manager->persist($Equipe);

        $Equipe = new Equipe();
        $Equipe->setNom("Serpentard");
        $manager->persist($Equipe);

        $Joueur = new Joueur();
        $Joueur->setNom("Drago Malefoy");
        $Joueur->setEquipe($Equipe);
        $Joueur->setAge("20");
        $Joueur->setNationalite($Pays);
        $Joueur->setPoste($poste);

        $manager->persist($Joueur);

        $Equipe = new Equipe();
        $Equipe->setNom("Balais de Braga");
        $manager->persist($Equipe);

        $Equipe = new Equipe();
        $Equipe->setNom("Tueurs-de-géants de Gimbi");
        $manager->persist($Equipe);

        $Equipe = new Equipe();
        $Equipe->setNom("Cork");
        $manager->persist($Equipe);

        $Equipe = new Equipe();
        $Equipe->setNom("Angleterre");
        $manager->persist($Equipe);

        $Equipe = new Equipe();
        $Equipe->setNom("France");
        $manager->persist($Equipe);

        $Equipe = new Equipe();
        $Equipe->setNom("Ecosse");
        $manager->persist($Equipe);

        $Equipe = new Equipe();
        $Equipe->setNom("Asie");
        $manager->persist($Equipe);

        $manager->flush();
    }
}