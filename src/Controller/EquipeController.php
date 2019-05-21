<?php

namespace App\Controller;

use Quidditch\Entity\Equipe;
use App\Repository\EquipeRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\AbstractFOSRestController;

class EquipeController extends AbstractFOSRestController {

  /**
  * @Rest\Post("equipes")
  */
  public function postEquipe(Request $request) : View {

    $equipe = new equipe();
    $equipe->setNom($request->get('nom'));
    $this->EquipeRepository->save($equipe);

    return View::create($equipe, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/equipes/{idEquipe}")
  */
  public function getEquipe(int $id) : View {

    $equipe = $this->EquipeRepository->findById($id);
    return View::create($equipe, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/equipes")
  */
  public function getEquipes(): View {

    $equipes = $this->EquipeRepository->findAll();
    return View::create($equipes, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/equipes/{idEquipe}")
  */
  public function putEquipe(Request $request, int $id) : View {

    $equipe = $this->EquipeRepository->findById($id);

    if ($equipe) {
      $equipe->setNom($request->get('nom'));
      $this->EquipeRepository->save($equipe);
    }

    return View::create($equipe, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/equipes/{idEquipe}")
  */
  public function deleteEquipe(int $id) : View {

    $equipe = $this->EquipeRepository->findById($id);

    if ($equipe) {
      $this->EquipeRepository->delete($equipe);
    }

    return View::create([], Response::HTTP_NO_CONTENT);
  }

}

?>
