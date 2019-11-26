<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\DeparturePublication;
use App\Entity\User;

class DeparturePublicationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $departurePublication1 = new DeparturePublication;
        $departurePublication1->setDepartureCity('Saguenay');
        $departurePublication1->setArrivalCity('Québec');
        $departurePublication1->setDepartureDatetime(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $departurePublication1->setRemainingSeats(2);
        $departurePublication1->setUser($this->getReference(User::class.'_0'));
        $manager->persist($departurePublication1);
        $this->addReference(DeparturePublication::class.'_0', $departurePublication1);

        $departurePublication2 = new DeparturePublication;
        $departurePublication2->setDepartureCity('Saguenay');
        $departurePublication2->setArrivalCity('Montréal');
        $departurePublication2->setDepartureDatetime(new \DateTime(sprintf('-%d days', rand(1, 100))));
        $departurePublication2->setRemainingSeats(5);
        $departurePublication2->setUser($this->getReference(User::class.'_1'));
        $manager->persist($departurePublication2);
        $this->addReference(DeparturePublication::class.'_1', $departurePublication2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }
}
