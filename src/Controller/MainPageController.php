<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\WeddingSettingsType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\WeddingSettings;

class MainPageController extends AbstractController
{
    #[Route('/main/page', name: 'app_main_page')]
    public function index(Request $request): Response
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
        $dataOfWedding = $em->getRepository(WeddingSettings::class)->getDataOfWedding($userId);

        $form = $this->createForm(WeddingSettingsType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            if($this->getUser())
            {
                $weddingDetail = new WeddingSettings();

                $weddingDetail->setUser($this->getUser());
                $weddingDetail->setBrideName($form->get('brideName')->getData());
                $weddingDetail->setGroomName($form->get('groomName')->getData());
                $weddingDetail->setDate($form->get('date')->getData());
                try{
                    $em->persist($weddingDetail);
                    $em->flush();
                    $this->addFlash('success', "Ustawiono datę ślubu oraz imiona Państwa Młodych!");
                    return $this->redirectToRoute('app_main_page');


                }catch(\Exception $e) {
                    $this->addFlash('error', 'Wystąpił nieoczekiwany błąd!');
                    return $this->redirectToRoute('app_main_page');

                }
        
       
            }
        }

        return $this->render('main_page/index.html.twig', [
            'controller_name' => 'MainPageController',
            'form' => $form->createView(),
            'dataWedding' => $dataOfWedding
            
        ]);
    }
}
