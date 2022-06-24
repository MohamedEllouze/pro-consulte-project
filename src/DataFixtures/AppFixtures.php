<?php

namespace App\DataFixtures;

use App\Entity\Specialist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $specialist = new Specialist();
            $specialist
                ->setFirstName('John '.$i)
                ->setLastName('Doe '.$i)
                ->setOnline($i % 2 === 0)
                ->setActive(true)
            ;
            $manager->persist($specialist);
        }

        $manager->flush();
    }
}
