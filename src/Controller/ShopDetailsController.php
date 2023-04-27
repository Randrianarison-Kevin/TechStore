<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopDetailsController extends AbstractController
{
    #[Route('/shopdetails', name: 'shop_details')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $produits= $produitRepository->findAll();
        $produit = $produits[array_rand($produits)];
        return $this->render('pages/shop-details.html.twig', [
            'Produit'=>$produit
        ]);
    }
}
