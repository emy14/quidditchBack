<?php

namespace App\Controller;

use App\Repository\PaysRepository;
use App\Entity\Pays;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaysController extends AbstractFOSRestController {

  /**
   * @var PaysRepository
   */
  private $PaysRepository;

  public function __construct(PaysRepository $paysRepository){
    $this->PaysRepository = $paysRepository;
  }

  /**
  * @Rest\Post("/secure/pays")
  */
  public function postPays(Request $request) {

    $pays = new pays();
    $pays->setNom($request->get('nom'));
    $this->PaysRepository->save($this->getDoctrine()->getManager(), $pays);

    return $this->view($pays, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/pays/{idPays}")
  */
  public function getPays(Request $request)  {

    $id = $request->get('idPays');

    $pays = $this->PaysRepository->findById($id);
    return $this->view($pays, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/allpays")
  */
  public function getAllPays() {

    $pays = $this->PaysRepository->findAll();
    return $this->view($pays, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/secure/pays/{idPays}")
  */
  public function putPays(Request $request) {
    $id = $request->get('idPays');

    $pays = $this->PaysRepository->findByPaysId($id);

    if ($pays) {
      $pays->setNom($request->get('nom'));
      $this->PaysRepository->save($this->getDoctrine()->getManager(), $pays);
    }

    return $this->view($pays, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/secure/pays/{idPays}")
  */
  public function deletePays(Request $request) {
    $id = $request->get('idPays');

    $pays = $this->PaysRepository->findByPaysId($id);

    if ($pays) {
      $this->PaysRepository->delete($this->getDoctrine()->getManager(), $pays);
    }

    return $this->view($pays, Response::HTTP_OK);
  }

}

?>
