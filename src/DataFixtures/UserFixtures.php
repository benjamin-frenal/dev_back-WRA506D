<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        protected UserPasswordHasherInterface $hasher
    ) {
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstName('Benjamin');
        $user->setLastName('Frenal');
        $user->setEmail('user@mail.com');
        $user->setPassword($this->hasher->hashPassword(
            $user,
            'test'
        ));
        $manager->persist($user);

        $manager->flush();
    }
}
