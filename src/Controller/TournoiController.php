<?php

namespace App\Controller;

use App\Repository\TournoiRepository;
use App\Entity\Tournoi;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TournoiController extends AbstractFOSRestController {


  /**
   * @var TournoiRepository
   */
  private $TournoiRepository;

  public function __construct(TournoiRepository $tournoiRepository){
    $this->TournoiRepository = $tournoiRepository;
  }

  /**
  * @Rest\Post("tournois")
  */
  public function postTournoi(Request $request)  {

    $tournoi = new tournoi();
    $tournoi->setNom($request->get('nom'));
    $tournoi->setDate($request->get('date'));
    $tournoi->setPays($request->get('pays'));
    $this->TournoiRepository->save($tournoi);

    return $this->view($tournoi, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/tournois/{idTournoi}")
  */
  public function getTournoi(int $id)  {

    $tournoi = $this->TournoiRepository->findByTournoiId($id);
    return $this->view($tournoi, Response::HTTP_OK);

  }

  /**
  * @Rest\Get("/tournois")
  */
  public function getTournois() {

    $tournois = $this->TournoiRepository->findAllTournoi();
    return $this->view($tournois, Response::HTTP_OK);

  }

  /**
  * @Rest\Put("/tournois/{idTournoi}")
  */
  public function putTournoi(Request $request, int $id)  {

    $tournoi = $this->TournoiRepository->findByTournoiId($id);

    if ($tournoi) {
      $tournoi->setNom($request->get('nom'));
      $tournoi->setDate($request->get('date'));
      $tournoi->setPays($request->get('pays'));
      $this->TournoiRepository->save($tournoi);
    }

    return $this->view($tournoi, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/tournois/{idTournoi}")
  */
  public function deleteTournoi(int $id)  {

    $tournoi = $this->TournoiRepository->findByTournoiId($id);

    if ($tournoi) {
      $this->TournoiRepository->delete($tournoi);
    }

    return $this->view([], Response::HTTP_NO_CONTENT);
  }

}

?>
