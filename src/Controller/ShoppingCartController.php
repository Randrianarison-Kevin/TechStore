<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShoppingCartController extends AbstractController
{
    #[Route('/shoppingcart', name: 'shopping_cart')]
    public function index(): Response
    {
        return $this->render('pages/shopping-cart.html.twig', [
        ]);
    }
}
