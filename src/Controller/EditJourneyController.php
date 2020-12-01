<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditJourneyController extends AbstractController
{
    /**
     * @Route("/add", name="edit_journey")
     */
    public function index(): Response
    {
        return $this->render('edit_journey/index.html.twig', [
            'controller_name' => 'EditJourneyController',
        ]);
    }
}
