<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PublicationController extends AbstractController
{
    /**
     * @Route("/publication", name="app_publication")
     */
    public function index()
    {
        return $this->render('publication/index.html.twig', [
            
        ]);
    }
}
