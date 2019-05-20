<?php

namespace App\Controller;

use Quidditch\Entity\Joueur;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class JoueurController extends FOSRestController {

  /**
  * @Rest\Post("joueurs")
  */
  public function postJoueur(Request $request) : View {

    $joueur = new joueur();
    $joueur->setNom($request->get('nom'));
    $joueur->setPrenom($request->get('prenom'));
    $joueur->setNationalite($request->get('nationalite'));
    $joueur->setAge($request->get('age'));
    $joueur->setPoste($request->get('poste'));
    $joueur->setEquipe($request->get('equipe'));
    $this->JoueurRepository->save($joueur);

    return View::create($joueur, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/joueurs/{idJoueur}")
  */
  public function getJoueur(int $id) : View {

    $joueur = $this->JoueurRepository->findById($id);
    return View::create($joueur, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/joueurs")
  */
  public function getJoueurs(): View {

    $joueurs = $this->JoueurRepository->findAll();
    return View::create($joueurs, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/joueurs/{idJoueur}")
  */
  public function putJoueur(Request $request, int $id) : View {

    $joueur = $this->JoueurRepository->findById($id);

    if ($joueur) {
      $joueur->setNom($request->get('nom'));
      $joueur->setPrenom($request->get('prenom'));
      $joueur->setNationalite($request->get('nationalite'));
      $joueur->setAge($request->get('age'));
      $joueur->setPoste($request->get('poste'));
      $joueur->setEquipe($request->get('equipe'));
      $this->JoueurRepository->save($joueur);
    }

    return View::create($joueur, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/joueurs/{idJoueur}")
  */
  public function deleteJoueur(int $id) : View {

    $joueur = $this->JoueurRepository->findById($id);

    if ($joueur) {
      $this->JoueurRepository->delete($joueur);
    }

    return View::create([], Response::HTTP_NO_CONTENT);
  }

}

?>
