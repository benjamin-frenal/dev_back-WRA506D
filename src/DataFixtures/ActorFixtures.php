<?php

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $firstNames = ['Alban', 'Brad', 'Bruce', 'Christian', 'Didier', 'Elodie', 'Eric', 'George', 'Gerard', 'Gerard', 'Gilles', 'Jean Claude', 'Jean', 'Johnny', 'Jonathan', 'Leonardo', 'Manu', 'Omar', 'Phillippe', 'Ramzy', 'Tarek', 'Taylor', 'Tom', 'Will'];
        $lastNames = ['Ivanov', 'Pitt', 'Willis', 'Clavier', 'Bourdon', 'Fontan', 'Judor', 'Clooney', 'Depardieu', 'Jugnor', 'Lellouche', 'Van Damme', 'DuJardin', 'Depp', 'Cohen', 'DiCaprio', 'Payet', 'Sy', 'Lacheau', 'Bedia', 'Boudali', 'Swift', 'Hanks', 'Smith'];

        foreach (range(1, 24) as $i) {
            $actor = new Author();
            $actor->setFirstName($firstNames[$i - 1]);
            $actor->setLastName($lastNames[$i - 1]);
            $actor->setNationalite($this->getReference('nationalite_'.rand(1, 10)));
            $actor->setImage($this->getReference('mediaObject_' . ($i)));
            $manager->persist($actor);
            $this->addReference('actor_' . $i, $actor);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            NationaliteFixtures::class,
        ];
    }
}
