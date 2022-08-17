<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\BudgetCategory;
use App\Entity\Expenses;

class BudgetController extends AbstractController
{
    #[Route('/budget', name: 'app_budget')]
    public function index(): Response
    {

        if(!$this->getUser()){
            return $this->redirectToRoute('app_index');
        }

        /** 
         * @var User $user 
         * */
        $user = $this->getUser();
        if(!empty($user)){
        $userId = $user->getId();
        }

        $em = $this->getDoctrine()->getManager();
        
        $categoryBudget = $em->getRepository(BudgetCategory::class)->getCategoryOfBudget();
        $expenses = $em->getRepository(Expenses::class)->getExpensesAssignedToUser($userId);

        return $this->render('budget/index.html.twig', [
            'budgetCategory' => $categoryBudget,
            'expenses' => $expenses
        ]);
    }
}
