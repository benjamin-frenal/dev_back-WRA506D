<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Movie;
use DateTime;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    private $movieImages = [
        'Les Simpson',
        'Grey\'s Anatomy',
        'Desperate Housewives',
        'Malcolm',
        'Bluey',
        'Modern Family',
        'Loki',
        'Esprits Criminels',
        'American Dad !',
        'Ma famille D\'abord',
        'How i met your mother',
        'Ahsoka',
        'Futurama',
        'Les Griffin',
        'Prison Break',
        'Black Cake',
        'Percy Jackson',
        'Atlanta',
        'SunCoast',
        'Cristobal',
        'Periple d\'un Heros',
        'Solar Opposites',
        '911',
        'Encanto',
        'Les Indestructibles',
        'Buzz l\'Eclair',
        'La Reine des Neiges',
        'Le monde de dory',
        'Rebelle',
        'Vice Versa',
        'Aladdin',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this->movieImages as $title) {
            $movie = new Movie();
            $movie->setTitle($title);
            $movie->setReleaseDate(new DateTime());
            $movie->setDuration(rand(60, 180));
            $movie->setDescription('Synopsis for ' . $title);
            $movie->setCategory($this->getReference('category_' . rand(1, 10)));

            $actors = [];
            foreach (range(1, rand(2, 6)) as $j) {
                $actor = $this->getReference('actor_' . rand(1, 24));
                if (!in_array($actor, $actors)) {
                    $actors[] = $actor;
                    $movie->addActor($actor);
                }
            }

            $manager->persist($movie);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ActorFixtures::class,
        ];
    }
}
