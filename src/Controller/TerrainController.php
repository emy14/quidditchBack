<?php

namespace App\Controller;

use App\Repository\TerrainRepository;
use App\Entity\Terrain;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TerrainController extends AbstractFOSRestController {

  /**
   * @var TerrainRepository
   */
  private $TerrainRepository;

  public function __construct(TerrainRepository $terrainRepository){
    $this->TerrainRepository = $terrainRepository;
  }

  /**
  * @Rest\Post("terrains")
  */
  public function postTerrain(Request $request)  {

    $terrain = new terrain();
    $terrain->setNom($request->get('nom'));
    $terrain->setLieu($request->get('lieu'));
    $this->TerrainRepository->save($this->getDoctrine()->getManager(), $terrain);

    return $this->view($terrain, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/terrains/{idTerrain}")
  */
  public function getTerrain(int $id)  {

    $terrain = $this->TerrainRepository->findByTerrainId($id);
    return $this->view($terrain, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/terrains")
  */
  public function getTerrains() {

    $terrains = $this->TerrainRepository->findAllTerrain();
    return $this->view($terrains, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/terrains/{idTerrain}")
  */
  public function putTerrain(Request $request)  {

    $id = $request->get('id');

    $terrain = $this->TerrainRepository->findByTerrainId($id);

    if ($terrain) {
      $terrain->setNom($request->get('nom'));
      $terrain->setLieu($request->get('lieu'));
      $this->TerrainRepository->save($this->getDoctrine()->getManager(), $terrain);
    }


    return $this->view($terrain, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/terrains/{idTerrain}")
  */
  public function deleteTerrain(Request $request)  {

    $id = $request->get('id');

    $terrain = $this->TerrainRepository->findByTerrainId($id);

    if ($terrain) {
      $this->TerrainRepository->delete($this->getDoctrine()->getManager(), $terrain);
    }

    return $this->view([], Response::HTTP_NO_CONTENT);
  }

}

?>
