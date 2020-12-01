<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\News;

class NewsController extends AbstractController
{
    /**
     * @Route("/news", name="newsAction")
     */
    public function newsAction()
    {
        $news = $this->getDoctrine()
            ->getRepository(News::class)
            ->findAll(); // this variable $news will store the result of running a query to find all the of the news.
         return $this->render('news/index.html.twig', array("news"=>$news)); // Send the variable that have all the news as an array of objects to the index.html.twig page
    }
}
