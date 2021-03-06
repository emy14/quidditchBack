<?php

namespace App\Controller;

use App\Entity\Poste;
use App\Repository\PosteRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PosteController extends AbstractFOSRestController {

  /**
   * @var PosteRepository
   */
  private $PosteRepository;

  public function __construct(PosteRepository $posteRepository){
    $this->PosteRepository = $posteRepository;
  }

  /**
  * @Rest\Post("postes")
  */
  public function postPoste(Request $request)  {

    $poste = new poste();
    $poste->setNom($request->get('nom'));
    $this->PosteRepository->save($this->getDoctrine()->getManager(), $poste);

    return $this->view($poste, Response::HTTP_CREATED);

  }

  /**
  * @Rest\Get("/postes/{idPoste}")
  */
  public function getPoste(Request $request)  {

    $id = $request->get('idPoste');

    $poste = $this->PosteRepository->findByPosteId($id);
    return $this->view($poste, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/postes")
  */
  public function getPostes() {

    $postes = $this->PosteRepository->findAll();
    return $this->view($postes, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/secure/postes/{idPoste}")
  */
  public function putPoste(Request $request)  {

    $id = $request->get('idPoste');

    $poste = $this->PosteRepository->findByPosteId($id);

    if ($poste) {
      $poste->setNom($request->get('nom'));
      $this->PosteRepository->save($this->getDoctrine()->getManager(), $poste);
    }
    return $this->view($poste, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/secure/postes/{idPoste}")
  */
  public function deletePoste(Request $request)  {

    $id = $request->get('idPoste');

    $poste = $this->PosteRepository->findByPosteId($id);

    if ($poste) {
      $this->PosteRepository->delete($this->getDoctrine()->getManager(), $poste);
    }

    return $this->view($poste, Response::HTTP_OK);
  }

}

?>
