<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\DeparturePublicationFormType;
use App\Entity\DeparturePublication;
use App\Entity\Reservation;
use App\Repository\DeparturePublicationRepository;

class PublicationController extends AbstractController
{
    /**
     * @Route("/publication", name="app_publication")
     * @IsGranted("ROLE_USER")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(DeparturePublicationFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $departurePublication = $form->getData();

            $user = $this->getUser();
            $departurePublication->setUser($user);
            $departurePublication->setRemainingSeats($user->getMaximumOfSeats());

            $em->persist($departurePublication);
            $em->flush();

            $this->addFlash('success', "L'annonce de départ a été créée avec succès");

            return $this->redirectToRoute('app_homepage'); // TODO: redirect to user publication list
        }

        return $this->render('publication/index.html.twig', [
            'departurePublicationForm' => $form->createView()
        ]);
    }
	
	/**
     * @Route("/search-publication", name="app_search_publication")
     */
    public function searchPublication(Request $request, DeparturePublicationRepository $departurePublicationRepository)
    {
        $departureCity = $request->query->get('departureCity');
        $arrivalCity = $request->query->get('arrivalCity');

        $listPublications = $departurePublicationRepository->findByDepartureAndArrivalCity($departureCity, $arrivalCity);
        
        return $this->render('publication/search-publication.html.twig', [
            'departureCity' => $departureCity,
            'arrivalCity' => $arrivalCity,
            'publications' => $listPublications
        ]);
    }

    /**
     * @Route("/reserve-publication/{id}", name="app_reserve_publication")
     * @IsGranted("ROLE_USER")
     */
    public function reservePublication(Request $request, DeparturePublication $publication, SessionInterface $session)
    {
        $numberOfSeatsReserved = $request->request->get('numberOfSeatsReserved');
        if ($numberOfSeatsReserved > $publication->getRemainingSeats()) {
            $this->addFlash('danger', "Impossible de réserver plus de places que le nombre de places qu'il reste");

            return $this->redirectToRoute('app_search_publication');
        }

        $reservation = new Reservation;
        $reservation->setUser($this->getUser());
        $reservation->setDeparturePublication($publication);
        $reservation->setNumberOfSeats($numberOfSeatsReserved);
        $session->set('reservation', $reservation);

        return $this->redirectToRoute('app_pay_reservation');
    }
}
