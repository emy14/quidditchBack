<?php

namespace App\Controller;

use Quidditch\Entity\Utilisateur;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class UtilisateurController extends AbstractFOSRestController {

  /**
  * @Rest\Post("utilisateurs")
  */
  public function postUtilisateur(Request $request) : View {

    $utilisateur = new Utilisateur();
    $utilisateur->setNom($request->get('nom'));
    $utilisateur->setRole($request->get('role'));
    $this->UtilisateurRepository->save($utilisateur);

    return View::create($utilisateur, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/utilisateurs/{IdUtilisateur}")
  */
  public function getUtilisateur(int $id) : View {

    $utilisateur = $this->UtilisateurRepository->findById($id);
    return View::create($utilisateur, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/utilisateurs")
  */
  public function getUtilisateurs(): View {

    $utilisateurs = $this->UtilisateurRepository->findAll();
    return View::create($utilisateurs, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/utilisateurs/{IdUtilisateur}")
  */
  public function putUtilisateur(Request $request, int $id) : View {

    $utilisateur = $this->UtilisateurRepository->findById($id);

    if ($utilisateur) {
      $utilisateur->setNom($request->get('nom'));
      $utilisateur->setRole($request->get('role'));
      $this->UtilisateurRepository->save($utilisateur);
    }

    return View::create($utilisateur, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/utilisateurs/{IdUtilisateur}")
  */
  public function deleteUtilisateur(int $id) : View {

    $utilisateur = $this->UtilisateurRepository->findById($id);

    if ($utilisateur) {
      $this->UtilisateurRepository->delete($utilisateur);
    }

    return View::create([], Response::HTTP_NO_CONTENT);
  }

}

?>
