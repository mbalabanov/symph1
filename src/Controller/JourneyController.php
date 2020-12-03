<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form \Extension\Core\Type\TextType ;
use Symfony\Component\Form \Extension\Core\Type\TextareaType ;
use Symfony\Component\ Form\Extension\Core\Type \DateTimeType;
use Symfony\ Component\Form\Extension\Core \Type\ChoiceType;
use Symfony\ Component\Form\Extension\Core \Type\NumberType;
use  Symfony\Component\Form\Extension \Core\Type\SubmitType;
use App\Entity\Journey;

class JourneyController extends AbstractController
{

    /**
    * @Route("/", name="showJourneysAction")
    */ 
    public function showJourneysAction()
    {
        $journeys = $this->getDoctrine()
            ->getRepository(Journey::class)
            ->findAll(); // this variable $journeys will store the result of running a query to find all the of the travel agency's journeys.
        return $this->render('journey/index.html.twig', array("journeys"=>$journeys)); // Send the variable that have all the jounreys as an array of objects to the index.html.twig page
    }

    /**
    * @Route("/delete/{id}", name="deleteAction")
    */
    public function deleteAction($id){
        $em = $this->getDoctrine()->getManager();
        $journey = $em->getRepository('App:Journey')->find($id);
        $em->remove($journey);
        $em->flush();
        $this->addFlash(
            'notice',
            'Journey Removed'
        );
        return $this->redirectToRoute('showJourneysAction');
    }
}
