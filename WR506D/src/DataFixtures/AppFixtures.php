<?php

// src/DataFixtures/AppFixtures.php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\User; // Assuming you have a User entity
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Xylis\FakerCinema\Provider\Person($faker));

        $fullName = $faker->actor; // Assuming $faker->actor returns a full name
        $nameParts = explode(' ', $fullName);

        $actor = new Actor();
        $actor->setLastname($nameParts[1] ?? ''); // Assuming the last name is the second part
        $actor->setFirstname($nameParts[0] ?? ''); // Assuming the first name is the first part
        $actor->setDob(new \DateTime('1980-01-01')); // Assuming setDob is a method in your Actor entity
        $actor->setCreatedAt(new \DateTimeImmutable());

        $manager->persist($actor);
        $manager->flush();
    }
}
