<?php

namespace App\Controller;

use Quidditch\Entity\Pays;
use App\Repository\PaysRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class PaysController extends AbstractFOSRestController {

  /**
  * @Rest\Post("pays")
  */
  public function postPays(Request $request) : View {

    $pays = new pays();
    $pays->setNom($request->get('nom'));
    $this->PaysRepository->save($pays);

    return View::create($pays, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/pays/{idPays}")
  */
  public function getPays(int $id) : View {

    $pays = $this->PaysRepository->findById($id);
    return View::create($pays, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/pays")
  */
  public function getAllPays(): View {

    $pays = $this->PaysRepository->findAll();
    return View::create($pays, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/pays/{idPays}")
  */
  public function putPays(Request $request, int $id) : View {

    $pays = $this->PaysRepository->findById($id);

    if ($pays) {
      $pays->setNom($request->get('nom'));
      $this->PaysRepository->save($pays);
    }

    return View::create($pays, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/pays/{idPays}")
  */
  public function deletePays(int $id) : View {

    $pays = $this->PaysRepository->findById($id);

    if ($pays) {
      $this->PaysRepository->delete($pays);
    }

    return View::create([], Response::HTTP_NO_CONTENT);
  }

}

?>
