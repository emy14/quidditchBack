<?php

namespace App\Controller;

use Quidditch\Entity\Classement;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class ClassementController extends FOSRestController {

  /**
  * @Rest\Post("classements")
  */
  public function postClassement(Request $request) : View {

    $classement = new classement();
    $classement->setTournoi($request->get('tournoi'));
    $classement->setEquipe($request->get('equipe'));
    $classement->setScore($request->get('score'));
    $classement->setRang($request->get('rang'));
    $this->ClassementRepository->save($classement);

    return View::create($classement, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/classements/{idClassement}")
  */
  public function getClassement(int $id) : View {

    $classement = $this->ClassementRepository->findById($id);
    return View::create($classement, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/classements")
  */
  public function getClassements(): View {

    $classements = $this->ClassementRepository->findAll();
    return View::create($classements, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/classements/{idClassement}")
  */
  public function putClassement(Request $request, int $id) : View {

    $classement = $this->ClassementRepository->findById($id);

    if ($classement) {
      $classement->setTournoi($request->get('tournoi'));
      $classement->setEquipe($request->get('equipe'));
      $classement->setScore($request->get('score'));
      $classement->setRang($request->get('rang'));
      $this->ClassementRepository->save($classement);
    }

    return View::create($classement, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/classements/{idClassement}")
  */
  public function deleteClassement(int $id) : View {

    $classement = $this->ClassementRepository->findById($id);

    if ($classement) {
      $this->ClassementRepository->delete($classement);
    }

    return View::create([], Response::HTTP_NO_CONTENT);
  }

}

?>
