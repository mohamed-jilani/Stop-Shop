<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GalleryController extends AbstractController
{
    /**
     * @Route("/gallery", name="app_gallery")
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->render('gallery/index.html.twig', [
            'products' => $productRepository->findAll()
        ]);
    }
    
}
