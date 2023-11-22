<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $categories = ['Disney', 'Marvel', 'Simpson', 'StarWars', 'Pixar'];

        foreach ($categories as $i => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('category_' . ($i + 1), $category); // Ajoute 1 à l'index pour correspondre aux références
        }

        $manager->flush();
    }
}
