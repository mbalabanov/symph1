<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product ;

class ProductController extends AbstractController
{



   /**
    * @Route("/create", name="createAction")
    */
    public function createAction()
    {  
        
         // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: createAction(EntityManagerInterface $em)
        $em = $this->getDoctrine()->getManager();
        $product = new  Product(); // here we will create an object from our class Product.
        $product->setName( 'Keyboard'); // in our Product class we have a set function for each column in our db
        $product->setPrice( 19);
 
        // tells Doctrine you want to (eventually) save the Product (no queries yet)
        $em->persist($product);
         // actually executes the queries (i.e. the INSERT query)
        $em->flush();
        return  new Response('Saved new product with id '.$product->getId());
    }

    /**
    * @Route("/details/{productId}", name="detailsAction")
    */ 
    public function showdetailsAction($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($productId);
         if (!$product) {
            throw  $this->createNotFoundException(
                 'No product found for id '.$productId
            );
        } else {
                 return new Response('Details from the product with id ' .$productId.", Product name is ".$product->getName()." and it cost " .$product->getPrice()."€");
        }
      
    }

}
