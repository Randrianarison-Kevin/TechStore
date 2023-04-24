<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopDetailsController extends AbstractController
{
    #[Route('/shopdetails', name: 'shop_details')]
    public function index(): Response
    {
        return $this->render('pages/shop-details.html.twig', [
        ]);
    }
}
