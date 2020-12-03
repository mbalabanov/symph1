<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation \Request;

use Symfony\Component\Form \Extension\Core\Type\TextType ;
use Symfony\Component\Form \Extension\Core\Type\TextareaType ;
use Symfony\Component\ Form\Extension\Core\Type \DateTimeType;
use Symfony\ Component\Form\Extension\Core \Type\ChoiceType;
use Symfony\ Component\Form\Extension\Core \Type\NumberType;
use  Symfony\Component\Form\Extension \Core\Type\SubmitType;
use App\Entity\Journey;

class EditJourneyController extends AbstractController
{
    /**
     * @Route("/edit/{id}", name="editAction")
     */
    public function editAction($id, Request $request)
    {
        $journey = $this->getDoctrine()->getRepository('App:Journey')->find($id);

        $journey->setDestination($journey->getDestination());
        $journey->setImage($journey->getImage());
        $journey->setDescription($journey->getDescription());
        $journey->setPrice($journey->getPrice());

        $form = $this->createFormBuilder($journey)->add( 'destination', TextType::class, array ('attr' => array ('class'=> 'form-control')))
        ->add( 'image', TextType::class, array ('attr' => array ('class'=> 'form-control')))
        ->add( 'description', TextType::class, array ('attr' => array ('class'=> 'form-control')))
        ->add( 'price', NumberType::class, array ('attr' => array ('class'=> 'form-control')))
   		->add( 'save' , SubmitType::class, array ( 'label' => 'Create Journey' , 'attr'  => array ( 'class' => 'btn btn-primary mt-2')))
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $destination = $form[ 'destination' ]->getData();
            $image = $form[ 'image' ]->getData();
            $description = $form[ 'description' ]->getData();
            $price = $form[ 'price' ]->getData();

            $em = $this->getDoctrine()->getManager();
            $journey = $em->getRepository( 'App:Journey')->find($id);

            $journey->setDestination($destination);
            $journey->setImage($image);
            $journey->setDescription($description);
            $journey->setPrice($price);
            $em = $this ->getDoctrine()->getManager();
            $em->persist($journey);
            $em->flush();
            $this ->addFlash(
                    'notice' ,
                    'Journey Updated'
                );
            return $this ->redirectToRoute( 'editAction', array( 'id' => $id ) );
        }
        return  $this->render( 'edit_journey/index.html.twig', array( 'journey' => $journey, 'form' => $form->createView()));
    }
}
