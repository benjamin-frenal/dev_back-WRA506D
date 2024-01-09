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
        $imageUrls = [
            '/src/assets/img/acteurs/alban_ivanov.webp',
            '/src/assets/img/acteurs/brad_pitt.webp',
            '/src/assets/img/acteurs/bruce_willis.webp',
            '/src/assets/img/acteurs/christian_clavier.webp',
            '/src/assets/img/acteurs/didier_bourdon.webp',
            '/src/assets/img/acteurs/elodie_fontan.webp',
            '/src/assets/img/acteurs/eric_judor.webp',
            '/src/assets/img/acteurs/george_clooney.webp',
            '/src/assets/img/acteurs/gerard_depardieu.webp',
            '/src/assets/img/acteurs/gerard_jugnot.webp',
            '/src/assets/img/acteurs/gilles_lellouche.webp',
            '/src/assets/img/acteurs/jean_claude_van_damme.webp',
            '/src/assets/img/acteurs/jean_dujardin.webp',
            '/src/assets/img/acteurs/johnny_depp.webp',
            '/src/assets/img/acteurs/jonathan_cohen.webp',
            '/src/assets/img/acteurs/leonardo_dicaprio.webp',
            '/src/assets/img/acteurs/manu_payet.webp',
            '/src/assets/img/acteurs/omar_sy.webp',
            '/src/assets/img/acteurs/philippe_lacheau.webp',
            '/src/assets/img/acteurs/ramzy_bedia.webp',
            '/src/assets/img/acteurs/tarek_boudali.webp',
            '/src/assets/img/acteurs/taylor_swift.webp',
            '/src/assets/img/acteurs/tom_hanks.webp',
            '/src/assets/img/acteurs/will_smith.webp',
        ];

        foreach (range(1, 24) as $i) {
            $actor = new Author();
            $actor->setFirstName($firstNames[$i - 1]);
            $actor->setLastName($lastNames[$i - 1]);
            $actor->setNationalite($this->getReference('nationalite_'.rand(1, 10)));
            $actor->setImage($imageUrls[$i - 1]);
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
