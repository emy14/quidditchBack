<?php

namespace App\Controller;

use Quidditch\Entity\Terrain;
use App\Repository\TerrainRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class TerrainController extends AbstractFOSRestController {

  /**
  * @Rest\Post("terrains")
  */
  public function postTerrain(Request $request) : View {

    $terrain = new terrain();
    $terrain->setNom($request->get('nom'));
    $terrain->setLieu($request->get('lieu'));
    $this->TerrainRepository->save($terrain);

    return View::create($terrain, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/terrains/{idTerrain}")
  */
  public function getTerrain(int $id) : View {

    $terrain = $this->TerrainRepository->findById($id);
    return View::create($terrain, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/terrains")
  */
  public function getTerrains(): View {

    $terrains = $this->TerrainRepository->findAll();
    return View::create($terrains, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/terrains/{idTerrain}")
  */
  public function putTerrain(Request $request, int $id) : View {

    $terrain = $this->TerrainRepository->findById($id);

    if ($terrain) {
      $terrain->setNom($request->get('nom'));
      $terrain->setLieu($request->get('lieu'));
      $this->TerrainRepository->save($terrain);
    }

    return View::create($terrain, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/terrains/{idTerrain}")
  */
  public function deleteTerrain(int $id) : View {

    $terrain = $this->TerrainRepository->findById($id);

    if ($terrain) {
      $this->TerrainRepository->delete($terrain);
    }

    return View::create([], Response::HTTP_NO_CONTENT);
  }

}

?>
