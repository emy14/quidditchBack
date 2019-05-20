<?php

namespace App\Controller;

use Quidditch\Entity\Poste;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class PosteController extends FOSRestController {

  /**
  * @Rest\Post("postes")
  */
  public function postPoste(Request $request) : View {

    $poste = new poste();
    $poste->setNom($request->get('nom'));
    $this->PosteRepository->save($poste);

    return View::create($poste, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/postes/{idPoste}")
  */
  public function getPoste(int $id) : View {

    $poste = $this->PosteRepository->findById($id);
    return View::create($poste, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/postes")
  */
  public function getPostes(): View {

    $postes = $this->PosteRepository->findAll();
    return View::create($postes, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/postes/{idPoste}")
  */
  public function putPoste(Request $request, int $id) : View {

    $poste = $this->PosteRepository->findById($id);

    if ($poste) {
      $poste->setNom($request->get('nom'));
      $this->PosteRepository->save($poste);
    }

    return View::create($poste, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/postes/{idPoste}")
  */
  public function deletePoste(int $id) : View {

    $poste = $this->PosteRepository->findById($id);

    if ($poste) {
      $this->PosteRepository->delete($poste);
    }

    return View::create([], Response::HTTP_NO_CONTENT);
  }

}

?>
