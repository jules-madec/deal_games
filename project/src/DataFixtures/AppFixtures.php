<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = ['Consoles', 'Jeux', 'Accessoires'];

        foreach ($categories as $nom) {
            $category = new Category();
            $category->setName($nom);
            $manager->persist($category);
        }

        $manager->flush();
    }
}
