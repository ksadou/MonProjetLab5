<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Content;

class ContentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 10000; $i++){
            $content = new Content();
            $content->setTitle("Titre $i")
                    ->setDescription("<p>Description du titre $i</p>");
            $manager->persist($content);
        }

        $manager->flush();
    }
}
