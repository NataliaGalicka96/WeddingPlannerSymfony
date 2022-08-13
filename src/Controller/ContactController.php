<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\ContactType;
use App\Entity\Contact;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
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
        $contacts = $em->getRepository(Contact::class)->getContact($userId);


        

        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            if($this->getUser())
            {
                $newContact = new Contact();

                $newContact->setUser($this->getUser());
                $newContact->setName($form->get('name')->getData());
                $newContact->setEmail($form->get('email')->getData());
                $newContact->setPhoneNumber($form->get('phoneNumber')->getData());
                $newContact->setStreet($form->get('street')->getData());
                $newContact->setHomeNumber($form->get('homeNumber')->getData());
                $newContact->setCity($form->get('city')->getData());
                $newContact->setPostalcode($form->get('postalcode')->getData());
                try{
                    $em->persist($newContact);
                    $em->flush();
                    $this->addFlash('success', "Dodano nowy kontakt!");

                }catch(\Exception $e) {
                    $this->addFlash('error', 'Wystąpił nieoczekiwany błąd!');
                }
                

            }
        }

        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts,
            'formContact' => $form->createView(),
        ]);
    }


}
