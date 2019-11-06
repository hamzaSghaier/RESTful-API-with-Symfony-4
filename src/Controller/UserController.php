<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations as Rest; 
use App\Entity\User;
use App\Form\UserType;


class UserController extends AbstractController
{



    /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/users")
     */
    public function postUsersAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $user;
        } else {
            return $form;
        }
    }

    /**
     * @Rest\View()
     * @Rest\Patch("/users/{id}")
     */
    public function patchUserAction(Request $request)
    {
        return $this->updateUser($request, false);
    }
    
    /**
     * @Rest\View()
     * @Rest\Put("/users/{id}")
     */
    public function putUserAction(Request $request)
    {
        return $this->updateUser($request, true);

    }




    

    public function updateUser(Request $request, $clearMissing)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($request->get('id'));
        if (empty($user)) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        } 
        $form = $this->createForm(UserType::class, $user);

        $form->submit($request->request->all(), $clearMissing); // Validation des données
  
        if ($form->isValid()) {
  
          $em = $this->getDoctrine()->getManager();
          $em->merge($user);
          $em->flush();
          
           return $user;
          } else {
          return $form;
           }
  
    }


/**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/users/{id}")
     */
    public function deleteUserAction($id ,Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)
                    ->find($id);
        /* @var $place Place */
        if (empty($user)) {
            return new JsonResponse(['message' => 'User  not found'], Response::HTTP_NOT_FOUND);;
        }else{
        $em->remove($user);
        $em->flush();
        return new JsonResponse(['message' => 'User ' .$id.' Deleted']);

    }
    }




    
  /**
     * @Rest\View()
     * @Rest\Get("/users")
     */
    public function getUsersAction(Request $request)
    {
        $users = $this->getDoctrine()
        ->getRepository(User::class)
                ->findAll();
        /* @var $users User[] */

        return $users;
    }

    /**
     * @Rest\View()
     * @Rest\Get("/users/{user_id}")
     */
    public function getUserAction($user_id, Request $request)
    {
        $user = $this->getDoctrine()
        ->getRepository(User::class)
                ->find($request->get('user_id'));
        /* @var $user User */

        if (empty($user)) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }

        return $user;
    }

}
