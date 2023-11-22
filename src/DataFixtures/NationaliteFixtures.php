<?php

namespace App\DataFixtures;

use App\Entity\Nationalite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NationaliteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $nationalites = ['Française', 'Américaine', 'Anglaise', 'Allemande',
            'Espagnole', 'Italienne', 'Belge', 'Suisse', 'Canadienne', 'Japonaise'];
        foreach (range(1, 10) as $i) {
            $nationalite = new Nationalite();
            $nationalite->setNationalite($nationalites[rand(0, 9)]);
            $this->addReference('nationalite_' . $i, $nationalite);
            $manager->persist($nationalite);
        }
        $manager->flush();
    }
}
