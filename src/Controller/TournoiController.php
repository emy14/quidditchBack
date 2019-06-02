<?php

namespace App\Controller;

use App\Entity\Pays;
use App\Repository\TournoiRepository;
use App\Entity\Tournoi;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use function MongoDB\BSON\toJSON;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;

class TournoiController extends AbstractFOSRestController {


  /**
   * @var TournoiRepository
   */
  private $TournoiRepository;

  public function __construct(TournoiRepository $tournoiRepository){
    $this->TournoiRepository = $tournoiRepository;
  }

  /**
  * @Rest\Post("/secure/tournois")
  */
  public function postTournoi(Request $request)  {



    $tournoi = new tournoi();

    $tournoi->setNom($request->get('nom'));

    $serializer = new Serializer(array(new DateTimeNormalizer()));
    $dateDebut = $serializer->denormalize($request->get('dateDebut'), \DateTime::class);
    $tournoi->setDateDebut($dateDebut);


    $pays = $this->getDoctrine()
        ->getRepository(Pays::class)
        ->find($request->get('pays'));

    $tournoi->setPays($pays);
    $this->TournoiRepository->save($this->getDoctrine()->getManager(), $tournoi);

    return $this->view($tournoi, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/tournois/{idTournoi}")
  */
  public function getTournoi(Request $request)  {
    $id = $request->get('idTournoi');

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
  * @Rest\Put("/secure/tournois/{idTournoi}")
  */
  public function putTournoi(Request $request)  {
    $id = $request->get('idTournoi');

    $tournoi = $this->TournoiRepository->findByTournoiId($id);

    if ($tournoi) {
      $tournoi->setNom($request->get('nom'));

      $serializer = new Serializer(array(new DateTimeNormalizer()));

      $dateDebut = $serializer->denormalize($request->get('dateDebut'), \DateTime::class);
      $tournoi->setDateDebut($dateDebut);

      if($request->get('dateFin') != "none"){
        $dateFin = $serializer->denormalize($request->get('dateFin'), \DateTime::class);
        $tournoi->setDateFin($dateFin);
      } else {
        $tournoi->setDateFin(null);
      }


      $pays = $this->getDoctrine()
          ->getRepository(Pays::class)
          ->find($request->get('pays'));


      $tournoi->setPays($pays);

      $this->TournoiRepository->save($this->getDoctrine()->getManager(), $tournoi);
    }

    return $this->view($tournoi, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/secure/tournois/{idTournoi}")
  */
  public function deleteTournoi(Request $request)  {

    $id = $request->get('idTournoi');

    $tournoi = $this->TournoiRepository->findByTournoiId($id);

    if ($tournoi) {
      $this->TournoiRepository->delete($this->getDoctrine()->getManager(), $tournoi);
    }

    return $this->view($tournoi, Response::HTTP_OK);
  }

}

?>
