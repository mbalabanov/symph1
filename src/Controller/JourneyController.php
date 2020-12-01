<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Journey;

class JourneyController extends AbstractController
{

    /**
    * @Route("/", name="indexAction")
    */ 
    public function indexAction()
    {
        $journeys = $this->getDoctrine()
            ->getRepository(Journey::class)
            ->findAll(); // this variable $journeys will store the result of running a query to find all the of the travel agency's journeys.
         return $this->render('journey/index.html.twig', array("journeys"=>$journeys)); // Send the variable that have all the jounreys as an array of objects to the index.html.twig page
    }
}
