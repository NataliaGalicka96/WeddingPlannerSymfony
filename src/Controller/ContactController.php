<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_index');
        }
        
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }
}
