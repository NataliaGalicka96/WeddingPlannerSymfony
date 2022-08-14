<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\CheckListCategory;
use App\Entity\CheckListPodcategory;
use App\Entity\User;




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

        $podcategoryName = $em->getRepository(CheckListPodcategory::class)->getNameOfCategory($userId);
        $idOfCategory = $em->getRepository(CheckListCategory::class)->getNameAndIdOfCategory();


    

        return $this->render('check_list/index.html.twig', [
            'idOfCategory' => $idOfCategory,
            'podcategoryName' => $podcategoryName,
     
        ]);
    }

    #[Route('/check/list/create', name: 'create_new_task', methods: 'POST')]
    public function createNewTask()
    {
        return $this->render('check_list/index.html.twig', [

     
        ]);
    }

    #[Route('/check/list/switch-status/{id}', name: 'switch_status')]
 
    public function switchStatus($id)
    {
          exit('to do: switch status of the task!'. $id);
    }

    #[Route('check_list/delete/{id}', name: 'task_delete')]
 
    public function delete($id)
    {
        exit('to do: delete a task with the id of !'. $id);
    }


}
