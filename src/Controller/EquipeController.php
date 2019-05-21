<?php

namespace App\Controller;

use App\Repository\EquipeRepository;
use App\Entity\Equipe;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;

class EquipeController extends AbstractFOSRestController {

  /**
   * @var EquipeRepository
   */
  private $EquipeRepository;

  public function __construct(EquipeRepository $equipeRepository){
    $this->EquipeRepository = $equipeRepository;
  }

  
  /**
  * @Rest\Post("equipes")
  */
  public function postEquipe(Request $request)  {

    $equipe = new equipe();
    $equipe->setNom($request->get('nom'));
    $this->EquipeRepository->save($equipe);

    return $this->view( $equipe, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/equipes/{idEquipe}")
  */
  public function getEquipe(int $id)  {

    $equipe = $this->EquipeRepository->findByEquipeId($id);
    return $this->view( $equipe, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/equipes")
  */
  public function getEquipes() {

    $equipes = $this->EquipeRepository->findAllEquipe();
    return $this->view( $equipes, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/equipes/{idEquipe}")
  */
  public function putEquipe(Request $request, int $id)  {

    $equipe = $this->EquipeRepository->findByEquipeId($id);

    if ($equipe) {
      $equipe->setNom($request->get('nom'));
      $this->EquipeRepository->save($equipe);
    }

    return $this->view( $equipe, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/equipes/{idEquipe}")
  */
  public function deleteEquipe(int $id)  {

    $equipe = $this->EquipeRepository->findByEquipeId($id);

    if ($equipe) {
      $this->EquipeRepository->delete($equipe);
    }

    return $this->view([], Response::HTTP_NO_CONTENT);
  }

}

?>
