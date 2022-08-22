<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\WeddingSettingsType;

class MainPageController extends AbstractController
{
    #[Route('/main/page', name: 'app_main_page')]
    public function index(): Response
    {
        if(!$this->getUser()){
            $this->addFlash('error', "Zaloguj się aby mieć dostęp do tej strony!");
            return $this->redirectToRoute('app_index');
        }

        $form = $this->createForm(WeddingSettingsType::class);
        
        

        return $this->render('main_page/index.html.twig', [
            'controller_name' => 'MainPageController',
            'form' => $form->createView(),
        ]);
    }
}
