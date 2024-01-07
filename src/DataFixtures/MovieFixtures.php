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
        'Les Simpson' => '/src/assets/img/miniatures/les-simpson.jpeg',
        'Grey\'s Anatomy' => '/src/assets/img/miniatures/greys-anatomy.jpeg',
        'Desperate Housewives' => '/src/assets/img/miniatures/desperate-housewives.jpeg',
        'Malcolm' => '/src/assets/img/miniatures/malcolm.jpeg',
        'Bluey' => '/src/assets/img/miniatures/bluey.jpeg',
        'Modern Family' => '/src/assets/img/miniatures/modern-family.jpeg',
        'Loki' => '/src/assets/img/miniatures/loki.jpeg',
        'Esprits Criminels' => '/src/assets/img/miniatures/esprits-criminels.jpeg',
        'American Dad !' => '/src/assets/img/miniatures/american-dad.jpeg',
        'Ma famille D\'abord' => '/src/assets/img/miniatures/ma-famille-dabord.jpeg',
        'How i met your mother' => '/src/assets/img/miniatures/how-i-met-your-mother.jpeg',
        'Ahsoka' => '/src/assets/img/miniatures/ahsoka.jpeg',
        'Futurama' => '/src/assets/img/miniatures/futurama.jpeg',
        'Les Griffin' => '/src/assets/img/miniatures/les-griffin.jpeg',
        'Prison Break' => '/src/assets/img/miniatures/prison-break.jpeg',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this->movieImages as $title => $imagePath) {
            $movie = new Movie();
            $movie->setTitle($title);
            $movie->setReleaseDate(new DateTime());
            $movie->setDuration(rand(60, 180));
            $movie->setDescription('Synopsis for ' . $title);
            $movie->setCategory($this->getReference('category_' . rand(1, 5)));
            $movie->setMiniature($imagePath);
            $movie->setBackground('/src/assets/img/background/' . strtolower(str_replace([' ', "'"], ['-', ''], $title)) . '.jpeg');
            $movie->setLogo('/src/assets/img/logo/' . strtolower(str_replace([' ', "'"], ['-', ''], $title)) . '.png');

            // Ajoute entre 2 et 6 acteurs dans le film, tous différents en se basant sur les fixtures
            $actors = [];
            foreach (range(1, rand(2, 6)) as $j) {
                $actor = $this->getReference('actor_' . rand(1, 10));
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
