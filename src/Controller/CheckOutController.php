<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckOutController extends AbstractController
{
    #[Route('/checkout', name: 'check_out')]
    public function index(): Response
    {
        return $this->render('pages/checkout.html.twig', [
        ]);
    }
}
