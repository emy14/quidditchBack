<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Pays;
use App\Entity\Poste;
use App\Repository\JoueurRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Entity\Joueur;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class JoueurController extends AbstractFOSRestController {

  /**
   * @var JoueurRepository
   */
  private $JoueurRepository;

  public function __construct(JoueurRepository $joueurRepository){
    $this->JoueurRepository = $joueurRepository;
  }
  
  /**
  * @Rest\Post("/secure/joueurs")
  */
  public function postJoueur(Request $request)  {

    $joueur = new joueur();
    $joueur->setNom($request->get('nom'));

    $nationalite = $this->getDoctrine()
        ->getRepository(Pays::class)
        ->find($request->get('nationalite'));

    $joueur->setNationalite($nationalite);


   // $joueur->setAge($request->get('age'));

    $poste = $this->getDoctrine()
        ->getRepository(Poste::class)
        ->find($request->get('poste'));

    $joueur->setPoste($poste);

    $equipe = $this->getDoctrine()
        ->getRepository(Equipe::class)
        ->find($request->get('equipe'));
    $joueur->setEquipe($equipe);

    $this->JoueurRepository->save($this->getDoctrine()->getManager(), $joueur);

    return $this->view( $joueur, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/joueurs/{idJoueur}")
  */
  public function getJoueur(Request $request)  {

    $id = $request->get('idJoueur');

    $joueur = $this->JoueurRepository->findByJoueurId($id);
    return $this->view( $joueur, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/joueurs")
  */
  public function getJoueurs() {

    $joueurs = $this->JoueurRepository->findAllJoueur();
    return $this->view( $joueurs, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/secure/joueurs/{idJoueur}")
  */
  public function putJoueur(Request $request)  {

    $id = $request->get('idJoueur');

    $joueur = $this->JoueurRepository->findByJoueurId($id);

    if ($joueur) {
      $joueur->setNom($request->get('nom'));

      $nationalite = $this->getDoctrine()
          ->getRepository(Pays::class)
          ->find($request->get('nationalite'));

      $joueur->setNationalite($nationalite);


      // $joueur->setAge($request->get('age'));

      $poste = $this->getDoctrine()
          ->getRepository(Poste::class)
          ->find($request->get('poste'));

      $joueur->setPoste($poste);

      $equipe = $this->getDoctrine()
          ->getRepository(Equipe::class)
          ->find($request->get('equipe'));
      $joueur->setEquipe($equipe);

      $this->JoueurRepository->save($this->getDoctrine()->getManager(), $joueur);
    }

    return $this->view( $joueur, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/secure/joueurs/{idJoueur}")
  */
  public function deleteJoueur(Request $request)  {

    $id = $request->get('idJoueur');

    $joueur = $this->JoueurRepository->findByJoueurId($id);

    if ($joueur) {
      $this->JoueurRepository->delete($this->getDoctrine()->getManager(), $joueur);
    }

    return $this->view($joueur, Response::HTTP_OK);
  }

}

?>
