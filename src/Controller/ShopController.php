<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShopController extends AbstractController
{
    #[Route('/shop', name: 'shop')]
    public function index(ProduitRepository $produitRepository, CategoriesRepository $categoriesRepository): Response
    {
        $produit = $produitRepository->findAll();
        $categories= $categoriesRepository ->findAll();

        return $this->render('pages/shop.html.twig', [
            'Produits' => $produit,
            'Categories' => $categories,
        ]);
    }

    #[Route('/shopdetails/{id}', name: 'shop_details')]
    public function details(Request $request, ProduitRepository $produitRepository): Response
    {
        $detailsId = $request -> attributes -> get('id');
        $details = $produitRepository->find($detailsId);
        
        return $this->render('pages/details.html.twig', [
        'Details' => $details
        ]);
    }
}
