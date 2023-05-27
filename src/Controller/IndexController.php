<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="app_index")
     */
    public function index(ProductRepository $productRepository): Response
    {
        $today = new \DateTime('today');
        $products = $productRepository->findByCreatedAt($today);
     
        return $this->render('index.html.twig', [
            'products' => $products,
        ]);
    }

}
