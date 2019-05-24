<?php

namespace App\Controller;

use App\Repository\JoueurRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use App\Entity\Joueur;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class JoueurController extends AbstractFOSRestController {

  /**
   * @var JoueurRepository
   */
  private $JoueurRepository;

  public function __construct(JoueurRepository $joueurRepository){
    $this->JoueurRepository = $joueurRepository;
  }
  
  /**
  * @Rest\Post("joueurs")
  */
  public function postJoueur(Request $request)  {

    $joueur = new joueur();
    $joueur->setNom($request->get('nom'));
    $joueur->setNationalite($request->get('nationalite'));
    $joueur->setAge($request->get('age'));
    $joueur->setPoste($request->get('poste'));
    $joueur->setEquipe($request->get('equipe'));
    $this->JoueurRepository->save($this->getDoctrine()->getManager(), $joueur);

    return $this->view( $joueur, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/joueurs/{idJoueur}")
  */
  public function getJoueur(Request $request)  {

    $id = $request->get('idJoueur');

    $joueur = $this->JoueurRepository->findByJoueurId($id);
    return $this->view( $joueur, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/joueurs")
  */
  public function getJoueurs() {

    $joueurs = $this->JoueurRepository->findAllJoueur();
    return $this->view( $joueurs, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/joueurs/{idJoueur}")
  */
  public function putJoueur(Request $request)  {

    $id = $request->get('idJoueur');

    $joueur = $this->JoueurRepository->findByJoueurId($id);

    if ($joueur) {
      $joueur->setNom($request->get('nom'));
      $joueur->setNationalite($request->get('nationalite'));
      $joueur->setAge($request->get('age'));
      $joueur->setPoste($request->get('poste'));
      $joueur->setEquipe($request->get('equipe'));
      $this->JoueurRepository->save($this->getDoctrine()->getManager(), $joueur);
    }

    return $this->view( $joueur, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/joueurs/{idJoueur}")
  */
  public function deleteJoueur(Request $request)  {

    $id = $request->get('idJoueur');

    $joueur = $this->JoueurRepository->findByJoueurId($id);

    if ($joueur) {
      $this->JoueurRepository->delete($this->getDoctrine()->getManager(), $joueur);
    }

    return $this->view([], Response::HTTP_NO_CONTENT);
  }

}

?>
