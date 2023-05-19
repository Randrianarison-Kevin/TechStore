<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(ProduitRepository $produitRepository, Request $request): Response
    {
        $produits= $produitRepository->findAll();
        $produit = $produits[array_rand($produits)];
        return $this->render('pages/index.html.twig', [
            'Produits' =>$produits,
            'Produit'=>$produit,
            
        ]);
    }
}
