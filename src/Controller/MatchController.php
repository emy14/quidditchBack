<?php

namespace App\Controller;

use App\Repository\MatchRepository;
use App\Entity\Match;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MatchController extends AbstractFOSRestController{

  /**
   * @var MatchRepository
   */
  private $MatchRepository;

  public function __construct(MatchRepository $matchRepository){
    $this->MatchRepository = $matchRepository;
  }
  
  /**
  * @Rest\Post("matchs")
  */
  public function postMatch(Request $request)  {

    $match = new match();
    $match->setScore($request->get('score'));
    $match->setTemps($request->get('temps'));
    $match->setDate($request->get('date'));
    $match->setArbitre($request->get('arbitre'));
    $match->setNiveau($request->get('niveau'));
    $match->setTerrain($request->get('terrain'));
    $match->setPremiereEquipe($request->get('premiereEquipe'));
    $match->setDeuxiemeEquipe($request->get('deuxiemeEquipe'));
    $this->MatchRepository->save($this->getDoctrine()->getManager(), $match);

    return $this->view($match, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/matchs/{idMatch}")
  */
  public function getMatch(Request $request)  {

    $id = $request->get('idMatch');

    $match = $this->MatchRepository->findByMatchId($id);
    return $this->view($match, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/matchs")
  */
  public function getMatchs() {

    $matchs = $this->MatchRepository->findAllMatch();
    return $this->view($matchs, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/matchs/{idMatch}")
  */
  public function putMatch(Request $request)  {

    $id = $request->get('idMatch');

    $match = $this->MatchRepository->findByMatchId($id);

    if ($match) {
      $match->setScore($request->get('score'));
      $match->setTemps($request->get('temps'));
      $match->setDate($request->get('date'));
      $match->setArbitre($request->get('arbitre'));
      $match->setNiveau($request->get('niveau'));
      $match->setTerrain($request->get('terrain'));
      $match->setPremiereEquipe($request->get('premiereEquipe'));
      $match->setDeuxiemeEquipe($request->get('deuxiemeEquipe'));
      $this->MatchRepository->save($this->getDoctrine()->getManager(), $match);
    }

    return $this->view($match, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/matchs/{idMatch}")
  */
  public function deleteMatch(Request $request)  {
    $id = $request->get('idMatch');

    $match = $this->MatchRepository->findByMatchId($id);

    if ($match) {
      $this->MatchRepository->delete($this->getDoctrine()->getManager(), $match);
    }

    return $this->view([], Response::HTTP_NO_CONTENT);
  }

}

?>
