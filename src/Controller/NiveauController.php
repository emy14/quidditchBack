<?php

namespace App\Controller;

use App\Entity\Niveau;
use App\Repository\NiveauRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NiveauController extends AbstractFOSRestController {

  /**
   * @var NiveauRepository
   */
  private $NiveauRepository;

  public function __construct(NiveauRepository $niveauRepository){
    $this->NiveauRepository = $niveauRepository;
  }

  /**
  * @Rest\Post("niveaux")
  */
  public function postNiveau(Request $request)  {

    $niveau = new niveau();
    $niveau->setNom($request->get('nom'));
    $this->NiveauRepository->save($this->getDoctrine()->getManager(), $niveau);

    return $this->view($niveau, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/niveaux/{idNiveau}")
  */
  public function getNiveau(int $id)  {

    $niveau = $this->NiveauRepository->findByNiveauId($id);
    return $this->view($niveau, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/niveaux")
  */
  public function getNiveaux() {

    $niveaux = $this->NiveauRepository->findAllNiveau();
    return $this->view($niveaux, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/niveaux/{idNiveau}")
  */
  public function putNiveau(Request $request, int $id) {

    $niveau = $this->NiveauRepository->findByNiveauId($id);

    if ($niveau) {
      $niveau->setNom($request->get('nom'));
      $this->NiveauRepository->save($this->getDoctrine()->getManager(), $niveau);
    }

    return $this->view($niveau, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/niveaux/{idNiveau}")
  */
  public function deleteNiveau(int $id)  {

    $niveau = $this->NiveauRepository->findByNiveauId($id);

    if ($niveau) {
      $this->NiveauRepository->delete($niveau);
    }

    return $this->view([], Response::HTTP_NO_CONTENT);
  }

}

?>
