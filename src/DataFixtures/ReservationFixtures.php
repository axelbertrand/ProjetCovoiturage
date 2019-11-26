<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Reservation;
use App\Entity\User;
use App\Entity\DeparturePublication;

class ReservationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $reservation = new Reservation;
        $reservation->setNumberOfSeats(1);
        $reservation->setUser($this->getReference(User::class.'_1'));
        $reservation->setDeparturePublication($this->getReference(DeparturePublication::class.'_0'));
        $manager->persist($reservation);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
            DeparturePublicationFixtures::class
        ];
    }
}
