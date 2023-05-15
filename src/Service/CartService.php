<?php

namespace App\Service;

use App\Entity\Produit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService 
{
    private RequestStack $requestStack;

    
    private EntityManagerInterface $em;

    private function getSession():SessionInterface
    {
        return $this -> requestStack -> getSession();
    }

    public function __construct( RequestStack $requestStack, EntityManagerInterface $em )
    {
        $this -> requestStack = $requestStack;
        $this -> em = $em;
    
    }

    public function addCart(int $id):void
    {
        $cart = $this -> requestStack ->getSession()->get('cart', []);
        
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        $this ->getSession() ->set('cart', $cart);

    }

    public function removeCart(int $id)
    {
        $cart = $this -> requestStack ->getSession()->get('cart', []);
        unset($cart[$id]);
        return $this -> getSession() -> set('cart' , $cart);
        
    }

    public function removeAllCart()
    {
        return $this ->getSession()->remove('cart');
    }

    public function decrementCart(int $id)
    {
        $cart = $this -> requestStack ->getSession()->get('cart', []);
        if ($cart[$id] > 1) {
            $cart[$id] --;
        } else {
            unset($cart[$id]);
        }
        
    
        return $this -> getSession() -> set('cart' , $cart);
        
    }

    public function getTotal()
    {
        $cart = $this ->getSession() -> get('cart');
        $cartData = [];
       
        if($cart !== null)
        {
            foreach($cart as $id => $quantity)
            {
                $produit = $this -> em ->getRepository(Produit::class)-> findOneBy(['id' => $id]);
               
                $cartData[] = [
                    'Produit' =>$produit,
                    'quantity' =>$quantity
                ];
            
            }
        }
        return $cartData ;  
    }

}