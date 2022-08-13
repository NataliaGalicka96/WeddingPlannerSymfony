<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\GuestType;
use App\Entity\Guest;

class GuestController extends AbstractController
{
    #[Route('/guest', name: 'app_guest')]
    public function index(Request $request): Response
    {
        if(!$this->getUser()){
            return $this->redirectToRoute('app_index');
        }

        $form = $this->createForm(GuestType::class);



        
        return $this->render('guest/index.html.twig', [
            'controller_name' => 'GuestController',
            'guestform' => $form->createView(),
        ]);
    }
}
