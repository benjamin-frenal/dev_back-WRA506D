<?php

namespace App\DataFixtures;

use App\Entity\MediaObject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class MediaObjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $imageUrls = [
            'acteurs/alban_ivanov.webp',
            'acteurs/brad_pitt.webp',
            'acteurs/bruce_willis.webp',
            'acteurs/christian_clavier.webp',
            'acteurs/didier_bourdon.webp',
            'acteurs/elodie_fontan.webp',
            'acteurs/eric_judor.webp',
            'acteurs/george_clooney.webp',
            'acteurs/gerard_depardieu.webp',
            'acteurs/gerard_jugnot.webp',
            'acteurs/gilles_lellouche.webp',
            'acteurs/jean_claude_van_damme.webp',
            'acteurs/jean_dujardin.webp',
            'acteurs/johnny_depp.webp',
            'acteurs/jonathan_cohen.webp',
            'acteurs/leonardo_dicaprio.webp',
            'acteurs/manu_payet.webp',
            'acteurs/omar_sy.webp',
            'acteurs/philippe_lacheau.webp',
            'acteurs/ramzy_bedia.webp',
            'acteurs/tarek_boudali.webp',
            'acteurs/taylor_swift.webp',
            'acteurs/tom_hanks.webp',
            'acteurs/will_smith.webp',
        ];

        foreach (range(1, 24) as $i) {
            $mediaObject = new MediaObject();
            $mediaObject->setFilePath($imageUrls[$i - 1]);
            $manager->persist($mediaObject);
            $this->addReference('mediaObject_' . $i, $mediaObject);
        }

        $manager->flush();
    }
}