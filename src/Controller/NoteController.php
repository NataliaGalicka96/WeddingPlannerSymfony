<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NoteController extends AbstractController
{
    #[Route('/note', name: 'app_note')]
    public function index(): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_index');
        }
        
        return $this->render('note/index.html.twig', [
            'controller_name' => 'NoteController',
        ]);
    }
}
