<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest; // alias pour toutes les annotations
use App\Form\PriceType;
use App\Entity\Price;
use App\Entity\Place;

class PriceController extends Controller
{

     /**
     * @Rest\View()
     * @Rest\Get("/places/{id}/prices")
     */
    public function getPricesAction(Request $request)
    {  $em = $this->getDoctrine()->getManager();
        $place = $em->getRepository(Place::class)
                    ->find($request->get('id'));
                    
            // L'identifiant en tant que paramétre n'est plus nécessaire
    /* @var $place Place */

        if (empty($place)) {
            return new JsonResponse(['message' => 'place  not found'], Response::HTTP_NOT_FOUND);;
        }
       // return $this->get('serializer')->serialize($place->getPrices(), 'json');


       // return $this->serializer->serialize($place->getPrices(), 'json', ['groups' => ['default']]);

       return $place->getPrices();

    }

     /**
     * @Rest\View(statusCode=Response::HTTP_CREATED)
     * @Rest\Post("/places/{id}/prices")
     */
    public function postPricesAction(Request $request)
    {   $em = $this->getDoctrine()->getManager();
        $place = $em->getRepository(Place::class)
                    ->find($request->get('id'));
        $price = new Price();
        $price->setPlace($place); // Ici, le lieu est associé au prix
        $form = $this->createForm(PriceType::class, $price);
        $form->submit($request->request->all());
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($price);
            $em->flush();
            return $price;
        } else {
            return $form;
        }

    }



}
