<?php

namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Place;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\ViewHandler;
use FOS\RestBundle\View\View; 
use FOS\RestBundle\Controller\Annotations as Rest;
use App\Form\PlaceType;



class PlaceController extends Controller
{
 
   

     /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/places")
     */
    public function postPlacesAction(Request $request)
    {

      $place = new Place();

      $form = $this->createForm(PlaceType::class, $place);

      $form->handleRequest($request); // Validation des données

      if ($form->isValid()) {

        $em = $this->getDoctrine()->getManager();
        $em->persist($place);
        $em->flush();
        
         return $place;
        } else {
        return $form;
         }

    }



    /**
     * @Rest\View(statusCode=Response::HTTP_NO_CONTENT)
     * @Rest\Delete("/places/{id}")
   */
            public function deletePlaceAction($id ,Request $request)
            {
                $em = $this->getDoctrine()->getManager();
                $place = $em->getRepository(Place::class)
                            ->find($id);
                /* @var $place Place */
                if (empty($place)) {
                    return new JsonResponse(['message' => 'place  not found'], Response::HTTP_NOT_FOUND);;
                }else{
                $em->remove($place);
                $em->flush();
                return new JsonResponse(['message' => 'place ' .$id.' Deleted']);

            }
        }




    /**
     * @Rest\View()
     * @Rest\Put("/places/{id}")
     */
    public function putPlaceAction(Request $request)
    {
        return $this->updatePlace($request, true);
    }



    /**
     * @Rest\View()
     * @Rest\Patch("/places/{id}")
     */
    public function patchPlaceAction(Request $request)
    {
        return $this->updatePlace($request, false);
    }

   
    public function updatePlace(Request $request, $clearMissing)
    {
        $place = $this->getDoctrine()->getRepository(Place::class)->find($request->get('id'));
        if (empty($place)) {
            return new JsonResponse(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        } 
        $form = $this->createForm(PlaceType::class, $place);

        $form->submit($request->request->all(), $clearMissing); // Validation des données
  
        if ($form->isValid()) {
  
          $em = $this->getDoctrine()->getManager();
          $em->merge($place);
          $em->flush();
          
           return $place;
          } else {
          return $form;
           }
  
    }

    
    /**
         * @Rest\View(serializerGroups={"place"})
         * @Rest\Get("/places")
     */
    public function getPlacesAction(Request $request)
        {
           $places = $this->getDoctrine()->getRepository(Place::class)->findAll();
           return $places;
        }


   /**
     * @Rest\View()
     * @Rest\Get("/places/{id}")
     */
    public function getPlaceAction(Place $place)
    {
      // $place = $this->getDoctrine()->getRepository(Place::class)->find($id);
        /* @var $place Place */

        if (empty($place)) {
            return new JsonResponse(['message' => 'Place not found'], Response::HTTP_NOT_FOUND);
        }
    
    return $place ;
    } 
    
}
