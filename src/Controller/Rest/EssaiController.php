<?php

namespace App\Controller\Rest;

use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\AbstractFOSRestController ;
use FOS\RestBundle\Controller\Annotations as Rest;

class EssaiController extends AbstractFOSRestController

{
    /**
     * Retrieves an Essai resource
     * @Rest\Get("/essai")
     */
    public function index()
    {
        // if you know the data to send when creating the response
        $response = new JsonResponse(['data' => 'essai']);
        return $response;
    }
}
