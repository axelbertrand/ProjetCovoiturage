<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\DeparturePublicationFormType;

class PublicationController extends AbstractController
{
    /**
     * @Route("/publication", name="app_publication")
     */
    public function index()
    {
        $form = $this->createForm(DeparturePublicationFormType::class);

        return $this->render('publication/index.html.twig', [
            'departurePublicationForm' => $form->createView()
        ]);
    }
}
