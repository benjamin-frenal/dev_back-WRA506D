<?php

namespace App\DataFixtures;

use App\Entity\Nationalite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NationaliteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Génère 10 nationalités différentes et entre 2 et 4 acteurs différents (en lien avec les autres fixtures)

        $nationalites = ['Française', 'Américaine', 'Anglaise', 'Allemande', 'Espagnole', 'Italienne', 'Belge', 'Suisse', 'Canadienne', 'Japonaise'];
        foreach (range(1, 10) as $i) {
            $nationalite = new Nationalite();
            $nationalite->setNationalite($nationalites[rand(0, 9)]);
            $this->addReference('nationalite_' . $i, $nationalite);
            $manager->persist($nationalite);
        }

        $manager->flush();
    }
}
