<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Note;

class NoteController extends AbstractController
{
    #[Route('/note', name: 'app_note')]
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

        $noteAssignedToUser= $em->getRepository(Note::class)->getNoteAssignedToUser($userId);

        var_dump($noteAssignedToUser);
        
        return $this->render('note/index.html.twig', [
            'notes' =>  $noteAssignedToUser
        ]);
    }

    #[Route('/note/create', name: 'create_new_note', methods: 'POST')]
    public function createNewTask(Request $request)
    {

        $title = trim($request->request->get('title'));
        $content = trim($request->request->get('content'));
        
        if(empty($title)||empty($content))
        return $this->redirectToRoute('app_note');

        $entityManager = $this->getDoctrine()->getManager();

        $note = new Note();

        $note->setNote($content);
        $note->setTitle($title);
        $note->setUser($this->getUser());

        $entityManager->persist($note);
        $entityManager->flush();

        return $this->redirectToRoute('app_note');
    }


    #[Route('/note/update/title/{id}', name: 'update_title', methods: "POST")]
    public function updateTitle(Request $request, $id)
    {

        $newTitle = trim($request->request->get('title'));
        
         /** 
         * @var User $user 
         * */
        
        $user = $this->getUser();
        if(!empty($user)){
        $userId = $user->getId();
        }
        

        $entityManager = $this->getDoctrine()->getManager();
        
        $title = $entityManager->getRepository(Note::class)->updateTitle($userId, $id, $newTitle);


        return $this->redirectToRoute('app_note');
    }

    
    #[Route('/note/update/note/{id}', name: 'update_note', methods: "POST")]
    public function updateNote(Request $request, $id)
    {

        $newNote = trim($request->request->get('note'));
        

         /** 
         * @var User $user 
         * */
        
        $user = $this->getUser();
        if(!empty($user)){
        $userId = $user->getId();
        }
        

        $entityManager = $this->getDoctrine()->getManager();
        
        $expense = $entityManager->getRepository(Note::class)->updateNote($userId, $id, $newNote);

        return $this->redirectToRoute('app_note');
    }

    #[Route('note/delete/{id}', name: 'note_delete')]
 
    public function delete(Note $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($id);
        $entityManager->flush();
        return $this->redirectToRoute('app_note');
    }

}
