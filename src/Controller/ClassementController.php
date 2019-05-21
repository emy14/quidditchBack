<?php

namespace App\Controller;

use App\Repository\ClassementRepository;
use App\Entity\Classement;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;

class ClassementController extends AbstractFOSRestController {

  /**
   * @var ClassementRepository
   */
  private $ClassementRepository;

  public function __construct(ClassementRepository $classementRepository){
    $this->ClassementRepository = $classementRepository;
  }
  
  /**
  * @Rest\Post("classements")
  */
  public function postClassement(Request $request)  {

    $classement = new classement();
    $classement->setTournoi($request->get('tournoi'));
    $classement->setEquipe($request->get('equipe'));
    $classement->setScore($request->get('score'));
    $classement->setRang($request->get('rang'));
    $this->ClassementRepository->save($this->getDoctrine()->getManager(), $classement);

   return $this->view( $classement, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/classements/{idClassement}")
  */
  public function getClassement(int $id)  {

    $classement = $this->ClassementRepository->findByClassementId($id);
   return $this->view( $classement, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/classements")
  */
  public function getClassements() {

    $classements = $this->ClassementRepository->findAllClassement();
   return $this->view( $classements, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/classements/{idClassement}")
  */
  public function putClassement(Request $request)  {

    $id = $request->get('id');

    $classement = $this->ClassementRepository->findByClassementId($id);

    if ($classement) {
      $classement->setTournoi($request->get('tournoi'));
      $classement->setEquipe($request->get('equipe'));
      $classement->setScore($request->get('score'));
      $classement->setRang($request->get('rang'));
      $this->ClassementRepository->save($this->getDoctrine()->getManager(), $classement);
    }

   return $this->view( $classement, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/classements/{idClassement}")
  */
  public function deleteClassement(Request $request)  {

    $id = $request->get('id');

    $classement = $this->ClassementRepository->findByClassementId($id);

    if ($classement) {
      $this->ClassementRepository->delete($this->getDoctrine()->getManager(), $classement);
    }

    return $this->view([], Response::HTTP_NO_CONTENT);
  }

}

?>
