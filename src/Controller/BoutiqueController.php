<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoutiqueController extends AbstractController
{
    #[Route('/boutique', name: 'boutique')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $produit= $produitRepository->find($id = 142);
        return $this->render('pages/boutique/index.html.twig', [
            'Produits' =>$produit
        
        ]);
    }
}
