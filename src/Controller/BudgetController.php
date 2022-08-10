<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BudgetController extends AbstractController
{
    #[Route('/budget', name: 'app_budget')]
    public function index(): Response
    {

        if(!$this->getUser()){
            return $this->redirectToRoute('app_index');
        }

        return $this->render('budget/index.html.twig', [
            'controller_name' => 'BudgetController',
        ]);
    }
}
