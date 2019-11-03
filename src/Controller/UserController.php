<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
}
