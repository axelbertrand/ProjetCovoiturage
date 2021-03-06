<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Form\UserRegistrationFormType;
use App\Form\UserPreferencesFormType;

class UserController extends AbstractController
{
    /**
     * @Route("/user-profile", name="app_user_profile")
     * @IsGranted("ROLE_USER")
     */
    public function userProfile()
    {
        return $this->render('user/user-profile.html.twig', [
            
        ]);
    }

    /**
     * @Route("/modify-user-info", name="app_modify_user_info")
     * @IsGranted("ROLE_USER")
     */
    public function modifyUserInfo(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createForm(UserRegistrationFormType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $form['plainPassword']->getData()
            ));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Informations utilisateurs modifiées avec succès');

            return $this->redirectToRoute('app_user_profile');
        }

        return $this->render('user/modify-user-info.html.twig', [
            'userInfoForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/user-preferences", name="app_user_preferences")
     * @IsGranted("ROLE_USER")
     */
    public function userPreferences(Request $request)
    {
        $form = $this->createForm(UserPreferencesFormType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Préférences utilisateurs modifiées avec succès');

            return $this->redirectToRoute('app_user_profile');
        }

        return $this->render('user/user-preferences.html.twig', [
            'userPreferencesForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/user-publications", name="app_user_publications")
     * @IsGranted("ROLE_USER")
     */
    public function userPublications()
    {
        return $this->render('user/user-publications.html.twig', [
            
        ]);
    }
}
