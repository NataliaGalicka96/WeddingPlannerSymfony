<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CheckListCategory;
use App\Entity\CheckListPodcategory;
use App\Entity\CheckList;
use App\Entity\User;

use Symfony\Component\HttpFoundation\Request;




class CheckListController extends AbstractController
{
    #[Route('/check/list', name: 'app_check_list')]
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
/*
        $podcategoryName = $em->getRepository(CheckListPodcategory::class)->getNameOfCategory($userId);
*/        
        $idOfCategory = $em->getRepository(CheckListCategory::class)->getNameAndIdOfCategory();

        $taskAssignedToUser= $em->getRepository(CheckList::class)->getTaskAssignedToUser($userId);

    

        return $this->render('check_list/index.html.twig', [
            'idOfCategory' => $idOfCategory,
            'taskAssignedToUser' => $taskAssignedToUser
     
        ]);
    }

    #[Route('/check/list/create', name: 'create_new_task', methods: 'POST')]
    public function createNewTask(Request $request)
    {

        $category = trim($request->request->get('category'));
        $title = trim($request->request->get('title'));
        
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
    }

    #[Route('/check/list/switch-status/{id}', name: 'switch_status')]
 
    public function switchStatus($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $task = $entityManager->getRepository(CheckList::class)->find($id);
    
        $task->setStatus(! $task->isStatus() );
        
        $entityManager->persist($task);
        $entityManager->flush();

        return $this->redirectToRoute('app_check_list');
    }

    #[Route('check_list/delete/{id}', name: 'task_delete')]
 
    public function delete(CheckList $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($id);
        $entityManager->flush();
        return $this->redirectToRoute('app_check_list');
    }


}
