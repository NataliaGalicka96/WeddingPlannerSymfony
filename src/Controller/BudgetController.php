<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\BudgetCategory;
use App\Entity\Expenses;
use App\Entity\Budget;
use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Validator\Validator\ValidatorInterface;

class BudgetController extends AbstractController
{
    #[Route('/budget', name: 'app_budget')]
    public function index(): Response
    {
        if(!$this->getUser()){
            $this->addFlash('error', "Zaloguj się aby mieć dostęp do tej strony!");
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

        $entityManager = $this->getDoctrine()->getManager();

        $setBudget = new Budget();

        $setBudget->setBudget($budget);
        $setBudget->setUser($this->getUser());

        

        $entityManager->persist($setBudget);
        $entityManager->flush();


        return $this->redirectToRoute('app_budget');
    }


    #[Route('/budget/addNewExpense', name: 'add_new_expense', methods: 'POST')]
    public function addNewExpense(Request $request, ValidatorInterface $validator)
    {

        $category = trim($request->request->get('category'));
        $expenseName = trim($request->request->get('expenseName'));
        $price = trim($request->request->get('price'));
        $alreadyPaid = trim($request->request->get('alreadyPaid'));

        $entityManager = $this->getDoctrine()->getManager();

        $expense = new Expenses();

        $expense->setCategoryName($category);
        $expense->setExpense($expenseName);
        $expense->setPrice($price);
        $expense->setAlreadyPaid($alreadyPaid); 
        $expense->setUser($this->getUser()); 


        $errors = $validator->validate($expense);
        
        if (count($errors) == 0) {

            $entityManager->persist($expense);
        $entityManager->flush();
            $this->addFlash('success', "Dodano nowy wydatek!");
            return $this->redirectToRoute('app_budget');

        }else{
            $this->addFlash('error', "Nie udało się dodać wydatku!");
            return $this->redirectToRoute('app_budget');
            
        }

    
    }

    #[Route('/budget/update/price/{id}', name: 'update_price', methods: "POST")]
    public function updatePrice(Request $request, $id, ValidatorInterface $validator)
    {

        $newPrice = trim($request->request->get('priceOfPodcategory'));
        $price = (float)number_format((float)$newPrice, 2, '.', '');

         /** 
         * @var User $user 
         * */
        
        $user = $this->getUser();
        if(!empty($user)){
        $userId = $user->getId();
        }

        
        
       
    
        $entityManager = $this->getDoctrine()->getManager();
        $expense = $entityManager->getRepository(Expenses::class)->updatePrice($userId, $id, $price);

   


        return $this->redirectToRoute('app_budget');
    }

    #[Route('/budget/update/alreadyPaid/{id}', name: 'update_alreadypay', methods: "POST")]
    public function updatealreadyPaid(Request $request, $id)
    {

        $newPrice = trim($request->request->get('alreadyPayOfPodcategory'));
        //$price = (float)number_format((float)$newPrice, 2, '.', '');

         /** 
         * @var User $user 
         * */
        
        $user = $this->getUser();
        if(!empty($user)){
        $userId = $user->getId();
        }
        
        $entityManager = $this->getDoctrine()->getManager();
        $expense = $entityManager->getRepository(Expenses::class)->updateAlreadyPaid($userId, $id, $newPrice);


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