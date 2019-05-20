<?php

namespace App\Controller;

use Quidditch\Entity\Match;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class MatchController extends FOSRestController{

  /**
  * @Rest\Post("matchs")
  */
  public function postMatch(Request $request) : View {

    $match = new match();
    $match->setScore($request->get('score'));
    $match->setTemps($request->get('temps'));
    $match->setDate($request->get('date'));
    $match->setArbitre($request->get('arbitre'));
    $match->setNiveau($request->get('niveau'));
    $match->setTerrain($request->get('terrain'));
    $match->setPremiereEquipe($request->get('premiereEquipe'));
    $match->setDeuxiemeEquipe($request->get('deuxiemeEquipe'));
    $this->MatchRepository->save($match);

    return View::create($match, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/matchs/{idMatch}")
  */
  public function getMatch(int $id) : View {

    $match = $this->MatchRepository->findById($id);
    return View::create($match, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/matchs")
  */
  public function getMatchs(): View {

    $matchs = $this->MatchRepository->findAll();
    return View::create($matchs, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/matchs/{idMatch}")
  */
  public function putMatch(Request $request, int $id) : View {

    $match = $this->MatchRepository->findById($id);

    if ($match) {
      $match->setScore($request->get('score'));
      $match->setTemps($request->get('temps'));
      $match->setDate($request->get('date'));
      $match->setArbitre($request->get('arbitre'));
      $match->setNiveau($request->get('niveau'));
      $match->setTerrain($request->get('terrain'));
      $match->setPremiereEquipe($request->get('premiereEquipe'));
      $match->setDeuxiemeEquipe($request->get('deuxiemeEquipe'));
      $this->MatchRepository->save($match);
    }

    return View::create($match, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/matchs/{idMatch}")
  */
  public function deleteMatch(int $id) : View {

    $match = $this->MatchRepository->findById($id);

    if ($match) {
      $this->MatchRepository->delete($match);
    }

    return View::create([], Response::HTTP_NO_CONTENT);
  }

}

?>
