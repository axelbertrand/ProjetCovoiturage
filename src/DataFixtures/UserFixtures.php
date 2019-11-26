<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user1 = new User;
        $user1->setUsername('axelbertrand');
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            'axelbertrand'
        ));
        $user1->setFirstname('Axel');
        $user1->setLastname('Bertrand');
        $user1->setCountry('Canada');
        $user1->setCity('Chicoutimi');
        $user1->setEmail('axelbertrand@mail.com');
        $user1->setMaximumOfSeats(3);
        $user1->setCanSmoke(false);
        $user1->setCanAccessDriverPhoneNumber(false);
        $user1->setCanAccessDriverEmail(true);
        $user1->setCanPutSuitcase(false);
        $user1->setBankAccount(500);
        $manager->persist($user1);
        $this->addReference(User::class.'_0', $user1);

        $user2 = new User;
        $user2->setUsername('thomasmonneret');
        $user2->setPassword($this->passwordEncoder->encodePassword(
            $user2,
            'thomasmonneret'
        ));
        $user2->setFirstname('Thomas');
        $user2->setLastname('Monneret');
        $user2->setCountry('Canada');
        $user2->setCity('Chicoutimi');
        $user2->setEmail('thomasmonneret@mail.com');
        $user2->setMaximumOfSeats(5);
        $user2->setCanSmoke(false);
        $user2->setCanAccessDriverPhoneNumber(false);
        $user2->setCanAccessDriverEmail(true);
        $user2->setCanPutSuitcase(true);
        $user2->setBankAccount(0);
        $manager->persist($user2);
        $this->addReference(User::class.'_1', $user2);

        $manager->flush();
    }
}
