<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $manager ): Response
    {
        $user = new User;
        $user -> setRoles(['ROLE_USER']);
        $form = $this->createForm(RegistrationType::class, $user);
        $form ->handleRequest($request);
        if($form->isSubmitted() && $form ->isValid()){
            $user = $form ->getData();
            
            $manager->persist($user);


            $manager ->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form ->createView()
        ]);
    }
}
