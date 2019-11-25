<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\DeparturePublication;

class PaymentController extends AbstractController
{
    /**
     * @Route("/pay-reservation", name="app_pay_reservation")
     */
    public function payReservation(SessionInterface $session)
    {
        if(!$session->has('reservation')) {
            throw new \RuntimeException('Pas de réservation disponible pour le paiement'); 
        }
        
        $reservation = $session->get('reservation');

        return $this->render('payment/pay-reservation.html.twig', [
            'reservation' => $reservation
        ]);
    }

    /**
     * @Route("/payment", name="app_payment")
     */
    public function payment(SessionInterface $session, EntityManagerInterface $em)
    {
        if(!$session->has('reservation')) {
            throw new \RuntimeException('Pas de réservation disponible pour le paiement'); 
        }

        $reservation = $session->get('reservation');
        $reservation->setUser($em->getRepository(User::class)->findOneBy(['id' => $reservation->getUser()->getId()]));
        $reservation->setDeparturePublication($em->getRepository(DeparturePublication::class)->findOneBy(['id' => $reservation->getDeparturePublication()->getId()]));
        $em->persist($reservation);

        $publication = $reservation->getDeparturePublication();
        $publication->setRemainingSeats($publication->getRemainingSeats() - $reservation->getNumberOfSeats());
        $em->flush();
        $session->remove('reservation');

        $this->addFlash('success', 'Réservation effectuée avec succès');

        return $this->redirectToRoute('app_homepage');
    }
}
