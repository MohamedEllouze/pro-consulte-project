<?php

namespace App\DataFixtures;

use App\Entity\Specialist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $loremIpsum = file_get_contents(__DIR__.'/../../resources/loremipsum.txt');
        $descriptions = explode(PHP_EOL, $loremIpsum);

        for ($i = 0; $i <= 10; $i++) {
            $specialist = new Specialist();
            $specialist
                ->setFirstName('John '.$i)
                ->setLastName('Doe '.$i)
                ->setOnline($i % 2 === 0)
                ->setActive(true)
                ->setMobile('06000000' . str_pad($i, 2, '0', STR_PAD_LEFT))
                ->setCity(array_rand(["Lorient", "Paris", "Lyon", "Rennes", "Lille"]))
                ->setEmail(sprintf('specialist%d@email.com', $i))
                ->setDescription($descriptions[$i])
            ;
            $manager->persist($specialist);
        }

        $manager->flush();
    }
}
