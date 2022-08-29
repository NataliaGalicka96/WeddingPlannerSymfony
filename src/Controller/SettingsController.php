<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\WeddingSettings;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\WeddingSettingsType;

class SettingsController extends AbstractController
{
    #[Route('/settings', name: 'app_settings')]
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
        $dataOfWedding = $em->getRepository(WeddingSettings::class)->getDataOfWedding($userId);

        $user = $this->getUser();

        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();


        $em = $this->getDoctrine()->getManager();
        $dataWedding = $em->getRepository(WeddingSettings::class)->getDataOfWedding($userId);

        $form = $this->createForm(WeddingSettingsType::class);

        

        return $this->render('settings/index.html.twig', [
            'dataWedding' => $dataOfWedding,
            'username' => $username,
            'email' => $email,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/settings/username', name: 'update_username', methods: 'POST')]
    public function updateUsername(Request $request)
    {
        $userName = trim($request->request->get('username'));

        if(empty($userName))
        return $this->redirectToRoute('app_settings');

        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $username = $user->setUsername($userName);

        $entityManager->persist($username);
        $entityManager->flush();

        return $this->redirectToRoute('app_settings');
    }

    #[Route('/settings/email', name: 'update_email', methods: 'POST')]
    public function updateEmail(Request $request)
    {
        $email = trim($request->request->get('email'));

        if(empty($email))
        return $this->redirectToRoute('app_settings');

        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $setEmail = $user->setEmail($email);

        $entityManager->persist($setEmail);
        $entityManager->flush();

        return $this->redirectToRoute('app_settings');
    }

    #[Route('/settings/password', name: 'update_password', methods: 'POST')]
    public function updatePassword(Request $request)
    {
        $newPassword = trim($request->request->get('password'));

        if(empty($newPassword))
        return $this->redirectToRoute('app_settings');

        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $password = $user->setPassword($newPassword);

        $entityManager->persist($password);
        $entityManager->flush();

        return $this->redirectToRoute('app_settings');
    }




    #[Route('/settings/brideName/{id}', name: 'update_brideName', methods: 'POST')]
    public function updateBrideName(Request $request, $id)
    {
        $newBrideName = trim($request->request->get('brideName'));

        if(empty($newBrideName))
       return $this->redirectToRoute('app_settings');

        $entityManager = $this->getDoctrine()->getManager();

        $settings = $entityManager->getRepository(WeddingSettings::class)->find($id);


        $settings->setBrideName($newBrideName);

        $entityManager->persist($settings);
        $entityManager->flush();

        return $this->redirectToRoute('app_settings');



    }

    #[Route('/settings/groomName/{id}', name: 'update_groomName', methods: 'POST')]
    public function updateGroomName(Request $request, $id)
    {
        $newGroomName = trim($request->request->get('groomName'));

        if(empty($newGroomName))
        return $this->redirectToRoute('app_settings');

        $entityManager = $this->getDoctrine()->getManager();

        $settings = $entityManager->getRepository(WeddingSettings::class)->find($id);

        $settings->setGroomName($newGroomName);

        $entityManager->persist($settings);
        $entityManager->flush();

        return $this->redirectToRoute('app_settings');
    }


    #[Route('/settings/date/{id}', name: 'update_date', methods: 'POST')]
    public function updateDate(Request $request, $id)
    {
        $newDate = trim($request->request->get('date'));

        if(empty($newDate))
        return $this->redirectToRoute('app_settings');

        $entityManager = $this->getDoctrine()->getManager();

        $settings = $entityManager->getRepository(WeddingSettings::class)->find($id);

        var_dump($newDate);

        $settings->setDate(\DateTime::createFromFormat('d-m-Y H:i', $newDate));

        $entityManager->persist($settings);
        $entityManager->flush();

        return $this->redirectToRoute('app_settings');
    }

}
