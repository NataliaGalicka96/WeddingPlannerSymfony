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

        /** 
         * @var User $user 
         * */
        $user = $this->getUser();
        if(!empty($user)){
        $userId = $user->getId();
        }
        $em = $this->getDoctrine()->getManager();
        $guests = $em->getRepository(Guest::class)->getGuestAssignedToUser($userId);
        $summary = $em->getRepository(Guest::class)->getSummaryOfGuest($userId);


        $form = $this->createForm(GuestType::class);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            if($this->getUser())
            {
                $newGuest = new Guest();

                $newGuest->setUser($this->getUser());
                $newGuest->setName($form->get('name')->getData());
                $newGuest->setIsConfirmed($form->get('is_confirmed')->getData());
                $newGuest->setIsAccommodation($form->get('is_accommodation')->getData());
                $newGuest->setTransport($form->get('transport')->getData());
                $newGuest->setIsAdult($form->get('is_adult')->getData());
                $newGuest->setIsChildUnder3Years($form->get('is_child_under_3_years')->getData());
                $newGuest->setIsChildBetween312Years($form->get('is_child_between_3_12_years')->getData());
                $newGuest->setSpecialDiet($form->get('special_diet')->getData());
                try{
                    $em->persist($newGuest);
                    $em->flush();
                    $this->addFlash('success', "Dodano nowego gościa!");
                    return $this->redirectToRoute('app_guest');
                }catch(\Exception $e) {
                    $this->addFlash('error', 'Wystąpił nieoczekiwany błąd!');
                    return $this->redirectToRoute('app_guest');
                    
                }
            }
            
        }

        return $this->render('guest/index.html.twig', [
            'guestform' => $form->createView(),
            'guests' => $guests,
            'summary' => $summary
        ]);
    }



    
}
