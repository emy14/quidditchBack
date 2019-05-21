<?php

namespace App\Controller;

use Quidditch\Entity\Tournoi;
use App\Repository\TournoiRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class TournoiController extends AbstractFOSRestController {

  /**
  * @Rest\Post("tournois")
  */
  public function postTournoi(Request $request) : View {

    $tournoi = new tournoi();
    $tournoi->setNom($request->get('nom'));
    $tournoi->setDate($request->get('date'));
    $tournoi->setPays($request->get('pays'));
    $this->TournoiRepository->save($tournoi);

    return View::create($tournoi, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/tournois/{idTournoi}")
  */
  public function getTournoi(int $id) : View {

    $tournoi = $this->TournoiRepository->findById($id);
    return View::create($tournoi, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/tournois")
  */
  public function getTournois(): View {

    $tournois = $this->TournoiRepository->findAll();
    return View::create($tournois, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/tournois/{idTournoi}")
  */
  public function putTournoi(Request $request, int $id) : View {

    $tournoi = $this->TournoiRepository->findById($id);

    if ($tournoi) {
      $tournoi->setNom($request->get('nom'));
      $tournoi->setDate($request->get('date'));
      $tournoi->setPays($request->get('pays'));
      $this->TournoiRepository->save($tournoi);
    }

    return View::create($tournoi, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/tournois/{idTournoi}")
  */
  public function deleteTournoi(int $id) : View {

    $tournoi = $this->TournoiRepository->findById($id);

    if ($tournoi) {
      $this->TournoiRepository->delete($tournoi);
    }

    return View::create([], Response::HTTP_NO_CONTENT);
  }

}

?>
