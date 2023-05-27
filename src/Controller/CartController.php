<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Product;

class CartController extends AbstractController 
{ 
    /**
     * @Route("/cart", name="cart")
     */
    public function index(Request $request,ProductRepository $productRepository): Response 
    { 
        $session = $request->getSession(); 
        $panier = $session->get('cart',[]); 
        $panierData = []; 
        $total = 0;
        foreach ($panier as $id => $quantity) 
        { 
            $product = $productRepository->find($id);
            $totalp = $product->getPrice() * $quantity;
            $total += $totalp;

            $panierData[] = [ 
            'id'=> $id,
            'quantity'=> $quantity,
            'product'=> $product,
            'price'=>$totalp,
            ];
        }
        $session->set('total',$total);
        return $this->render('cart/index.html.twig', ['items'=>$panierData,'total'=>$total]); 
    }

    public function add($id, Request $request) 
    { 
    $session = $request->getSession();

    $panier = $session->get('cart',[]); 
    if(!empty($panier[$id])) 
    $panier[$id]++; 
    else
    $panier[$id]=1; 
    $session->set('cart',$panier); 
    return $this->redirectToRoute('cart'); 
    }
    
    public function removeProduct($id, Request $request)
    {
        $session = $request->getSession();
        $cart = $session->get('cart', []);
        if (array_key_exists($id, $cart)) {
            $cart[$id]--;
            if ($cart[$id] <= 0) { 
                unset($cart[$id]);
            }
            $session->set('cart', $cart);
        }
        return  $this->redirectToRoute('cart');
    }

}
/**
 * @Route("/add", name="app_add")
 */



// class CartController extends AbstractController
// {
//     /**
//      * @Route("/cart", name="app_cart")
//      */
//     public function index(): Response
//     {
//         return $this->render('cart/index.html.twig', [
//             'controller_name' => 'CartController',
//         ]);
//     }
// }
