<?php

namespace App\Controller;

use Quidditch\Entity\Niveau;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class NiveauController extends AbstractFOSRestController {

  /**
  * @Rest\Post("niveaux")
  */
  public function postNiveau(Request $request) : View {

    $niveau = new niveau();
    $niveau->setNom($request->get('nom'));
    $this->NiveauRepository->save($niveau);

    return View::create($niveau, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/niveaux/{idNiveau}")
  */
  public function getNiveau(int $id) : View {

    $niveau = $this->NiveauRepository->findById($id);
    return View::create($niveau, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/niveaux")
  */
  public function getNiveaux(): View {

    $niveaux = $this->NiveauRepository->findAll();
    return View::create($niveaux, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/niveaux/{idNiveau}")
  */
  public function putNiveau(Request $request, int $id) : View {

    $niveau = $this->NiveauRepository->findById($id);

    if ($niveau) {
      $niveau->setNom($request->get('nom'));
      $this->NiveauRepository->save($niveau);
    }

    return View::create($niveau, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/niveaux/{idNiveau}")
  */
  public function deleteNiveau(int $id) : View {

    $niveau = $this->NiveauRepository->findById($id);

    if ($niveau) {
      $this->NiveauRepository->delete($niveau);
    }

    return View::create([], Response::HTTP_NO_CONTENT);
  }

}

?>
