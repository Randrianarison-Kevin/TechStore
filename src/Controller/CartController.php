<?php

namespace App\Controller; 

use App\Entity\User;
use App\Service\CartService;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class CartController extends AbstractController
{
    #[Route('/cart/Acheter', name: 'Acheter')]
    public function Acheter()
    {
    
        return $this ->redirectToRoute('cart');
    
    }

    #[Route('/cart', name: 'cart')]
    public function index(CartService $cartService): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $cartService -> getTotal()
        ]);
    }

    #[Route('/cart/removeAll', name: 'removeAll_cart')]
    public function removeCart(CartService $cartService):Response
    {
        $cartService->removeAllCart();

        return $this ->redirectToRoute('shop');
    }

    #[Route('/cart/{id}', name: 'add_cart')]
    public function addToCart(CartService $cartService, int $id):Response
    {
        $cartService->addCart($id);

        return $this ->redirectToRoute('cart');
    }
    
    #[Route('/cart/remove/{id}', name: 'remove_cart')]
    public function removeToCart(CartService $cartService, int $id):Response
    {
        $cartService->removeCart($id);

        return $this ->redirectToRoute('cart');
    }

    #[Route('/cart/decrement/{id}', name: 'decrement_cart')]
    public function decrementCart(CartService $cartService, int $id):RedirectResponse
    {
        $cartService->decrementCart($id);

        return $this ->redirectToRoute('cart');
    }

    

     

}
