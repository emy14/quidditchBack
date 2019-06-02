<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Terrain;
use App\Entity\Tournoi;
use App\Entity\Utilisateur;
use App\Repository\MatchRepository;
use App\Entity\Match;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\VarDumper\Cloner\Data;
use Pusher\Pusher;

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
  public function postMatch(Request $request, Pusher $pusher)  {

    $match = new match();
    $match->setScoreDeuxiemeEquipe(0);
    $match->setScorePremiereEquipe(0);
    //$match->setTemps($request->get('temps'));

    $serializer = new Serializer(array(new DateTimeNormalizer()));

    $dateDebut = $serializer->denormalize($request->get('dateDebut'), \DateTime::class);
    $match->setDateDebut($dateDebut);

    $arbitre = $this->getDoctrine()
        ->getRepository(Utilisateur::class)
        ->find($request->get('arbitre'));

    $match->setArbitre($arbitre);


   // $match->setNiveau($request->get('niveau'));


    $terrain = $this->getDoctrine()
        ->getRepository(Terrain::class)
        ->find($request->get('terrain'));

    $match->setTerrain($terrain);

    $premiereEquipe = $this->getDoctrine()
        ->getRepository(Equipe::class)
        ->find($request->get('premiereEquipe'));

    $match->setPremiereEquipe($premiereEquipe);

    $deuxiemeEquipe = $this->getDoctrine()
        ->getRepository(Equipe::class)
        ->find($request->get('deuxiemeEquipe'));

    $match->setDeuxiemeEquipe($deuxiemeEquipe);


    $tournoi = $this->getDoctrine()
        ->getRepository(Tournoi::class)
        ->find($request->get('tournoi'));

    $match->setTournoi($tournoi);


    $this->MatchRepository->save($this->getDoctrine()->getManager(), $match);


    $matchs = $this->MatchRepository->findMatchsByTournoi($match->getTournoi());
    $this->triggerPusherAction($pusher, $matchs);



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
  * @Rest\Get("/matchs/arbitre/{arbitre}")
  */
  public function getMatchsParArbitre(Request $request)  {

    $arbitre = $request->get('arbitre');


    $matchs = $this->MatchRepository->findMatchsByArbitre($arbitre);
    return $this->view($matchs, Response::HTTP_OK);
  }

  /**
   * @Rest\Get("/matchs/tournoi/{arbitre}")
   */
  public function getMatchsParTournoi(Request $request)  {

    $tournoi = $request->get('arbitre');

    $matchs = $this->MatchRepository->findMatchsByTournoi($tournoi);
    return $this->view($matchs, Response::HTTP_OK);
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
  public function putMatch(Request $request, Pusher $pusher)  {

    $id = $request->get('idMatch');

    $match = $this->MatchRepository->findByMatchId($id);

    if ($match) {

      //$match->setTemps($request->get('temps'));

      $serializer = new Serializer(array(new DateTimeNormalizer()));

      $dateDebut = $serializer->denormalize($request->get('dateDebut'), \DateTime::class);
      $match->setDateDebut($dateDebut);


      if($request->get('dateFin') != "none"){
        $dateFin = $serializer->denormalize($request->get('dateFin'), \DateTime::class);
        $match->setDateFin($dateFin);
      } else {
        $match->setDateFin(null);
      }

      $arbitre = $this->getDoctrine()
          ->getRepository(Utilisateur::class)
          ->find($request->get('arbitre'));

      $match->setArbitre($arbitre);


      // $match->setNiveau($request->get('niveau'));


      $terrain = $this->getDoctrine()
          ->getRepository(Terrain::class)
          ->find($request->get('terrain'));

      $match->setTerrain($terrain);

      $premiereEquipe = $this->getDoctrine()
          ->getRepository(Equipe::class)
          ->find($request->get('premiereEquipe'));

      $match->setPremiereEquipe($premiereEquipe);

      $deuxiemeEquipe = $this->getDoctrine()
          ->getRepository(Equipe::class)
          ->find($request->get('deuxiemeEquipe'));

      $match->setDeuxiemeEquipe($deuxiemeEquipe);

      $tournoi = $this->getDoctrine()
          ->getRepository(Tournoi::class)
          ->find($request->get('tournoi'));

      $match->setTournoi($tournoi);

      $this->MatchRepository->save($this->getDoctrine()->getManager(), $match);
    }

    $matchs = $this->MatchRepository->findMatchsByTournoi($match->getTournoi());
    $this->triggerPusherAction($pusher, $matchs);

    return $this->view($match, Response::HTTP_OK);
  }

  public function triggerPusherAction($pusher, $matchs)
  {
    /** @var \Pusher $pusher */
  //  $pusher = $this->container->get('lopi_pusher');

    $serializedEntity = $this->container->get('serializer')->serialize($matchs, 'json');

    $data['message'] = 'hello world';
    $pusher->trigger('matchs', 'update', $serializedEntity);
  }

  /**
   * @Rest\Put("/matchs/score/{idMatch}")
   */
  public function putMatchScore(Request $request, Pusher $pusher)  {

    $id = $request->get('idMatch');

    $match = $this->MatchRepository->findByMatchId($id);

    if ($match) {
      $match->setScoreDeuxiemeEquipe($request->get('scoreDeuxiemeEquipe'));
      $match->setScorePremiereEquipe($request->get('scorePremiereEquipe'));
      $this->MatchRepository->save($this->getDoctrine()->getManager(), $match);
    }


    $matchs = $this->MatchRepository->findMatchsByTournoi($match->getTournoi());

    $this->triggerPusherAction($pusher, $matchs);

    return $this->view($match, Response::HTTP_OK);
  }

  /**
   * @Rest\Put("/matchs/end/{idMatch}")
   */
  public function endMatch(Request $request, Pusher $pusher)  {

    $id = $request->get('idMatch');

    $match = $this->MatchRepository->findByMatchId($id);

    if ($match) {

      $match->setDateFin(new \DateTime('now'));
      $this->MatchRepository->save($this->getDoctrine()->getManager(), $match);
    }

    $matchs = $this->MatchRepository->findMatchsByTournoi($match->getTournoi());
    $this->triggerPusherAction($pusher, $matchs);

    return $this->view($match, Response::HTTP_OK);
  }


  /**
  * @Rest\Delete("/matchs/{idMatch}")
  */
  public function deleteMatch(Request $request, Pusher $pusher)  {
    $id = $request->get('idMatch');

    $match = $this->MatchRepository->findByMatchId($id);

    if ($match) {
      $this->MatchRepository->delete($this->getDoctrine()->getManager(), $match);
    }

    $matchs = $this->MatchRepository->findMatchsByTournoi($match->getTournoi());
    $this->triggerPusherAction($pusher, $matchs);

    return $this->view($match, Response::HTTP_OK);
  }

}

?>
