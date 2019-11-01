<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\DeparturePublicationFormType;

class PublicationController extends AbstractController
{
    /**
     * @Route("/publication", name="app_publication")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(DeparturePublicationFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $departurePublication = $form->getData();

            // TODO: fill entity with user data

            $em->persist($departurePublication);
            $em->flush();

            $this->addFlash('success', "L'annonce de départ a été créée avec succès");

            return $this->redirectToRoute('app_homepage'); // TODO: redirect to user publication list
        }

        return $this->render('publication/index.html.twig', [
            'departurePublicationForm' => $form->createView()
        ]);
    }
}
