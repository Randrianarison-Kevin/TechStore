<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{
    #[Route('/shop', name: 'shop')]
    public function index(ProduitRepository $produitRepository, CategoriesRepository $categoriesRepository): Response
    {
        $produit = $produitRepository->findAll();
        $categories= $categoriesRepository ->findAll();
        return $this->render('pages/shop.html.twig', [
            'Produits' => $produit,
            'Categories' => $categories

        ]);
    }
}
