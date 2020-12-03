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
            ->findAll();
         return $this->render('news/index.html.twig', array("news"=>$news));
    }
}
