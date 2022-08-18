<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\BudgetCategory;
use App\Entity\Expenses;
use App\Entity\Budget;
use Symfony\Component\HttpFoundation\Request;

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
        $budget = $em->getRepository(Budget::class)->getBudgetAssignedToUser($userId);
        $alreadyPaidGroupByCategory = $em->getRepository(Expenses::class)->getSumOfAlreadyPaid($userId);
        $sumOfalreadyPaid = $em->getRepository(Expenses::class)->sumOfAllExpenses($userId);
        $detailsOfExpense = $em->getRepository(Expenses::class)->getDetailsOfExpense($userId);







        return $this->render('budget/index.html.twig', [
            'budgetCategory' => $categoryBudget,
            'expenses' => $expenses,
            'budget' => $budget,
            'alreadyPaid' => $alreadyPaidGroupByCategory,
            'sumOfAlreadyPaid' => $sumOfalreadyPaid,
            'details' => $detailsOfExpense
        ]);
    }

    #[Route('/budget/set', name: 'set_budget', methods: 'POST')]
    public function setBudget(Request $request): Response
    {

        $budgetFromForm = trim($request->request->get('budget'));
        $budget = (float)number_format((float)$budgetFromForm, 2, '.', '');

        var_dump($budget);

        $entityManager = $this->getDoctrine()->getManager();

        $setBudget = new Budget();

        $setBudget->setBudget($budget);
        $setBudget->setUser($this->getUser());

        

        $entityManager->persist($setBudget);
        $entityManager->flush();


        return $this->redirectToRoute('app_budget');
    }
}
/*
    if(empty($title))
        return $this->redirectToRoute('app_check_list');

        $entityManager = $this->getDoctrine()->getManager();

        $task = new CheckList();

        $task->setCategoryName($category);
        $task->setTask($title);
        $task->setUser($this->getUser());

        $entityManager->persist($task);
        $entityManager->flush();

        return $this->redirectToRoute('app_check_list');
        */