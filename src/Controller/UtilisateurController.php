<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Role;

class UtilisateurController extends AbstractFOSRestController   {

  /**
   * @var UtilisateurRepository
   */
  private $UtilisateurRepository;

  public function __construct(UtilisateurRepository $articleRepository){
    $this->UtilisateurRepository = $articleRepository;
  }

  /**
   *
  * @Rest\Post("login")
  */
  public function loginUtilisateur(Request $request, UserPasswordEncoderInterface $encoder)  {


    //we check if the username is in DB
    $user = $this->UtilisateurRepository->findByUsername($request->get('username'));

    if ($user) {

      $valid = $encoder->isPasswordValid($user, $request->get('password'));

      if ($valid) {
        return $this->view(array('success' => true, 'user' => $user), Response::HTTP_OK);
      }

      return $this->view(array('success' => false, 'errors' => "Pas le bon mot de passe"), Response::HTTP_INTERNAL_SERVER_ERROR);

    }


     return $this->view(array('success' => false, 'errors' => "L'utilisateur n'existe pas."), Response::HTTP_INTERNAL_SERVER_ERROR);
  }


  /**
  * @Rest\Post("utilisateurs")
  */
  public function postUtilisateur(Request $request, UserPasswordEncoderInterface $encoder)  {

    $utilisateur = new Utilisateur();
    $utilisateur->setNom($request->get('nom'));


    $role = $this->getDoctrine()
        ->getRepository(Role::class)
        ->find($request->get('roles'));

    $utilisateur->setRole($role);
    $utilisateur->setEmail($request->get('email'));
    //encode it.
    $encoded = $encoder->encodePassword($utilisateur, $request->get('motDePasse'));

    $utilisateur->setMotDePasse($encoded);
    $this->UtilisateurRepository->save($this->getDoctrine()->getManager(), $utilisateur);

    return $this->view($utilisateur, Response::HTTP_CREATED);
  }

  /**
  * @Rest\Get("/utilisateurs/{IdUtilisateur}")
  */
  public function getUtilisateur(Request $request)  {

    $id = $request->get('IdUtilisateur');

    $utilisateur = $this->UtilisateurRepository->findByUserId($id);
    return $this->view($utilisateur, Response::HTTP_OK);
  }

  /**
  * @Rest\Get("/utilisateurs")
  */
  public function getUtilisateurs() {

    $utilisateurs = $this->UtilisateurRepository->findAllUsers();
    return $this->view($utilisateurs, Response::HTTP_OK);
  }


  /**
   * @Rest\Get("/arbitres")
   */
  public function getArbitres() {

    $utilisateurs = $this->UtilisateurRepository->findAllUsers();
    return $this->view($utilisateurs, Response::HTTP_OK);
  }

  /**
  * @Rest\Put("/utilisateurs/{IdUtilisateur}")
  */
  public function putUtilisateur(Request $request)  {

    $id = $request->get('IdUtilisateur');

    $utilisateur = $this->UtilisateurRepository->findByUserId($id);

    if ($utilisateur) {
      $utilisateur->setNom($request->get('nom'));

      $role = $this->getDoctrine()
          ->getRepository(Role::class)
          ->find($request->get('roles'));

      $utilisateur->setRole($role);

    //  $utilisateur->setMotDePasse($request->get('motDePasse'));
      $this->UtilisateurRepository->save($this->getDoctrine()->getManager(), $utilisateur);
    }

    return $this->view($utilisateur, Response::HTTP_OK);
  }

  /**
  * @Rest\Delete("/utilisateurs/{IdUtilisateur}")
  */
  public function deleteUtilisateur(Request $request)  {

    $id = $request->get('IdUtilisateur');

    $utilisateur = $this->UtilisateurRepository->findByUserId($id);

    if ($utilisateur) {
      $this->UtilisateurRepository->delete($this->getDoctrine()->getManager(), $utilisateur);
    }

    return $this->view($utilisateur, Response::HTTP_OK);
  }

}

?>
